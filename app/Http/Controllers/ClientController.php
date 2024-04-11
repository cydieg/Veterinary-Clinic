<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class ClientController extends Controller
{
    public function customer(Request $request)
    {
        $branchId = Auth::user()->branch_id;
        
        // Check if a specific date is requested, otherwise default to today
        $selectedDate = $request->input('date') ?? date('Y-m-d');
    
        // Get appointments for the selected date
        $appointments = Auth::user()->appointments()->where('appointment_date', $selectedDate)->get();
    
        // Calculate remaining reservation slots for the selected date
        $bookedSlots = Appointment::where('appointment_date', $selectedDate)->count(); // Number of booked slots for the selected date
        $totalSlots = 10; // Total slots per day
        $remainingSlots = $totalSlots - $bookedSlots;
    
        // Calculate remaining slots for the current date booked by the current user
        $currentDateBookedSlots = Auth::user()->appointments()->where('appointment_date', $selectedDate)->count();
        $currentDateRemainingSlots = $totalSlots - $currentDateBookedSlots;
    
        // Fetch appointments for the next 7 days to display available slots
        $nextWeekDates = [];
        for ($i = 1; $i <= 7; $i++) {
            $nextWeekDates[] = date('Y-m-d', strtotime("+$i day", strtotime($selectedDate)));
        }
    
        $futureAppointments = [];
        foreach ($nextWeekDates as $date) {
            $branches = Branch::all();
            foreach ($branches as $branch) {
                $bookedSlots = Appointment::where('appointment_date', $date)->where('branch_id', $branch->id)->count();
                $remainingSlots = $totalSlots - $bookedSlots;
                $futureAppointments[$date][$branch->id] = $remainingSlots;
            }
        }
    
        $branches = Branch::all();
        return view('client.customer', compact('appointments', 'branches', 'selectedDate', 'remainingSlots', 'futureAppointments', 'currentDateRemainingSlots'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'pet_name' => 'required|string',
            'animal_type' => 'required|string',
            'breed' => 'required|string',
            'description' => 'nullable|string',
            'service_type' => 'required|string',
        ]);

        $status = 'pending';

        $user = Auth::user();

        if (!$user->firstName || !$user->lastName) {
            return redirect()->back()->with('error', 'Please update your profile with your first name and last name before making an appointment.');
        }

        // Get the number of existing appointments for the selected branch and date
        $existingAppointmentsCount = Appointment::where('appointment_date', $request->input('appointment_date'))
            ->where('branch_id', $request->input('branch_id'))
            ->count();

        // Calculate the slot number
        $slotNumber = $existingAppointmentsCount + 1;

        $appointmentData = [
            'appointment_date' => $request->input('appointment_date'),
            'branch_id' => $request->input('branch_id'),
            'status' => $status,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'pet_name' => $request->input('pet_name'),
            'animal_type' => $request->input('animal_type'), // Include animal type in appointment data
            'breed' => $request->input('breed'),
            'description' => $request->input('description'),
            'service_type' => $request->input('service_type'),
            'appointment_slot' => 'Slot ' . $slotNumber,
        ];

        // Additional logic to check reservation slot limit (10 slots per day) can be added here

        $user->appointments()->create($appointmentData);

        return redirect()->route('customer')->with('success', 'Appointment requested successfully. Please wait for a notification in your email.');
    }
}