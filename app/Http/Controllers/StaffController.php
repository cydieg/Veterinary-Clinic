<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Sale;
use App\Models\User;
use App\Models\Audit;
use App\Models\Cart;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentAccepted;
use App\Mail\AppointmentCancelled;
use App\Mail\FailedDeliveryNotification;
use App\Mail\DeliveryNotification;
use App\Models\Fee;



class StaffController extends Controller
{
    public function index()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve appointments for the designated clinic only
            $pendingAppointments = Appointment::where('status', 'pending')
                ->whereHas('branch', function ($query) use ($user) { // Updated relation to 'branch'
                    $query->where('id', $user->branch_id); // Updated field name to 'branch_id'
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

    public function pendingAppointment(Appointment $appointment)
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        try {
            // Send email notification
            Mail::to($appointment->user->email)->send(new AppointmentAccepted($appointment));

            // Update appointment status to 'accepted' for pending appointments
            $appointment->update(['status' => 'accepted']);

            // Redirect with success message
            return redirect()->route('staff')->with('success', 'Appointment accepted successfully');
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while accepting the appointment.');
        }
    }

    public function acceptedAppointments()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        try {
            // Get the authenticated user
            $user = Auth::user();

            // Retrieve accepted appointments with user information
            $acceptedAppointments = Appointment::where('status', 'accepted')
                ->where('branch_id', $user->branch_id) // Updated field name to 'branch_id'
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
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
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
        // Get the authenticated user's branch ID

        $branchId = auth()->user()->branch_id;
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

    // order product
    public function productOrder()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
    
        // Fetch sales related to the authenticated user's branch with category and subcategory
        $sales = Sale::with(['user', 'product', 'product.branch']) // Eager load product and its branch
            ->whereHas('branch', function ($query) use ($branchId) {
                $query->where('id', $branchId);
            })
            ->where('status', '!=', 'delivered')
            ->where('status', '!=', 'delivering')
            ->where('status', '!=', 'canceled')
            ->get();
    
        // Pass sales to the view
        return view('staff.productorder', compact('sales'));
    }
    
    
    //ito na
    public function deliverSale(Sale $sale, Request $request)
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;

        // Update sale status
        $sale->update(['status' => 'delivering']);

        // Send email notification
        Mail::to($sale->user->email)->send(new DeliveryNotification($sale));

        return redirect()->back()->with('success', 'Sale is being delivered');
    }




    //delivred product

    public function deliveringStatus()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;

        // Fetch delivering sales related to the authenticated user's branch
        $deliveringSales = Sale::with(['user', 'product', 'branch']) // Removed 'fee' to avoid unnecessary eager loading
            ->whereHas('branch', function ($query) use ($branchId) {
                $query->where('id', $branchId);
            })
            ->where('status', 'delivering')
            ->get();

