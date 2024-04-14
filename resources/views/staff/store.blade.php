@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Add any additional meta tags or links to CSS files here -->
    <style>
        /* Your existing styles here */

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            position: relative;
            margin: 10% auto; /* Adjusted margin for smaller modal */
            padding: 20px;
            border: 1px solid #888;
            width: 60%; /* Adjusted width for smaller modal */
            max-width: 400px; /* Limit maximum width */
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 5px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #BC7FCD;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #955B9A;
        }

        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container p-3 my-3 custom-bg-color text-white">Store Purchase</div>
@if ($inventory->isEmpty())
    <p>No inventory items available.</p>
@else
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₱{{ $item->price }}</td>
                    <td>
                        <button class="btn btn-success" onclick="openModal('{{ $item->name }}', {{ $item->id }}, {{ $item->price }})">Purchase</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</div>

<!-- Modal -->
<div id="purchaseModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="title">Purchase <span id="itemName"></span></div>
        <form action="{{ route('staff.storePurchase') }}" method="POST" id="purchaseForm">
            @csrf
            <input type="hidden" name="inventory_id" id="inventoryId">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required oninput="calculateTotal()">
            <label for="totalPrice">Total Price:</label>
            <input type="text" id="totalPrice" name="total_price" readonly>
            <div class="btn-container">
                <button type="button" class="btn" onclick="submitPurchase()">Store Purchase</button>
            </div>
        </form>
    </div>
</div>

<!-- Add any additional scripts or links to JS files here -->
<script>
    function openModal(name, id, price) {
        document.getElementById("purchaseModal").style.display = "block";
        document.getElementById("itemName").innerHTML = name;
        document.getElementById("inventoryId").value = id;
        document.getElementById("totalPrice").value = "";
        document.getElementById("quantity").value = "";
        document.getElementById("quantity").setAttribute("max", "{{ $item->quantity }}");
        document.getElementById("quantity").focus();
        document.getElementById("quantity").select();
        document.getElementById("totalPrice").setAttribute("price", price);
    }

    function closeModal() {
        document.getElementById("purchaseModal").style.display = "none";
    }

    function calculateTotal() {
        var quantity = document.getElementById("quantity").value;
        var price = document.getElementById("totalPrice").getAttribute("price");
        var totalPrice = quantity * price;
        document.getElementById("totalPrice").value = totalPrice.toFixed(2);
    }

    function submitPurchase() {
        document.getElementById("purchaseForm").submit();
    }
</script>

</body>
</html>
@endsection
