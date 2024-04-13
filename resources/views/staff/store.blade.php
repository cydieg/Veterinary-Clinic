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
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Store Purchase</h1>
    
        @if ($inventory->isEmpty())
            <p>No inventory items available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th> <!-- Add a new table header for the action -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventory as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <!-- Add a button/link for the store purchase action -->
                                <a href="#" class="btn" onclick="openModal('{{ $item->name }}', {{ $item->id }}, {{ $item->price }})">Purchase</a>
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
        <h2>Purchase <span id="itemName"></span></h2>
        <form action="{{ route('staff.storePurchase') }}" method="POST" id="purchaseForm">
            @csrf
            <input type="hidden" name="inventory_id" id="inventoryId">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required oninput="calculateTotal()">
            <label for="totalPrice">Total Price:</label>
            <input type="text" id="totalPrice" name="total_price" readonly>
            <button type="button" class="btn" onclick="submitPurchase()">Store Purchase</button>
        </form>
    </div>
</div>

<!-- Add any additional scripts or links to JS files here -->
<script>
    // Function to open modal and set item name, ID, and price
    function openModal(name, id, price) {
        document.getElementById("purchaseModal").style.display = "block";
        document.getElementById("itemName").innerHTML = name;
        document.getElementById("inventoryId").value = id; // Set the inventory item ID
        document.getElementById("totalPrice").value = ""; // Clear total price on modal open
        document.getElementById("quantity").value = ""; // Clear quantity on modal open
        document.getElementById("quantity").setAttribute("max", "{{ $item->quantity }}"); // Set max quantity based on available stock
        document.getElementById("quantity").focus(); // Focus on quantity input
        document.getElementById("quantity").select(); // Select quantity input
        document.getElementById("totalPrice").setAttribute("price", price); // Set price attribute
    }

    // Function to close modal
    function closeModal() {
        document.getElementById("purchaseModal").style.display = "none";
    }

    // Function to calculate total price
    function calculateTotal() {
        var quantity = document.getElementById("quantity").value;
        var price = document.getElementById("totalPrice").getAttribute("price");
        var totalPrice = quantity * price;
        document.getElementById("totalPrice").value = totalPrice.toFixed(2);
    }

    // Function to submit purchase form
    function submitPurchase() {
        document.getElementById("purchaseForm").submit();
    }
</script>

</body>
</html>
