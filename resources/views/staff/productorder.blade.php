@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <style>
        /* Additional styling */
        .table {
            margin-top: 20px;
        }
        .table th,
        .table td {
            vertical-align: middle;
        }
        .action-buttons button {
            margin-right: 5px;
            font-size: 12px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
    <div class="container p-3 my-3 custom-bg-color text-white">Product Sales</div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Product</th>
                <th>Category</th> <!-- Combined category and subcategory -->
                <th>Quantity</th>
                <th>Courier</th>
                <th>Branch</th>
                <th>Total Price</th>
                <th>Delivery Fee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->user->firstName }} {{ $sale->user->lastName }}</td>
                    <td>{{ $sale->user->contact_number }}</td>
                    <td>{{ $sale->user->address }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->product->category }} ({{ $sale->product->subcategory }})</td> <!-- Combined category and subcategory -->
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->courier }}</td>
                    <td>{{ $sale->branch->name }}</td>
                    <td>₱{{ $sale->total_price }}</td>
                    <td>
                        @if(trim(strtolower($sale->courier)) === 'pick up')
                            No Fees
                        @else
                            ₱{{ $sale->fee ? $sale->fee->delivering_fee : 'N/A' }}
                        @endif
                    </td>
                    <td class="action-buttons">
                        <form action="{{ route('deliver.sale', $sale->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary btn-sm">Deliver</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
