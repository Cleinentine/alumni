<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            div {
                text-align: center;
            }

            footer {
                background-color: gold;
                padding: 5px;
            }

            header {
                background-color: maroon;
                color: white;
                padding: 15px;
            }

            h2 {
                font-family: 'Montserrat', sans-serif;
                font-size: 56px;
                font-weight: 900;
                text-align: center;
            }

            h3 {
                font-family: 'Montserrat', sans-serif;
                font-size: 16px;
                font-weight: 300;
                text-align: center;
            }

            h4 {
                font-family: 'Nunito', sans-serif;
                font-size: 18px;
                letter-spacing: 1px;
                text-align: center;
            }

            img {
                width: 120px;
            }

            p {
                font-family: 'Nunito', sans-serif;
                letter-spacing: 1px;
                line-height: 30px;
                margin: auto;
                text-align: center;
                width: 50%;
            }

            section {
                background-color: lightgray;
                padding: 50px 25px;
            }
        </style>

        <title>{{ $subject }}</title>
    </head>

    <body>
        <header>
            <div>
                <img alt="CSUA Logo" src="https://csu.edu.ph/img/csulogo.png">
            </div>

            <h2>CSUAN AKO</h2>
            <h3>AN ONLINE ALUMNI REPOSITORY</h3>
        </header>

        <section>
            <p>{{ $contactMessage }}</p>
        </section>

        <footer>
            <h4>From: {{ $name }}</h4>
        </footer>
    </body>
</html>