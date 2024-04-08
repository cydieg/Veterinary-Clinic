<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Sale;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function visualization()
    {
        // Retrieve completed appointments
        $completedAppointments = Appointment::where('status', 'completed')->get();

        // Group appointments by day, month, and year and count them
        $appointmentsByDay = $completedAppointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->appointment_date)->format('Y-m-d');
        })->map->count();

        $appointmentsByMonth = $completedAppointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->appointment_date)->format('Y-m');
        })->map->count();

        $appointmentsByYear = $completedAppointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->appointment_date)->format('Y');
        })->map->count();

        // Get the number of users registered to each branch
        $usersPerBranch = User::select('branch_id', \DB::raw('count(*) as total'))
                            ->groupBy('branch_id')
                            ->get();

        // Get all delivered sales with the associated user's address
        $salesWithUserAddress = Sale::with(['user' => function ($query) {
                                        // Include necessary address-related fields
                                        $query->select('id', 'region', 'province', 'city', 'barangay', 'address');
                                    }])
                                    ->whereHas('user', function ($query) {
                                        // Filter by users whose sales have been delivered
                                        $query->where('status', 'delivered');
                                    })
                                    ->get();

        // Get all branches with their respective sales count
        $branchesWithSalesCount = Branch::withCount(['sales' => function ($query) {
                                            // Filter by sales that have been delivered
                                            $query->where('status', 'delivered');
                                        }])
                                        ->get();

        return view('superadmin.visualization.visualization', compact('branchesWithSalesCount', 'usersPerBranch', 'salesWithUserAddress', 'appointmentsByDay', 'appointmentsByMonth', 'appointmentsByYear'));
    }

}
