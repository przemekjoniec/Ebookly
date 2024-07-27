<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aboreto&family=Cormorant:ital,wght@0,300;1,300&family=Montserrat:wght@300&family=Poppins:wght@200;300&family=Unbounded&display=swap');

        .main-div {
            height: 56vh;
        }

        .div-1 {
            float: left;
            width: 60%;
            height: 100%;
            display: grid;
            align-items: center;
            text-align: center;
        }

        .p-big {
            font-family: 'Poppins', sans-serif;
            font-size: 36px;
            font-weight: 600;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .div-2 {
            float: left;
            width: 40%;
            height: 100%;
            background-image: url(../../Baza_Danych/Obrazy/Tło_PageInBuild/ReadingDoodle.png);
            background-size: cover;
        }

        .wrapper {
            overflow-x: hidden;
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>

<body>
    <?php
    include '../Include/header.php'
        ?>
    <section class="wrapper">
        <div class="main-div">
            <div class="div-1">
                <p class="p-big">STRONA W BUDOWIE<br>PRZECZYTAJ PARĘ KSIĄŻEK I WRÓĆ PÓŻNIEJ</p>
            </div>
            <div class="div-2">

            </div>
        </div>
    </section>

    <?php
    include '../Include/footer.html'
        ?>
</body>

</html>