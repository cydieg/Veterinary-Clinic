<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clinic; // Updated import statement
use Illuminate\Support\Facades\Hash;

class UserManagmentController extends Controller
{
    // Display user table
    public function index()
    {
        // Retrieve users except those with the role of "super_admin"
        $user_table = User::where('role', '!=', 'super_admin')->get();
    
        return view('usermanagement.usertable', compact('user_table'));
    }
    // Edit user
    public function editUser($id)
    {
        $user = User::find($id);
        return view('usermanagement.edituser', compact('user'));
    }

    // Update user
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->only([
            'username', 'email', 'firstName', 'lastName', 'middleName', 'address', 'gender', 'age', 'role'
        ]));

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        // Handle file upload

        // You might want to add validation and error handling here
        return redirect()->route('userTable')->with('success', 'User updated successfully');
    }

    public function showAddUserForm()
    {
        // Fetch all clinics from the database (updated variable name)
        $clinics = Clinic::all();

        return view('usermanagement.adduserform', compact('clinics'));
    }

    public function storeUser(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'firstName' => 'string|max:255', // Add validation for firstName
            'clinic_id' => 'required|exists:clinics,id', // Updated validation for clinic_id

        ]);

        // Handle file upload

        // Create a new user
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'middleName' => $request->input('middleName'),
            'address' => $request->input('address', ''), // Provide a default value
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'role' => $request->input('role'),
            'clinic_id' => $request->input('clinic_id'), // Updated field name
            'created_at' => now(),
        ]);

        return redirect()->route('userTable')->with('success', 'User added successfully');
    }

    public function getUserDetails($id)
    {
        $user = User::find($id);
        return view('usermanagement.userdetails', compact('user'));
    }

    public function showEditUserForm($id)
    {
        $user = User::find($id);
        return view('usermanagement.edituser', compact('user'));
    }
}
