@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales</title>
    <!-- Include any CSS or meta tags here -->
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
    <div  class="container p-3 my-3 custom-bg-color text-white">Daily Sales - {{ now()->format('F j, Y') }}</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalSales = 0; // Initialize total sales variable
                @endphp
                @foreach($totalPrices as $totalPrice)
                <tr>
                    <td>{{ $totalPrice->product->name }}</td>
                    <td>{{ $totalPrice->quantitySold }}</td>
                    <td>₱{{ $totalPrice->totalPrice }}</td>
                </tr>
                @php
                    $totalSales += $totalPrice->totalPrice; // Accumulate total sales
                @endphp
                @endforeach
                <tr class="total-row">
                    <td colspan="2"><strong>Total Sales</strong></td>
                    <td><strong>₱{{ $totalSales }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Include any scripts here -->
</body>


</html>
@endsection