<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failed Delivery Notification</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>

    <p>We regret to inform you that the delivery of your product with the following details:</p>
    
    <ul>
        <li>Product Name: {{ $product->name }}</li>
        <li>Order ID: {{ $sale->id }}</li>
        <!-- Add more details about the product if needed -->
    </ul>

    <p>has failed due to the unavailability of someone to receive the delivery.</p>

    <p>Please contact our customer support for further assistance or to reschedule the delivery.</p>

    <p>Thank you for your understanding.</p>

    <p>Sincerely,<br>Rem's PetShop</p>
</body>
</html>
