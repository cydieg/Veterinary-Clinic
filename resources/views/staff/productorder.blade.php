<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Sales</title>
    <!-- Include your CSS and JS files here -->
</head>
<body>
    <header>
        <!-- Your header content goes here -->
    </header>
    
    <main>
        <h1>Product Sales</h1>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Branch</th>
                    <!-- Add more table headers if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->user->firstName }} {{ $sale->user->lastName }}</td>
                    <td>{{ $sale->user->contact_number }}</td>
                    <td>{{ $sale->user->address }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ $sale->branch->name }}</td>
                    <!-- Add more table cells if needed -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

    <footer>
        <!-- Your footer content goes here -->
    </footer>
</body>
</html>
