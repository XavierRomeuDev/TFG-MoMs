<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Research Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            flex-basis: 0;
        }

        .main-container {
            margin-top: 80px;
            margin-bottom: 40px;
            margin-right: auto;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .title {
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            margin: auto;
            font-family: 'Pacifico', cursive;
            font-size: 70px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);
        }

        p {
            max-width: 1200px;
            width: 100%;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
            padding: 0;
            margin: 0;
        }

        .content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 1400px;
        }

        iframe {
            box-shadow: #5C5FAD 0px 0px 10px;
            border-radius: 10px;
            width: 100%;


        }

        .btn-primary {
            padding: 0;
            margin: 0;
            margin-bottom: 20px;
            width: fit-content;
            background-color: #5C5FAD !important;
        }

        @media (max-width: 1420px) {
            .content {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .large-screen {
                display: none;
            }

        }
    </style>
</head>

<body>
    @php
        $locale = app()->getLocale();
        $lang = strtoupper($locale);
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

        foreach ($research as $research) {
            $pdfs = explode(',', $research->file);
            $pdf = null;
            foreach ($pdfs as $file) {
                if (strpos($file, $lang) !== false) {
                    echo $file;
                    $pdf = $file;
                    break;
                }
            }
            if (!$pdf) {
                foreach ($pdfs as $file) {
                    if (strpos($file, 'EN') !== false) {
                        $pdf = $file;
                        break;
                    }
                }
            }
        }

    @endphp

    @include('layouts.navbar')

    <div class="main-container">
        <h1 class="title" data-aos="fade-down" data-aos-duration="700" data-aos-once="true">{!! strip_tags($translations['research_book_title'] ?? $translations_en['research_book_title']) !!}
        </h1>
        <div class="content">
            <p data-aos="fade-right" data-aos-duration="700" data-aos-once="true">{!! strip_tags($translations['research_book_text'] ?? $translations_en['research_book_text']) !!}</p>

            <a data-aos="zoom-in" data-aos-duration="700" data-aos-once="true" href="{{ asset($pdf) }}" class="btn btn-primary d-block mx-auto my-3"
                download>{!! strip_tags($translations['download_pdf_text'] ?? $translations_en['download_pdf_text']) !!}</a>

            <iframe data-aos="zoom-in" data-aos-duration="700" data-aos-once="true" src="{{ asset($pdf) }}" class="large-screen"
                style="width: 100%; height: 600px; border: none;"></iframe>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script id="aioa-adawidget"
        src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
