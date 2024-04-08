@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <style>
        /* Additional styling */
        .table {
            margin-top: 20px; /* Add margin to the top of the table */
        }
        .table th,
        .table td {
            vertical-align: middle; /* Align content vertically in cells */
        }
        .action-buttons button {
            margin-right: 5px; /* Add some spacing between buttons */
            font-size: 12px; /* Adjust button font size */
        }
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
    </style>
    <div class="container p-3 my-3 custom-bg-color text-white">Product Sales</div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Branch</th>
                <th>Total Price</th>
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
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->branch->name }}</td>
                    <td>{{ $sale->total_price }}</td>
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
</div>
@endsection
