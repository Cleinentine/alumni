<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{ env('APP_NAME') }}</title>
    </head>

    <body style="font-family: 'Nunito' sans-serif; font-size: 16px;">
        <header style="background-color: maroon; color: white; padding: 15px; text-align: center;">
            <div style="text-align: center;">
                <img alt="CSUA Logo" src="https://csu.edu.ph/img/csulogo.png" style="width: 120px;">
            </div>

            <h2 style="font-family: 'Montserrat', sans-serif; font-size: 56px; font-weight: 900; margin: 0 auto; padding: 0 auto;">CSUAN AKO</h2>
            <h3 style="font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: 300; margin: 0 auto; padding: 0 auto;">AN ONLINE ALUMNI REPOSITORY</h3>
        </header>

        <section style="background-color: #F6F6F8; padding: 50px 25px; text-align: center;">
            <p style="letter-spacing: 1px; line-height: 30px; margin: auto; width: 50%;">
                The Alumni Tracer Office is sending a formal reminder to all graduates to update their information in the tracer system as part of our annual data 
                verification process.
            </p>

            <a style="background-color: #ef4444; color: white; display: inline-block; font-weight: bold; margin-top: 15px; padding: 15px; text-decoration: none;" href="{{ route('home') }}">
                GO TO CSUAN AKO
            </a>
        </section>
    </body>
</html>