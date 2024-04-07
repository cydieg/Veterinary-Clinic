<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales</title>
    <!-- Include any CSS or meta tags here -->
</head>

<body>
    <div class="container">
        <h1>Daily Sales</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($totalPrices as $totalPrice)
                <tr>
                    <td>{{ $totalPrice->product->name }}</td>
                    <td>{{ $totalPrice->totalPrice }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Include any scripts here -->
</body>

</html>
