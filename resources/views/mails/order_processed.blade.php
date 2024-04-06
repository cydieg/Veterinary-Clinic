<!DOCTYPE html>
<html>
<head>
    <title>Order Processed</title>
</head>
<body>
    <h2>Order Processed</h2>
    <p>Your order is being processed. Details are as follows:</p>
    <ul>
        @foreach($cart as $item)
            <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</li>
        @endforeach
    </ul>
    <p>Total Price: ₱{{ $totalPrice }}</p>
</body>
</html>
