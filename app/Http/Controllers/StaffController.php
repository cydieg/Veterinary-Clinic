<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCompleted;
use App\Mail\AppointmentCancelled; 

class StaffController extends Controller
{
    public function index()
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve appointments for the designated clinic only
            $pendingAppointments = Appointment::where('status', 'pending')
                ->whereHas('clinic', function ($query) use ($user) {
                    $query->where('id', $user->clinic_id);
                })
                ->get();

            // Filter out completed appointments
            $pendingAppointments = $pendingAppointments->reject(function ($appointment) {
                return $appointment->status === 'completed';
            });

            return view('staff.staff', compact('pendingAppointments'));
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while retrieving appointments.');
        }
    }

    public function pendingAppointment(Appointment $appointment) //this is where pending appointment
{
    try {
        // Send email notification
        Mail::to($appointment->user->email)->send(new AppointmentCompleted($appointment));

        // Update appointment status to 'accepted' for pending appointments
        $appointment->update(['status' => 'accepted']);

        // Redirect with success message
        return redirect()->route('staff')->with('success', 'Appointment accepted successfully');
    } catch (\Exception $e) {
        // Log or handle the exception
        return back()->with('error', 'An error occurred while accepting the appointment.');
    }
}
    public function acceptedAppointments() //this will show the accepeted appointment
        {
            try {
                // Get the authenticated user
                $user = Auth::user();

                // Retrieve accepted appointments with user information
                $acceptedAppointments = Appointment::where('status', 'accepted')
                    ->where('clinic_id', $user->clinic_id)
                    ->with('user') // Eager load user information
                    ->get();

                return view('staff.acceptedappoint', compact('acceptedAppointments'));
            } catch (\Exception $e) {
                // Log or handle the exception
                return back()->with('error', 'An error occurred while retrieving accepted appointments.');
            }
        }
        public function completeAppointment(Appointment $appointment)
    {
        try {
            // Update appointment status to 'completed'
            $appointment->update(['status' => 'completed']);

            // Redirect with success message
            return redirect()->route('staff.acceptedappoint')->with('success', 'Appointment completed successfully');
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while completing the appointment.');
        }
    }
    public function homeStaff()
    {
        return view('staff.homeStaff');
    }
    public function cancelAppointment(Appointment $appointment)
    {
        try {
            // Update appointment status to 'canceled'
            $appointment->update(['status' => 'canceled']);
    
            // Send email notification
            Mail::to($appointment->user->email)->send(new AppointmentCancelled($appointment));
    
            // Redirect with success message
            return redirect()->route('staff')->with('success', 'Appointment canceled successfully');
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while canceling the appointment.');
        }
    }
    
}
