<?php
session_start();
if (!isset ($_SESSION['zalogowany'])) {
    header('Location: form_logowanie.php');
    exit();
}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konto</title>
</head>

<body>
    <?php
    echo "Witaj " . $_SESSION['login'] . '! [<a href="Wylogowanie.php">Wyloguj sie</a>]';
    echo "<br>" . $_SESSION['id'];
    echo "<br>" . $_SESSION['haslo'];
    echo "<br>" . $_SESSION['imie'];
    echo "<br>" . $_SESSION['nazwisko'];
    echo "<br>" . $_SESSION['adres'];
    echo "<br>" . $_SESSION['numer_kontaktowy'];
    echo "<br>" . $_SESSION['adres_email'];
    ?>
    <a href="../Main_Page/index.php">Przejdz na strone główna</a>

</body>

</html>