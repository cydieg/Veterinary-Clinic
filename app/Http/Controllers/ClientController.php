<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\PetHotel;
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
        $activeBranches = Branch::where('status', 'active')->get(); // Filter out inactive branches
        foreach ($activeBranches as $branch) {
            $bookedSlots = Appointment::where('appointment_date', $date)->where('branch_id', $branch->id)->count();
            $remainingSlots = $totalSlots - $bookedSlots;
            $futureAppointments[$date][$branch->id] = $remainingSlots;
        }
    }

    $branches = Branch::where('status', 'active')->get(); // Filter out inactive branches
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
            'service_type' => 'required|string',
        ]);

        $status = 'pending';

        $user = Auth::user();

        if (!$user->firstName || !$user->lastName) {
            return redirect()->back()->with('error', 'Please update your profile with your first name and last name before making an appointment.');
        }

        // Check if the user already has an appointment on the selected date
        $existingAppointment = $user->appointments()->where('appointment_date', $request->input('appointment_date'))->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'You already have a reservation on this date.');
        }

        // Get the number of existing appointments for the selected branch and date
        $existingAppointmentsCount = Appointment::where('appointment_date', $request->input('appointment_date'))
            ->where('branch_id', $request->input('branch_id'))
            ->count();

        // Check if the total appointments for the selected branch and date exceeds the limit (10)
        if ($existingAppointmentsCount >= 10) {
            return redirect()->back()->with('error', 'Sorry, all reservation slots for this branch on this date are filled. Please select another date.');
        }

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
            'service_type' => $request->input('service_type'),
            'appointment_slot' => 'Slot ' . $slotNumber
        ];

        // Check if the service type is Pet Hotel
        if ($request->input('service_type') === 'Pet Hotel') {
            $appointmentData['check_out_date'] = $request->input('check_out_date'); // Include check_out_date
            $appointmentData['size'] = $request->input('size'); // Include size

            // Calculate price based on size
            $price = 0;
            switch ($request->input('size')) {
                case 'small':
                    $price = 250;
                    break;
                case 'medium':
                    $price = 300;
                    break;
                case 'large':
                    $price = 400;
                    break;
            }
            $appointmentData['price'] = $price; // Include price

            // Create a new appointment
            $appointment = $user->appointments()->create($appointmentData);

            // Create a pet hotel reservation associated with the appointment
            $petHotel = new PetHotel([
                'check_out_date' => $request->input('check_out_date'),
                'size' => $request->input('size'),
                'price' => $price, // Include price in PetHotel
            ]);
            $appointment->petHotel()->save($petHotel);

            return redirect()->route('customer')->with('success', 'Pet hotel reservation requested successfully.');
        }

        // Create a regular appointment
        $user->appointments()->create($appointmentData);

        return redirect()->route('customer')->with('success', 'Appointment requested successfully. Please wait for a notification in your email.');
    }
}

