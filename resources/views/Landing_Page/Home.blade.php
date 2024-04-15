@extends('back.layout.EcommerceLayout.headerfooter-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                    <h1>
                      Welcome to
                      <span>
                        Rem's Pet Shop
                      </span>
                    </h1>
                    <p>
                      Quality goodies for your furbabies!
                      <br>With Rem's warm smile and dedication to animal welfare, it's more than just a shop—it's a sanctuary 
                      where lasting bonds between humans and pets are forged.
                    </p>
                    <div class="btn-box">
                      <a href="{{ route('ourClinic') }}" class="btn-1">
                        Learn More
                      </a>
                      <a href="{{ route('contactUs') }}" class="btn-2">
                        Contact
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                    <img src="/assets petology/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                  <h1>
                        Quality Products
                        <span>
                          for Your Furry Friends
                        </span>
                      </h1>
                      <p>
                        Find the finest selection of pet supplies and accessories,
                        curated with love and care for your beloved pets.
                      </p>
                    <div class="btn-box">
                      <a href="{{ route('ourShop') }}" class="btn-1">
                        Buy now
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                    <img src="/assets petology/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                  <h1>
                    Exceptional Services
                    <span>
                      for Your Pet's Well-being
                    </span>
                  </h1>
                  <p>
                    From grooming to boarding, our expert team is dedicated to
                    providing top-notch care and attention to your furry companions.
                  </p>
                    <div class="btn-box">
                      <a href="{{ route('services') }}" class="btn-1">
                        Learn more about our Services
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                    <img src="/assets petology/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>

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
              About Our
              <span>
                Pet Shop
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

  <!-- service section -->
  <section class="service_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 offset-md-2">
          <h2 class="custom_heading">
            Our <span>Services</span>
          </h2>
          <div class="container layout_padding2">
            <div class="row">
              <div class="col-md-4">
                <div class="img_box">
                  <img src="/assets petology/images/s-1.png" alt="">
                </div>
                <div class="detail_box">
                  <h6>
                    Pet Grooming
                  </h6>
                  <p>
                  Treat your furry friend to a pampering session at Rem's Pet Shop, 
                  where our expert groomers will have them looking and feeling their best in no time.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="img_box">
                  <img src="/assets petology/images/s-2.png" alt="">
                </div>
                <div class="detail_box">
                  <h6>
                    Pet Hotel
                  </h6>
                  <p>
                  When you're away, you can trust Rem's Pet Shop to 
                  provide a safe and comfortable stay for your beloved pets, 
                  with attentive care and plenty of love.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="img_box">
                  <img src="/assets petology/images/s-3.png" alt="">
                </div>
                <div class="detail_box">
                  <h6>
                    Selling of Pet Products
                  </h6>
                  <p>
                  From pet foods to toys, accessories, and grooming supplies, 
                  find everything you need to keep your pets happy and healthy at Rem's Pet Shop.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <a href="">
              Read More
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <img src="/assets petology/images/tool.png" alt="" class="w-100">
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->



  <!-- gallery section -->
  <section class="gallery-section layout_padding">
    <div class="container">
      <h2>
        Our Gallery
      </h2>
    </div>
    <div class="container ">
      <div class="img_box box-1">
        <img src="back/images/dog.jpg" alt="">
      </div>
      <div class="img_box box-2">
        <img src="assets petology/images/g-2.png" alt="">
      </div>
      <div class="img_box box-3">
        <img src="back/images/dog1.jpg" alt="">
      </div>
      <div class="img_box box-4">
        <img src="back/images/dog2.jpg" alt="">
      </div>
      <div class="img_box box-5">
        <img src="assets petology/images/g-5.png" alt="">
      </div>
    </div>
  </section>



  <!-- end gallery section -->

  <!-- buy section -->

  <section class="buy_section layout_padding">
    <div class="container">
      <h2>
        You Can Buy Pet Supplies and Accesories from our Shop
      </h2>
      <p>
        We offer pet food supplies, grooming supplies, toys for your furbabies and many more!!!
      </p>
      <div class="d-flex justify-content-center">
        <a href="{{ route('login') }}">
          Buy Now
        </a>
      </div>
    </div>
  </section>

  <!-- end buy section -->

  <!-- client section -->
  <section class="client_section layout_padding-bottom">
    <div class="container">
      <h2 class="custom_heading text-center">
        What Say Our
        <span>
          clients
        </span>
      </h2>
      <p class="text-center">
        This part contains comments from our previous clients. Check it out!!!
      </p>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                  <img src="/back/images/pic1.jpg" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Sandy Lopez
                  </h5>
                  <p>
                  Rem's Pet Shop offers exceptional pet grooming services! 
                  Their skilled groomers not only make my pet look fabulous 
                  but also ensure they feel comfortable and relaxed throughout the process. 
                  I always leave with a happy and well-groomed pet, thanks to Rem's!
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                  <img src="/back/images/pic2.jpg" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Shiena Mendoza
                  </h5>
                  <p>
                    Grabe, ang galing nila mag groom. As in pet glow up talaga ang nangyari!!!
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                  <img src="/back/images/pic3.jpg" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Ryan Tupido
                  </h5>
                  <p>
                    Di lang sila dito nag-o-offer ng services like grooming and pet hotel, 
                    but also nagbebenta din sila ng mga products na perfect para sa aking furbabies. 
                    They are also very accomodating when it comes to their customer.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


    </div>

  </section>
  <!-- end client section -->
@endsection