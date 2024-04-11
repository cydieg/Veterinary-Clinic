<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;

class LandingPageController extends Controller

{
    public function home()
    {
        return view('Landing_Page.Home');
    }

    public function services()
    {
        return view('Landing_Page.Services');
    }

    public function ourClinic()
    {
        return view('Landing_Page.OurClinic');
    }

    public function ourShop(Request $request)
    {
        // Define available categories
        $categories = ['Dog', 'Cat', 'Fish', 'Bird'];
    
        // Initialize variable to hold inventory items
        $inventoryItems = Inventory::query();
    
        // Check if a category is selected
        if ($request->has('category')) {
            $category = $request->input('category');
            if ($category !== 'All' && in_array($category, $categories)) {
                // Filter inventory items by selected category
                $inventoryItems->where('category', $category);
            }
        }
    
        // Retrieve filtered inventory items
        $inventoryItems = $inventoryItems->get();
    
        // Pass categories and inventory data to the view
        return view('Landing_Page.OurShop', compact('categories', 'inventoryItems'));
    }

    public function search(Request $request)
{
    // Check if there is a search query
    if ($request->has('query')) {
        $query = $request->input('query');
        // Perform search for inventory items with names containing the query
        $inventoryItems = Inventory::where('name', 'like', '%' . $query . '%')->get();
    } else {
        // If no search query, fetch all inventory items
        $inventoryItems = Inventory::all();
    }

    // Pass inventory data to the view
    return view('Landing_Page.OurShop', compact('inventoryItems'));
}
    public function contactUs()
    {
        return view('Landing_Page.ContactUs');
    }

    public function ourGallery()
    {
        return view('Landing_Page.OurGallery');
    }
}



