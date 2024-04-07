<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/img/favicon.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            object-fit: cover; /* This ensures the image fills the container */
        }
        .hot-item-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="row">
            <div class="container mt-4">
                <h1 class="mb-4">Welcome to Our Shop</h1>

                <!-- Dropdown selection for branches -->
                <div class="dropdown mb-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="branchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if($branchId)
                            {{ $branches->where('id', $branchId)->first()->name }}
                        @else
                            Select branch
                        @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="branchDropdown">
                        @foreach($branches as $branch)
                            @php
                                $encryptedId = Crypt::encrypt($branch->id);
                            @endphp
                            <a class="dropdown-item" href="{{ route('shop.index', ['branch_id' => $encryptedId]) }}">{{ $branch->name }}</a>
                        @endforeach
                    </div>
                </div>
                
                <!-- HOT ITEMS section -->
                <h2>HOT ITEMS</h2>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach($hotItems as $hotItem)
                                <div class="col-lg-3 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $hotItem->product->image) }}" class="card-img-top" alt="{{ $hotItem->product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $hotItem->product->name }}</h5>
                                            <p class="card-text">{{ $hotItem->product->description }}</p>
                                            <p class="card-text">Price: ₱ {{ $hotItem->product->price }}</p>
                                            <button class="btn btn-primary" onclick="showProductModal('{{ $hotItem->product->name }}', '{{ $hotItem->product->description }}', {{ $hotItem->product->price }}, {{ $hotItem->product->quantity }}, '{{ $hotItem->product->id }}', '{{ $branchId }}')">Add to Cart</button>
                                            <div class="hot-item-indicator">Hot Item!</div>
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                        
                        </div>
                    </div>
                </div>

                <!-- Other items section -->
                <h2>Other Items</h2>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach($inventoryItems as $item)
                                <div class="col-lg-3 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text">{{ $item->description }}</p>
                                            <p class="card-text">Price: ₱ {{ $item->price }}</p>
                                            <button class="btn btn-primary" onclick="showProductModal('{{ $item->name }}', '{{ $item->description }}', {{ $item->price }}, {{ $item->quantity }}, '{{ $item->id }}', '{{ $branchId }}')">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination links -->
                        <div class="row">
                            <div class="col-12">
                                {{ $inventoryItems->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <a href="/showDashboard" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript to update dropdown text -->
    <script>
        // Function to show the modal with product details
        function showProductModal(name, description, price, quantity, productId, branchId) {
            document.getElementById('productName').innerText = name;
            document.getElementById('productDescription').innerText = description;
            document.getElementById('productPrice').innerText = price;
            document.getElementById('productQuantity').innerText = quantity;
            document.getElementById('quantity').value = 1; // Reset quantity input to 1
            document.getElementById('totalPrice').innerText = price; // Reset total price to product price
            document.getElementById('productId').value = productId; // Set the product ID
            document.getElementById('branchId').value = branchId; // Set the branch ID
            $('#productModal').modal('show');
        }

        // Function to increment quantity
        function incrementQuantity() {
            var quantityElement = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityElement.value);
            quantityElement.value = currentQuantity + 1;
            calculateTotal();
        }

        // Function to decrement quantity
        function decrementQuantity() {
            var quantityElement = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityElement.value);
            if (currentQuantity > 1) {
                quantityElement.value = currentQuantity - 1;
                calculateTotal();
            }
        }

        // Function to calculate total price based on quantity input
        function calculateTotal() {
            var quantity = parseInt(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('productPrice').innerText);
            var totalPrice = quantity * price;
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
        }
    </script>

    <!-- Script to hide the error message after 2.5 seconds -->
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get the error message element
            var errorMessage = document.getElementById('errorMessage');

            // Check if the error message exists
            if (errorMessage) {
                // Hide the error message after 2.5 seconds
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 2500); // 2.5 seconds
            }
        });
    </script>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="productName"></h5>
                    <p id="productDescription"></p>
                    <p>Price: ₱<span id="productPrice"></span></p>
                    <p>Current Quantity: <span id="productQuantity"></span></p>
                    <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" id="productId">
                        <!-- Add this line to include the branch_id -->
                        <input type="hidden" name="branch_id" id="branchId" value="{{ $branchId }}">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">-</button>
                                </div>
                                <input type="text" class="form-control text-center" id="quantity" name="quantity" value="1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">+</button>
                                </div>
                            </div>
                        </div>
                        <p>Total Price: ₱<span id="totalPrice"></span></p>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
