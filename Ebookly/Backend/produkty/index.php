<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produkty</title>
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
            echo "Dodawana tresc to:" . $_GET['nazwa'] . ", cena: " . $_GET['cena'] . ", opis: " . $_GET['opis'] . ", zdjecie: " . $_GET['zdjecie'] . ", ilosc: " . $_GET['ilosc'] . ", kategoria: " . $_GET['kategoria'];
            $query = "INSERT INTO produkty (nazwa,cena,opis,zdjecie_url,ilosc_na_stanie,kategoria_id) VALUES ('{$_GET['nazwa']}', '{$_GET['cena']}','{$_GET['opis']}','{$_GET['zdjecie']}','{$_GET['ilosc']}','{$_GET['kategoria']}')";
            $connect->query($query);
            echo "<br>";

        }

        if ($_GET['mode'] == 'Usun') {
            echo "TRYB: Usuwanie <br>";
            echo "Usuwana tresc to: " . $_GET['id'];
            $query = "DELETE FROM `produkty` WHERE `produkty`.`id` = '{$_GET['id']}'";
            $connect->query($query);
            header('location: index.php?mode=wyswietl');
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'Modyfikacja') {
            echo "TRYB: Modyfikacja <br>";
            echo "Modyfikowana tresc to:" . $_GET['nazwa'] . ", cena: " . $_GET['cena'] . ", opis: " . $_GET['opis'] . ", zdjecie: " . $_GET['zdjecie'] . ", ilosc: " . $_GET['ilosc'] . ", kategoria: " . $_GET['kategoria'];
            $query = "UPDATE produkty SET nazwa='{$_GET['nazwa']}', cena='{$_GET['cena']}', opis='{$_GET['opis']}', zdjecie_url='{$_GET['zdjecie']}', ilosc_na_stanie='{$_GET['ilosc']}', kategoria_id='{$_GET['kategoria']}' WHERE id = '{$_GET['id']}'";
            $connect->query($query);
            echo "<br>";
        }
        
        if ($_GET['mode'] == 'wyswietl') {

            $query = "SELECT * FROM produkty";
            $result = $connect->query($query);
            echo <<<etykieta1
    <table border='1'>
    <tr>
    <td>ID</td>
    <td>Nazwa</td>
    <td>Cena</td>
    <td>Opis</td>
    <td>Zdjęcie</td>
    <td>Ilosc</td>
    <td>Kategoria</td>
    <td>Opcja 1</td>
    <td>Opcja 2</td>
    </tr>
    etykieta1;

            while ($row = $result->fetch_object()) {
                echo <<<etykieta2
        <tr>
        <td>$row->id</td>
        <td>$row->nazwa</td>
        <td>$row->cena</td>
        <td>$row->opis</td>
        <td>$row->zdjecie_url</td>
        <td>$row->ilosc_na_stanie</td>
        <td>$row->kategoria_id</td>
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
</body>

</html>