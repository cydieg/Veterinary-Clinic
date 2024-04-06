<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Branch; // Update namespace
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;




class AuthController extends Controller
{
    
    public function showRegistrationForm()
    {
        // Fetch all branches from the database
        $branches = Branch::all(); // Update the model

        return view('logins.register', compact('branches')); // Update the variable name
    }

   public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required|string|max:50',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'middleName' => 'nullable|string|max:50',
            'gender' => 'required|in:male,female,other',
            'age' => 'required|integer',
            'email' => 'required|email|max:50',
            'role' => 'required|in:super_admin,admin,staff,patient',
            'password' => 'required|string|max:255',
            'branch_id' => $request->role === 'patient' ? 'nullable' : 'required|exists:branches,id',
            'contact_number' => 'nullable|string|max:20',
            'region' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
        ]);

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);


         // Add the actual names of region, province, city, and barangay
            $validatedData['region'] = $request->region_text;
            $validatedData['province'] = $request->province_text;
            $validatedData['city'] = $request->city_text;
            $validatedData['barangay'] = $request->barangay_text;

        // Construct the address from individual components
        $addressComponents = [
            'region' => $request->region_text,
            'province' => $request->province_text,
            'city' => $request->city_text,
            'barangay' => $request->barangay_text,
        ];

        // Concatenate the address components into a single string
        $address = implode(', ', $addressComponents);

        // Add the concatenated address to validated data
        $validatedData['address'] = $address;

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
            // Check if the user has access to the current branch
            if ($user->branch_id === auth()->user()->branch_id) { // Update field name
                // Redirect based on the user's role
                switch ($user->role) {
                    case 'super_admin':
                        return redirect()->route('super_admin.dashboard');

                    case 'admin':
                        return redirect()->route('admin.home');
                    case 'staff':
                        return redirect('/staff');
                    case 'patient':
                        return redirect()->route('showDashboard');
                    default:
                        return redirect()->route('dashboard');
                }
            } else {
                // User does not have access to the current branch
                Auth::logout();
                return redirect()->route('login.form')->with('error', 'You do not have access to this branch.'); // Update message
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
