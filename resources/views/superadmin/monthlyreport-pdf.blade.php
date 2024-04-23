<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Sales Report PDF</title>
    <!-- Add your styles here -->
    <style>
        /* Add your custom styles for the PDF report */
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            color: #333;
            text-align: center;
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
    <h1>Monthly Sales Report</h1>
    <!-- Add your PDF content here -->
    @foreach ($monthlySales as $monthData)
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
                        <td>{{ $sale->product->name }}</td>
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
    @endforeach
</body>
</html>
