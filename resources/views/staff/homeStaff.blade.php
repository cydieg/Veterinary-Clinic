@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')


        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="/back/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome to
                        <div class="weight-600 font-30 text-blue"> Rem's Pet Shop</div>
                    </h4>
                    <p class="font-18 max-width-600">
                    Quality goodies for your furbabies!
                      <br>With Rem's warm smile and dedication to animal welfare, it's more than just a shop—it's a sanctuary 
                      where lasting bonds between humans and pets are forged.
                    </p>
                </div>
@endsection