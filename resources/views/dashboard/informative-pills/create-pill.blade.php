<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Tag Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">

        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Add New Video</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.pills.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('pills.store', ['lang' => app()->getLocale()]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">YouTube URL</label>
                        <input type="url" class="form-control" id="url" name="url" required>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary ml-3">Add Video</button>
                </div>
            </div>

        </form>
</body>

</html>
