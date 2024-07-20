@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')

@section('content')

<style>
    /* Additional styling */
    .form-group {
        margin-bottom: 20px; /* Add some spacing between form groups */
    }
    .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
    }
    .action-buttons button {
        margin-right: 5px; /* Add some spacing between buttons */
        font-size: 12px; /* Adjust button font size */
    }
    .button-container form {
        display: inline-block; /* Make forms display inline */
    }
    .button-container form:first-child {
        margin-right: 10px; /* Add margin between buttons */
    }
    .table-responsive {
        margin-bottom: 15px; /* Add some spacing below the table */
    }
</style>

<div class="col-md-7 col-lg-8 col-xl-9">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="container p-3 my-3 custom-bg-color text-white">Shopping Cart</div>
                <div class="table-responsive">
                    <table class="table mt-4 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Courier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            @if ($item->cart_status !== 'PlacedOrder')
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>₱{{ $item->product->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₱{{ $item->product->price * $item->quantity }}</td>
                                <td>{{ $item->courier }}</td>
                                <td class="button-container">
                                    <form method="POST" action="{{ route('cart.order') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <button type="submit" class="btn btn-success btn-sm">Place Order</button>
                                    </form>
                                    <form method="POST" action="{{ route('cart.remove') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Price</h5>
                <p class="card-text">Total: ₱{{ $totalPrice }}</p>
                <p class="card-text">Delivering Fee: ₱{{ $deliveringFee }}</p>
                <p class="card-text">Grand Total: ₱{{ $totalPrice + $deliveringFee }}</p>
            </div>
        </div>
        <a href="/showDashboard" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
