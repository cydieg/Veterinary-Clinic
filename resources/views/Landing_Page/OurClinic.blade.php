@extends('back.layout.EcommerceLayout.headerfooter-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="/assets petology/images/about.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <h2 class="custom_heading">
              About Our Pets
              <span>
                Shop
              </span>
            </h2>
            <p>
            Our shop was founded in Calapan City, Oriental Mindoro and has been a beloved part of the community since 2018. 
            With our commitment to providing exceptional products and services for pets and their owners, we have expanded to include a branch in Roxas, Oriental Mindoro, ensuring that even more furry friends and their families have access to top-quality care and supplies.
            </p>

            <p>
            At Rem's Pet Shop, we understand the special bond between pets and their owners. That's why we strive to offer a wide range of products, from premium pet foods to toys, accessories, and grooming supplies, carefully selected to meet the unique needs of every pet. 
            Our knowledgeable and friendly staff are here to assist you in finding the perfect items for your furry companions.
            Whether you're a seasoned pet parent or a first-time pet owner, we're dedicated to providing you with the support and resources you need to give your pets the happy, healthy lives they deserve. 
            </p>

            <p>
            Visit us at either of our convenient locations in Calapan City or Roxas, and let us be your trusted partner in pet care.
            </p>
            <div>
              <a href="">
                About More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection