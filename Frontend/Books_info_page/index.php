<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/05eb19a694.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../Include/header.php'; ?>
    <?php

    // Tworzymy pusty koszyk, jeśli nie istnieje
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Połącz z bazą danych
    $connect = new mysqli('localhost', 'root', '', 'ebookly');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Sprawdzanie, czy parametry zostały przekazane przez adres URL
    if (isset($_GET['ks']) && isset($_GET['kat']) && isset($_GET['aut'])) {
        // Przypisanie wartości parametrów do odpowiednich zmiennych
        $id_produktu = $_GET['ks'];
        $id_kategoria = $_GET['kat'];
        $autorzy_id = $_GET['aut'];

        $query = "SELECT produkty.*, kategorie.nazwa_kategoria AS nazwa_kategoria, autorzy.imie, autorzy.nazwisko
        FROM produkty 
        JOIN kategorie ON produkty.kategoria_id = kategorie.id 
        JOIN autorzy_produkty ON produkty.id = autorzy_produkty.produkt_id
        JOIN autorzy ON autorzy_produkty.autor_id = autorzy.id
        WHERE produkty.id = $id_produktu";
        $result = $connect->query($query);

        // Sprawdzanie, czy zapytanie zwróciło wyniki
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $zdjecie_url = $row['zdjecie_url'];
        } else {
            // Jeśli zapytanie nie zwróciło wyników, ustaw domyślny URL obrazu
            $zdjecie_url = 'domyslny_url_zdjecia.jpg';
        }
    } else {
        // Jeśli brakuje któregoś z parametrów, ustaw domyślne wartości
        $id_produktu = 0;
        $id_kategoria = 0;
        $autorzy_id = 0;
        $zdjecie_url = 'domyslny_url_zdjecia.jpg';
    }
    ?>
    <div class="wrapper">
        <div class="main">
            <div class="left-div">
                <img src="<?= $zdjecie_url; ?>" alt="Product Image">
            </div>
            <div class="right-div">
                <div class="name-div">
                    <span>
                        <?= $row['nazwa'] ?? ''; ?>
                    </span>
                </div>
                <div class="author-div">
                    <span>
                        Autor:
                        <?= $row['imie'] ?? ''; ?>
                        <?= $row['nazwisko'] ?? ''; ?>
                    </span>
                </div>
                <div class="category-div">
                    <span>
                        Kategoria:
                        <?= $row['nazwa_kategoria'] ?? ''; ?>
                    </span>
                </div>
                <div class="disc-div">
                    <?= $row['opis'] ?? ''; ?>
                </div>
                <div class="price-div">
                    <span>
                        Cena:
                        <?= $row['cena'] ?? ''; ?> zł
                    </span>
                </div>
                <div class="icon-div">
                    <a href="#" class="add-to-cart">
                        <i class="fa-solid fa-cart-shopping fa-2xl" style="margin-right: 10px;"></i>Dodaj do Koszyka
                    </a>
                    <a href="#"><i class="fa-solid fa-heart fa-2xl"
                            style="margin-right: 10px; margin-left: 20px;"></i>Dodaj do ulubionych</a>
                </div>
                <div class="rating-div">
                    <?php
                    $ocena = $row['ocena'] ?? 0;
                    echo '<div class="rating-div">';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $ocena) {
                            echo '<i class="fas fa-star" style="color: #fb8500;"></i>';
                        } else {
                            echo '<i class="fas fa-star" style="color: grey;"></i>';
                        }
                    }
                    echo '</div>';
                    ?>
                    <div class="amount-div">
                        W magazynie pozostało
                        <?= $row['ilosc_na_stanie'] ?? ''; ?> sztuk
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../Include/footer.html'; ?>
</body>
<script>
    var productPrice = <?= $row['cena'] ?>;
    console.log("Cena produktu:", productPrice);
    document.addEventListener('DOMContentLoaded', function () {
        var addToCartBtn = document.querySelector('.icon-div a:first-child');

        addToCartBtn.addEventListener('click', function (event) {
            event.preventDefault();

            // Pobieranie danych produktu
            var productId = <?= $id_produktu ?>;
            var productName = "<?= addslashes($row['nazwa']) ?>";
            var productPrice = <?= $row['cena'] ?>;
            var productAuthor = "<?= addslashes($row['imie'] . ' ' . $row['nazwisko']) ?>";
            var productCategory = "<?= addslashes($row['nazwa_kategoria']) ?>";

            // Dodawanie produktu do koszyka w sessionStorage
            var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            var existingItem = cart.find(item => item.id === productId);

            if (existingItem) {
                // Jeśli produkt już istnieje w koszyku, zwiększamy ilość
                existingItem.quantity++;
            } else {
                // Jeśli produkt nie istnieje, dodajemy nowy produkt do koszyka
                cart.push({ id: productId, name: productName, price: productPrice, author: productAuthor, category: productCategory, quantity: 1 });
            }
            sessionStorage.setItem('cart', JSON.stringify(cart));

            alert('Produkt "' + productName + '" został dodany do koszyka.');
        });
    });
</script>


</html>