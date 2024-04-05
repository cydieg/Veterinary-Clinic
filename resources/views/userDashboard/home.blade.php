@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')

	<div class="col-md-7 col-lg-8 col-xl-9">
		<div class="card">
			<div class="card-body pt-0">
								
				<!-- Tab Menu -->
				<nav class="user-tabs mb-4">
					<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
						<li class="nav-item">
							<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
						</li>
					</ul>
				</nav>
				<!-- /Tab Menu -->
			</div>
		</div>
	</div>
</html>

@endsection