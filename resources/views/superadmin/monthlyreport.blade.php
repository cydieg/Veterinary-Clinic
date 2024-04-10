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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Monthly Sales Report</h1>
        
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
            <h2>{{ $monthData['month_name'] }}</h2>
            <p>Total Sales: ${{ number_format($monthData['total_sales'], 2) }}</p>
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
                            <td>{{ $sale->product->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>${{ number_format($sale->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="total-column" colspan="3">Total Sales:</td>
                        <td class="total-column">${{ number_format($monthData['total_sales'], 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
</body>
</html>
