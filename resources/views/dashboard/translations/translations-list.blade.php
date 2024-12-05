<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translation Manager</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 0;
            margin: 0;

        }

        .main {
            margin-top: 50px;
            margin-bottom: 50px;
            margin-left: 300px;
        }

        table {
            border-collapse: collapse;
            width: 1500px;
        }

        select{
            width: 100%;
            height: 60px;
            padding: 10px;
            box-sizing: border-box;
        }

        .selection {
            width: 1500px;
            border: 1px solid black;
        }

        td {
            padding: 10px;


        }

        .index {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 1500px;
        }



        .actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .value {
            width: 800px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>


<body>
    @extends('layouts.dashboard-menu')
    <div class="main">
        <div class="index">
            <h1>Translation Manager</h1>
            <a class="btn btn-primary"
                href="{{ route('dashboard.translations.store', ['lang' => app()->getLocale()]) }}">Create</a>
        </div>
        <select name="filter" id="filter">
            <option value="all">All</option>
            <option value="home">Home</option>
            <option value="partners">Partners</option>
            <option value="research_book">Research Book</option>
            <option value="self_assessment">Self_Assesment</option>
            <option value="forum">Forum</option>
            <option value="informative_pills">Informative Pills</option>
            <option value="news">News</option>
            <option value="contact">Contact</option>
            <option value="footer">Footer</option>
            <option value="navbar">Navbar</option>
        </select>
        <table>
            <tr>
                <th>Id</th>
                <th>Key</th>
                <th>Section Id</th>
                <th>Value</th>
                <th>Translated Languages</th>
                <th>Section</th>
                <th></th>
            </tr>
            @php
                $uniqueTranslations = $translations->unique('key');
            @endphp
            @foreach ($uniqueTranslations as $item)
                @php
                    $translations = \app\Models\Translations::where('key', $item->key)->get();
                    $arrayTranslations = [];
                    foreach ($translations as $translation) {
                        $arrayTranslations[] = $translation->locale;
                    }
                    $arrayTranslations = implode(', ', $arrayTranslations);

                @endphp
                <tr class="selection">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->key }}</td>
                    <td>{{ $item->section_id }}</td>
                    <td>
                        <p class="value">{{ strip_tags($item->value) }}</p>
                    </td>
                    <td>{{ $arrayTranslations }}</td>
                    <td>{{ $item->section }}</td>
                    <td class="actions">

                        <a class="btn btn-primary"
                            href="{{ route('dashboard.translations.translate', ['lang' => app()->getLocale(), 'translation' => $item->id]) }}">Translate</a>
                        @php
                            $translation = $item;
                        @endphp
                        <form
                            action="{{ route('dashboard.translations.destroy', ['lang' => app()->getLocale(), 'translation' => $item->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </div>

    <script>
        const filter = document.getElementById('filter');
        const rows = document.querySelectorAll('.selection');
        filter.addEventListener('change', () => {
            if (filter.value === 'all') {
                rows.forEach(row => {
                    row.style.display = 'table-row';
                });
                return;
            }
            rows.forEach(row => {
                if (row.children[4].innerText !== filter.value) {
                    row.style.display = 'none';
                } else {
                    row.style.display = 'table-row';
                }
            });
        });
    </script>
</body>

</html>
