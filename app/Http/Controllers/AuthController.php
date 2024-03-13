<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Clinic; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\UserRegistered; 
class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        // Fetch all clinics from the database
        $clinics = Clinic::all(); // Update the model

        return view('logins.register', compact('clinics')); // Update the variable name
    }

        public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:50',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'middleName' => 'nullable|string|max:50',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer',
            'email' => 'required|email|max:50',
            'role' => 'required|in:super_admin,admin,staff,patient',
            'password' => 'required|string|max:255',
            'clinic_id' => $request->role === 'patient' ? 'nullable' : 'required|exists:clinics,id', 
        ]);

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Create the user
        $user = User::create($validatedData);

        // Send registration email
        Mail::to($user->email)->send(new UserRegistered($user));

        return redirect()->route('login.form');
    }


    public function showLoginForm()
    {
        return view('logins.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            // Check if the user has access to the current clinic
            if ($user->clinics_id === auth()->user()->clinics_id) {
                // Redirect based on the user's role
                switch ($user->role) {
                    case 'super_admin':
                        return redirect()->route('super_admin.home');
                    case 'admin':
                        return redirect()->route('admin.home');
                    case 'staff':
                        return redirect('/staff');
                    case 'patient':
                        return redirect()->route('customer');
                    default:
                        return redirect()->route('dashboard');
                }
            } else {
                // User does not have access to the current clinic
                Auth::logout();
                return redirect()->route('login.form')->with('error', 'You do not have access to this clinic.');
            }
        }

        // Redirect back to the login form if authentication fails
        return redirect()->route('login.form')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Get the currently authenticated user
            $user = Auth::user();

            // Log the user out
            Auth::logout();

            // Clear all session data
            Session::flush();

            // Redirect to the login form with a success message
            return redirect()->route('login.form')->with('success', "You have been logged out successfully, $user->name.");
        }

        // If the user is not logged in, simply redirect to the login form
        return redirect()->route('login.form');
    }
}
