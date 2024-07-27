<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    echo "Id pytania do modyfikacji to:" . $_GET['wartosc'];
    $query = "SELECT * FROM produkty WHERE id='{$_GET['wartosc']}'";


    $row = $connect->query($query)->fetch_object();
    echo <<<html
        <form action="index.php" method="GET">
            <input type="number" name="id" value="$row->id" placeholder="id">
            <input type="text" name="nazwa" value="$row->nazwa" placeholder="Nazwa">
            <input type="number" name="cena" value="$row->cena" placeholder="Cena">
            <input type="text" name="opis" value="$row->opis" placeholder="Opis">
            <input type="text" name="zdjecie" value="$row->zdjecie_url" placeholder="Url zdjęcia">
            <input type="number" name="ilosc" value="$row->ilosc_na_stanie" placeholder="Ilosc">
            <input type="number" name="kategoria" value="$row->kategoria_id" placeholder="Id kategorii">
            <input type="submit" name="mode" value="Modyfikacja">
        </form>
    html;
    // $row->free_result();
    $connect->close();
    ?>
</head>

<body>



</body>

</html>