@extends('back.layout.cashier-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px; /* Rounded corners */
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px; /* Limit the max-width */
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Subtle shadow */
        }

        .modal-header {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-size: 18px;
            font-weight: bold;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-body {
            padding: 20px 0;
        }

        .modal-body label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal-body input[type="number"],
        .modal-body input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container .btn {
            background-color: #28a745; /* Bootstrap success color */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-container .btn:hover {
            background-color: #218838;
        }

        /* Styles for the filter forms */
        .filter-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .filter-form label {
            font-size: 14px;
            font-weight: bold;
            margin-right: 10px;
        }

        .filter-form input[type="text"] {
            width: 250px; /* Adjust width for larger search bar */
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
            margin-right: 10px; /* Space between search bar and icon */
        }

        .filter-form button {
            background: none;
            border: none;
            cursor: pointer;
            color: #007bff;
            font-size: 18px;
        }

        .filter-form button:hover {
            color: #0056b3;
        }

        .filter-form select {
            width: 150px; /* Adjust width for smaller category filter */
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container p-3 my-3 custom-bg-color text-white">Store Purchase</div>

<!-- Search Filter Form -->
<form method="GET" action="{{ route('store.purchase') }}" class="filter-form">
    <input type="text" name="search" id="search" class="form-control" placeholder="Search for products" value="{{ $searchTerm }}">
    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
</form>
<form method="GET" action="{{ route('store.purchase') }}" class="filter-form">
    <select name="category" id="category" class="form-control" onchange="this.form.submit()">
        <option value="">All Categories</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>
</form>

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
        <div class="modal-header">
            <span class="close" onclick="closeModal()">&times;</span>
            <div>Purchase <span id="itemName"></span></div>
        </div>
        <div class="modal-body">
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
</div>

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
