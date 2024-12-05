<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Newsletter Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Edit newsletter</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.newsletters.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('dashboard.newsletters.update', ['lang' => app()->getLocale(), 'newsletter' => $newsletter->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Newsletter Number:</strong>
                    <input type="number" name="number" class="form-control" value="{{$newsletter->number}}">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control" placeholder="Choose image">
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>File:</strong>
                        <input type="file" name="file[]" class="form-control" placeholder="Choose image" multiple>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>

        </form>
</body>

</html>
