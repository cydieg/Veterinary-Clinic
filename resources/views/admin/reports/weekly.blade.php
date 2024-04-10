<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Reports</title>
    <!-- Include any CSS files or stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Weekly Reports</h1>
        <p>Total Sales (Delivered) from {{ $startDate->format('F j, Y') }} to {{ $endDate->format('F j, Y') }}: ${{ $totalSales }}</p>

        <h2>Sales for the week</h2>
        
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
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>${{ $sale->product->price }}</td>
                        <td>${{ $sale->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Include any JavaScript files or scripts here -->
</body>
</html>
