<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['haslo']))) {
    header('Location: form_logowanie.php');
    exit();
}
;
$connect = @new mysqli('localhost', 'root', '', 'ebookly');
$connect->select_db('ebookly');

if ($connect->connect_error) {
    echo "blad";
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

    $result = $connect->query(
        sprintf(
            "SELECT * FROM uzytkownicy WHERE login='%s' AND haslo='%s'",
            mysqli_real_escape_string($connect, $login),
            mysqli_real_escape_string($connect, $haslo)
        )
    );

    if ($result) {
        $ile_user = $result->num_rows;

        if ($ile_user > 0) {
            //Użytkownik istnieje
            $_SESSION['zalogowany'] = true;

            $tablica = $result->fetch_assoc();
            $_SESSION['id'] = $tablica['id'];
            $_SESSION['login'] = $tablica['login'];
            $_SESSION['haslo'] = $tablica['haslo'];
            $_SESSION['imie'] = $tablica['imie'];
            $_SESSION['nazwisko'] = $tablica['nazwisko'];
            $_SESSION['adres'] = $tablica['adres'];
            $_SESSION['numer_kontaktowy'] = $tablica['numer_kontaktowy'];
            $_SESSION['adres_email'] = $tablica['adres_email'];

            unset($_SESSION['blad']);
            $result->close();
            header('Location: konto.php');
        } else {
            // Brak użytkownika
            $_SESSION['blad'] = '<span style="color:red">Nieprawidlowy login lub haslo</span>';
            header('Location: form_logowanie.php');
        }
    }

    $connect->close();
}
?>