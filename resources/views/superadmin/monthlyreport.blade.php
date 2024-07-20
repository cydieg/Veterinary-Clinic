@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        h2 {
            margin-top: 30px;
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
    
    <div class="container p-3 my-3 custom-bg-color text-white">Monthly Sales Report</div>
        <!-- Add month filter form -->
        <form action="{{ route('monthly.report') }}" method="get">
            <label for="month">Select Month:</label>
            <select name="month" id="month">
                <option value="">All Months</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
            <button type="submit">Filter</button>
        </form>

        <!-- Add branch filter form -->
        <form action="{{ route('monthly.report') }}" method="get">
            <label for="branch">Select Branch:</label>
            <select name="branch" id="branch">
                <option value="">All Branches</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                @endforeach
            </select>
            <button type="submit">Filter</button>
        </form>

        <!-- Display selected branch name -->
        @if(request('branch'))
            <p>Filtered by: {{ $branches->where('id', request('branch'))->first()->name }} Sales</p>
        @endif

        @foreach ($monthlySales as $monthData)
            @if (!request('month') || $monthData['month_number'] == request('month'))
                <h2>{{ $monthData['month_name'] }}</h2>
                <p>Total Sales: ₱{{ number_format($monthData['total_sales'], 2) }}</p>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthData['sales_data'] as $sale)
                            <tr>
                                <td>{{ $sale->created_at->format('M d, Y') }}</td>
                                <td>{{ $sale->product->name ?? 'N/A' }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>₱{{ number_format($sale->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="total-column" colspan="3">Total Sales:</td>
                            <td class="total-column">₱{{ number_format($monthData['total_sales'], 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
</body>
</html>
@endsection
