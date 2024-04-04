<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Branch;
use App\Models\Cart; 
use Illuminate\Support\Facades\Session;
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

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $user = Auth::user();

        $product = Inventory::findOrFail($productId);

        // Check if the product already exists in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Increment the quantity if the product is already in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Add the product to the user's cart
            $user->cart()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

        public function showCart()
    {
        $user = Auth::user();
        $cart = $user->cart()->with('product')->get();

        // Calculate total price
        $totalPrice = $cart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('shop.cart', compact('cart', 'totalPrice'));
    }


    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        $user = Auth::user();

        // Find the cart item for the user and the product
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Remove the cart item
            $cartItem->delete();
        }

        return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully.');
    }
}
