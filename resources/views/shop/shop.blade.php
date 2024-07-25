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
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="electro/css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="electro/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="electro/css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="electro/css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="electro/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="electro/css/style.css" />

    <!-- back button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            /* Adjust the height as needed */
            object-fit: cover;
            /* This ensures the image fills the container */
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

        #header {
            background-color: #6AD4DD;
            padding-top: -30px;
            /* Increase top padding */
            padding-bottom: -30px
        }

        .dropdown-toggle .fa-shopping-cart {
            color: black;
        }

        .dropdown-toggle span {
            color: black;
        }

        #footer {
            background-color: #6AD4DD;
        }

        #footer .footer-links li a {
            color: black;
        }

        #footer,
        #footer .footer-title,
        #footer .footer p {
            color: black;
        }

        .footer {
            background-color: #6AD4DD;
        }

        .navbar {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .navbar li {
            display: inline;
            margin-left: 10px;
            /* Adjust this value to add space between items */
        }

        #navigation {
            display: flex;
            align-items: center;
        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar li {
            display: inline;
            margin-right: 20px;
            /* Adjust this value to add space between items */
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            display: none;
            z-index: 1000;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            font-size: 14px;
            text-align: left;
            list-style: none;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 4px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        }

        .dropdown-menu {
            /* Existing styles */
            background-color: white;
            /* Change background color to transparent */
        }
        .dropdown-submenu {
        position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -10px;
            margin-left: 100px;
        }
    </style>
</head>

<body>
 
    <!-- HEADER -->
    <header>
        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <a href="/showDashboard" class="btn btn-secondary mt-3 back-button"
                style="background-color: transparent; padding-top: -30px; ;
            padding-bottom: -30px"><i
                    class="fas fa-arrow-left"></i></a>
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO and BACK BUTTON -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="" alt="">
                            </a>
                        </div>
                    </div>

                    <!-- /LOGO -->


                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form id="searchForm" action="{{ route('shop.index') }}" method="GET">
                                <input id="searchInput" class="input" type="text"
                                    placeholder="Search here for products" name="search">
                                <!-- Add a hidden input field to submit the branch ID -->
                                <input type="hidden" name="branch_id" value="{{ $encryptedBranchId }}">
                                <button type="submit" class="search-btn">Search</button>
                            </form>
                            <div id="searchResults" class="search-dropdown"></div> <!-- Result container -->
                        </div>
                    </div>



                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Cart -->
                            <div class="dropdown">
                                <a href="{{ route('cart.show') }}" aria-expanded="true">
                                    <i class="fa fa-shopping-cart" style="color: black;"></i>
                                    <span style="color: black;">Your Cart</span>
                                </a>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="navbar">
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Categories <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('shop.index', ['branch_id' => $encryptedBranchId]) }}">All</a></li>
                            @foreach ($categories as $category => $subcategories)
                                <li class="dropdown-submenu">
                                    <a href="{{ route('shop.index', ['branch_id' => $encryptedBranchId, 'category' => $category]) }}">{{ $category }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach ($subcategories as $subcategory)
                                            <li><a href="{{ route('shop.index', ['branch_id' => $encryptedBranchId, 'category' => $category, 'subcategory' => $subcategory->subcategory]) }}">{{ $subcategory->subcategory }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                        <button class="btn" type="button" id="branchDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Select Branch:
                    
                            @if ($branchId)
                                {{ $branches->where('id', $branchId)->first()->name }}
                            @else
                                Select branch
                            @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="branchDropdown">
                            @foreach ($branches as $branch)
                                @php
                                    $encryptedId = Crypt::encrypt($branch->id);
                                @endphp
                                <a class="dropdown-item"
                                    href="{{ route('shop.index', ['branch_id' => $encryptedId]) }}">{{ $branch->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    
                    
                    
                    
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>

    <div class="card">
        <div class="row">
            <div class="container mt-4">

                <!-- Check if no category is selected -->
                <!-- Check if no category is selected -->
                @if (!$request->has('search') && !$request->has('category'))
                    <!-- HOT ITEMS section -->
                    <h2>HOT ITEMS</h2>
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                @if ($hotItems->isNotEmpty())
                                    <!-- Check if there are any hot items -->
                                    @foreach ($hotItems as $hotItem)
                                        <div class="col-lg-3 mb-4">
                                            <div class="card">
                                                <img src="{{ asset('images/' . $hotItem->product->image) }}"
                                                    class="card-img-top" alt="{{ $hotItem->product->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $hotItem->product->name }}</h5>
                                                    <p class="card-text">{{ $hotItem->product->description }}</p>
                                                    <p class="card-text">Price: ₱ {{ $hotItem->product->price }}</p>
                                                    <div class="d-flex align-items-center">
                                                        <!-- "Add to Cart" button -->
                                                        <button class="btn btn-sm btn-primary"
                                                            onclick="showProductModal('{{ $hotItem->product->name }}', '{{ $hotItem->product->description }}', {{ $hotItem->product->price }}, {{ $hotItem->product->quantity }}, '{{ $hotItem->product->id }}', '{{ $branchId }}')">Add
                                                            to Cart</button>&nbsp
                                                        <!-- "View Ratings" button -->
                                                        <button class="btn btn-sm btn-secondary mr-2"
                                                            onclick="window.location='{{ route('shop.viewratings', ['item' => $hotItem->product->id]) }}'">View
                                                            Ratings</button>
                                                    </div>
                                                    <div class="hot-item-indicator">Hot Item!</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hot items available.</p>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif



                <!-- Other items section -->
                <h2>Other Items</h2>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            @foreach ($inventoryItems as $item)
                                <div class="col-lg-3 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top"
                                            alt="{{ $item->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text">{{ $item->description }}</p>
                                            <p class="card-text">Price: ₱ {{ $item->price }}</p>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-sm btn-primary mr-2"
                                                    onclick="showProductModal('{{ $item->name }}', '{{ $item->description }}', {{ $item->price }}, {{ $item->quantity }}, '{{ $item->id }}', '{{ $branchId }}')">Add
                                                    to Cart</button>
                                                <button class="btn btn-sm btn-secondary"
                                                    onclick="window.location='{{ route('shop.viewratings', $item->id) }}'">View
                                                    Ratings</button>
                                            </div>
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
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Camilmil, Calapan City</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>09071112979</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>remspetshop@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">Grooming</a></li>
                                <li><a href="#">Pet Hotel</a></li>
                                <li><a href="#">Selling Products</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery library (make sure it's included before your script) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <!-- jQuery Plugins -->
    <script src="electro/js/jquery.min.js"></script>
    <script src="electro/js/bootstrap.min.js"></script>
    <script src="electro/js/slick.min.js"></script>
    <script src="electro/js/nouislider.min.js"></script>
    <script src="electro/js/jquery.zoom.min.js"></script>
    <script src="electro/js/main.js"></script>

    <!-- JavaScript to update dropdown text -->
    <script>
        // Function to show/hide courier selection based on pickup/delivery choice
        function toggleCourierSelection() {
            var pickupOrDelivery = document.getElementById('pickupOrDelivery').value;
            var courierSelection = document.getElementById('courierSelection');
    
            if (pickupOrDelivery === 'delivery') {
                courierSelection.style.display = 'block';
            } else {
                courierSelection.style.display = 'none';
            }
        }
    
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
    
        // Function to add product to cart
        function addToCart() {
            var quantity = parseInt(document.getElementById('quantity').value);
            var availableQuantity = parseInt(document.getElementById('productQuantity').innerText);
            var pickupOrDelivery = document.getElementById('pickupOrDelivery').value;
            var courier = (pickupOrDelivery === 'pickup') ? 'Pick up' : document.getElementById('courier').value;
    
            if (quantity > availableQuantity) {
                // If quantity exceeds available quantity, show notification and return
                alert("Failed to add to cart. Exceeds available quantity.");
                return;
            }
    
            // If quantity is valid, set the courier value and submit the form
            document.getElementById('courier').value = courier;
            document.getElementById('addToCartForm').submit();
        }
    
        // Function to calculate total price based on quantity input
        function calculateTotal() {
            var quantity = parseInt(document.getElementById('quantity').value);
            var price = parseFloat(document.getElementById('productPrice').innerText);
            var totalPrice = quantity * price;
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
        }
    </script>
   <script>
    $(document).ready(function() {
        $('.dropdown-submenu').on("mouseenter", function(e) {
            $(this).children('ul').stop(true, true).slideDown(200);
        }).on("mouseleave", function(e) {
            $(this).children('ul').stop(true, true).slideUp(200);
        });
    });
</script>






    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
        aria-hidden="true">
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
                        <input type="hidden" name="branch_id" id="branchId" value="{{ $branchId }}">
                        <div class="form-group">
                            <label for="pickupOrDelivery">Pick up or Delivery:</label>
                            <select class="form-control" name="pickup_or_delivery" id="pickupOrDelivery"
                                onchange="toggleCourierSelection()">
                                <option value="pickup">Pick up</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                        <div class="form-group" id="courierSelection" style="display: none;">
                            <label for="courier">Available Courier:</label>
                            <select class="form-control" name="courier" id="courier">
                                <option value="hatid">Hatid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" class="form-control text-center" id="quantity" name="quantity"
                                oninput="calculateTotal()" value="1">
                        </div>
                        <p>Total Price: ₱<span id="totalPrice"></span></p>
                        <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
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
