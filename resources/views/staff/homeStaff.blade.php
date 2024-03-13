@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')

<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="/back/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back
                        <div class="weight-600 font-30 text-blue">Cydie Gargullo!</div>
                    </h4>
                    <p class="font-18 max-width-600">
                        OralEase is committed to providing quality healthcare services and products. 
                        Our experienced denstists are dedicated to ensuring you receive the best possible care for your health needs.
                    </p>
                </div>
            </div>
        </div>

@endsection