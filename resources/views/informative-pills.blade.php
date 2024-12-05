<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Informative Pills</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Library CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>

        body{
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            flex-basis: 0;
        }

        .main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .title{
            margin-top: 104px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            font-family: 'Pacifico', cursive;
            padding: 20px 0;
            color: white;
            font-size: 70px;
            padding-bottom: 25px;
        }

        .text {
            max-width: 1200px;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
        }


        .about-img {
            margin-left: 450px;
        }

        .video-wrapper {
            padding: 5px;
            background: #ffffff;
            border: 1px solid #dddddd;
        }

        .video-wrapper iframe {
            width: 100%;
            height: 200px;
        }

        .card-header {
            background-color: #5C5FAD !important;
            border-bottom: none;
        }

        .card {
            border: none;
            box-shadow: none;
            background-color: #5C5FAD !important;
        }

        @media (max-width: 768px) {
            .body {
                width: 80%;
                margin: 40px 40px 40px 40px;
            }
        }

        @media (min-width: 769px) {
            .body {
                width: 80%;
                margin-left: 175px;
                margin-right: 175px;
                margin-top: 100px;
                margin-bottom: 150px;
            }
        }
    </style>
</head>

@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
@endphp

@include('layouts.navbar')
<body>

    <div class="main">

            <h1 class="title" data-aos="fade-down" data-aos-duration="1200" data-aos-once="true">{!!strip_Tags($translations['informative_title'] ?? $translations_en['informative_title'])!!}</h1>
            <p class="text" data-aos="fade-right" data-aos-duration="700" data-aos-once="true">{!!strip_Tags($translations['informative_text'] ?? $translations_en['informative_text'])!!}</p>



        <div class="row">
            @foreach ($videos as $index => $video)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card mb-4">
                        <div class="card-header text-center text-white">
                            <h5 class="card-title m-0">{{ $video->title }}</h5>
                            <p class="text-center text-white m-2">{{ $video->description }}</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="video-wrapper">
                                <iframe class="embed-responsive-item" src="{{ $video->url }}"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
@include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Library JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script id="aioa-adawidget"
        src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
    </script>


</html>
