<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivering Status of Products</title>
    <!-- Include your CSS stylesheets, meta tags, or other head elements here -->
</head>
<body>
    <div class="container">
        <h1>Delivering Status of Products</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <!-- Add more columns if needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($deliveringSales as $sale)
                    <tr>
                        <td>{{ $sale->user->firstName }} {{ $sale->user->lastName }}</td>
                        <td>{{ $sale->user->contact_number }}</td>
                        <td>{{ $sale->user->address }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>
                            @if($sale->status == 'delivering')
                                <form action="{{ route('mark-as-delivered', $sale->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Mark as Delivered</button>
                                </form>
                            @else
                                Delivered
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include your JavaScript scripts or other body elements here -->
</body>
</html>
