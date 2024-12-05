<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        .main-container{
            width: 100%;
            padding: 0;
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .footer-style {
            background-color: #5C5FAD;
            color: white;
        }


        .footer-style ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .center-columns {
            display: flex;
            justify-content: center;
            width: 100%;

            padding-right: 20px;
            padding-left: 20px;
        }

        .footer-style a {
            color: inherit;
            text-decoration: none;
        }

        .footer-style a:hover {
            text-decoration: none;
        }

        h5 {
            text-transform: uppercase;
        }

        h6 {
            text-transform: uppercase;
        }

        .mid-item {
            margin-left: 150px;
        }

        .social-media{
            display: flex;
            width: 100%;
            gap: 15px;
        }

        .social-media a {
            color: white;
            font-size: 30px;

        }

        .eu-logo {
            max-width: 300px;
            width: 100%;
            height: auto;
        }

        .creative-commons {
            width: 150px;
            height: 50px;
            margin-top: -7px;
        }

        p {
            text-align: justify;
        }

        .divider {
            width: 65%;
            height: 2px;
            background-color: white;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 250px;
            margin-left: 250px;
        }

        .row{
            display: flex;
            justify-content: center;
            width: 100%;
        }

        @media (max-width: 992px) {
            .mid-item {
                margin-left: 0px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .divider {
                width: 100%;
                margin-right: 0px;
                margin-left: 0px;
            }

            .creative-commons {
                max-width: 100%;
                height: auto;
                margin-top: -7px;
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

    <footer class="main-container py-4 footer-style">
        <div class="row center-columns">
            <div class="col-md-4">
                <div>
                    <h5>{!!strip_tags($translations['disclaimer_title'] ?? $translations_en['disclaimer_title']) !!}</h5>
                    <p>{!!strip_tags($translations['footer_disclaimer'] ?? $translations_en['footer_disclaimer']) !!}</p>
                    <img src="{{ asset('images/co-funded-by-EU.png') }}" class="eu-logo" alt="Example Image">
                </div>
            </div>

            <div class="col-md-4">
                <div class="mid-item">
                    <h5>{!! strip_tags($translations['Quick Links'] ?? $translations_en['Quick Links']) !!}</h5>
                    <ul>
                        <li><a href="/{{ app()->getLocale() }}/home">{!!strip_tags($translations['home'] ?? $translations_en['home'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/partners">{!!strip_tags($translations['partners'] ?? $translations_en['partners'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/research-book">{!!strip_tags($translations['research'] ?? $translations_en['research'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/self-assessment">{!!strip_tags($translations['self'] ?? $translations_en['self'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/forum">{!!strip_tags($translations['forum'] ?? $translations_en['forum'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/informative-pills">{!!strip_tags($translations['informative'] ?? $translations_en['informative'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/news">{!!strip_tags($translations['news'] ?? $translations_en['news'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/contact">{!!strip_tags($translations['contact'] ?? $translations_en['contact'])!!}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">

                    <h5>{!! strip_tags($translations['Access'] ?? $translations_en['Access']) !!}</h5>
                    <ul>
                        <li><a href="/{{ app()->getLocale() }}/login">{!!strip_tags($translations['login'] ?? $translations_en['login'])!!}</a></li>
                        <li><a href="/{{ app()->getLocale() }}/register">{!!strip_tags($translations['Register'] ?? $translations_en['Register'])!!}</a></li>
                    </ul>
                    <br>
                    <h5>{!! strip_tags($translations['Social'] ?? $translations_en['Social']) !!}</h5>
                    <div class="social-media">
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=61554491343427"><i class="fa-brands fa-square-facebook"></i></a>
                        <a target="_blank" href="https://www.instagram.com/moms.mothermatters"><i class="fa-brands fa-instagram"></i></a>
                    </div>

            </div>
        </div>
        <div class="divider"></div>
        <div class="row center-columns">
            <div class="col-md-4">
                <h6>Project number: 2023-1-IT02-KA220-ADU-000153664</h6>
            </div>
            <div class="col-md-4">
                <div class="mid-item">
                    <h6> &copy; <?php echo date('Y'); ?> - MoMs</h6>
                </div>
            </div>
            <!--<div class="col-md-4">
                <a href="https://creativecommons.org/" target="_blank">
                    <img src="{{ asset('images/creative-commons.png') }}" class="creative-commons"
                        alt="Creative Commons">
                </a>
            </div>-->
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
