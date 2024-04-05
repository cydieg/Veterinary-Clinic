

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('pageTitle')</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="/assets petology/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="/assets petology/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="/assets petology/css/responsive.css" rel="stylesheet" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">

  <style>
   	 		.light-blue-btn {
        	background-color: #37B5B6; /* Light blue color */
        	color: #fff; /* Text color */
    		}
		</style>
</head>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
      <header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="index-2.html" class="navbar-brand logo">
                    <img src="/back/images/OralEase.png" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="index-2.html" class="menu-logo">
                        <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
				<ul class="main-nav">
					<li><a href="">Home</a></li>
					<li><a href="">About</a></li>
					<li><a href="">Clinics</a></li>
					<li class="nav-item">
					<a class="nav-link header-login" href="{{ route('customer') }}">
						<i class="fas fa-calendar-plus"></i> Make Appointment
					</a>
					<li><a href="{{ route('shop.index', ['branch_id' => $branches->isNotEmpty() ? encrypt($branches->first()->id) : null]) }}">Shop</a></li>


					<li class="nav-item">
						<a class="nav-link" href="{{ route('cart.show') }}">Cart</a>
					</li>
					

					

					
				</li>
					
					</ul>
            </div>
			<ul class="nav header-navbar-rht">
				<li class="nav-item contact-item">
					<div class="header-contact-img">
						<i class="far fa-hospital"></i>
					</div>
				</li>
				<li class="nav-item user-info-dropdown dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<i class="far fa-user"></i>
						</span>
						<span class="user-name">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{ route('manual.logout') }}">
							<i class="dw dw-logout"></i> Log Out
						</a>
					</div>
				</li>
			</ul>
			
			<!-- Bootstrap JavaScript -->
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			
			
        </nav>
    </header>
    
			<!-- /Header -->
	
    		<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						
						<!-- Profile Sidebar -->
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="assets/img/patients/patient.jpg" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3>Richard Wilson</h3>
											<div class="patient-details">
												<h5><i class="fas fa-birthday-cake"></i> 24 Jul 1983, 38 years</h5>
												<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Newyork, USA</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li class="active">
												<a href="{{route('showDashboard')}}">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li>
												<a href="{{route('customer')}}">
													<i class="fas fa-bookmark"></i>
													<span>Reservation</span>
												</a>
											</li>
											<li>
												<a href="{{ route('shop.index') }}">
													<i class="fas fa-bookmark"></i>
													<span>Shop</span>
												</a>
											</li>
											<li>
												<a href="{{ route('message') }}">
													<i class="fas fa-comments"></i>
													<span>Message</span>
													<small class="unread-msg"></small>
												</a>
											</li>
											<li>
												<a href="{{ route('profileSetting') }}">
													<i class="fas fa-user-cog"></i>
													<span>Profile Settings</span>
												</a>
											</li>
											<li>
												<a href="{{ route('changePassword') }}">
													<i class="fas fa-lock"></i>
													<span>Change Password</span>
												</a>
											</li>
											<li>
												<a href="{{ route('manual.logout') }}">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>

							</div>
						</div>
						<!-- / Profile Sidebar -->
	<body>
	@yield('content')
	</body>
						
  </body>  

  <script type="text/javascript" src="/assets petology/js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="/assets petology/js/bootstrap.js"></script>

  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/back/js/popper.min.js"></script>
		<script src="assets/back/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/back/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/back/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/back/js/script.js"></script>
</body>

</html>
