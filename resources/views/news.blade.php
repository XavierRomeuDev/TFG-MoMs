<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - News</title>
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
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 104px;
        }

        .container1,
        .container2 {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 50px;

        }

        .card-list {
            padding: 10px;
        }

        .swiper-pagination-bullet-active {
            background-color: #5C5FAD;
        }

        .title {
            margin: 0;
            padding: 0;
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 100%;
            font-size: 70px;
            color: white;
            font-family: 'Pacifico', cursive;
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);
        }

        iframe {
            margin-top: 50px;
            margin-bottom: 50px;
            width: 500px;
            height: 500px;

        }

        .news {
            text-decoration: none;
            color: black;
            border: #5C5FAD 2px solid;
            background-color: rgba(255, 255, 255, 0.711);
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.987);
            overflow: hidden;
            width: 350px;
            height: 600px;
            transition: transform 0.3s ease;
            margin: auto;
        }

        .newsletter {
            border: #5C5FAD 2px solid;
            background-color: rgba(255, 255, 255, 0.711);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.987);
            overflow: hidden;
            width: 350px;
            height: 400px;
            transition: transform 0.3s ease;
            margin: auto;
        }

        .newsletter img {
            width: 300px;
            border-radius: 25px;
            height: auto;
            object-fit: cover;
        }

        .newsletter .card-body {
            padding: 15px;
        }

        .news img {
            border-radius: 25px;
            height: 250px;
            object-fit: cover;
        }

        .news .card-title {
            text-align: center;
            height: 80px;
            font-size: 1.25rem;
            margin-top: 10px;
            margin-right: 10px;
            margin-left: 10px;
            font-weight: bold;
            text-transform: none;
        }

        .news .card-footer {
            background-color: transparent;
            border-top: none;
            text-align: center;
            padding-bottom: 15px;
        }

        .news .card-body {
            padding: 15px;
        }

        .news .date {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            display: block;
            color: #323794;
            font-weight: bold;
        }

        .card-img-container {
            padding: 10px;
        }

        .card-img-top {
            border: 25px;
        }

        /* Hover effect */
        .news:hover,
        .newsletter:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px #eccd7a87;
            border: #ECCD7A 2px solid;
        }

        .slider-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            max-width: 1200px;
            height: fit-content;
            margin: 0 70px 55px;
        }

        .slider-wrapper .swiper-pagination-bullet-active {
            opacity: 1;
        }

        .slider-wrapper .swiper-slide-button {
            color: #000000;
            margin-top: -55px;
            transition: 0.2s ease;
        }

        .slider-wrapper .swiper-slide-button:hover {
            color: #000000;
        }

        @media (max-width: 768px) {
            .slider-wrapper {
                margin: 0 10px 40px;
            }

            .slider-wrapper .swiper-slide-button {
                display: none;
            }


        }

        @media (max-width: 410px) {

            .news,
            .newsletter {
                width: 100%;

            }

            .news {
                height: fit-content;
            }
        }
    </style>
</head>

@php
    $locale = app()->getLocale();
    $translations = \App\Models\Translations::where('locale', $locale)
        ->get()
        ->select('key', 'value')
        ->pluck('value', 'key')
        ->toArray();
    $translations_en = \App\Models\Translations::where('locale', 'en')
        ->get()
        ->select('key', 'value')
        ->pluck('value', 'key')
        ->toArray();
@endphp

<body>

    @include('layouts.navbar')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v14.0"
        nonce="YbWpMDWq"></script>

    <div class="main">
        <h1 class="title" data-aos="fade-down" data-aos-duration="700" data-aos-once="true">Facebook Feed</h1>
        <iframe data-aos="zoom-in" data-aos-duration="700" data-aos-once="true"
            src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D61554491343427&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
            width="500" height="500"
            style="border:#5C5FAD 2px solid;overflow:hidden; border-radius: 15px; padding:5px;" scrolling="no"
            frameborder="0" allowfullscreen="true"
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        <section class="container1">
            <h1 class="title" data-aos="fade-down" data-aos-duration="700" data-aos-once="true">{!! strip_tags($translations['newsletter_title'] ?? $translations_en['newsletter_title']) !!}</h1>
            <div id="newsletter-container" data-aos="zoom-in" data-aos-duration="700" data-aos-once="true">
                <div class="container swiper">
                    <div class="slider-wrapper">
                        <div class="card-list swiper-wrapper">
                            @foreach ($newsletters as $newsletter)
                                @php
                                    $locale = strtoupper(App::getLocale());

                                    $pdfs = explode(',', $newsletter->file);
                                    $pdf = null;

                                    foreach ($pdfs as $file) {
                                        if (strpos($file, "_$locale.") !== false) {
                                            $pdf = $file;
                                            break;
                                        }
                                    }
                                    if (!$pdf) {
                                        foreach ($pdfs as $file) {
                                            if (strpos($file, '_EN.') !== false) {
                                                $pdf = $file;
                                                break;
                                            }
                                        }
                                    }

                                @endphp
                                <div class="card-item swiper-slide">
                                    <div class="card-newsletter">
                                        <div class="newsletter mb-4 ">
                                            <a href="/{{ $pdf }}" target="_blank" class="card-img-container"
                                                style="cursor: pointer">
                                                <img src="/{{ $newsletter->image }}" alt="Newsletter-image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-slide-button swiper-button-prev"></div>
                        <div class="swiper-slide-button swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container2">
            <h1 class="title" data-aos="fade-down" data-aos-duration="700" data-aos-once="true">{!! strip_tags($translations['news_title'] ?? $translations_en['news_title']) !!}</h1>
            <div id="news-container" data-aos="zoom-in" data-aos-duration="700" data-aos-once="true">
                <div class="container swiper">
                    <div class="slider-wrapper">
                        <div class="card-list swiper-wrapper">
                            @foreach ($news as $index => $new)
                                @php
                                    $image = explode(',', $new->image);

                                @endphp
                                <div class="card-item swiper-slide">
                                    <a class="news mb-4"
                                        href="{{ route('news.detail', ['lang' => app()->getLocale(), 'new' => $new->id]) }}">
                                        <div class="card-img-container">
                                            <img class="card-img-top" src="/{{ $image[0] }}" alt="News image">
                                        </div>
                                        <div class="text-center">
                                            <h5 class="card-title">{!! strip_tags($translations['new_title' . $new->id] ?? $translations_en['new_title' . $new->id]) !!}</h5>
                                            <p class="date">{{ $new->date }}</p>
                                        </div>
                                        <div class="card-body">
                                            <p>{!! Str::limit(
                                                $translations['new_description' . $new->id] ?? $translations_en['new_description' . $new->id],
                                                200,
                                            ) !!}</p>
                                        </div>

                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-slide-button swiper-button-prev"></div>
                        <div class="swiper-slide-button swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
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

    <!-- Linking SwiperJS script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <script>
        const swiper = new Swiper('.slider-wrapper', {
            loop: false,
            grabCursor: true,
            spaceBetween: 30,

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: false,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                990: {
                    slidesPerView: 2
                },
                1400: {
                    slidesPerView: 3
                }
            }
        });
    </script>

</body>

</html>
