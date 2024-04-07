<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales</title>
    <!-- Include any CSS or meta tags here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row td {
            background-color: #e9e9e9;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daily Sales - {{ now()->format('F j, Y') }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalSales = 0; // Initialize total sales variable
                @endphp
                @foreach($totalPrices as $totalPrice)
                <tr>
                    <td>{{ $totalPrice->product->name }}</td>
                    <td>{{ $totalPrice->quantitySold }}</td>
                    <td>{{ $totalPrice->totalPrice }}</td>
                </tr>
                @php
                    $totalSales += $totalPrice->totalPrice; // Accumulate total sales
                @endphp
                @endforeach
                <tr class="total-row">
                    <td colspan="2"><strong>Total Sales</strong></td>
                    <td><strong>{{ $totalSales }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Include any scripts here -->
</body>

</html>
