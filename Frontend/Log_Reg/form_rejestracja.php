<?php
session_start();

if (isset($_POST['email'])) {
    //Udana walidacja
    $walidacja = TRUE;

    //Sprawdzanie nazwy
    $login = $_POST['login'];
    //Sprawdzenie długosci nicku (3-20)
    if ((strlen($login) < 3) || (strlen($login) > 20)) {
        $walidacja = FALSE;
        $_SESSION['e_login'] = "Login powinien zawierać od 3 do 20 znaków";

    }
    if (ctype_alnum($login) == FALSE) {
        $walidacja = FALSE;
        $_SESSION['e_login'] = "Login powinien zawierać tylko litery i cyfry(bez polskich znaków)";
    }
    //Sprawdzanie email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL) == FALSE || ($emailB != $email))) {
        $walidacja = FALSE;
        $_SESSION['e_email'] = "Sprawdź poprawność adresu e-mail";
    }

    //Sprawdzanie hasła
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    //Sprawdzenie długosci hasła (8-20)
    if ((strlen($password1) < 8) || (strlen($password1) > 20)) {
        $walidacja = FALSE;
        $_SESSION['e_haslo'] = "Hasło powinno zawierać od 8 do 20 znaków";
    }
    if ($password1 != $password2) {
        $walidacja = FALSE;
        $_SESSION['e_haslo'] = "Hasła powinny być takie same";
    }

    //Sprawdzanie regulaminu
    if (!isset($_POST["regulamin"])) {
        $walidacja = FALSE;
        $_SESSION['e_regulamin'] = "Potwierdź regulamin";
    }

    //Sprawdzanie reCaptcha
    $secret_key = "6Le5s0ApAAAAAEun7tfubwWxDad3RVnBLFLVjRCT";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST[
        'g-recaptcha-response']);

    $reCaptcha_response = json_decode($check);

    if ($reCaptcha_response->success == FALSE) {
        $walidacja = FALSE;
        $_SESSION['e_recaptcha'] = "Potwierdź reCaptche";
    }

    //Sprawdzanie duplikacji kont
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connect = new mysqli('localhost', 'root', '', 'ebookly');
        if ($connect->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Czy email juz w bazie istnieje
            $result = $connect->query("SELECT id FROM uzytkownicy WHERE adres_email='$email'");
            if (!$result)
                throw new Exception($connect->error);

            $ilosc_emaili = $result->num_rows;
            if ($ilosc_emaili > 0) {
                $walidacja = FALSE;
                $_SESSION['e_email'] = "Istnieje konto o podanym e-mailu";
            }
            //Czy login juz w bazie istnieje
            $result = $connect->query("SELECT id FROM uzytkownicy WHERE login='$login'");
            if (!$result)
                throw new Exception($connect->error);

            $ilosc_loginow = $result->num_rows;
            if ($ilosc_loginow > 0) {
                $walidacja = FALSE;
                $_SESSION['e_login'] = "Istnieje konto o podanym loginie";
            }

            //Koniec Walidacja
            if ($walidacja == TRUE) {
                //Walidacja ukończona poprawnie, użytkownik zostaje dodany do bazy
                if ($connect->query("INSERT INTO uzytkownicy VALUES (NULL,'$login',NULL,NULL,NULL,NULL,'$email','$password1',NULL)")) {
                    $_SESSION['rejestracjaPoprawna'] = true;
                    header('Location: form_logowanie.php');
                } else {
                    throw new Exception($connect->error);
                }
            }
            $connect->close();
        }
    } catch (Exception $e) {
        echo "Błąd serwera";
        echo '<br>Informacja deweloperska: ' . $e;
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="rejestracja.css">
    <title>Rejestracja</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="center">
        <form class="form_main" method="POST">
            <p class="heading">Rejestracja</p>
            <div class="inputContainer">
                <input placeholder="Nazwa" id="login" class="inputField" type="text" name="login">
                <?php
                if (isset($_SESSION["e_login"])) {
                    echo '<div class="error">' . $_SESSION['e_login'] . '</div>';
                    unset($_SESSION['e_login']);
                }
                ?>
            </div>
            <div class="inputContainer">
                <input placeholder="Email" id="email" class="inputField" type="text" name="email">
                <?php
                if (isset($_SESSION["e_email"])) {
                    echo '<div class="error">' . $_SESSION['e_email'] . '</div>';
                    unset($_SESSION['e_email']);
                }
                ?>
            </div>
            <div class="inputContainer">
                <input placeholder="Twoje hasło" id="password1" class="inputField" type="password" name="password1">
                <?php
                if (isset($_SESSION["e_haslo"])) {
                    echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>';
                    unset($_SESSION['e_haslo']);
                }
                ?>
            </div>
            <div class="inputContainer">
                <input placeholder="Powtórz hasło" id="password2" class="inputField" type="password" name="password2">
                <?php
                if (isset($_SESSION["e_haslo"])) {
                    echo '<div class="error">' . $_SESSION['e_haslo'] . '</div>';
                    unset($_SESSION['e_haslo']);
                }
                ?>
            </div>
            <div class="inputContainer">
                <label>
                    <input type="checkbox" name="regulamin"> Akceptuje regulamin
                    <?php
                    if (isset($_SESSION["e_regulamin"])) {
                        echo '<div class="error">' . $_SESSION['e_regulamin'] . '</div>';
                        unset($_SESSION['e_regulamin']);
                    }
                    ?>
                </label>
            </div>
            <div class="g-recaptcha" data-sitekey="6Le5s0ApAAAAAKSaXBfMH_NVzbjMqzGYXkl4P4hI"></div>
            <?php
            if (isset($_SESSION["e_recaptcha"])) {
                echo '<div class="error">' . $_SESSION['e_recaptcha'] . '</div>';
                unset($_SESSION['e_recaptcha']);
            }
            ?>
            <button id="button"><a href="Zalogowanie.php"></a>Zarejestruj się!</a></button>
            <div class="signupContainer">
                <p>Masz już konto?</p>
                <a href="form_logowanie.php">Zaloguj się</a>
            </div>
        </form>
    </div>
</body>

</html>