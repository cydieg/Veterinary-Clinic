<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rem's Pet Shop</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="electro/css/bootstrap.min.css"/>
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="electro/css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="electro/css/slick-theme.css"/>
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="electro/css/nouislider.min.css"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="electro/css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="electro/css/style.css"/>
    <!-- Back button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #header {
            background-color: #6AD4DD;
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
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <a href="/" class="btn btn-secondary mt-3 back-button"><i class="fas fa-arrow-left"></i></a>
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <img src="" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->
                    <!-- SEARCH BAR -->
                    <form action="{{ route('search') }}" method="GET">
						<input type="text" name="query" class="input" placeholder="Search here">
						<button type="submit" class="search-btn">Search</button>
					</form>
					
                    <!-- /SEARCH BAR -->
                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            
                            <!-- /Cart -->
                            <!-- Login -->
                            <div class="dropdown">
                                <a href="{{ route('login') }}" aria-expanded="true">
                                    <i class="fa fa-user" style="color: black;"></i>
                                    <span style="color: black;">Login</span>
                                </a>
                            </div>
                            <!-- /Login -->
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
    <!-- /HEADER -->
    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Hot Deals</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Categories <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Dog</a></li>
                            <li><a href="#">Cat</a></li>
                            <li><a href="#">Fish</a></li>
                            <li><a href="#">Bird</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
    <!-- SECTION -->
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
							
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- Pagination links -->
			<div class="row">
				<div class="col-12">
					
				</div>
			</div>
		</div>
	</div>
	
<!-- /SECTION -->

        <!-- /container -->
    </div>
    <!-- /SECTION -->
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
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>Camilmil, Calapan City</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>09071112979</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>remspetshop@email.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Dog Products</a></li>
                                <li><a href="#">Cat Products</a></li>
                                <li><a href="#">Bird Products</a></li>
                                <li><a href="#">Fish Products</a></li>
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
    <!-- jQuery Plugins -->
    <script src="electro/js/jquery.min.js"></script>
    <script src="electro/js/bootstrap.min.js"></script>
    <script src="electro/js/slick.min.js"></script>
    <script src="electro/js/nouislider.min.js"></script>
    <script src="electro/js/jquery.zoom.min.js"></script>
    <script src="electro/js/main.js"></script>
</body>
</html>
