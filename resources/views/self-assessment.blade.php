<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">


    <style>
        .result {
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .deselect {
            display: none;
            outline: none;
            border: none;
            background: transparent;
            color: rgb(164, 9, 9);
            text-align: start;
            margin-top: 10px;
        }

        .self-assessment-form-x,
        .self-assessment-form-y {
            display: none;
        }

        .question {
            gap: 10px;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 22px;
            border-bottom: #ECCD7A 2px solid;
            margin-bottom: 20px;
        }

        .questionary_title {
            font-size: 30px;
            padding: 10px;
            margin: 0;
        }

        .options {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 10px;
        }

        .options label {
            font-size: 17px;
        }

        input {
            cursor: pointer;
        }

        input[type='radio']:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: -4px;
            left: -1px;
            position: relative;
            background-color: #d1d3d1;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

        input[type='radio']:checked:after {
            width: 15px;
            height: 15px;
            border-radius: 15px;
            position: relative;
            background-color: #5C5FAD;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
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

        .title {
            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            margin: auto;
            font-family: 'Pacifico', cursive;
            font-size: 70px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);
        }

        .content {
            max-width: 1200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .main-container p {
            padding: 20px;
            max-width: 1200px;
            width: 100%;

            text-align: center;
            font-size: 17px;
            font-weight: 600;
        }

        .about-img {
            margin-left: 450px;
        }

        @media (max-width: 768px) {
            .body {
                width: 80%;
                margin: 40px 40px 40px 40px;
            }
        }

        @media (min-width: 769px) {
            .body {
                width: 80%;
                margin-left: 175px;
                margin-right: 175px;
                margin-top: 100px;
                margin-bottom: 150px;
            }
        }

        .card-header {
            background-color: #5c5fad !important;
            color: white !important;
        }

        .form-group {
            padding: 20px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1);
            padding-bottom: 15px;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .form-group:last-child {
            border-bottom: none;
        }

        .btn-primary {
            background-color: #5c5fad !important;
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    @include('components.top-section', [
        'title' => 'WELCOME TO THE SELF ASSESSMENT TOOL',
        'animation' => 'json/self-assessment.json',
    ])

    <div class="main-container">
        <h1 class="title" data-aos="fade-down" data-aos-duration="700" data-aos-once="true">Self Assessment</h1>
        <p data-aos="fade-right" data-aos-duration="700" data-aos-once="true">
            A self-assessment tool that helps healthcare and education professionals measure, implement and improve
            their inclusion skills in daily practices.
        </p>

        <div class="content" data-aos="zoom-in" data-aos-duration="700" data-aos-once="true">
            <div id="result"></div>
            <form class="init-form" onsubmit="event.preventDefault(); handleInitSubmit(this);">
                @csrf
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="questionary_title">USER QUESTION</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="question">SELECT AN OPTION TO START</label>
                            <div class="rating">
                                <div class="options">
                                    <input type="radio" name="start-option"
                                        value="Are you a health care or educational professional?" required>
                                    <label>Are you a health care or educational professional?</label>
                                </div>
                                <div class="options">
                                    <input type="radio" name="start-option"
                                        value="Are you a woman considering maternity?" required>
                                    <label>Are you a woman considering maternity?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
            @csrf
            @foreach ($selfs as $self)
                @if ($self->title_en == 'Are you a health care or educational professional?')
                    <form class="self-assessment-form-x" onsubmit="event.preventDefault(); ">
                        <div class="card mb-4" data-self-id="{{ $self->id }}" data-title="{{ $self->title_en }}">
                            <div class="card-header">
                                <h4 class="questionary_title">QUESTIONARY</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($self->questions as $question)
                                    <div class="form-group" data-self-id={{ $question->id }}>
                                        <label class="question">{{ $question->question_en }}</label>
                                        <div class="rating">
                                            @php
                                                $options = explode(',', $question->options);
                                            @endphp
                                            @foreach ($options as $option)
                                                <div class="options">
                                                    <input type="radio" name="answer_{{ $question->id }}"
                                                        value={{ $option }} required
                                                        onchange="checkSelection({{ $question->id }})">
                                                    <label>{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="deselect" type="button" id="deselect_{{ $question->id }}"
                                            onclick="deselect({{ $question->id }})">Deselect</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="form1-submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                @else
                    <form class="self-assessment-form-y" onsubmit="event.preventDefault();">
                        <div class="card mb-4" data-self-id="{{ $self->id }}" data-title="{{ $self->title_en }}">
                            <div class="card-header">
                                <h4 class="questionary_title">QUESTIONARY</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($self->questions as $question)
                                    <div class="form-group" data-self-id={{ $question->id }}>
                                        <label class="question">{{ $question->question_en }}</label>
                                        <div class="rating">
                                            @php
                                                $options = explode(',', $question->options);
                                            @endphp
                                            @foreach ($options as $option)
                                                <div class="options">
                                                    <input class="answ" type="radio"
                                                        name="answer_{{ $question->id }}" value={{ $option }}
                                                        required onchange="checkSelection({{ $question->id }})">
                                                    <label>{{ $option }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="deselect" type="button" id="deselect_{{ $question->id }}"
                                            onclick="deselect({{ $question->id }})">Deselect</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="form2-submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                @endif
            @endforeach
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const radio = document.querySelectorAll('.answ');
        const initForm = document.querySelector('.init-form');
        const selfAssessmentFormX = document.querySelector('.self-assessment-form-x');
        const selfAssessmentFormY = document.querySelector('.self-assessment-form-y');

        function handleInitSubmit(form) {
            const formData = new FormData(form);
            const option = formData.get('start-option');
            if (option === 'Are you a health care or educational professional?') {
                initForm.style.display = 'none';
                selfAssessmentFormX.style.display = 'block';
            } else {
                initForm.style.display = 'none';
                selfAssessmentFormY.style.display = 'block';
            }
        }

        function checkSelection(questionId) {
            const isSelected = document.querySelector(`input[name="answer_${questionId}"]:checked`) !== null;
            document.getElementById(`deselect_${questionId}`).style.display = isSelected ? 'block' : 'none';
        }

        function deselect(questionId) {
            document.querySelectorAll(`input[name="answer_${questionId}"]`).forEach(radio => {
                radio.checked = false;
            });
            document.getElementById(`deselect_${questionId}`).style.display = 'none';
        }

        const result = document.getElementById('result');

        function showResult() {
            result.style.display = 'flex';
            result.innerHTML = 'Thank you for completing the self-assessment';
            selfAssessmentFormX.style.display = 'none';
            selfAssessmentFormY.style.display = 'none';
        }

        function handleSubmit() {
            showResult();
        }

        function validateForm() {
            const isSelected = document.querySelector('input[type="radio"]:checked') !== null;
            if (isSelected) {
                return true;
            }
            return false;
        }

        const submit1 = document.querySelector('button[type="form1-submit"]');
        const submit2 = document.querySelector('button[type="form2-submit"]');
        const buttons = [submit1, submit2];
        buttons.forEach(button => {
            if (validateForm) {
                button.addEventListener('click', handleSubmit);
            }

        });
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
