<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Partners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Library CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        body,
        html {
            overflow-x: hidden;
        }

        .card-container {
            display: flex;

            justify-content: center;
            align-items: center;

        }

        .main-container {
            margin-top: 104px;
            margin-bottom: 40px;
            margin-right: auto;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .main-container h1 {
            width: 100%;
            padding: 20px 0;
            color: white;
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Pacifico', cursive;
            text-align: center;
            font-size: 70px;
            margin-bottom: 50px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);

        }

        .row2 {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            max-width: 1500px;
            width: 100%;
            gap: 20px;
            padding: 20px;
            margin: auto;
            place-items: center;
        }


        .card-row {
            margin: 0;
            gap: 20px;
            overflow: hidden;
            width: 450px;
            height: 450px;
            transition: 0.5s ease-in-out;
        }

        .card-body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 450px;
            height: 450px;
            gap: 10px;
            text-align: center;
            font-weight: 500;
            box-sizing: border-box;
            padding: 20px;
            transform: translateY(450px);

        }

        .title {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            text-align: center;
            width: 450px;
            height: 450px;
        }



        .card-row:hover {
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);
            & .title {
                animation: slidePhoto 0.5s ease-in-out;
                animation-fill-mode: forwards;
            }

            & .card-body {

                animation: slideText 0.5s ease-in-out;
                animation-fill-mode: forwards;
            }
        }

        @keyframes slidePhoto {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-450px);
            }
        }

        @keyframes slideText {
            0% {
                transform: translateY(450px);
            }

            100% {
                transform: translateY(-450px);
            }
        }

        img {
            width: 200px;


        }

        .card-border {
            border-radius: 20px !important;
            border: 3px solid #161887 !important;
            box-shadow: #5C5FAD 0px 0px 10px;
        }

        .card-title {
            font-size: 30px;
            font-weight: bold;
        }

        .card-text {
            margin: 0;
        }

        .link {
            width: 30px;
            font-size: 30px;
        }

        @media (max-width: 490px){
            .row2{
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
            .card-row {
                width: 100%;
            }

            .card-body {
                width: 100%;
            }

            .title {
                width: 100%;
            }
        }



    </style>
</head>

@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
@endphp

<body>

    @include('layouts.navbar')

    @include('components.top-section', [
        'title' => 'WELCOME TO THE PARTNERS',
        'animation' => 'json/partners.json',
    ])

    <div class="main-container">
        <h1 data-aos="fade-down" data-aos-duration="1200" data-aos-once="true">
            {!!strip_tags($translations['partners'] ?? $translations_en['partners']) !!}
        </h1>
        <div class="row2">
            @foreach ($partners as $index => $partner)
                <div class="card-container" data-aos="fade-right" data-aos-delay="{{ $index * 150 }}" data-aos-once="true">
                    <div class="card card-border">
                        <div class="card-row">
                            <div class="title">
                                <img src="{{ asset($partner['image']) }}" alt="{!!strip_tags($translations['partner_name'.$partner->id] ?? $translations_en['partner_name'.$partner->id]) !!}">
                                <h5 class="card-title">{!!strip_tags($translations['partner_name'.$partner->id] ?? $translations_en['partner_name'.$partner->id]) !!}</h5>
                                <p class="card-text">{!!strip_tags($translations['partner_country'.$partner->id] ?? $translations_en['partner_country'.$partner->id]) !!}</p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!!strip_tags($translations['partner_description'.$partner->id] ?? $translations_en['partner_description'.$partner->id]) !!}</p>
                                <a class="link" target="_blank" href="{{ $partner['website'] }}" role="button">
                                    <i class="bi bi-globe"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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
</body>

</html>
