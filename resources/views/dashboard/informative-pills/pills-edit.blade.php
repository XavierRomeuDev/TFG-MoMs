<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moms - Edit pill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Edit pill {{ $pill->name }}</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.pills.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('dashboard.pills.update', ['lang' => app()->getLocale(), 'pill' => $pill->id]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" value="{{ $pill->title }}" class="form-control"
                            placeholder="please enter title">
                        @error('title')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" value="{{ $pill->description }}" class="form-control"
                            placeholder="please enter description">
                        @error('description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>YouTube URL:</strong>
                        <input type="text" name="url" value="{{ $pill->url }}" class="form-control"
                            placeholder="please enter url">
                        @error('url')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>

    </div>

    </form>
    </div>
</body>

</html>
