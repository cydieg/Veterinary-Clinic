@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
<!-- Page Content -->
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">Dental Clinics around Calapan City</h2>
            </div>
        </div>
        <div class="row">
            @foreach($inventoryData as $item)
                <div class="col-sm-6 col-lg-4 text-center item mb-4">
                    <div class="product-container">
                        <a href="{{ url('/order-layout', ['productId' => $item->id]) }}">
                            <img src="{{ asset('storage/images/' . $item->image) }}" alt="Image" class="img-fluid product-image">
                        </a>
                        <h3 class="text-dark"><a href="{{ url('/order-layout', ['productId' => $item->id]) }}">{{ $item->item_name }}</a></h3>
                        <p class="price">$ {{ $item->price }}</p>
                        
                        <!-- Form for Add to Cart button -->
                        <form action="{{ url('/order-layout', ['productId' => $item->id]) }}" method="GET">
                            <button type="submit" class="btn btn-primary add-to-cart-btn">Add to Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection