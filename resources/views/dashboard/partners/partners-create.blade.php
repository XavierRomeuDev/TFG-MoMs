<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moms - Create partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/t9r9anclcfpr69phglipgcund7r4ec4ewcp99ng4ucfdptnq/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    </script>

</head>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Create new partner</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.partners.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form
            action="{{ route('dashboard.partners.store', ['lang' => app()->getLocale()]) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control"
                            placeholder="Please enter name">
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control"
                            placeholder="Choose image" multiple>
                        @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea name="description_en" id="textarea"></textarea>
                        @error('description_en')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>Country:</strong>
                        <input type="text" name="country" class="form-control"
                            placeholder="Please enter country">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                    <div class="form-group">
                        <strong>Website:</strong>
                        <input type="text" name="website" class="form-control"
                            placeholder="Please enter website">
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

<script>
    tinymce.init({
        selector: '#textarea',
        menubar: false,
        paste_as_text: true,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>

</html>
