<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\Sale; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Mail\OrderProcessed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $encryptedBranchId = $request->input('branch_id');
        
        try {
            $branchId = $encryptedBranchId ? Crypt::decrypt($encryptedBranchId) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error, log the error message, or fallback to a default value
            $branchId = null; // Fallback to null in case of decryption failure
            \Log::error('Error decrypting branch ID: ' . $e->getMessage());
        }

        $branches = Branch::all();

        if (!$branchId && $branches->isNotEmpty()) {
            $branchId = $branches->first()->id;
            // Redirect to the index route with the selected branch ID
            return redirect()->route('shop.index', ['branch_id' => Crypt::encrypt($branchId)]);
        }

        $inventoryItems = Inventory::where('branch_id', $branchId)->paginate(9);

        return view('shop.shop', compact('inventoryItems', 'branches', 'branchId', 'encryptedBranchId'));
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $branchId = $request->input('branch_id');
    
        $user = Auth::user();
    
        $product = Inventory::findOrFail($productId);
    
        // Check if the requested quantity exceeds the available quantity
        if ($quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Failed to add product to cart. Requested quantity exceeds available quantity. Current available quantity: ' . $product->quantity);
        }
    
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
                'branch_id' => $branchId,
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

    public function order(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        // Retrieve the selected product from the cart
        $item = $user->cart()->where('product_id', $productId)->first();

        if (!$item) {
            return redirect()->route('cart.show')->with('error', 'Product not found in cart.');
        }

        // Calculate total price for the selected product
        $totalPrice = $item->product->price * $item->quantity;

        // Send email notification
        Mail::to($user->email)->send(new OrderProcessed([$item], $totalPrice));

        // Create a sale record for the selected product
        Sale::create([
            'user_id' => $user->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'branch_id' => $item->branch_id,
        ]);

        // Remove the ordered item from the cart
        $item->delete();

        return redirect()->route('cart.show')->with('success', 'Order placed successfully.');
    }

}