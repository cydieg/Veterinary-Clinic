<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Clinic;
use App\Models\Audit;

class InventoryController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        $inventoryItems = Inventory::all();
        return view('inventory.index', compact('clinics', 'inventoryItems'));
    }

    public function store(Request $request)
    {
        // Validation rules for the form inputs
        $request->validate([
            // Your validation rules...
        ]);

        // Handle file upload...

        // Create new inventory item...
        
        // Create audit record for addition of the inventory item
        $inventory = Inventory::create([
            'upc' => $upc,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'category' => $request->category,
            'price' => $request->price,
            'created_at' => $request->created_at,
            'expiration' => $request->expiration,
            'clinic_id' => $request->clinic_id
        ]);

        Audit::create([
            'inventory_id' => $inventory->id,
            'upc' => $upc,
            'name' => $request->name,
            'description' => $request->description,
            'old_quantity' => 0, // Initial quantity is 0
            'quantity' => $request->quantity,
            'type' => 'inbound', // Type is inbound for addition
        ]);

        return redirect()->route('inventory.index')->with('success', 'Product added successfully.');
    }

    public function showAudit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $audits = Audit::where('inventory_id', $inventory->id)->get();

        return view('inventory.auditindex', compact('inventory', 'audits'));
    }

    public function addQuantity(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);

        // Validation rules for adding quantity...

        // Update the quantity of the inventory item...

        $inventory->quantity += $request->quantity;
        $inventory->save();

        // Create audit record for addition of quantity
        Audit::create([
            'inventory_id' => $inventory->id,
            'upc' => $inventory->upc,
            'name' => $inventory->name,
            'description' => $inventory->description,
            'old_quantity' => $inventory->quantity - $request->quantity,
            'quantity' => $request->quantity,
            'type' => 'inbound', // Type is inbound for addition
        ]);

        return redirect()->back()->with('success', 'Quantity added successfully.');
    }
}
