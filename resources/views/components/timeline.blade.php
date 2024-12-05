<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MoMs - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        h4 {
            margin: 15%;
            text-align: center;
            font-size: 2rem;
            font-weight: 100;
        }

        .top {
            margin-top: 25px;
            text-transform: uppercase;
            color: #5C5FAD;
        }

        :root {
            --color-primary: #5C5FAD;
            --color-light: white;
            --color-dim: #6c6d6d;
            --spacing: 50px;
            --radius: 4px;
            --date: 120px;
            --dotborder: 4px;
            --dot: 11px;
            --line: 4px;
            --font-title: 'Saira', sans-serif;
            --font-text: 'Chivo', sans-serif;
        }

        body {
            font-size: 16px;
            color: var(--color-primary);
        }

        .timeline {
            border-left: var(--line) solid var(--color-primary);
            border-bottom-right-radius: var(--radius);
            border-top-right-radius: var(--radius);
            background: fade(var(--color-light), 3%);
            color: fade(white, 80%);
            font-family: var(--font-text);
            margin: var(--spacing) auto;
            letter-spacing: 0.5px;
            position: relative;
            line-height: 1.4em;
            font-size: 1.03em;
            padding: var(--spacing);
            list-style: none;
            text-align: left;
            font-weight: 100;
            max-width: 30%;
        }

        .timeline .event h5 {
            color: var(--color-primary);
            margin-bottom: 50px;
        }

        .timeline .event {
            position: relative;
        }

        .timeline .event:before {
            content: attr(data-date);
            position: absolute;
            left: -275px;
            top: 0;
            color: #5C5FAD;
            font-weight: 100;
            font-size: 0.9em;
            font-family: 'Saira', sans-serif;
        }

        .timeline .event:after {
            content: "";
            position: absolute;
            left: -60px;
            top: 20%;
            background-color: #5C5FAD;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            transform: translateY(-50%);
            z-index: 1;
        }

        .date {
            text-transform: uppercase;
        }

        @media (min-width: 992px) {
            h5 {
                white-space: nowrap;
            }
        }

        @media (max-width: 768px) {
            .timeline {
                max-width: 100%;
            }

            .timeline .event:before {
                left: 0%;
                top: -55%;
            }

            .top {
                font-size: 15px;
            }
        }
    </style>

</head>

<body>
    <h4 class="top">
        <i class="bi bi-caret-right-fill"></i>
        <i class="bi bi-caret-right-fill"></i>
        <i class="bi bi-caret-right-fill"></i>
        {{ __('tl_title') }}
        <i class="bi bi-caret-left-fill"></i>
        <i class="bi bi-caret-left-fill"></i>
        <i class="bi bi-caret-left-fill"></i>
    </h4>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline8">
                    <ul class="timeline">
                        <li class="event date" data-date="{{ __('tl_date1') }}">
                            <h5>{{ __('tl_first') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date2') }}">
                            <h5>{{ __('tl_second') }}</h5>
                        </li>
                        <li class="event date" id="date" data-date="{{ __('tl_date3') }}">
                            <h5>{{ __('tl_third') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date4') }}">
                            <h5>{{ __('tl_fourth') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date5') }}">
                            <h5>{{ __('tl_fifth') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date6') }}">
                            <h5>{{ __('tl_sixth') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date7') }}">
                            <h5>{{ __('tl_seventh') }}</h5>
                        </li>
                        <li class="event date" data-date="{{ __('tl_date8') }}">
                            <h5>{{ __('tl_eighth') }}</h5>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
