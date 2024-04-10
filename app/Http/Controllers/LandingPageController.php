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



