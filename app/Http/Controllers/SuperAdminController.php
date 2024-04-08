<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use App\Models\Sale;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Get all branches with their respective sales count
        $branchesWithSalesCount = Branch::select('id', 'name')
                                        ->withCount('sales') // Count of sales associated with each branch
                                        ->get();

        // Get the number of users registered to each branch
        $usersPerBranch = User::select('branch_id', \DB::raw('count(*) as total'))
                              ->groupBy('branch_id')
                              ->get();
    
        // Get all delivered sales with the associated user's address
        $salesWithUserAddress = Sale::with(['user' => function ($query) {
                                        // Include necessary address-related fields
                                        $query->select('id', 'region', 'province', 'city', 'barangay', 'address');
                                    }])
                                    ->where('status', 'delivered')
                                    ->get();
    
        return view('superadmin.visualization.visualization', compact('branchesWithSalesCount', 'usersPerBranch', 'salesWithUserAddress'));
    }
    
    


        
    
}
