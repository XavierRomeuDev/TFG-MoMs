<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $new->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .news-container {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 150px;
            margin-bottom: 50px;
            height: 100%;
        }

        .news-title {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #5C5FAD;
        }

        .news-image {
            border-radius: 15px;
            border: #000000 2px solid;
            box-shadow: #000000 0px 0px 10px;
            margin: auto;
            width: 100%;
            height: auto;
            margin-bottom: 40px;
            animation: fade-in 1s;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .news-date {
            color: #babdff;
            font-weight: bold;
            text-align: center;
            display: block;
            margin-bottom: 20px;
        }

        .news-content {
            text-align: justify;
            margin-bottom: 50px;
            font-size: 17px;
        }

        .fade-in {
            opacity: 1 !important;
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

    @php
        $images = explode(',', $new->image);
    @endphp

    <div class="news-container">
        <h1 class="news-title">{!!strip_tags($translations['new_title'.$new->id] ?? $translations_en['new_title'.$new->id])!!}</h1>
        <p class="news-date">{{ $new->date}}</p>
        <div class="news-content">
            <p>{!! $translations['new_description'.$new->id] ?? $translations_en['new_description'.$new->id] !!}</p>
        </div>
        @foreach ($images as $image)
            <img class="news-image" src="/{{ $image }}" alt="News image">
        @endforeach
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const img = document.querySelector('.news-image');

            function handleScroll() {
                const imgPosition = img.getBoundingClientRect().top + window.scrollY;
                const screenPosition = window.innerHeight + window.scrollY;

                if (screenPosition > imgPosition) {
                    img.classList.add('fade-in');
                }
            }

            window.addEventListener('scroll', handleScroll);
            handleScroll(); // Check on load in case image is already in view
        });
    </script>
</body>

</html>
