<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autorzy</title>
    <?php
    //w wersji 7.5
    //error_reporting(0);
    //do php w wersji 8.x
    //mysqli_report(MYSQLI_REPORT_OFF);
    $connect = @new mysqli('localhost', 'root', '', 'ebookly');
    $connect->select_db('ebookly');
    if ($connect->connect_error) {
        echo "blad";
    }
    if (isset($_GET['mode'])) {
        if ($_GET['mode'] == 'Dodaj') {
            echo "TRYB: dodawanie <br>";
            echo "Dodawana tresc to:" . $_GET['imie'] . $_GET['nazwisko'];
            $query = "INSERT INTO autorzy (imie,nazwisko) VALUES ('{$_GET['imie']}', '{$_GET['nazwisko']}')";
            $connect->query($query);
            echo "<br>";

        }

        if ($_GET['mode'] == 'Usun') {
            echo "TRYB: Usuwanie <br>";
            echo "Usuwana tresc to: " . $_GET['id'];
            $query = "DELETE FROM `autorzy` WHERE `autorzy`.`id` = '{$_GET['id']}'";
            $connect->query($query);
            header('location: index.php?mode=wyswietl');
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'Modyfikacja') {
            echo "TRYB: Modyfikacja <br>";
            echo "Modyfikowana tresc to:" . $_GET['imie'] . $_GET['nazwisko'];
            $query = "UPDATE autorzy SET imie='{$_GET['imie']}', nazwisko='{$_GET['nazwisko']}'";
            $connect->query($query);
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'wyswietl') {

            $query = "SELECT * FROM autorzy";
            $result = $connect->query($query);
            echo <<<etykieta1
    <table border='1'>
    <tr>
    <td>ID</td>
    <td>Imie</td>
    <td>Nazwisko</td>
    <td>Opcja 1</td>
    <td>Opcja 2</td>
    </tr>
    etykieta1;

            while ($row = $result->fetch_object()) {
                echo <<<etykieta2
        <tr>
        <td>$row->id</td>
        <td>$row->imie</td>
        <td>$row->nazwisko</td>
        <td><a href="form_Modyfikacja.php?wartosc=$row->id">Modyfikuj</a></td>
        <td><a href="index.php?id=$row->id&mode=Usun">Usun</a></td>
        </tr>
        etykieta2;
            }

            echo "</table>";
            $result->free_result();
        }
    }


    ?>
</head>

<body>

    <a href="index.php?mode=wyswietl">wyswietl</a>
    <a href="form_dodaj.html">dodaj</a>
    <a href="form_modyfikuj.html">modyfikuj</a>

</body>

</html>