<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Partners</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .menu-wrapper.show {
            display: block;
        }

        .menu-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            margin-top: -40px;
        }

        .menu-item {
            cursor: pointer;
            background-color: transparent !important;
            outline: none !important;
        }

        .menu-item:hover {
            background-color: #e9ecef;
        }

        .menu-toggle-button {
            display: block;
            position: absolute;
            top: 20px;
            right: 20px;
            border: none;
            outline: none !important;
            background-color: transparent;
            color: #f8f9fa;
        }

        .menu-toggle-button:focus {
            outline: none !important;
        }

        .menu-brand {
            display: flex;
            align-items: center;
            padding: -10px 20px 20px;
            margin-top: -30px;
        }

        .menu-brand img {
            max-height: 50px;
            max-width: 50px;
            margin-right: 10px;
        }

        .menu-brand h2 {
            margin: 0;
        }

        @media (max-width: 768px) {
            .menu-wrapper {
                display: none;
            }

            .navigation {
                margin-top: 400px;
            }
        }

        @media (min-width: 768px) {
            .navigation {
                margin-top: 475px;
            }
        }
    </style>
</head>

<body>

    <div class="menu-wrapper" id="menuWrapper">
        <div class="menu-brand">
            <a class="navbar-brand" href="/{{ app()->getLocale() }}/home">
                <img src="{{ asset('images/MoMs-LOGO.png') }}" class="img-fluid" alt="MoMs Logo">
            </a>
            <h2 class="menu-title">Menu</h2>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/partners">
                    Partners
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/self">
                    {{ __('menu_self') }}
                </a>
            </li>
            <li class="list-group-item menu-item">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/forum">
                    {{ __('menu_forum') }}
                </a>
            </li>
            <li class="list-group-item menu-item">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/tags">
                    Tags
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/pills">
                    {{ __('menu_informative') }}
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/news">
                    {{ __('menu_news') }}
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/newsletters">
                    Newsletter
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/research-book">
                    Research Book
                </a>
            </li>
            <li class="list-group-item menu-item ">
                <a class="nav-link" href="/{{ app()->getLocale() }}/dashboard/translations">
                    Translations
                </a>
            </li>
        </ul>
        <div class="sm:flex sm:ms-6 navigation">
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-light" onclick="openProfile()">
                    {{ Auth::user()->name }}
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-light" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <button class="btn btn-primary d-lg-none menu-toggle-button text-secondary bg-light" onclick="toggleMenu()">
        <span id="hamburgerIcon">&#9776;</span>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function openProfile() {
            var profileEditUrl = "{{ route('profile.edit', ['lang' => app()->getLocale()]) }}";
            window.location.href = profileEditUrl;
        }

        function toggleMenu() {
            var menuWrapper = document.getElementById("menuWrapper");
            var hamburgerIcon = document.getElementById("hamburgerIcon");

            menuWrapper.classList.toggle("show");

            if (menuWrapper.classList.contains("show")) {
                hamburgerIcon.textContent = "✕";
            } else {
                hamburgerIcon.textContent = "☰";
            }
        }

        document.addEventListener("click", function(event) {
            var menuWrapper = document.getElementById("menuWrapper");
            var menuToggle = document.getElementById("menuToggle");

            if (!menuWrapper.contains(event.target) && event.target !== menuToggle && !menuToggle.contains(event.target)) {
                menuWrapper.classList.remove("show");

                document.getElementById("hamburgerIcon").textContent = "☰";
            }
        });
    </script>
</body>

</html>
