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

    // Inside your controller method, where you are rendering the view
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        
        // Fetch unique address components from existing users
        $addresses = [
            'regions' => User::distinct()->pluck('region')->filter()->toArray(),
            'provinces' => User::distinct()->pluck('province')->filter()->toArray(),
            'cities' => User::distinct()->pluck('city')->filter()->toArray(),
            'barangays' => User::distinct()->pluck('barangay')->filter()->toArray(),
        ];

        return view('superadmin.user.edit', compact('user', 'addresses'));
    }

    // Update user for super admin
public function update(Request $request, $id)
{
    // Validate if needed
    $request->validate([
        'username' => 'required|string|unique:users,username,' . $id,
        'firstName' => 'nullable|string',
        'lastName' => 'nullable|string',
        'middleName' => 'nullable|string',
        'gender' => 'nullable|in:male,female',
        'age' => 'nullable|integer|min:0',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|string|in:admin,patient,staff,super_admin',
        'branch_id' => 'nullable|exists:branches,id',
        'contact_number' => 'nullable|string|max:20', // Update field name to match form
        'region' => 'nullable|string',
        'province' => 'nullable|string',
        'city' => 'nullable|string',
        'barangay' => 'nullable|string',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

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
    ]);

    // Concatenate the address components into a single string
    $addressComponents = [
        'region' => $request->input('region_text'),
        'province' => $request->input('province_text'),
        'city' => $request->input('city_text'),
        'barangay' => $request->input('barangay_text'),
    ];
    $address = implode(', ', $addressComponents);

    // Add the concatenated address to the userData array
    $userData['address'] = $address;

    // Remove individual address components from userData array
    unset($userData['region'], $userData['province'], $userData['city'], $userData['barangay']);

    // Check if password field is present and not empty, then update password
    if ($request->filled('password')) {
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
    
        // Concatenate the address components into a single string
        $addressComponents = [
            'region' => $request->region_text,
            'province' => $request->province_text,
            'city' => $request->city_text,
            'barangay' => $request->barangay_text,
        ];
        $address = implode(', ', $addressComponents);
    
        // Add the concatenated address to validated data
        $validatedData['address'] = $address;
    
        // Remove individual address components from validated data
        unset($validatedData['region'], $validatedData['province'], $validatedData['city'], $validatedData['barangay']);
    
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
