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

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            // Add other validation rules as needed
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

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
