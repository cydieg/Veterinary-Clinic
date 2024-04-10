<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sale;
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
    public function dailyReports()
    {
          // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        // Get the current date
        $currentDate = now()->toDateString();

        // Get the authenticated user's branch
        $branchId = auth()->user()->branch_id;

        // Fetch sales data for the current date where status is delivered and for the authenticated user's branch
        $sales = Sale::whereDate('created_at', $currentDate)
                    ->where('status', 'delivered')
                    ->whereHas('branch', function ($query) use ($branchId) {
                        $query->where('id', $branchId);
                    })
                    ->with('product') // Eager load the related product
                    ->get();

        // Calculate total sales for the current date
        $totalSales = $sales->sum('total_price');

        return view('admin.reports.report', compact('sales', 'totalSales'));
    }
    public function weeklyReports()
    {
          // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        // Get the current week's start and end dates (Monday to Friday)
        $startDate = now()->startOfWeek()->addDays(1); // Monday
        $endDate = now()->startOfWeek()->addDays(5); // Friday

        // Fetch sales data for the current week (Monday to Friday) where status is delivered
        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
                    ->where('status', 'delivered')
                    ->whereHas('branch', function ($query) {
                        $query->where('id', auth()->user()->branch_id);
                    })
                    ->with('product') // Eager load the related product
                    ->get();

        // Calculate total sales for the current week
        $totalSales = $sales->sum('total_price');

        return view('admin.reports.weekly', compact('sales', 'totalSales', 'startDate', 'endDate'));
    }
    public function monthlyReports()
    {
          // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        // Initialize an empty array to store monthly sales data
        $monthlySales = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Get the start and end dates for the current month
            $startDate = now()->startOfYear()->addMonths($month - 1)->startOfMonth();
            $endDate = now()->startOfYear()->addMonths($month - 1)->endOfMonth();

            // Fetch sales data for the current month where status is delivered
            $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
                        ->where('status', 'delivered')
                        ->whereHas('branch', function ($query) {
                            $query->where('id', auth()->user()->branch_id);
                        })
                        ->with('product') // Eager load the related product
                        ->get();

            // Calculate total sales for the current month
            $totalSales = $sales->sum('total_price');

            // Store monthly sales data in the array
            $monthlySales[$startDate->format('F')] = [
                'sales' => $sales,
                'totalSales' => $totalSales,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        }

        return view('admin.reports.monthly', compact('monthlySales'));
    }
    public function yearlyReports()
{
      // Get the authenticated user's branch ID
    $branchId = auth()->user()->branch_id;
    // Initialize an empty array to store yearly sales data
    $yearlySales = [];

    // Get the current year
    $currentYear = now()->year;

    // Loop through each year
    for ($year = $currentYear; $year >= $currentYear - 3; $year--) {
        // Initialize an empty array to store monthly sales data for the current year
        $monthlySales = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Get the start and end dates for the current month and year
            $startDate = now()->setYear($year)->setMonth($month)->startOfMonth();
            $endDate = now()->setYear($year)->setMonth($month)->endOfMonth();

            // Fetch sales data for the current month and year where status is delivered
            $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
                        ->where('status', 'delivered')
                        ->whereHas('branch', function ($query) {
                            $query->where('id', auth()->user()->branch_id);
                        })
                        ->with('product') // Eager load the related product
                        ->get();

            // Calculate total sales for the current month and year
            $totalSales = $sales->sum('total_price');

            // Store monthly sales data in the array
            $monthlySales[$startDate->format('F')] = [
                'sales' => $sales,
                'totalSales' => $totalSales,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ];
        }

        // Store yearly sales data in the array
        $yearlySales[$year] = $monthlySales;
    }

    return view('admin.reports.yearly', compact('yearlySales'));
}

}


