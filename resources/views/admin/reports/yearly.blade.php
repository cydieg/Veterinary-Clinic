@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yearly Reports</title>
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
    <div class="container p-3 my-3 custom-bg-color text-white">Yearly Sales Reports</div>
    <div class="container">
        @foreach($yearlySales as $year => $monthlySales)
            <h5>Sales for {{ $year }}</h5>
            @foreach($monthlySales as $month => $data)
                <h5>{{ $month }}</h5>
                <p>Total Sales (Delivered) from {{ $data['startDate']->format('F j, Y') }} to {{ $data['endDate']->format('F j, Y') }}: ${{ $data['totalSales'] }}</p>
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
                        @foreach($data['sales'] as $sale)
                            <tr>
                                <td>{{ $sale->product->name ?? 'N/A' }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>${{ $sale->product->price ?? 'N/A' }}</td>
                                <td>${{ $sale->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endforeach
    </div>
    <!-- Include any JavaScript files or scripts here -->
</body>
</html>
@endsection
