<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Self</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css"
        media="all">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        tr, td{
            width: 2000px;
        }

        .btn-new-partner {
            margin-left: auto;
        }


        .options {
            height: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
        }

        .options a,
        .options form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }


        tbody{
            width: 100%;
        }

        .opt{
            width: 1050px;
        }
    </style>
</head>


<body>

    @extends('layouts.dashboard-menu')

    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
            <h1 class="mb-0">Self</h1>
            <a href="{{ route('dashboard.self.create', ['lang' => app()->getLocale()]) }}"
                class="btn btn-primary btn-new-partner">+ New self</a>
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
                        <th class="name">Title</th>
                        <th class="options">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selfs as $self)
                        <tr>
                            <td class="name">{{ utf8_encode($self->title_en) }}</td>
                            <td class="options">
                                <form action="{{ route('self.destroy', $self->id) }}" method="Post">
                                    <a class="btn btn-warning"
                                        href="{{ route('dashboard.self.createQuestion', ['lang' => app()->getLocale(), 'self' => $self->id]) }}">Create
                                        question</a>
                                    <a class="btn btn-primary"
                                        href="{{ route('dashboard.self.edit', ['lang' => app()->getLocale(), 'self' => $self->id]) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @foreach ($self->questions as $question)
                            <tr style="background-color: #ECCD7A; !important;">
                                <td>
                                    &emsp; &emsp; &emsp; {{ $question->question_en }}
                                </td>
                                <td class="options" >
                                    <form
                                        action="{{ route('self.destroyQuestion', ['lang' => app()->getLocale(), 'question' => $question->id]) }}"
                                        method="POST">
                                        <a class="btn btn-primary"
                                            href="{{ route('dashboard.self.editQuestion', ['lang' => app()->getLocale(), 'question' => $question->id]) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            @php
                                $options = explode(',', $question->options);
                            @endphp
                            <div class="opt">

                                @foreach ($options as $option)
                                    @if ($question->answer === $option)
                                        <tr>
                                            <td style="background-color: #5C5FAD; !important; color:white;">
                                                &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; {{ $option }}
                                            </td>
                                            <td class="options" style="background-color: #5C5FAD; !important;"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td style="background-color: #ECCD7A; !important;">
                                                &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;{{ $option }}
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach
                            </div>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
