<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Sales Report PDF</title>
    <!-- Add your styles here -->
    <style>
        /* Add your custom styles for the PDF report */
    </style>
</head>
<body>
    <h1>Monthly Sales Report</h1>
    <!-- Add your PDF content here -->
    @foreach ($monthlySales as $monthData)
        <h2>{{ $monthData['month_name'] }}</h2>
        <p>Total Sales: ${{ number_format($monthData['total_sales'], 2) }}</p>
        <table>
            <!-- Add your table structure and data here -->
        </table>
    @endforeach
</body>
</html>
