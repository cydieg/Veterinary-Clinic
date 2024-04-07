<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales</title>
    <!-- Add your CSS files here -->
</head>

<body>
    <!-- Your content goes here -->
    <h1>Daily Sales</h1>
    <!-- Display the computed sales data here -->
    @foreach($dailySales as $sale)
        <p>{{ $sale->id }} - {{ $sale->amount }}</p>
    @endforeach

    <!-- Add your JavaScript files here -->
</body>

</html>
