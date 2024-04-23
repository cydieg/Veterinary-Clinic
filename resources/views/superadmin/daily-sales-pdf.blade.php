<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales Report</title>
    <style>
        /* Define your styles for the PDF report */
        /* Example: */
        body {
            font-family: Arial, sans-serif;
        }
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
            color: white;
            font-size: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="custom-bg-color">Daily Sales Report - {{ \Carbon\Carbon::today()->toFormattedDateString() }}</div>
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
