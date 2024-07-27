<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        /*---CARD---*/
        .book-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        img {
            border-radius: 20px;
        }

        .card-image {
            width: 190px;
            height: 280px;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .category {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: #219ebc;
            padding-left: 2px;
            padding-top: 5px;
        }

        .heading {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: #000000;
            padding-left: 2px;
        }

        .heading_cena {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #000000;
            padding-left: 2px;
            padding-top: 5px;
        }

        .author {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #000000;
            padding-left: 2px;
        }

        .book-list-button {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            margin-top: 5%;
            height: 40px;
            width: 100%;
            border: none;
            border-radius: 6px;
            background-color: #e5e5e5;
        }

        .a-yellow {
            color: #fb8500;
        }

        .book-list-button:hover {
            transition: 0.4s;
            background-color: #fb8500;
        }

        .book-list-name {
            margin-bottom: 10px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 600;
            color: #000000;
        }
    </style>
</head>

<body>

    <?php
    $query = "SELECT produkty.*, kategorie.nazwa_kategoria AS nazwa_kategoria, autorzy.imie, autorzy.nazwisko
    FROM produkty 
    JOIN kategorie ON produkty.kategoria_id = kategorie.id 
    JOIN autorzy_produkty ON produkty.id = autorzy_produkty.produkt_id
    JOIN autorzy ON autorzy_produkty.autor_id = autorzy.id
    WHERE produkty.id = $id_produktu";
    $result = $connect->query($query);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        ?>
        <div class="card">
            <div class="card-image">
                <a
                    href="../Books_info_page/index.php?ks=<?= $id_produktu ?>&kat=<?= $id_kategoria ?>&aut=<?= $autorzy_id ?>"><img
                        src="<?= $product['zdjecie_url'] ?? ''; ?>" alt="Product Image"></a>
            </div>
            <div class="heading">
                <?= $product['nazwa'] ?? ''; ?>
            </div>
            <div class="category">
                <?= $product['nazwa_kategoria'] ?? ''; ?>
            </div>
            <div class="heading_cena">
                <?= $product['cena'] ?? ''; ?> zł
            </div>
        </div>
        <?php
    } else {
        echo "Produkt o podanym ID nie istnieje.";
    }
    ?>
</body>

</html>