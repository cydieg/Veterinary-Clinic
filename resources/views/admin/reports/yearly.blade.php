<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yearly Reports</title>
    <!-- Include any CSS files or stylesheets here -->
</head>
<body>
    <div class="container">
        <h1>Yearly Sales Reports</h1>
        @foreach($yearlySales as $year => $monthlySales)
            <h2>Sales for {{ $year }}</h2>
            @foreach($monthlySales as $month => $data)
                <h3>{{ $month }}</h3>
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
            @endforeach
        @endforeach
    </div>
    <!-- Include any JavaScript files or scripts here -->
</body>
</html>
