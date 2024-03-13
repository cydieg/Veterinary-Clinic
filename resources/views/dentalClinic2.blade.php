@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'DentalClinic')

@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to the Dental Clinic!</h1>
        <p class="lead">Find nearby dental clinics and book appointments.</p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="map" style="height: 400px;"></div>
            </div>
            <div class="col-md-4">
                <!-- Bootstrap Appointment Modal -->
                <div class="modal" id="appointmentModal" tabindex="-1" role="dialog">
                    <!-- Modal content goes here (unchanged) -->
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Section -->
			<section class="section section-doctor">
				<div class="container-fluid">
				   <div class="row">
						<div class="col-lg-4">
							<div class="section-header ">
								<h2>Our Dentist</h2>
							</div>
							<div class="about-content">
								<p>Dentists are dedicated to providing exceptional healthcare. In the dynamic field of medicine, 
                                    these professionals bring a wealth of experience and expertise to ensure the well-being of their patients. 
                                    As advocates for health and healing, our esteemed doctors cover a diverse range of specialties, 
                                    from internal medicine to surgery, pediatrics to neurology.</p>
                                <p>Each one is committed to delivering compassionate 
                                    and personalized care, staying abreast of the latest medical advancements to provide cutting-edge solutions. 
                                    We understand the importance of finding the right healthcare partner, 
                                    and our curated list of doctors aims to connect you with skilled professionals devoted to your health and wellness journey.</p>					
	
							</div>
						</div>
						<div class="col-lg-8">
							<div class="doctor-slider slider">
							
								<!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/doctors/doctor-01.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Dra. Ivy Goco</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<span class="d-inline-block average-rating">(17)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> JP SubStreet,  San Vicente East, Calapan City, Philippines
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->
						
								<!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/gayeta.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Dra. Gayeta</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(35)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> Ramirez St. Brgy. San Vicente Central, Calapan, Philippines
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->
						
								<!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/benedict.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Benedict Masangkay</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(27)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> J. P. Rizal Street, Calapan, 5200 Oriental Mindoro, Philippines 
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->

                                <!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/doctors/doctor-03.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Dr. Bolor</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(27)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> San Agustin Street, Calapan City, Mimaropa, 5200 
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->
                                
                                 <!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/doctors/doctor-03.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Dra. Orense</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(27)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> A. Mabini Street, Calapan City, Mimaropa, 5200
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->

                                <!-- Doctor Widget -->
								<div class="profile-widget">
									<div class="doc-img">
										<a href="doctor-profile.html">
											<img class="img-fluid" alt="User Image" src="assets/img/doctors/doctor-03.jpg">
										</a>
										<a href="javascript:void(0)" class="fav-btn">
											<i class="far fa-bookmark"></i>
										</a>
									</div>
									<div class="pro-content">
										<h3 class="title">
											<a href="doctor-profile.html">Dr. Gozar</a> 
											<i class="fas fa-check-circle verified"></i>
										</h3>
										<p class="speciality">Dentist</p>
										<div class="rating">
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(27)</span>
										</div>
										<ul class="available-info">
											<li>
												<i class="fas fa-map-marker-alt"></i> J. P. Rizal Street, Calapan City, Mimaropa, 5200
											</li>
											<li>
												<i class="far fa-clock"></i> Available on Fri, 22 Mar
											</li>
										</ul>
									</div>
								</div>
								<!-- /Doctor Widget -->
                            </div>
						</div>
				   </div>
				</div>
			</section>
			<!-- /Popular Section -->

    <!-- Include Leaflet and other scripts -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    	<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Slick JS -->
		<script src="assets/js/slick.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
    <!-- Your custom JavaScript -->
    <script src="assets/js/dental-clinic-map.js"></script>
@endsection
