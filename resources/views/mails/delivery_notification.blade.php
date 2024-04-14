<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Notification</title>
</head>
<body>
    <p>Dear {{ $sale->user->name }},</p>
    
    <p>We are writing to inform you that your order for {{ $sale->product->name }} is currently being delivered.</p>

    <p>The total amount for your order is: ₱{{ $sale->total_price }}</p> <!-- Assuming total_amount is the attribute containing the amount -->

    <p>Please prepare the exact amount for the payment of the product. The delivery agent will collect the payment upon delivery.</p>

    <p>Thank you for choosing us.</p>

    <p>Sincerely,</p>
    <p>Rem's PetShop</p>
</body>
</html>
