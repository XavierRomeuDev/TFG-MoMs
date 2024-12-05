<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHAV3_SITE_KEY') }}"></script>
    <title>Moms - Contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: relative;
        }

        .book {
            position: relative;
            max-width: 900px;
            margin-top: 170px;
            margin-bottom: 50px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            overflow: hidden;
            background-color: #fff;
            z-index: 1;
            border-radius: 20px;
            border: 8px solid #161887;
        }

        .left-page,
        .right-page {
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
            background-color: transparent;
        }

        .form-content {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            border: none;
            border-bottom: 1px solid #161887;
            border-radius: 0;
            box-sizing: border-box;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            background-color: #161887;
        }

        .text-style {
            color: #161887;
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            text-transform: uppercase;
        }

        .button.color {
            box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
        }



        .centered-image {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: -50px;
            max-width: 100%;
            max-height: 350px;
        }

        @media screen and (min-width: 800px) {
            .book {
                display: flex;
            }

            .centered-image {
                width: 450px;
                height: 300px;
                margin: 20 20 20 20;
                color: #161887;
            }

            .top-section {
                height: 35%;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        @media (max-width: 992px) {
            .centered-image {
                display: none;
            }

            .book {

                max-width: none;
                border-radius: 0;
                border: none;
                padding: 0;
                border: 8px solid #161887;
                border-radius: 20px;
                margin: 50px auto;
            }

            .left-page,
            .right-page {
                width: 100%;
            }

            .text-style {
                color: #161887;
                text-align: center;
                margin-top: 50px;
                margin-bottom: -30px;
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

    <div class="book" data-aos="zoom-in" data-aos-duration="700" data-aos-once="true">
        <div class="left-page">
            <h2 class="text-style title">{!! strip_tags($translations['contact'] ?? $translations_en['contact']) !!}</h2>
            <p class="text-style">{!! strip_tags($translations['contact_msg'] ?? $translations_en['contact_msg']) !!}</p>
            <lottie-player src="{{ asset('json/contact.json') }}" class="centered-image" background="transparent"
                speed=".5" direction="1" mode="normal" loop autoplay>
            </lottie-player>
        </div>
        <div class="right-page">
            <div class="form-content">
                <form method="POST" action="{{ url('validate-recaptcha-v3') }}" id="googleCaptchaForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="{!! strip_tags($translations['contact_name'] ?? $translations_en['contact_name']) !!}"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="{!! strip_tags($translations['contact_email'] ?? $translations_en['contact_email']) !!}"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="subject" placeholder="{!! strip_tags($translations['contact_subject'] ?? $translations_en['contact_subject']) !!}" name="subject">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" rows="5" placeholder="{!! strip_tags($translations['contact_message'] ?? $translations_en['contact_message']) !!}" required></textarea>
                    </div>
                    @if ($errors->has('token'))
                        <span class="text-danger">{{ $errors->first('token') }}</span>
                    @endif
                    <div class="form-group">
                        <input type="submit" class="button color" value="{!! strip_tags($translations['contact_btn'] ?? $translations_en['contact_btn']) !!}">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="top-section"></div>

    @include('layouts.footer')

    <script type="text/javascript">
        $('#googleCaptchaForm').submit(function(event) {
            event.preventDefault();

            grecaptcha.ready(function() {
                grecaptcha.execute("{{ env('RECAPTCHAV3_SITE_KEY') }}", {
                    action: 'contact_form_submission'
                }).then(function(token) {
                    // Add the reCAPTCHA token to the form data
                    $('#googleCaptchaForm').prepend('<input type="hidden" name="token" value="' +
                        token + '">');
                    // Submit the form
                    $('#googleCaptchaForm').unbind('submit').submit();
                });
            });
        });
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <script id="aioa-adawidget"
        src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
