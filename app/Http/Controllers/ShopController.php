<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Branch;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $branchId = $request->input('branch_id');
        $branches = Branch::all();
        
        // If Branch ID is provided in the request, get the ID of the first Branch in the database
        if (!$branchId && $branches->isNotEmpty()) {
            $branchId = $branches->first()->id;
        }
        
        // Fetch inventory items based on the provided or default branch ID
        $inventoryItems = Inventory::where('branch_id', $branchId)->paginate(9);

        return view('shop.shop', compact('inventoryItems', 'branches', 'branchId'));
    }

    public function orderProduct(Request $request)
    {
        // Validate request
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new sale
        Sale::create([
            'inventory_id' => $request->input('inventory_id'),
            'quantity_sold' => $request->input('quantity'),
            'user_id' => Auth::id(),
            'status' => 'pending', // Initial status
        ]);

        return redirect()->back()->with('success', 'Product ordered successfully!');
    }
}
