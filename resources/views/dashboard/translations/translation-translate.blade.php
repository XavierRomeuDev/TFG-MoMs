<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moms - Translate</title>
    <script src="https://cdn.tiny.cloud/1/t9r9anclcfpr69phglipgcund7r4ec4ewcp99ng4ucfdptnq/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
    $languages = ['English', 'Italiano', 'Español', 'Català', 'Български', 'Ελληνικά'];
    $shortLanguages = ['en', 'it', 'es', 'cat', 'bg', 'gr'];
    ?>
</head>

<style>
    .selection-container {
        display: flex;
        justify-content: start;
        align-items: center;
        gap: 15px;
        width: 100%;
        margin-top: 20px;
    }

    .selection-container select {
        width: 100%;
        height: 40px;
        box-sizing: border-box;
        padding: 10px;
        border-radius: 15px;
    }
</style>

<body>

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Translation for {{ $translation->key }}</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.translations.index', ['lang' => app()->getLocale()]) }}">Back</a>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        @php
            $lang = app()->getLocale();
        @endphp

        <div class="container mt-4">
            <form
                action="{{ route('dashboard.translations.translateUpdate', ['lang' => $lang, 'translation' => $translation->id]) }}"
                method="post">
                @method('PATCH')
                @csrf
                <div class="container">
                    <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                        @foreach ($shortLanguages as $key => $language)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link{{ $key === 0 ? ' active' : '' }}" id="tab{{ $key }}-tab"
                                    data-bs-toggle="tab" href="#tab{{ $key }}" role="tab"
                                    aria-controls="tab{{ $key }}"
                                    aria-selected="{{ $key === 0 ? 'true' : 'false' }}">{{ $language }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="languageTabsContent">
                        @foreach ($shortLanguages as $key => $language)
                            @php
                                $getLanguageText = \App\Models\Translations::where('key', $translation->key)
                                    ->where('locale', $language)
                                    ->first();
                                $text = $getLanguageText ? $getLanguageText->value : '';
                            @endphp
                            <div class="tab-pane fade{{ $key === 0 ? ' show active' : '' }}"
                                id="tab{{ $key }}" role="tabpanel"
                                aria-labelledby="tab{{ $key }}-tab">
                                <input type="hidden" name="key" value="{{ $translation->key }}">
                                <textarea id="textarea{{ $key + 1 }}" name="translations[{{ $language }}]">{{ $text }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            @foreach ($shortLanguages as $key => $language)
                tinymce.init({
                    selector: `#textarea{{ $key + 1 }}`,
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    setup: function(editor) {
                        editor.on('change', function() {
                            editor.save();
                        });
                    },
                    init_instance_callback: function(editor) {
                        editor.on('Change', function(e) {
                            editor.save();
                        });
                    }
                });
            @endforeach
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
