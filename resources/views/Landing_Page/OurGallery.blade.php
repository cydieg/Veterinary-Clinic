@extends('back.layout.EcommerceLayout.headerfooter-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')


  <!-- gallery section -->
  <section class="gallery-section layout_padding">
    <div class="container">
      <h2>
        Our Gallery
      </h2>
    </div>
    <div class="container ">
      <div class="img_box box-1">
        <img src="assets petology/images/g-1.png" alt="">
      </div>
      <div class="img_box box-2">
        <img src="assets petology/images/g-2.png" alt="">
      </div>
      <div class="img_box box-3">
        <img src="assets petology/images/g-3.png" alt="">
      </div>
      <div class="img_box box-4">
        <img src="assets petology/images/g-4.png" alt="">
      </div>
      <div class="img_box box-5">
        <img src="assets petology/images/g-5.png" alt="">
      </div>
    </div>
  </section>
<!-- end gallery section -->
@endsection