@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')

	<div class="col-md-7 col-lg-8 col-xl-9">
		<div class="card">
			<div class="card-body">				
				<!-- Tab Menu -->
				<div class="row align-items-center">
					<div class="col-md-8">
										<h4 class="font-20 weight-500 mb-20 text-capitalize">
											Welcome to
											<div class="weight-600 font-30 text-blue"> Rem's Pet Shop</div>
										</h4>
										<p class="font-18 max-width-500">
										Quality goodies for your furbabies!
										<br>With Rem's warm smile and dedication to animal welfare, it's more than just a shop—it's a sanctuary 
										where lasting bonds between humans and pets are forged.
										</p>
					</div>
					<!-- /Tab Menu -->
			</div>
		</div>
	</div>
</html>


@endsection