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

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background: #f6f9fc;
            font-family: "Open Sans", sans-serif;
            color: white;
        }

        .container-top {
            margin-top: 50px !important;
        }

        .top-section {
            background-color: #ECCD7A;
            padding: 50px;
            margin-bottom: 100px;
        }

        .text {
            text-align: center;
            margin-bottom: 50px;
        }
    </style>

</head>

<body>

    @include('layouts.navbar')

    <div class="top-section">
        <p>
            PAGE NOT FOUND
        </p>
    </div>

    <div class="container container-top">
        <div class="row">
            <div class="col">
                <h5 class="text"> Welcome to MoMs</h5>
                <p class="text"> Sorry we couldn't find that page </p>
            </div>
        </div>
    </div>

    </div>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
