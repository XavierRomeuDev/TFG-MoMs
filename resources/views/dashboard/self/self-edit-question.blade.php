<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Question Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
</head>

<body>

    @php
        $question->options = explode(',', $question->options);
    @endphp
@extends('layouts.dashboard-menu')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <h2>Edit question</h2>
            <a class="btn btn-primary" href="{{ route('dashboard.self.index', ['lang' => app()->getLocale(), 'selfAssessment' => $self->id]) }}">Back</a>
            <button type="button" id="addOptionButton" class="btn btn-primary">Add Option</button>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
    @endif

    <form class="form" action="{{ route('dashboard.self.updateQuestion', ['lang' => app()->getLocale(), 'question' => $question->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="form-group">
                <strong>Question:</strong>
                <input type="text" name="question_en" class="form-control" placeholder="Question" value="{{ strip_tags($question->question_en) }}">
                @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        <div id="optionsContainer">
            @foreach ($question->options as $option)
                <div class="form-group option-group">
                    <strong>Option:</strong>
                    <input type="text" name="options[]" class="form-control option-input" placeholder="Option" value="{{ strip_tags($option) }}">
                    @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        </div>

        <div id="answerFieldsContainer">
            <strong>Answer</strong>
            @foreach ($question->options as $option)
                <div class="form-group">
                    <input type="radio" name="answer" value="{{ strip_tags($option) }}" {{ $question->answer == $option ? 'checked' : '' }} required>
                    <label>{{ $option }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    function addOptionListeners(optionInput, answerInput, answerLabel) {
        optionInput.addEventListener('input', function() {
            answerInput.value = optionInput.value;
            answerLabel.textContent = optionInput.value;
        });
    }

    document.querySelectorAll('.option-input').forEach(function(optionInput) {
        var answerInput = document.querySelector('input[type="radio"][value="' + optionInput.value + '"]');
        var answerLabel = answerInput ? answerInput.nextElementSibling : null;
        if (answerInput && answerLabel) {
            addOptionListeners(optionInput, answerInput, answerLabel);
        }
    });

    document.getElementById('addOptionButton').addEventListener('click', function() {
        var optionGroup = document.createElement('div');
        optionGroup.className = 'form-group option-group';
        var optionLabel = document.createElement('strong');
        optionLabel.textContent = 'Option:';
        optionGroup.appendChild(optionLabel);
        var optionInput = document.createElement('input');
        optionInput.type = 'text';
        optionInput.name = 'options[]';
        optionInput.className = 'form-control option-input';

        optionInput.placeholder = 'Option';
        optionInput.required = true;

        optionGroup.appendChild(optionInput);
        document.getElementById('optionsContainer').appendChild(optionGroup);


        var answerGroup = document.createElement('div');
        answerGroup.className = 'form-group';
        var answerInput = document.createElement('input');
        answerInput.type = 'radio';
        answerInput.name = 'answer';
        answerInput.value = optionInput.value;
        answerInput.required = true;
        var answerLabel = document.createElement('label');
        answerLabel.textContent = optionInput.value;

        addOptionListeners(optionInput, answerInput, answerLabel);

        answerGroup.appendChild(answerInput);
        answerGroup.appendChild(answerLabel);
        document.getElementById('answerFieldsContainer').appendChild(answerGroup);
    });
</script>

</body>

</html>

