<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yearly Sales Report ({{ $currentYear }})</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #BC7FCD;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 20px;
        }
        .month {
            margin-top: 20px;
            font-size: 18px;
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
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">Yearly Sales Report ({{ $currentYear }})</div>
    <!-- Display yearly sales data here -->
    @foreach ($yearlySales as $monthData)
        <div class="month">{{ $monthData['month_name'] }}</div>
        <!-- Display sales data for each month -->
        <table>
            <!-- Table headers -->
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <!-- Table body -->
            <tbody>
                @foreach ($monthData['sales_data'] as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>₱{{ number_format($sale->product->price, 2) }}</td>
                        <td>₱{{ number_format($sale->total_price, 2) }}</td>
                    </tr>
                @endforeach
                <!-- Display total sales for the month -->
                <tr>
                    <td colspan="3" class="total-column">Total:</td>
                    <td class="total-column">₱{{ number_format($monthData['total_sales'], 2) }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach
</body>
</html>