        // Pass delivering sales to the view
        return view('staff.delivering_status', compact('deliveringSales'));
    }

    public function markAsDelivered($saleId)
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
        // Find the sale by ID
        $sale = Sale::findOrFail($saleId);

        // Check if the sale status is already delivered
        if ($sale->status === 'delivered') {
            return redirect()->back()->with('error', 'Sale has already been marked as delivered.');
        }

        // Update sale status to "delivered"
        $sale->status = 'delivered';
        $sale->save();

        // Deduct the quantity from inventory
        $inventory = Inventory::where('id', $sale->product_id)->where('branch_id', $sale->branch_id)->firstOrFail();
        $inventory->quantity -= $sale->quantity;
        $inventory->save();

        // Record audit
        $audit = new Audit();
        $audit->inventory_id = $inventory->id;
        $audit->upc = $inventory->upc; // Or whatever your UPC logic is
        $audit->name = $inventory->name; // Or any other relevant information from inventory
        $audit->old_quantity = $inventory->quantity + $sale->quantity; // Previous quantity before the sale
        $audit->quantity = $inventory->quantity; // New quantity after the sale
        $audit->type = 'sales';

        // Assign the description from inventory
        $audit->description = $inventory->description;

        $audit->save();

        return redirect()->back()->with('success', 'Sale marked as delivered successfully.');
    }
    public function dailySales()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;

        // Get the current date
        $currentDate = now()->toDateString();

        // Fetch delivered sales related to the authenticated user's branch for the current date
        $deliveredSales = Sale::with('product')
            ->where('branch_id', $branchId)
            ->where('status', 'delivered')
            ->whereDate('created_at', $currentDate)
            ->get();

        // Initialize an empty array to store total prices and quantity sold for each product
        $totalPrices = [];

        // Calculate total price and quantity sold for each product
        foreach ($deliveredSales as $sale) {
            $productId = $sale->product_id;

            // If the product is not yet added to the totalPrices array, initialize its values
            if (!isset($totalPrices[$productId])) {
                $totalPrices[$productId] = (object) [
                    'product' => $sale->product,
                    'totalPrice' => 0,
                    'quantitySold' => 0
                ];
            }

            // Accumulate total price and quantity sold
            $totalPrices[$productId]->totalPrice += $sale->total_price;
            $totalPrices[$productId]->quantitySold += $sale->quantity;
        }

        // Pass total prices to the view
        return view('staff.dailysales', compact('totalPrices'));
    }
    public function showInventory(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $category = $request->input('category'); // Get the category from the request
        $searchTerm = $request->input('search'); // Get the search term from the request
        
        try {
            // Fetch inventory items and distinct categories
            $query = Inventory::where('branch_id', $branchId);
        
            if ($category) {
                $query->where('category', $category);
            }
            
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%');
                });
            }
        
            $inventory = $query->get();
            $categories = Inventory::where('branch_id', $branchId)->pluck('category')->unique();
        
            return view('staff.store', compact('inventory', 'categories', 'category', 'searchTerm'));
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while retrieving inventory.');
        }
    }
    

    public function storePurchase(Request $request)
    {
        try {
            // Get the authenticated user's branch ID
            $branchId = auth()->user()->branch_id;

            // Retrieve the inventory item by ID
            $inventoryItem = Inventory::findOrFail($request->input('inventory_id'));

            // Calculate total price
            $totalPrice = $inventoryItem->price * $request->input('quantity');

            // Create a new sale
            $sale = new Sale();
            $sale->branch_id = $branchId;
            $sale->user_id = auth()->id();
            $sale->product_id = $inventoryItem->id;
            $sale->quantity = $request->input('quantity');
            $sale->total_price = $totalPrice;
            $sale->status = 'delivered'; // Automatically mark as delivered
            $sale->save();

            // Deduct the quantity from inventory
            $inventoryItem->quantity -= $request->input('quantity');
            $inventoryItem->save();

            return redirect()->route('staff.storePurchase')->with('success', 'Purchase recorded successfully.');
        } catch (\Exception $e) {
            // Log or handle the exception
            dd($e->getMessage()); // Add this line to see the error message
            return back()->with('error', 'An error occurred while recording the purchase.');
        }
    }
    public function failedDelivery(Sale $sale)
    {
        try {
            // Update sale status to 'canceled'
            $sale->update(['status' => 'canceled']);

            // Pass necessary data to the mail constructor
            $user = $sale->user;
            $product = $sale->product; // Assuming you have a relationship defined in Sale model
            // Pass $user, $product, and $sale to the FailedDeliveryNotification constructor
            Mail::to($sale->user->email)->send(new FailedDeliveryNotification($user, $product, $sale));

            return redirect()->back()->with('success', 'Sale marked as failed delivery successfully. User notified.');
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while marking the sale as failed delivery and notifying the user.');
        }
    }
    public function deliveringFee()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
    
        // Retrieve fee records for the authenticated user's branch only
        $fees = Fee::where('branch_id', $branchId)->get();
    
        // Pass the branch ID and fees to the view
        return view('staff.fee', compact('branchId', 'fees'));
    }
    

    public function saveDeliveringFee(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'branch_id' => 'required',
            'barangay' => 'required',
            'delivering_fee' => 'required|numeric',
        ]);

        // Create a new fee record
        Fee::create([
            'branch_id' => $request->branch_id,
            'barangay' => $request->barangay,
            'delivering_fee' => $request->delivering_fee,
        ]);

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Fee saved successfully.');
    }
    // StaffController.php

    public function updateDeliveringFee(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fee_id' => 'required',
            'edit_barangay' => 'required',
            'edit_delivering_fee' => 'required|numeric',
        ]);

        // Find the fee record
        $fee = Fee::findOrFail($request->fee_id);

        // Update the fee record
        $fee->update([
            'barangay' => $request->edit_barangay,
            'delivering_fee' => $request->edit_delivering_fee,
        ]);

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Fee updated successfully.');
    }
    



}
