<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Report</h1>

        <table>
            <thead>
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
                        <td>${{ $sale->total_price }}</td>
                        <td>{{ $sale->branch_id }}</td>
                        <td>{{ $sale->created_at->toDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>Daily Total Sales ${{ $totalSales }}</p>
    </div>
</body>
</html>
