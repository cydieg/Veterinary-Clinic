<?php

// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch; // Update namespace

class ClientController extends Controller
{
    public function customer()
    {
        $branchId = Auth::user()->branch_id; // Update clinic_id to branch_id
        $appointments = Auth::user()->appointments()->whereHas('user', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId); // Update clinic_id to branch_id
        })->get();
        $branches = Branch::all(); // Update model name
        return view('client.customer', compact('appointments', 'branches')); // Update variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string|in:08:00,09:00,10:00,11:00,13:00,15:00,17:00',
            'branch_id' => 'required|exists:branches,id', // Update clinic_id to branch_id
        ]);
    
        $status = 'pending';
    
        $user = Auth::user();
    
        // Ensure the user has first name and last name
        if (!$user->firstName || !$user->lastName) {
            return redirect()->back()->with('error', 'Please update your profile with your first name and last name before making an appointment.');
        }
    
        $appointmentData = [
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'branch_id' => $request->input('branch_id'), // Update clinic_id to branch_id
            'status' => $status,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
        ];
    
        $user->appointments()->create($appointmentData);
    
        return redirect()->route('customer')->with('success', 'Appointment requested successfully. Please wait for a notification in your email.');
    }
}
