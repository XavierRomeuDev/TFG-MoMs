<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .table-responsive {
            margin-top: 25px;
        }

        th.options,
        td.options {
            text-align: right;
            width: auto;
        }

        @media (min-width: 993px) {
            .container {
                margin-left: 300px;
                width: 80%;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 70px;
                margin-left: 25px;
                margin-right: 25px;
            }
        }

        .btn-new-partner {
            margin-left: auto;
        }

        .options form {
            display: inline-block;
        }

        .options {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: auto;
        }

        .options a,
        .options form {
            margin-left: 10px;
        }

        .table-striped th,
        .table-striped td {
            white-space: nowrap;
        }
    </style>
</head>

@php
    $lang = app()->getLocale();
@endphp

<body>

    @extends('layouts.dashboard-menu')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
            <h1 class="mb-0">Research Book</h1>
            {{-- <a href="{{ route('dashboard.research-book.create', ['lang' => app()->getLocale()]) }}"
                class="btn btn-primary btn-new-partner">+ Create New</a> --}}
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="file">File</th>
                        <th class="options">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($research as $research)
                        <tr>
                            <td class="file">{{Str::limit($research->file , 70, ' ...')  }}</td>
                            <td class="options">
                                {{-- <form action="{{ route('dashboard.research-book.destroy', ['lang' => $lang ,'research' => $research->id]) }}" method="POST"> --}}
                                    <a class="btn btn-primary"
                                        href="{{ route('dashboard.research-book.edit', ['lang' => app()->getLocale(), 'research' => $research->id]) }}">Edit</a>
                                    {{-- @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>