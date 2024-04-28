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
use Illuminate\Support\Facades\URL;




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

        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['region'] = $request->region_text;
        $validatedData['province'] = $request->province_text;
        $validatedData['city'] = $request->city_text;
        $validatedData['barangay'] = $request->barangay_text;

        $addressComponents = [
            'region' => $request->region_text,
            'province' => $request->province_text,
            'city' => $request->city_text,
            'barangay' => $request->barangay_text,
        ];

        $address = implode(', ', $addressComponents);

        $validatedData['address'] = $address;

        $validatedData['status'] = 'pending';

        $user = User::create($validatedData);

        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id]
        );

        Mail::to($user->email)->send(new UserRegistered($user, $verificationUrl));

        return redirect()->route('login.form')->with('success', 'Registration successful. Please check your email for verification instructions.');
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
            if ($user->status === 'verified') {
                if ($user->branch_id === auth()->user()->branch_id) {
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
                    Auth::logout();
                    return redirect()->route('login.form')->with('error', 'You do not have access to this branch.');
                }
            } else {
                Auth::logout();
                return redirect()->route('login.form')->with('error', 'Your account is not verified. Please check your email for verification instructions.');
            }
        }

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
    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the user's status is pending
        if ($user->status === 'pending') {
            // Update the user's status to verified
            $user->status = 'verified';
            $user->save();

            return redirect()->route('login.form')->with('success', 'Email verification successful. You can now login.');
        }

        // If the user's status is already verified, redirect with a message
        return redirect()->route('login.form')->with('info', 'Your email is already verified.');
    }

}
