<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sale;
use App\Models\Branch;
use App\Models\Audit;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            ->select('id', 'username', 'email', 'role', 'contact_number', 'age', 'gender', 'firstName', 'lastName', 'middleName', 'address', 'region', 'province', 'city', 'barangay') // Include region, province, city, and barangay fields
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
        $user = User::findOrFail($id);

        // Update user details
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->middleName = $request->input('middleName');
        $user->region = $request->input('region_text');
        $user->province = $request->input('province_text');
        $user->city = $request->input('city_text');
        $user->barangay = $request->input('barangay_text');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->role = $request->input('role');
        $user->contact_number = $request->input('contact_number'); // Update contact number

        // Concatenate address components
        $addressComponents = [
            $request->input('barangay_text'),
            $request->input('city_text'),
            $request->input('province_text'),
            $request->input('region_text')
        ];

        $user->address = implode(', ', array_filter($addressComponents));

        // Check if password field is not empty
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
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

    public function audit($productId)
    {
        // Fetch audit records related to the specified product ID
        $auditRecords = Audit::where('inventory_id', $productId)->get();

        // Assuming you need other data in the view, fetch it here if needed

        // Return the view with audit records
        return view('admininven.audit', compact('auditRecords'));
    }

    public function addinven()
    {
        return view('admininven.create');
    }
   // AdminController.php

   public function storeinven(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'expiration' => 'nullable|date',
            // Remove the 'branch_id' validation rule
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        } else {
            $validatedData['image'] = null; // Set default value if no image is uploaded
        }

        // Generate UPC
        $validatedData['upc'] = rand(100000000000, 999999999999); // Generate a random UPC

        // Set the creation date
        $validatedData['created_at'] = now();

        // Manually assign the branch_id
        $validatedData['branch_id'] = auth()->user()->branch_id; // Assuming authenticated user has branch_id

        // Create the product
        Inventory::create($validatedData);

        return redirect()->route('admin.inventory.indexadmin')->with('success', 'Product added successfully');
    }

   

    public function addQuantity(Request $request, $productId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1', // Example validation rules
        ]);
    
        // Find the inventory item by ID
        $inventoryItem = Inventory::findOrFail($productId);
    
        // Store the old quantity for audit
        $oldQuantity = $inventoryItem->quantity;
    
        // Add the quantity to the existing quantity
        $inventoryItem->quantity += $request->quantity;
    
        // Save the changes
        $inventoryItem->save();
    
        // Create an audit record for the quantity addition
        Audit::create([
            'inventory_id' => $inventoryItem->id,
            'upc' => $inventoryItem->upc,
            'name' => $inventoryItem->name,
            'description' => $inventoryItem->description,
            'old_quantity' => $oldQuantity,
            'quantity' => $request->quantity,
            'type' => 'addition',
        ]);
    
        // Redirect back or wherever appropriate
        return redirect()->back()->with('success', 'Quantity added successfully');
    }


 
}


