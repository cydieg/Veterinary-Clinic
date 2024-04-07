<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Sale;
use App\Models\User;
use App\Models\Audit;
use App\Models\Inventory;
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

    public function acceptedAppointments()
    {
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
    
   // order product
    public function productOrder()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;

        // Fetch sales related to the authenticated user's branch
        $sales = Sale::with('user', 'product', 'branch')
                    ->whereHas('branch', function ($query) use ($branchId) {
                        $query->where('id', $branchId);
                    })
                    ->where('status', '!=', 'delivered') // Exclude 'delivered' sales
                    ->get();

        // Pass sales to the view
        return view('staff.productorder', compact('sales'));
    }

    public function deliverSale(Sale $sale, Request $request)
    {
        
        $sale->update(['status' => 'delivering']);
    
        
        return redirect()->back()->with('success', 'Sale is being delivered');
    }



    //delivred product

    public function deliveringStatus()
    {
        // Get the authenticated user's branch ID
        $branchId = auth()->user()->branch_id;
    
        // Fetch sales with delivering status related to the authenticated user's branch
        $deliveringSales = Sale::with('user', 'product', 'branch')
                            ->where('branch_id', $branchId) // Filter by branch_id directly
                            ->where('status', 'delivering')
                            ->get();
    
        // Pass delivering sales to the view
        return view('staff.delivering_status', compact('deliveringSales'));
    }
   
    public function markAsDelivered($saleId)
    {
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
        try {
            // Get the authenticated user's branch ID
            $branchId = auth()->user()->branch_id;

            // Fetch sales for the current date with status 'delivered' related to the authenticated user's branch
            $dailySales = Sale::with('user', 'product', 'branch')
                            ->where('branch_id', $branchId)
                            ->whereDate('created_at', now()->toDateString()) // Filter by current date
                            ->where('status', 'delivered')
                            ->get();

            // Pass daily sales to the view
            return view('staff.dailysales', compact('dailySales'));
        } catch (\Exception $e) {
            // Log or handle the exception
            return back()->with('error', 'An error occurred while retrieving daily sales.');
        }
    }







        
    
    
    


    


}
