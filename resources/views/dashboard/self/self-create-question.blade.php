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

    @extends('layouts.dashboard-menu')

    <div class="container mt-2">

        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                <h2>Add new question</h2>
                <a class="btn btn-primary"
                    href="{{ route('dashboard.self.index', ['lang' => app()->getLocale(), 'selfAssessment' => $self->id]) }}">Back</a>
                <button type="button" id="addOptionBtn" class="btn btn-primary">Add Option</button>
            </div>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif

        <form
        class="form"
            action="{{ route('dashboard.self.storeQuestion', ['lang' => app()->getLocale(), 'selfAssessment' => $self->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <div class="form-group
                ">
                    <strong>Question:</strong>
                    <input type="text" name="question_en" class="form-control" placeholder="Question">
                    @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div id="optionFieldsContainer"></div>

            <div id="answerFieldsContainer"></div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

    <script>
        const addOptionBtn = document.getElementById('addOptionBtn');
        const optionFieldsContainer = document.getElementById('optionFieldsContainer');
        const answerFieldsContainer = document.getElementById('answerFieldsContainer');

        addOptionBtn.addEventListener('click', () => {
            const optionField = document.createElement('div');
            optionField.classList.add('row');
            optionField.innerHTML = `
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group
                    ">
                        <strong>Option:</strong>
                        <input type="text" name="options[]" class="form-control" placeholder="Option" required>
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            `;
            optionFieldsContainer.appendChild(optionField);
        });

        optionFieldsContainer.addEventListener('change', (e) => {
            const options = optionFieldsContainer.querySelectorAll('input[name="options[]"]');
            answerFieldsContainer.innerHTML = '';
            options.forEach((option, index) => {
                const answerField = document.createElement('div');
                answerField.classList.add('row');
                answerField.innerHTML = `
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group
                        ">
                            <input type="radio" name="answer" value="${option.value}" required>
                            <label>${option.value}</label>
                        </div>
                    </div>
                `;

                answerFieldsContainer.appendChild(answerField);
            });
        });

    </script>
</body>

</html>
