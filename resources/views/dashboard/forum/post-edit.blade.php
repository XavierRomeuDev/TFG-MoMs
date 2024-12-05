<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moms - Add forum post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">

        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Edit partner</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.partners.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('forum.update', ['lang' => app()->getLocale(), 'post' => $post->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Title:</strong>
                            <input type="text" name="title" class="form-control" placeholder="Title" value={{ $post->title}}>
                            @error('title')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <strong>Tags:</strong>
                            <select name="tags[]" class="form-control tags-selector" multiple="multiple">
                                @foreach ($availableTags as $tag)
                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                        <div class="form-group">
                            <strong>Description
                                :</strong>
                            <x-forms.tinymce-editor name="description" id="description" :value="$post->description"/>
                            @error('description')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 mt-3">
                        <button type="submit" class="btn btn-primary ml-3">Submit</button>
                    </div>
                </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags-selector').select2({
                placeholder: "Select existing tags"
            });

            $('.tags-selector').on('select2:unselecting', function(e) {
                var $select = $(this);
                var $selected = $select.find('option:selected');
                if ($selected.length > 1) {
                    e.preventDefault();
                    var vals = $select.val();
                    vals.pop();
                    $select.val(vals).trigger('change');
                }
            });
        });
    </script>

    <script id="aioa-adawidget"
        src="https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#5C5FAD&token=&position=bottom_left">
    </script>



</body>

</html>
