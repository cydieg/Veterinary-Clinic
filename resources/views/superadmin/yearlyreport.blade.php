@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yearly Sales Report</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        h3 {
            margin-top: 10px;
            color: #333;
        }

        p {
            margin-top: 10px;
            font-weight: bold;
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
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container p-3 my-3 custom-bg-color text-white">Yearly Sales Report ({{ $currentYear }})</div>
    <!-- Add branch filter form -->
    <form action="{{ route('yearly.report') }}" method="get">
        &nbsp &nbsp <label for="branch">Select Branch:</label>
        <select name="branch" id="branch">
            <option value="">All Branches</option>
            @foreach($branches as $branch)
                <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
            @endforeach
        </select>
        
        <label for="date">Select Date:</label>
        <input type="date" id="date" name="date" value="{{ request('date') }}">
        
        <button type="submit">Filter</button>
        <div class="row">
            <div class="col-md-12 mb-2 text-right">
                <a href="{{ route('yearly.report.pdf') }}" method="get" class="btn btn-info btn-sm" style="text-align: left;">Download Yearly Sales Report</a>&nbsp &nbsp
            </div>
        </div>
    </form>

    <!-- Display selected branch name -->
    @if(request('branch'))
        <p>Filtered by: {{ $branches->where('id', request('branch'))->first()->name }} Sales</p>
    @endif

    <p>Total Sales for {{ $currentYear }}: ${{ number_format($totalSalesForCurrentYear, 2) }}</p>

    <!-- Display months with sales and products sold -->
    @foreach ($salesForCurrentYear->groupBy(function($sale) { return $sale->created_at->format('F'); }) as $month => $sales)
        <h2>{{ $month }}</h2>
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
                @php
                    $monthlyTotalPrice = 0;
                @endphp
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name ?? 'N/A' }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>₱{{ number_format($sale->product->price ?? 0, 2) }}</td>
                        <td>₱{{ number_format($sale->total_price, 2) }}</td>
                    </tr>
                    @php
                        $monthlyTotalPrice += $sale->total_price;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="3" class="total-column">Total:</td>
                    <td class="total-column">₱{{ number_format($monthlyTotalPrice, 2) }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>
@endsection
