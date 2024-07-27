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
    echo "Id do modyfikacji to:" . $_GET['wartosc'];
    $query = "SELECT * FROM autorzy_produkty WHERE id='{$_GET['wartosc']}'";


    $row = $connect->query($query)->fetch_object();
    echo <<<html
        <form action="index.php" method="GET">
            <input type="number" name="id" value="$row->id" placeholder="ID">
            <input type="number" name="autor_id" value="$row->autor_id" placeholder="Autor ID">
            <input type="number" name="produkt_id" value="$row->produkt_id" placeholder="Produkt ID">
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