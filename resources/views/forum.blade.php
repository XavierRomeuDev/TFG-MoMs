<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css">
    <link rel="preload" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        body{
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            flex-basis: 0;
        }
        .main-container {
            margin-top: 104px;
            margin-bottom: 40px;
            margin-right: auto;
            margin-left: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .main-container h1 {
            width: 100%;
            padding: 20px 0;
            color: white;
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Pacifico', cursive;
            text-align: center;
            font-size: 70px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);

        }

        .main-container .forum-text{
            max-width: 1200px;
            width: 100%;
            padding: 20px;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
        }


        .main-container .forum{
            max-width: 1200px;
            width: 100%;
            padding: 20px;
        }

        .about-img {
            margin-left: 450px;
        }

        .btn {
            background-color: #5C5FAD !important;
        }

        .card-header {
            background-color: #5C5FAD !important;
            color: white !important;
        }

        .badge {
            background-color: #ECCD7A;
            padding: 8px 10px !important;
        }


    </style>
</head>

@php
    $locale = app()->getLocale();
    $translations  = \App\Models\Translations::where('locale', $locale)->get()->select('key', 'value')->pluck('value', 'key')->toArray();
    $translations_en  = \App\Models\Translations::where('locale', "en")->get()->select('key', 'value')->pluck('value', 'key')->toArray();
@endphp

@include('layouts.navbar')

<body>
    <div class="main-container">
        <h1 data-aos="fade-down" data-aos-duration="700" data-aos-once="true">{!!strip_tags($translations['forum_title'] ?? $translations_en['forum_title'])!!}</h1>
        <p class="forum-text" data-aos="fade-right" data-aos-duration="700" data-aos-once="true">{!!strip_tags($translations['forum_text'] ?? $translations_en['forum_text'])!!}</p>

        <div class="forum" data-aos="zoom-in" data-aos-duration="700" data-aos-once="true">
            <div class="mb-3">
                <h5>{!!strip_tags($translations['forum_filter_by_tag_title'] ?? $translations_en['forum_filter_by_tag_title'])!!}</h5>
                @foreach ($availableTags as $tag)
                    <span style="cursor: pointer" class="badge @if ($selectedTag == $tag->id) selected @endif"
                        onclick="filterByTag({{ $tag->id }})">{{ $tag->name }}</span>
                @endforeach
                <span style="cursor: pointer" class="badge @if (!$selectedTag) selected @endif" onclick="filterByTag(null)">All
                    Tags</span>
            </div>

            @if ($posts->isEmpty())
                <p>{{ __('No posts available.') }}</p>
            @else
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-4">{{ $post->description }}</p>
                            <div class="d-flex justify-content-between mb-0">
                                <p class="card-text mb-0">
                                    @foreach ($post->tags as $tag)
                                        <span class="badge">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                                <p class="card-text">{{ $post->user->name }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <h5>{!!strip_tags($translations['forum_comments_title'] ?? $translations_en['forum_comments_title'])!!}</h5>
                            @foreach ($post->comments as $comment)
                                <div class="mb-2">
                                    <div class="card-body d-flex justify-content-between px-2 py-2">
                                        <p class="mb-0 px-2 w-100">{{ $comment->content }}</p>
                                        <p class="mb-0 px-2">{{ $comment->user->name }}</p>
                                    </div>
                                </div>
                            @endforeach

                            @auth
                                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="content" class="form-label">{!!strip_tags($translations['forum_add_comment_title'] ?? $translations_en['forum_add_comment_title'])!!}</label>
                                        <input type="text" name="content" class="form-control" rows="3"
                                            required></input>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterByTag(tagId) {
            let url = "{{ route('forum.showApproved', ['lang' => app()->getLocale()]) }}";
            if (tagId) {
                url += "?tag=" + tagId;
            }
            window.location.href = url;
        }
    </script>
    <script id="aioa-adawidget"
        src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
