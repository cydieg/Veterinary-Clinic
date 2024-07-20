<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Admin Dashboard</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="/back/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="/back/vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="/back/vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="b/ack/src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="/back/src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />



		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->
	</head>
	<body>
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				<div class="header-search">
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Search Here"
							/>
							<div class="dropdown">
								<a
									class="dropdown-toggle no-arrow"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					
				</div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="/back/vendors/images/wendell.png" alt="" />
											<h3>Wendel Cabrera</h3>
											<p>
												hello
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/mark.png" alt="" />
											<h3>Mark Tupas</h3>
											<p>
												How much is this?
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/cydie.png" alt="" />
											<h3>Cydie</h3>
											<p>
												Is this available?
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="/back/vendors/images/photo3.jpg" alt="" />
											<h3>Ely</h3>
											<p>
												Do you have a paracetamol medicine?
											</p>
										</a>
                                    </li>
								</ul>
							</div>
						</div>
					</div>
				</div>

		
				<div class="user-info-dropdown">
    <div class="dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
                <i class="far fa-user"></i>
            </span>
            <span class="user-name">{{ auth()->user()->firstName }} {{ auth()->user()->lastName }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
            <a class="dropdown-item" href="profile.html">
                <i class="dw dw-user1"></i> Profile
            </a>
            <a class="dropdown-item" href="profile.html">
                <i class="dw dw-settings2"></i> Setting
            </a>
            <a class="dropdown-item" href="faq.html">
                <i class="dw dw-help"></i> Help
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="dw dw-logout"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>

			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.html">
					<img src="/back/images/petlogo.png" alt="" class="dark-logo" />
					<img
						src="/back/images/petlogo.png"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
							</a>
						</li>

						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-building"></span>
								<span class="mtext">Manage Branches</span>
							</a>
							<ul class="submenu">
								<li>
									<a href="{{ route('branches.view') }}">View Branches</a> <!-- Updated link -->
								</li>
							</ul>
						</li>           
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-person"></span>
								<span class="mtext">User Management</span>
							</a>
							<!-- Add the button to navigate to the route for managing users -->	
							<ul class="submenu">
								<li>				
									<a href="{{ route('superadmin.user.index') }}">Manage Users</a>
						</li>
						</ul>
						<li class="dropdown">
							<a href="{{ route('inventory.index') }}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-bar-chart"></span>
								<span class="mtext">Inventory</span>
							</a>
						</li>
						<li class="dropdown">
    						<a href="javascript:;" class="dropdown-toggle no-arrow">
        						<span class="micon bi bi-bar-chart"></span>
        						<span class="mtext">Reports</span>
    						</a>
   		 					<ul class="submenu">
        						<li><a href="{{ url('/superadmin/report') }}">Daily</a></li>
								<li><a href="{{ route('weekly.report') }}">Weekly</a></li>
        						<li><a href="{{ route('monthly.report') }}">Monthly</a></li>
        						<li><a href="{{ route('yearly.report') }}">Yearly</a></li>

    						</ul>
						</li>

                       
						<li class="dropdown">
							<a href="{{ route('visualization') }}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-arrow-up-right-square"></span>
								<span class="mtext">Visualization</span>
							</a>
						</li>
						
						
						
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>


			<div class="main-container">
				<div class="card-box mb-50">
					@yield('content')
				</div>
			</div>
		</div>
		</div>
		</div>

		<!-- js -->
		<script src="/back/vendors/scripts/core.js"></script>
		<script src="/back/vendors/scripts/script.min.js"></script>
		<script src="/back/vendors/scripts/process.js"></script>
		<script src="/back/vendors/scripts/layout-settings.js"></script>
		<script src="/back/src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="/back/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="/back/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="/back/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="/back/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="/back/vendors/scripts/dashboard.js"></script>




		<script>
			var my_handlers = {
				// fill province
				fill_provinces: function() {
					var region_code = $(this).val();
					var region_text = $(this).find("option:selected").text();
					let region_input = $('#region-text');
					region_input.val(region_text);
					$('#province-text').val('');
					$('#city-text').val('');
					$('#barangay-text').val('');
	
					let dropdown = $('#province');
					dropdown.empty();
					dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
					dropdown.prop('selectedIndex', 0);
	
					let city = $('#city');
					city.empty();
					city.append('<option selected="true" disabled></option>');
					city.prop('selectedIndex', 0);
	
					let barangay = $('#barangay');
					barangay.empty();
					barangay.append('<option selected="true" disabled></option>');
					barangay.prop('selectedIndex', 0);
	
					var url = '/philippine-address-selector-main/ph-json/province.json';
					$.getJSON(url, function(data) {
						var result = data.filter(function(value) {
							return value.region_code == region_code;
						});
	
						result.sort(function(a, b) {
							return a.province_name.localeCompare(b.province_name);
						});
	
						$.each(result, function(key, entry) {
							dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
						})
	
					});
				},
				// fill city
				fill_cities: function() {
					var province_code = $(this).val();
					var province_text = $(this).find("option:selected").text();
					let province_input = $('#province-text');
					province_input.val(province_text);
					$('#city-text').val('');
					$('#barangay-text').val('');
	
					let dropdown = $('#city');
					dropdown.empty();
					dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
					dropdown.prop('selectedIndex', 0);
	
					let barangay = $('#barangay');
					barangay.empty();
					barangay.append('<option selected="true" disabled></option>');
					barangay.prop('selectedIndex', 0);
	
					var url = '/philippine-address-selector-main/ph-json/city.json';
					$.getJSON(url, function(data) {
						var result = data.filter(function(value) {
							return value.province_code == province_code;
						});
	
						result.sort(function(a, b) {
							return a.city_name.localeCompare(b.city_name);
						});
	
						$.each(result, function(key, entry) {
							dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
						})
	
					});
				},
				// fill barangay
				fill_barangays: function() {
					var city_code = $(this).val();
					var city_text = $(this).find("option:selected").text();
					let city_input = $('#city-text');
					city_input.val(city_text);
					$('#barangay-text').val('');
	
					let dropdown = $('#barangay');
					dropdown.empty();
					dropdown.append('<option selected="true" disabled>Choose barangay</option>');
					dropdown.prop('selectedIndex', 0);
	
					var url = '/philippine-address-selector-main/ph-json/barangay.json';
					$.getJSON(url, function(data) {
						var result = data.filter(function(value) {
							return value.city_code == city_code;
						});
	
						result.sort(function(a, b) {
							return a.brgy_name.localeCompare(b.brgy_name);
						});
	
						$.each(result, function(key, entry) {
							dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
						})
	
					});
				},
	
				onchange_barangay: function() {
					var barangay_text = $(this).find("option:selected").text();
					let barangay_input = $('#barangay-text');
					barangay_input.val(barangay_text);
				},
			};
	
			$(function() {
				$('#region').on('change', my_handlers.fill_provinces);
				$('#province').on('change', my_handlers.fill_cities);
				$('#city').on('change', my_handlers.fill_barangays);
				$('#barangay').on('change', my_handlers.onchange_barangay);
	
				let dropdown = $('#region');
				dropdown.empty();
				dropdown.append('<option selected="true" disabled>Choose Region</option>');
				dropdown.prop('selectedIndex', 0);
				const url = '/philippine-address-selector-main/ph-json/region.json';
				$.getJSON(url, function(data) {
					$.each(data, function(key, entry) {
						dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
					})
				});
	
			});
		</script>
		@stack('scripts')
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
