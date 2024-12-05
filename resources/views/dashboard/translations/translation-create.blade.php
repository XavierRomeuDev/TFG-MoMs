<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .key-container {
            width: 100%;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 15px;
        }

        .main-container {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        label{
            font-size: 18px;
        }
        input{
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 15px;
            outline: none;
            border: 2px solid #ccc;
        }

        .content-container{
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 15px;
        }

        .selection-container{
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 15px;
            width: 100%;
        }

        .selection-container select{
            width: 100%;
            height: 40px;
            box-sizing: border-box;
            padding: 10px;
            border-radius: 15px;
        }
        button{
            text-transform: uppercase;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 15px;
            background-color: #5C5FAD;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            box-shadow: #000000 0px 0px 2px;
        }

        .title{

            background-image: url('/images/TrianglePattern.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 100%;
            font-size: 70px;
            font-family: 'Pacifico', cursive;
            text-align: center;
            color: white;

        }

        button:hover{
            background-color:rgb(54, 56, 104)
        }


    </style>
</head>

<body>
    <section class="main-container">
        <h1 class="title">Create new translation</h1>
        <form action="{{ route('dashboard.translations.store', ['lang' => app()->getLocale()]) }}" method="POST" id="paragraphForm">
            @csrf
            <div class="key-container">
                <label for="key">Key</label>
                <input type="text" name="key" id="key" required>
            </div>
            <div id="paragraph" class="content-container">
                <x-forms.tinymce-editor name="value" id="value" />
            </div>
            <div class="selection-container">
                <label for="section">Section</label>
                <select name="section" id="section">
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
            </div>
            <button type="submit">Save</button>
        </form>
    </section>
</body>


</html>
