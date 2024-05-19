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
use Dompdf\Dompdf;
use Dompdf\Options;

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
        // Retrieve completed sales with associated user addresses
        $salesWithUserAddress = Sale::with([
            'user' => function ($query) {
                // Include necessary address-related fields
                $query->select('id', 'region', 'province', 'city', 'barangay', 'address');
            }
        ])
        ->where('status', 'delivered')
        ->get();
    
        // Group sales by day, month, year, and week and calculate total price
        $completedSales = $salesWithUserAddress->where('status', 'delivered');
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
        $usersPerBranch = User::select('branch_id', DB::raw('count(*) as total'))
            ->groupBy('branch_id')
            ->get();
    
        // Get all branches with their respective sales count
        $branchesWithSalesCount = Branch::withCount([
            'sales' => function ($query) {
                // Filter by sales that have been delivered
                $query->where('status', 'delivered');
            }
        ])
            ->get();
    
        return view('superadmin.visualization.visualization', compact('branchesWithSalesCount', 'usersPerBranch', 'salesWithUserAddress', 'appointmentsByDay', 'appointmentsByMonth', 'appointmentsByYear', 'salesByDay', 'salesByWeek', 'salesByMonth', 'salesByYear'));
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
        // Get branches for the dropdown
        $branches = Branch::all();

        // Initialize an array to store monthly sales data
        $monthlySales = [];

        // Get selected month from the request
        $selectedMonth = $request->input('month');

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // If a specific month is selected and it doesn't match the current iteration, skip to the next iteration
            if ($selectedMonth && $selectedMonth != $month) {
                continue;
            }

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
                'month_number' => $month, // Add the 'month_number' key
                'month_name' => $startDate->format('F'),
                'total_sales' => $totalSalesWithinMonth,
                'sales_data' => $salesWithinMonth
            ];

            // If a specific month is selected, break the loop after fetching data for that month
            if ($selectedMonth) {
                break;
            }
        }

        return view('superadmin.monthlyreport', compact('monthlySales', 'branches'));
    }


    public function yearlyReport(Request $request)
    {
        // Get the current year
        $currentYear = Carbon::now()->year;
    
        // Get branches for the dropdown
        $branches = Branch::all();
    
        // Get selected branch ID and date from the request
        $branchId = $request->input('branch');
        $selectedDate = $request->input('date');
    
        // Query for sales based on branch selection and date
        $salesQuery = Sale::where('status', 'delivered')
            ->whereYear('created_at', $currentYear);
    
        if ($branchId) {
            $salesQuery->where('branch_id', $branchId);
        }
    
        if ($selectedDate) {
            $salesQuery->whereDate('created_at', $selectedDate);
        }
    
        // Fetch delivered sales for the current year
        $salesForCurrentYear = $salesQuery->get();
    
        // Calculate total sales for the current year
        $totalSalesForCurrentYear = $salesForCurrentYear->sum('total_price');
    
        // Pass the data to the view
        return view('superadmin.yearlyreport', compact('salesForCurrentYear', 'totalSalesForCurrentYear', 'currentYear', 'branches'));
    }
    
    public function generatePDF(Request $request)
    {
        // Get the monthly sales data
        $monthlySales = $this->getMonthlySales($request);

        // Load the view into a variable
        $pdfView = view('superadmin.monthlyreport-pdf', compact('monthlySales'))->render();

        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($pdfView);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or download)
        return $dompdf->stream('monthly_sales_report.pdf');
    }
    private function getMonthlySales(Request $request)
    {
        $monthlySales = [];

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create(null, $month, 1)->startOfMonth();
            $endDate = Carbon::create(null, $month, 1)->endOfMonth();

            $branchId = $request->input('branch');

            $salesQuery = Sale::where('status', 'delivered')
                ->whereBetween('created_at', [$startDate, $endDate]);

            if ($branchId) {
                $salesQuery->where('branch_id', $branchId);
            }

            $salesWithinMonth = $salesQuery->get();

            $totalSalesWithinMonth = $salesWithinMonth->sum('total_price');

            $monthlySales[$month] = [
                'month_name' => $startDate->format('F'),
                'total_sales' => $totalSalesWithinMonth,
                'sales_data' => $salesWithinMonth
            ];
        }

        return $monthlySales;
    }
    public function generateDailySalesPDF(Request $request)
    {
        // Get the delivered sales data for the current date
        $deliveredSales = $this->getDeliveredSalesForCurrentDate($request);

        // Load the view for the daily sales report into a variable
        $pdfView = view('superadmin.daily-sales-pdf', compact('deliveredSales'))->render();

        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfView);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or download)
        return $dompdf->stream('daily_sales_report.pdf');
    }
    private function getDeliveredSalesForCurrentDate(Request $request)
    {
        // Get the current date
        $currentDate = Carbon::today();

        // Get branch ID from the request, if any
        $branchId = $request->input('branch_id');

        // Query delivered sales for the current date
        $query = Sale::with(['product'])
            ->where('status', 'delivered')
            ->whereDate('created_at', $currentDate);

        // Filter by branch if a specific branch is selected
        if ($branchId !== null) {
            $query->where('branch_id', $branchId);
        }

        // Retrieve delivered sales data
        return $query->get();
    }
    public function generateWeeklyReportPDF(Request $request)
    {
        // Calculate the start and end dates for the current week (Monday to Sunday)
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        // Get the weekly sales data
        $salesWithinWeek = $this->getWeeklySales($request, $startDate, $endDate);

        // Calculate total sales within the week
        $totalSalesWithinWeek = $salesWithinWeek->sum('total_price');

        // Get branches for the dropdown
        $branches = Branch::all();

        // Load the view for the weekly report PDF
        $pdfView = view('superadmin.weeklyreport-pdf', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'salesWithinWeek' => $salesWithinWeek,
            'totalSalesWithinWeek' => $totalSalesWithinWeek,
            'branches' => $branches
        ])->render();

        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfView);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or download)
        return $dompdf->stream('weekly_sales_report.pdf');
    }
    private function getWeeklySales(Request $request, $startDate, $endDate)
    {
        // Get branch ID from the request
        $branchId = $request->input('branch');

        // Query for sales based on branch selection
        $salesQuery = Sale::where('status', 'delivered');

        if ($branchId) {
            $salesQuery->where('branch_id', $branchId);
        }

        // Fetch delivered sales within the current week
        return $salesQuery->whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public function generateYearlyReportPDF(Request $request)
    {
        // Get the yearly sales data
        $yearlySales = $this->getYearlySales($request);

        // Filter out months with no sales
        $yearlySales = array_filter($yearlySales, function ($monthData) {
            return $monthData['total_sales'] > 0;
        });

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Load the view for the yearly report PDF
        $pdfView = view('superadmin.yearlyreport-pdf', compact('yearlySales', 'currentYear'))->render();

        // Create a new instance of Dompdf
        $dompdf = new Dompdf();

        // Load HTML content into Dompdf
        $dompdf->loadHtml($pdfView);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline or download)
        return $dompdf->stream('yearly_sales_report.pdf');
    }


    private function getYearlySales(Request $request)
    {
        $yearlySales = [];

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Get selected branch ID from the request
        $branchId = $request->input('branch');

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Calculate the start and end dates of the current month
            $startDate = Carbon::create(null, $month, 1)->startOfMonth();
            $endDate = Carbon::create(null, $month, 1)->endOfMonth();

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
            $yearlySales[$month] = [
                'month_name' => $startDate->format('F'),
                'total_sales' => $totalSalesWithinMonth,
                'sales_data' => $salesWithinMonth
            ];
        }

        return $yearlySales;
    }




}