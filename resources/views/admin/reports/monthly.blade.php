<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports</title>
    <!-- Include any CSS files or stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Monthly Sales Reports</h1>
        @foreach($monthlySales as $month => $data)
            @if($data['totalSales'] > 0)
                <h2>Sales for {{ $month }}</h2>
                <p>Total Sales (Delivered) from {{ $data['startDate']->format('F j, Y') }} to {{ $data['endDate']->format('F j, Y') }}: ${{ $data['totalSales'] }}</p>
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
                        @foreach($data['sales'] as $sale)
                            <tr>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>${{ $sale->product->price }}</td>
                                <td>${{ $sale->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
    <!-- Include any JavaScript files or scripts here -->
</body>
</html>
