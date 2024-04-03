<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Branch;
use App\Models\Audit;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $inventoryItems = Inventory::all();
        return view('inventory.index', compact('branches', 'inventoryItems'));
    }

    public function store(Request $request)
{
    // Validation rules for the form inputs
    $request->validate([
        // Your validation rules...
    ]);

    // Handle file upload
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
    } else {
        $imageName = null; // Set default value if no image is uploaded
    }

    // Generate UPC code (using timestamp and inventory ID)
    $upc = time() . Inventory::max('id');

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
        'branch_id' => $request->branch_id
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
        public function indexadmin()
    {
        // Get the authenticated user's clinic ID
        $branchId = auth()->user()->branch_id;

        // Retrieve the inventory items for the user's clinic
        $inventoryItems = Inventory::whereHas('branch', function ($query) use ($branchId) {
            $query->where('id', $branchId);
        })->get();

        return view('admininven.indexadmin', compact('inventoryItems'));
    }
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Delete the associated image file if it exists
        if ($inventory->image && Storage::exists('public/images/' . $inventory->image)) {
            Storage::delete('public/images/' . $inventory->image);
        }

        // Delete the inventory item
        $inventory->delete();

        return redirect()->route('admin.inventory.indexadmin')->with('success', 'Product deleted successfully.');
    }

}
