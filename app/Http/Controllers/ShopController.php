<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Branch;
use Illuminate\Support\Facades\Session;

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

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Inventory::findOrFail($productId);

        // Retrieve the cart from session or create an empty array
        $cart = Session::get('cart', []);

        // Check if the product already exists in the cart
        if (array_key_exists($productId, $cart)) {
            // Increment the quantity if the product is already in the cart
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Add the product to the cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        // Store the updated cart back into the session
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);

        return view('shop.cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        // Retrieve the cart from session
        $cart = Session::get('cart', []);

        // Check if the product exists in the cart
        if (array_key_exists($productId, $cart)) {
            // Remove the product from the cart
            unset($cart[$productId]);
        }

        // Store the updated cart back into the session
        Session::put('cart', $cart);

        // Return a success response
        return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully.');
    }
}
