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

        $completedSales = Sale::where('status', 'delivered')->get();

        // Group sales by day, month, year, and week and calculate total price
        $salesByDay = $completedSales->groupBy(function ($sale) {
            return Carbon::parse($sale->created_at)->format('Y-m-d');
        })->map->sum('total_price');
    
        $salesByWeek = $completedSales->groupBy(function ($sale) {
            return Carbon::parse($sale->created_at)->format('Y-W');
        })->map->sum('total_price');
    
        $salesByMonth = $completedSales->groupBy(function ($sale) {
            return Carbon::parse($sale->created_at)->format('Y-m');
        })->map->sum('total_price');
    
        $salesByYear = $completedSales->groupBy(function ($sale) {
            return Carbon::parse($sale->created_at)->format('Y');
        })->map->sum('total_price');
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

        return view('superadmin.visualization.visualization', compact('branchesWithSalesCount', 'usersPerBranch', 'salesWithUserAddress', 'appointmentsByDay', 'appointmentsByMonth', 'appointmentsByYear','salesByDay', 'salesByWeek', 'salesByMonth', 'salesByYear'));
    } 
    
    public function report(Request $request)
    {
        // Get branch ID from the request, or use null if "All Branches" is selected
        $branchId = $request->input('branch_id');

        // Fetch delivered sales with associated user and product information for the current date and selected branch
        $currentDate = Carbon::today();
        $query = Sale::with(['product'])
            ->where('status', 'delivered')
            ->whereDate('created_at', $currentDate);

        // If a specific branch is selected, filter by that branch
        if ($branchId !== null) {
            $query->where('branch_id', $branchId);
        }

        // Retrieve sales data
        $deliveredSales = $query->get();

        // Compute total sales for the current date and selected branch
        $totalSales = $deliveredSales->sum('total_price');

        // Fetch branches to populate branch selection dropdown
        $branches = Branch::all();

        return view('superadmin.report', compact('deliveredSales', 'totalSales', 'currentDate', 'branches'));
    }


  
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }
    public function weeklyReport(Request $request)
{
    // Calculate the start and end dates for the current week (Monday to Sunday)
    $startDate = Carbon::now()->startOfWeek();
    $endDate = Carbon::now()->endOfWeek();

    // Get branches for the dropdown
    $branches = Branch::all();

    // Get selected branch ID from the request
    $branchId = $request->input('branch');

    // Query for sales based on branch selection
    $salesQuery = Sale::where('status', 'delivered');

    if ($branchId) {
        $salesQuery->where('branch_id', $branchId);
    }

    // Fetch delivered sales within the current week
    $salesWithinWeek = $salesQuery->whereBetween('created_at', [$startDate, $endDate])
                                    ->get();

    // Calculate total sales within the week
    $totalSalesWithinWeek = $salesWithinWeek->sum('total_price');

    // Pass the data to the view
    return view('superadmin.weeklyreport', [
        'startDate' => $startDate,
        'endDate' => $endDate,
        'salesWithinWeek' => $salesWithinWeek,
        'totalSalesWithinWeek' => $totalSalesWithinWeek,
        'branches' => $branches
    ]);
}
public function monthlyReport(Request $request)
{
    // Initialize an array to store monthly sales data
    $monthlySales = [];

    // Get branches for the dropdown
    $branches = Branch::all();

    // Loop through each month of the year
    for ($month = 1; $month <= 12; $month++) {
        // Calculate the start and end dates of the current month
        $startDate = Carbon::create(null, $month, 1)->startOfMonth();
        $endDate = Carbon::create(null, $month, 1)->endOfMonth();

        // Get selected branch ID from the request
        $branchId = $request->input('branch');

        // Query for sales based on branch selection
        $salesQuery = Sale::where('status', 'delivered')
                         ->whereBetween('created_at', [$startDate, $endDate]);

        if ($branchId) {
            $salesQuery->where('branch_id', $branchId);
        }

        // Fetch delivered sales within the current month
        $salesWithinMonth = $salesQuery->get();

        // Calculate total sales within the month
        $totalSalesWithinMonth = $salesWithinMonth->sum('total_price');

        // Store monthly sales data
        $monthlySales[$month] = [
            'month_name' => $startDate->format('F'),
            'total_sales' => $totalSalesWithinMonth,
            'sales_data' => $salesWithinMonth
        ];
    }

    return view('superadmin.monthlyreport', compact('monthlySales', 'branches'));
}

public function yearlyReport(Request $request)
{
    // Get the current year
    $currentYear = Carbon::now()->year;

    // Get branches for the dropdown
    $branches = Branch::all();

    // Get selected branch ID from the request
    $branchId = $request->input('branch');

    // Query for sales based on branch selection
    $salesQuery = Sale::where('status', 'delivered')
                     ->whereYear('created_at', $currentYear);

    if ($branchId) {
        $salesQuery->where('branch_id', $branchId);
    }

    // Fetch delivered sales for the current year
    $salesForCurrentYear = $salesQuery->get();

    // Calculate total sales for the current year
    $totalSalesForCurrentYear = $salesForCurrentYear->sum('total_price');

    return view('superadmin.yearlyreport', compact('salesForCurrentYear', 'totalSalesForCurrentYear', 'currentYear', 'branches'));
}

        

}
