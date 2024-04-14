@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivering Status of Products</title>
    <!-- Include your CSS stylesheets, meta tags, or other head elements here -->
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
    </style>
</head>
<body>
    <div class="container p-3 my-3 custom-bg-color text-white">Accepted Appointments</div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($deliveringSales as $sale)
                    <tr>
                        <td>{{ $sale->user->firstName }} {{ $sale->user->lastName }}</td>
                        <td>{{ $sale->user->contact_number }}</td>
                        <td>{{ $sale->user->address }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>₱{{ $sale->total_price }}</td>
                        <td class="action-buttons">
                            @if($sale->status == 'delivering')
                                <form action="{{ route('mark-as-delivered', $sale->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Mark as Delivered</button>
                                </form>
                                <form action="{{ route('failed-delivery', $sale->id) }}" method="POST">
                                    @csrf
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
    </div>

    <!-- Include your JavaScript scripts or other body elements here -->
</body>
</html>
@endsection
