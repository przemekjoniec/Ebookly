<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kategorie</title>
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
            echo "TRYB: dodwanie <br>";
            echo "Dodawana tresc to:" . $_GET['nazwa'];
            $query = "INSERT INTO kategorie (nazwa_kategoria) VALUES ('{$_GET['nazwa']}')";
            $connect->query($query);
            echo "<br>";

        }

        if ($_GET['mode'] == 'Usun') {
            echo "TRYB: Usuwanie <br>";
            echo "Usuwana tresc to: " . $_GET['id'];
            $query = "DELETE FROM `kategorie` WHERE `kategorie`.`id` = '{$_GET['id']}'";
            $connect->query($query);
            header('location: index.php?mode=wyswietl');
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'Modyfikacja') {
            echo "TRYB: Modyfikacja <br>";
            echo "Modyfikowana tresc to:" . $_GET['nazwa_kategoria'];
            $query = "UPDATE kategorie SET nazwa_kategoria='{$_GET['nazwa_kategoria']}' WHERE `kategorie`.`id` = '{$_GET['id']}'";
            $connect->query($query);
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'wyswietl') {

            $query = "SELECT * FROM kategorie";
            $result = $connect->query($query);
            echo <<<etykieta1
    <table border='1'>
    <tr>
    <td>ID</td>
    <td>Nazwa</td>
    <td>Opcja 1</td>
    <td>Opcja 2</td>
    </tr>
    etykieta1;

            while ($row = $result->fetch_object()) {
                echo <<<etykieta2
        <tr>
        <td>$row->id</td>
        <td>$row->nazwa_kategoria</td>
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
    <a href="form_Modyfikacja.php">modyfikuj</a>

</body>

</html>