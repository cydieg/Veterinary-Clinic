<?php

// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;

class ClientController extends Controller
{
    public function customer()
    {
        $clinicId = Auth::user()->clinic_id;
        $appointments = Auth::user()->appointments()->whereHas('user', function ($query) use ($clinicId) {
            $query->where('clinic_id', $clinicId);
        })->get();
        $clinics = Clinic::all();
        return view('client.customer', compact('appointments', 'clinics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string|in:08:00,09:00,10:00,11:00,13:00,15:00,17:00',
            'clinic_id' => 'required|exists:clinics,id',
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
            'clinic_id' => $request->input('clinic_id'),
            'status' => $status,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
        ];
    
        $user->appointments()->create($appointmentData);
    
        return redirect()->route('customer')->with('success', 'Appointment requested successfully. Please wait for a notification in your email.');
    }
}
