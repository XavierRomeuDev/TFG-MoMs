<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoMs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        head, body{

            width: 100%;
            height: 100%;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 30px;
            border-top: 8px solid #5C5FAD;
            box-shadow: #adadad 0px 0px 10px;
            margin-top: 0px;
        }

        .language-container{
            display: flex;
            align-items: center;
        }

        .right-container {
            display: flex;
            justify-content: center
            align-items: center;
        }

        .user-login-btn {
            margin-left: auto;
        }

        .dropdown-item {
            text-transform: uppercase;
        }

        .dropdown-menu {
            box-shadow: none;
        }

        .btn {
            text-transform: uppercase;
        }

        .navbar .nav-link {
            font-weight: 600;
            text-transform: uppercase;
            transition: transform 0.3s ease-in-out;
        }

        .navbar .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .flags {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }

        .bi {
            color: #5C5FAD;
        }
        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
                flex-basis: auto;
                height: 0px;
            }
        }

        /* Zoom effect */
        .navbar .nav-link:hover {
            transform: scale(1.05);
        }
    </style>
</head>

@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $languageText = '';
    switch (strtoupper($locale)) {
        case 'EN':
            $languageText = 'English';
            break;
        case 'IT':
            $languageText = 'Italiano';
            break;
        case 'ES':
            $languageText = 'Español';
            break;
        case 'CAT':
            $languageText = 'Català';
            break;
        case 'BG':
            $languageText = 'Български';
            break;
        case 'GR':
            $languageText = 'Ελληνικά';
            break;
    }
@endphp

<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light"  data-aos="fade-down" data-aos-delay="300" data-aos-duration="700" data-aos-once="true">
        <div class="container-fluid">
            <a class="navbar-brand" href="/{{ app()->getLocale() }}/home">
                <img src="{{ asset('images/MoMs-LOGO.png') }}" class="img-fluid"
                    style="max-height: 70px; max-width: 70px;" alt="MoMs Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/home">
                            {!!strip_tags($translations['home'] ?? $translations_en['home'])!!}
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/partners">
                            {!!strip_tags($translations['partners'] ?? $translations_en['partners'])!!}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMaterials" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Materials
                        </a>
                        <div class="dropdown-menu border-0" aria-labelledby="navbarDropdownMaterials">
                            <a class="dropdown-item" href="/{{ app()->getLocale() }}/research-book">
                                {!!strip_tags($translations['research'] ?? $translations_en['research'])!!}
                            </a>
                            <a class="dropdown-item" href="/{{ app()->getLocale() }}/self-assessment">
                                {!!strip_tags($translations['self'] ?? $translations_en['self'])!!}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/forum">
                            {!!strip_tags($translations['forum'] ?? $translations_en['forum'])!!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/informative-pills">
                            {!!strip_tags($translations['informative'] ?? $translations_en['informative'])!!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/news">
                            {!!strip_tags($translations['news'] ?? $translations_en['news'])!!}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ app()->getLocale() }}/contact">
                            {!!strip_tags($translations['contact'] ?? $translations_en['contact'])!!}
                        </a>
                    </li>
                </ul>
                <div class="right-container">
                    <div class="language-container">
                        <ul class="navbar-nav languageSelector">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/flags/'.app()->getLocale().'.png') }}" class="flags">
                                    {{ $languageText }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                    <li><a class="dropdown-item flag-text" href="/en/home">
                                            <img src="{{ asset('images/flags/en.png') }}" class="flags">
                                            English
                                        </a></li>
                                    <li><a class="dropdown-item flag-text" href="/it/home">
                                            <img src="{{ asset('images/flags/it.png') }}" class="flags">
                                            Italiano
                                        </a></li>
                                    <li><a class="dropdown-item flag-text" href="/es/home">
                                            <img src="{{ asset('images/flags/es.png') }}" class="flags">
                                            Español
                                        </a></li>
                                    <li><a class="dropdown-item flag-text" href="/cat/home">
                                            <img src="{{ asset('images/flags/cat.png') }}" class="flags">
                                            Català
                                        </a></li>
                                    <li> <a class="dropdown-item flag-text" href="/bg/home">
                                            <img src="{{ asset('images/flags/bg.png') }}" class="flags">
                                            Български
                                        </a></li>
                                    <li><a class="dropdown-item flag-text" href="/gr/home">
                                            <img src="{{ asset('images/flags/gr.png') }}" class="flags">
                                            Ελληνικά
                                        </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="user-login-btn">
                        <a href="/{{ app()->getLocale() }}/login">
                            <i class="bi bi-person-circle" style="font-size: 35px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var navbarToggle = document.querySelector('.navbar-toggler');
            var navbarCollapse = document.querySelector('.navbar-collapse');
            var languageDropdown = document.getElementById('languageDropdown');
            var languageMenu = document.querySelector('.dropdown-menu[aria-labelledby="languageDropdown"]');
            var materialsDropdown = document.querySelector('.nav-item.dropdown .dropdown-toggle');
            var materialsMenu = document.querySelector('.nav-item.dropdown .dropdown-menu');

            navbarToggle.addEventListener('click', function() {
                if (navbarCollapse.style.display === 'block') {
                    navbarCollapse.style.display = 'none';
                } else {
                    navbarCollapse.style.display = 'block';
                }
            });

            languageDropdown.addEventListener('click', function() {
                if (languageMenu.style.display === 'block') {
                    languageMenu.style.display = 'none';
                } else {
                    languageMenu.style.display = 'block';
                }
            });

            materialsDropdown.addEventListener('click', function() {
                if (materialsMenu.style.display === 'block') {
                    materialsMenu.style.display = 'none';
                } else {
                    materialsMenu.style.display = 'block';
                }
            });

            document.addEventListener('click', function(event) {
                var isNavbarCollapse = event.target.closest('.navbar-collapse');
                var isDropdownToggle = event.target.closest('.navbar-toggler');
                var isLanguageDropdown = event.target.closest('.dropdown');
                var isMaterialsDropdown = event.target.closest('.dropdown');
                var isDropdownMenu = event.target.closest('.dropdown-menu');

                if (!isNavbarCollapse && !isDropdownToggle) {
                    navbarCollapse.style.display = 'none';
                }

                if (!isLanguageDropdown && !isDropdownMenu) {
                    languageMenu.style.display = 'none';
                }

                if (!isMaterialsDropdown && !isDropdownMenu) {
                    materialsMenu.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
