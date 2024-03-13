@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'About')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - OralEase</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin: 50px 0;
            margin-top: 2px;
            margin-bottom: 3px;
        }

        .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .col-12 {
            flex: 5;
            padding: 20px;
        }

        .col-12 img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .about-text {
            font-size: 16px;
            line-height: 1.5;
        }

        h1 {
            color: #008080;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <img src="/back/images/loginpic.jpg" alt="dental Image">
            </div>
            <div class="col-12">
                <h1>Welcome to OralEase - Your Trusted Dental Clinics</h1>
                <p class="about-text">
                    At OralEase, our commitment goes beyond merely providing healthcare services and products – it's about fostering a seamless experience for your well-being. 
                    Our team of experienced dentists is dedicated to ensuring you receive the highest standard of care for all your health needs.
                </p>
                <p class="about-text">
                    Whether you require prescription fulfillment, health consultations, or access to a diverse range of healthcare products, 
                    OralEase stands ready to serve you. We are more than a dental clinic; we are your dedicated partner on your journey to optimal oral health. Our mission is to provide personalized and comprehensive dental care in a comfortable and welcoming environment. 
                    From routine check-ups to advanced dental procedures, our skilled team is here to meet all your oral health needs.
                </p>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <h1>Redefining Your Health, Beauty, and Well-Being Experience.</h1>
                <p class="about-text">
                    With an extensive network of dental clinics strategically located across the nation, 
                    OralEase stands as a prominent leader in the dental healthcare landscape. 
                    We take pride in facilitating easy access to premium dental services, 
                    striving to enhance the overall well-being of our valued patients.
                </p>
                <p class="about-text">
                    In a landmark collaboration, OralEase proudly joined forces with Robinsons Retail Holdings Inc. (RRHI) in October 2020. 
                    This strategic partnership, coupled with our unwavering commitment to delivering unparalleled dental care, 
                    has propelled OralEase to new heights. We go beyond conventional limits to cater to our patients, 
                    offering a wide range of services from routine dental check-ups to cosmetic dentistry, orthodontics, and oral surgery.
                </p>
                <p class="about-text">
                    Driven by a dedication to provide value, OralEase ensures the widespread availability of 
                    high-quality dental services at affordable prices. Our clinics are equipped with state-of-the-art 
                    technology, and our team of skilled dentists is committed to delivering compassionate care. 
                    Explore additional savings through our dental care packages, promotions, and exclusive offers, 
                    providing exceptional value whether you choose to visit our clinics in person or consult with our dentists online.
                </p>
                <p class="about-text">
                    At OralEase, we are not just a dental clinic; we are a trusted partner in your journey toward holistic oral well-being. 
                    Our mission is to redefine your dental care experience by combining quality services, accessibility, 
                    and a touch of passionate care. 
                    Thank you for choosing OralEase, where your oral health and happiness take center stage.
                </p>
            </div>
        </div>
    </div>

</body>

</html>

@endsection
