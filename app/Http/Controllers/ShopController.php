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
use Carbon\Carbon;
use App\Models\Rating;
use Illuminate\Support\Collection;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the encrypted branch ID from the request
        $encryptedBranchId = $request->input('branch_id');
    
        try {
            // Decrypt the encrypted branch ID
            $branchId = $encryptedBranchId ? Crypt::decrypt($encryptedBranchId) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error, log the error message, or fallback to a default value
            $branchId = null; // Fallback to null in case of decryption failure
            \Log::error('Error decrypting branch ID: ' . $e->getMessage());
        }
    
        // Retrieve all branches
        $branches = Branch::all();
    
        // If branch ID is not provided and there are branches available, set the first branch ID and redirect
        if (!$branchId && $branches->isNotEmpty()) {
            $branchId = $branches->first()->id;
            // Redirect to the index route with the selected branch ID
            return redirect()->route('shop.index', ['branch_id' => Crypt::encrypt($branchId)]);
        }
    
        // Retrieve inventory items for the selected branch
        $inventoryQuery = Inventory::where('branch_id', $branchId);
    
        // Filter by category if provided in the request
        if ($request->has('category')) {
            $category = $request->input('category');
            $inventoryQuery->where('category', $category);
        }
    
        // Filter by search query if provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $inventoryQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
    
        // Ensure that only products belonging to the selected branch are retrieved
        $inventoryQuery->where('branch_id', $branchId);
    
        // Retrieve the paginated inventory items
        $inventoryItems = $inventoryQuery->paginate(9);
    
        // Fetch hot items based on sales data with status 'delivered' and quantity over 200 for the selected branch
        $hotItemsQuery = Sale::where('status', 'delivered')
                             ->where('quantity', '>=', 200)
                             ->where('branch_id', $branchId);
    
        // Filter hot items by category if provided in the request
        if ($request->has('category')) {
            $category = $request->input('category');
            $hotItemsQuery->whereHas('product', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }
    
        $hotItems = $hotItemsQuery->get();
    
        // Pass the data to the view and render it
        return view('shop.shop', compact('inventoryItems', 'branches', 'branchId', 'encryptedBranchId', 'hotItems', 'request'));
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

        // Calculate total price for the product
        $totalPrice = $product->price * $quantity;

        // Check if the product already exists in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Increment the quantity and update total price if the product is already in the cart
            $cartItem->quantity += $quantity;
            $cartItem->total_price += $totalPrice;
            $cartItem->save();
        } else {
            // Add the product to the user's cart
            $user->cart()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
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
            'total_price' => $totalPrice, // Record the total price
        ]);
    
        // Remove the ordered item from the cart
        $item->delete();
    
        return redirect()->route('cart.show')->with('success', 'Order placed successfully.');
    }
    public function history()
    {
        // Retrieve the user's purchase history
        $user = Auth::user();
        
        // Retrieve sales records for delivered, pending, and canceled products that are not older than a day
        $sales = Sale::where('user_id', $user->id)
                     ->whereIn('status', ['delivering', 'delivered', 'pending', 'canceled'])
                     ->where('created_at', '>=', Carbon::now()->subDay())
                     ->get();
    
        // Pass the filtered purchase history to the view and render it
        return view('shop.history', compact('sales'));
    }
    public function create($sale_id)
    {
        $sale = Sale::findOrFail($sale_id);
        return view('shop.ratings', compact('sale'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'rating' => 'required|integer|min:1|max:6',
            'comment' => 'nullable|string|max:255',
        ]);

        // Create a new rating instance
        $rating = new Rating([
            'sale_id' => $request->sale_id,
            'user_id' => auth()->id(), // Assuming you are using authentication
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Save the rating to the database
        $rating->save();

        // Redirect to the home page with a thank you message
        return redirect('/showDashboard')->with('success', 'Thank you for your response!');
    }
    public function viewRatings($itemId)
    {
        $ratings = Rating::whereHas('sale', function ($query) use ($itemId) {
            $query->where('product_id', $itemId);
        })->get();
    
        // Calculate the total rating points and the total number of ratings
        $totalRatingPoints = $ratings->sum('rating');
        $totalRatings = $ratings->count();
    
        // Calculate the average rating
        $averageRating = $totalRatings > 0 ? $totalRatingPoints / $totalRatings : 0;
    
        // Convert the average rating into a percentage with two decimal places
        $totalPercentage = number_format($averageRating * 20, 2); // Since each star represents 20%
    
        return view('shop.viewratings', compact('ratings', 'totalPercentage'));
    }
    
    
    

}