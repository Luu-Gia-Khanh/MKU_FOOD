@extends('client.layout_client')
@section('content_body')
<link rel="stylesheet" href="{{ asset('public/font_end/custom_ui/css/custom_breadcrumb.css') }}">
{{-- <div class="hero-section hero-background">
    <h1 class="page-title">Organic Fruits</h1>
</div> --}}
<div class="container">
    <nav class="biolife-nav cus_breadcrumb nav-86px">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Liên hệ</span></li>
        </ul>
    </nav>
</div>
<div class="page-contain contact-us">
    <div id="main-content" class="main-content">
        <div class="wrap-map biolife-wrap-map" id="map-block">
            <iframe
             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3927.135411109321!2d105.9254456142831!3d10.169646972881754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a078154ac958a1%3A0xb4409c498d9d692a!2sMekong%20University!5e0!3m2!1sen!2s!4v1628666794977!5m2!1sen!2s"
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>

@endsection
