<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Ebookly.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="main.css">
</head>
<?php
// Połącz z bazą danych
$connect = new mysqli('localhost', 'root', '', 'ebookly');
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<body>
    <?php
    include '../Include/header.php'
        ?>
    <section class="wrapper">
        <!-- PIERWSZA SEKCJA -->
        <div class="div1">
            <div class="div1-left">
                <div class="div1-left-1" style="margin-left: 10vh;">
                    <p class="p-small" style="color: #fb8500;">Oferta Specjalna</p>
                </div>
                <div class="div1-left-2">
                    <p class="p-big" style="margin-left: 10vh;">Nawet do 30% rabatu</p>
                </div>
                <div class="div1-left-3">
                    <p class="p-small" style="margin-left: 10vh;">Dla stałych klientów</p>
                </div>
                <div class="div1-left-4" style="margin-left: 10vh;">
                    <p class="p-text">Przy twoim kolejnym zamówieniu dostanie doliczony rabat 10%<br>za każdą książkę,
                        maksymalnie do 30%.</p>
                </div>
                <div class="div1-left-5">
                    <a href="../page_in_build/page_in_build.php"><button class="div1-left-btn"
                            style="margin-left: 10vh;">Sprawdź naszą ofertę</button></a>
                    <a href="../page_in_build/page_in_build.php"><button class="div1-left-btn"
                            style="background-color:transparent; border: 1px solid black;">Pozostałe
                            Promocje</button></a>
                </div>
            </div>

            <div class="div1-right">
                <div class="div1-right-1">
                    <p class="p-big">BESTSELLER</p>
                </div>
                <div class="div1-right-2">
                    <div class="book-list">
                    <?php
                    $id_produktu = 41;
                    $id_kategoria = 15;
                    $autorzy_id = 30;
                    include '../Include/product_card.php'
                        ?>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <section class="wrapper">
        <!-- DRUGA SEKCJA -->
        <div class="main-page">
            <div class="book-list-name">Wybrane dla <a class="a-yellow">Ciebie</a></div>
            <div class="book-list">
                <div class="book-list">
                    <?php
                    $id_produktu = 31;
                    $id_kategoria = 15;
                    $autorzy_id = 23;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 32;
                    $id_kategoria = 15;
                    $autorzy_id = 24;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 33;
                    $id_kategoria = 5;
                    $autorzy_id = 24;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 34;
                    $id_kategoria = 5;
                    $autorzy_id = 25;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 35;
                    $id_kategoria = 5;
                    $autorzy_id = 26;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 36;
                    $id_kategoria = 15;
                    $autorzy_id = 27;
                    include '../Include/product_card.php'
                        ?>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper">
        <!-- DRUGA SEKCJA -->
        <div class="main-page">
            <div class="book-list-name">Najciekawsze <a class="a-yellow">nowości</a></div>
            <div class="book-list">
                <div class="book-list">
                    <?php
                    $id_produktu = 37;
                    $id_kategoria = 5;
                    $autorzy_id = 28;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 38;
                    $id_kategoria = 15;
                    $autorzy_id = 28;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 39;
                    $id_kategoria = 5;
                    $autorzy_id = 29;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 40;
                    $id_kategoria = 5;
                    $autorzy_id = 28;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 41;
                    $id_kategoria = 15;
                    $autorzy_id = 30;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 42;
                    $id_kategoria = 5;
                    $autorzy_id = 31;
                    include '../Include/product_card.php'
                        ?>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper">
        <!-- DRUGA TRZECIA -->
        <div class="main-page">
            <div class="book-list-name">Najświeższa <a class="a-yellow">E-Prasa</a></div>
            <div class="book-list">
                <div class="book-list">
                    <?php
                    $id_produktu = 43;
                    $id_kategoria = 17;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 44;
                    $id_kategoria = 15;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 45;
                    $id_kategoria = 17;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 46;
                    $id_kategoria = 17;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 47;
                    $id_kategoria = 17;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
                <div class="book-list">
                    <?php
                    $id_produktu = 48;
                    $id_kategoria = 17;
                    $autorzy_id = 0;
                    include '../Include/product_card.php'
                        ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    include '../Include/footer.html'
        ?>

</body>


</html>