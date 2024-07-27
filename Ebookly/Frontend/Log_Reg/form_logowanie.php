<?php
session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
    header('Location: konto.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="logowanie.css">
</head>

<body>
    <div class="center">
    <form class="form_main" action="Zalogowanie.php" method="POST">
        <p class="heading">Logowanie</p>
        <div class="inputContainer">
            <input placeholder="Nazwa Użytkownika" id="username" class="inputField" type="text" name="login">
        </div>

        <div class="inputContainer">
            <input placeholder="Hasło" id="password" class="inputField" type="password" name="haslo">
        </div>
        <?php
        if (isset($_SESSION['blad'])) {
            echo $_SESSION['blad'];
        }
        ?>


        <button id="button"><a href="Zalogowanie.php"></a>Zaloguj się</a></button>
        <div class="signupContainer">
            <p>Nie masz konta?</p>
            <a class="register" href="form_rejestracja.php">Zarejestruj się</a>
        </div>
    </form>
    </div>


</body>

</html>