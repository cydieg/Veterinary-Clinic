@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Shopping Cart Content -->
            <div class="col-lg-12">
                <div class="container mt-12">
                    <h1 class="mb-4">Shopping Cart</h1>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>${{ $item->product->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ $item->product->price * $item->quantity }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('cart.order') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                    <button type="submit">Place Order</button>
                                                </form>
                                                <form method="POST" action="{{ route('cart.remove') }}">
                                                    @csrf
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $item->product->id }}">
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                                                                            
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Price</h5>
                                    <p class="card-text">Total: ${{ $totalPrice }}</p>
                                </div>
                            </div>
                            <!-- Add back button here -->
                            <a href="/showDashboard" class="btn btn-secondary mt-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Shopping Cart Content -->

        </div>
    </div>
</div>

@endsection
