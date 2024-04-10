@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Reports</title>
    <!-- Include any CSS files or stylesheets here -->
    <style>
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-column {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
        <div class="container p-3 my-3 custom-bg-color text-white">Weekly Reports</div>
        <div class="container">
        <p>Total Sales (Delivered) from {{ $startDate->format('F j, Y') }} to {{ $endDate->format('F j, Y') }}: ${{ $totalSales }}</p>

        <h5>Sales for the week</h5>
        
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>${{ $sale->product->price }}</td>
                        <td>${{ $sale->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Include any JavaScript files or scripts here -->
</body>
</html>
@endsection