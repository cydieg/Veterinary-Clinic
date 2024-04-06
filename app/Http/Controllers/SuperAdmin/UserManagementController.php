<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;

class UserManagementController extends Controller
{
    // Display user table for super admin
    public function index()
    {
        $users = User::all(); // Retrieve all users
        return view('superadmin.user.index', compact('users'));
    }

    // Edit user for super admin
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('superadmin.user.edit', compact('user'));
    }

    // Update user for super admin
    public function update(Request $request, $id)
    {
        // Validate if needed

        $user = User::findOrFail($id);

        // Define the fields you want to allow updating
        $userData = $request->only([
            'username',
            'firstName',
            'lastName',
            'middleName',
            'gender',
            'age',
            'email',
            'role',
            'branch_id',
            'contact_number',
            'region',
            'province',
            'city',
            'barangay',
        ]);

        // Check if password field is present and not empty, then update password
        if ($request->has('password') && $request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        // Update user data
        $user->update($userData);

        return redirect()->route('superadmin.user.index')->with('success', 'User updated successfully');
    }

    // Add user for super admin
    public function create()
    {
        $branches = Branch::all(); // Retrieve all branches
        return view('superadmin.user.create', compact('branches')); // Update variable name
    }

    public function store(Request $request)
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


        return redirect()->route('superadmin.user.index')->with('success', 'User created successfully');
    }
    // Show user details for super admin
    public function show($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('superadmin.user.show', compact('user'));
    }

    // Archive user for super admin
    public function archive($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        // Archive user logic here, e.g., updating a column in the database
        // Example: $user->update(['archived' => true]);
        $user->delete(); // Delete the user

        return redirect()->route('superadmin.user.index')->with('success', 'User archived successfully');
    }
}
