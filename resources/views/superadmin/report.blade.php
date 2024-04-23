@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="container p-3 my-3 custom-bg-color text-white">Daily Sales Report</div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Branch selection dropdown -->
        <form action="{{ route('report') }}" method="GET">
            <select name="branch_id">
                <option value="">All Branches</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" @if(request('branch_id') == $branch->id) selected @endif>{{ $branch->name }}</option>
                @endforeach
            </select>
            <button type="submit">Filter</button>

            <div class="row">
                <div class="col-md-12 mb-2 text-right">
                    <a href="{{ route('daily.sales.pdf') }}" class="btn btn-info btn-sm" style="text-align: left;">Download Daily Sales Report</a>
                </div>
            </div>
        </form>
        
        <table>
            <thead>
                <p>Daily Total Sales ₱{{ $totalSales }}</p>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Branch</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliveredSales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>₱{{ $sale->total_price }}</td>
                        <td>{{ $sale->branch_id }}</td>
                        <td>{{ $sale->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
