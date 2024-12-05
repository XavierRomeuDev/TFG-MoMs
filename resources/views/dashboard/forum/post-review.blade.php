<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moms - Review post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Review post</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.forum.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TITLE: {{ $post->title }}</h3>
            </div>
            <div class="card-body">
                <form id="approveOrDenyForm"
                    action="{{ route('dashboard.forum.approveOrDeny', ['lang' => app()->getLocale(), 'post' => $post->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group my-2">
                        <label for="description"><strong>DESCRIPTION:</strong></label>
                        <div class="form-control-plaintext">{!! $post->description !!}</div>
                    </div>

                    <div>
                        <label for="tags"><strong>TAGS:</strong></label>
                        <p class="card-text">
                            @foreach ($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" onclick="setAction('approve')"
                            class="btn btn-success mx-2">Publish</button>
                        <button type="button" onclick="setAction('deny')" class="btn btn-danger mx-2">Deny</button>
                    </div>
                    <input type="hidden" name="action" id="action">
                </form>
            </div>
        </div>
    </div>

    <script>
        function setAction(value) {
            document.getElementById('action').value = value;
            document.getElementById('approveOrDenyForm').submit();
        }
    </script>
</body>

</html>
