<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MoMs - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;

        }

        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .section {
            margin-top: 104px;
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            box-shadow: #000000 0px 0px 5px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            gap: 15px;
            border-bottom: 1px solid #000000;
        }


        .mom-image {
            border-radius: 50%;
            width: 230px;
            height: 230px;
            box-shadow: #000000 0px 0px 10px;
            text-align: center;

        }



        .welcome h1 {
            font-family: 'Pacifico', cursive;
            text-align: center;
            font-size: 80px;
            color: white;
        }

        .welcome p {
            max-width: 1400px;
            width: 100%;
            text-align: center;
            color: white;
            font-weight: 600;
            font-size: 17px;

        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .about_title {
            font-family: "Passion One", sans-serif;
            font-size: 50px;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            z-index: 1;
        }

        .about {
            padding: 20px;
            width: 75%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;

            border-bottom: 2px solid #000000;
        }

        .about_text {
            font-family: 'Poppins', sans-serif;
            text-align: justify;
            font-size: 17px;
            line-height: 42px;
            margin-bottom: 50px;
        }

        .about_pic {
            margin-right: 50px;
            position: relative;
            float: left;
        }

        .about_title {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            z-index: 2;
        }

        .image-circle {
            height: auto;
            position: relative;
            z-index: 1;
            height: 350px;
            float: left;
            shape-outside: url('/images/Circle.svg');
        }


        @media (min-width: 992px) {
            .color-text {
                width: 80%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 15px;
            }

            .card-title {
                text-align: center;
            }

            .card-img {
                text-align: center;
                background: white;
            }
        }

        @media (max-width: 768px) {
            .content {
                width: 100%;
            }

            .about {
                width: 100%;
            }
        }

        @media (max-width: 615px){
            .about{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .about_pic {
                margin-right: 0px;
                margin-bottom: 50px;
            }
        }

        @media (max-width: 500px){
            .image-circle {
                width: 300px;
                height: auto;
                position: relative;

            }
        }

    </style>

</head>

@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
@endphp

<header>
    @include('layouts.navbar')
</header>

<body>
    <div class="main-container">
        <div class="section"  data-aos="fade-down" data-aos-duration="1200" data-aos-once="true">
            <div class="main">
                <img class="mom-image" src="/images/MoMs_image1.png" alt="MoMs1">
                <div class="welcome">
                    <h1>Moms</h1>
                    <p>{!!$translations['hero_text'] ?? $translations_en['hero_text']!!}</p>
                </div>
            </div>
        </div>

        <div class="about"  data-aos="fade-right" data-aos-duration="1200" data-aos-once="true">
            <div class="about_pic">
                <h2 class="about_title">{!!strip_tags($translations['about_title'] ?? $translations_en['about_title'])!!}</h2>
                <img class="image-circle" src="/images/Circle.svg" alt="Circle image">
            </div>
            <p class="about_text">{!! strip_tags($translations['about_text'] ?? $translations_en['about_text']) !!}</p>
        </div>



        @include('components.timeline-2')
</body>

<footer>
    @include('layouts.footer')
</footer>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

<script id="aioa-adawidget"
    src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
</script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
    AOS.init();
</script>
