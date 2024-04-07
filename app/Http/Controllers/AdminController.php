<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $branch = auth()->user()->branch;
        $users = User::where(function($query) use ($branch) {
                $query->where('branch_id', $branch->id) // Users of the current branch
                      ->whereIn('role', ['staff', 'admin']);
            })
            ->orWhere(function($query) {
                $query->whereNull('branch_id') // Users with null branch_id
                      ->where('role', 'patient');
            })
            ->get();

        return view('admin.index', compact('users'));
    } 
      
    // Show the form for creating a new user
    public function create()
    {
        // Assuming you have authenticated user and you're fetching the branch
        $branch = auth()->user()->branch;

        // Pass the branch to the view
        return view('admin.create', compact('branch'));
    }

    public function store(Request $request)
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

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }





    // Display the specified user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'middleName' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'gender' => 'required|in:male,female',
        'age' => 'required|integer|min:0',
        'role' => 'required|in:admin,patient,staff',
        'password' => 'nullable|string|min:6',
    ]);

    $user = User::findOrFail($id);
    $user->fill($request->all());

    // Update password only if provided and not empty
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    } else {
        // If password is not provided, remove it from the update array
        unset($user->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
}

    

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
