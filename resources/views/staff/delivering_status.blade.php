@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

    <div class="container p-3 my-3 custom-bg-color text-white">Delivered Products</div>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Product Name</th>
                <th>Category</th> <!-- Combined category and subcategory -->
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Delivery Fee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deliveringSales as $sale)
                <tr>
                    <td>{{ $sale->user->firstName }} {{ $sale->user->lastName }}</td>
                    <td>{{ $sale->user->contact_number }}</td>
                    <td>{{ $sale->user->address }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->product->category }} ({{ $sale->product->subcategory }})</td> <!-- Combined category and subcategory -->
                    <td>{{ $sale->quantity }}</td>
                    <td>₱{{ $sale->total_price }}</td>
                    <td>
                        @if(trim(strtolower($sale->courier)) === 'pick up')
                            No Fees
                        @else
                            ₱{{ $sale->fee ? $sale->fee->delivering_fee : 'N/A' }}
                        @endif
                    </td>
                    <td class="action-buttons">
                        @if($sale->status == 'delivering')
                            <form action="{{ route('mark-as-delivered', $sale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Mark as Delivered</button>
                            </form>
                            <form action="{{ route('failed-delivery', $sale->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger btn-sm">Failed Delivery</button>
                            </form>                                
                        @else
                            Delivered
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
