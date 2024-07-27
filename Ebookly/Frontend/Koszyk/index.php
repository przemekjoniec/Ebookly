<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Koszyk</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Aboreto&family=Cormorant:ital,wght@0,300;1,300&family=Montserrat:wght@300&family=Poppins:wght@200;300&family=Unbounded&display=swap');

        .wrapper {
            overflow-x: hidden;
            margin-left: 5%;
            margin-right: 5%;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            margin-top: auto;
            background-color: #fff;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item .left-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cart-item .name {
            font-weight: 500;
        }

        .cart-item .info {
            font-size: 14px;
            color: #666;
        }

        .cart-item .right-content {
            display: flex;
            align-items: center;
        }

        .cart-item .quantity,
        .cart-item .price {
            margin-right: 20px;
            font-weight: 500;
        }

        .cart-item button {
            margin-left: 10px;
            background-color: #fb8500;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-item button:hover {
            background-color: #d06d00;
        }

        .total-price {
            margin-top: 20px;
            font-weight: bold;
            align-self: flex-end;
            margin-right: 5%;
        }

        .submit-order {
            margin-top: 2vh;
            background-color: #fb8500;
            color: #fff;
            font-size: 16px;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-order:hover {
            background-color: #d06d00;
        }

        .delivery-info-div {
            width: 100%;
        }

        .delivery-info-left {
            width: 50%;
            float: left;
        }

        .delivery-info-right {
            width: 50%;
            float: left;
            margin-bottom: 5vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <?php include '../Include/header.php'; ?>
            <div class="wrapper">
                <h2>Twój koszyk</h2>
                <div id="cart-items">
                    <!-- Tutaj będą wyświetlane produkty z koszyka -->
                </div>
                <div class="delivery-info-div">
                    <div class="delivery-info-left">
                        <form>
                            <p>Wybierz sposób dostawy: <br>(koszt 10zł)</p>
                            <input type="radio" name="dostawa" value="InPost Paczkomat® 24/7">InPost Paczkomat® 24/7<br>
                            <input type="radio" name="dostawa" value="DPD Pickup punkt odbioru/automat
                            paczkowy/Żabka">DPD Pickup punkt odbioru/automat
                            paczkowy/Żabka<br>
                            <input type="radio" name="dostawa" value="ORLEN Paczka odbiór w punkcie">ORLEN Paczka odbiór
                            w punkcie<br>
                            <input type="radio" name="dostawa" value="Kurier InPost">Kurier InPost<br>
                            <input type="radio" name="dostawa" value="Odbiór w Pocztex Punkt, sklep Żabka">Odbiór w
                            Pocztex Punkt, sklep Żabka<br>
                            <input type="radio" name="dostawa" value="Pocztex Kurier">Pocztex Kurier<br>
                        </form>
                    </div>
                    <div class="delivery-info-right">
                        <form>
                            <p>Wybierz sposób płatności:</p>
                            <input type="radio" name="platnosc" value="Szybkie płatności online i kartą">Szybkie
                            płatności online i kartą<br>
                            <input type="radio" name="platnosc" value="Apple Pay">Apple Pay<br>
                            <input type="radio" name="platnosc" value="BLIK">BLIK<br>
                            <input type="radio" name="platnosc" value="Zwykły przelew">Zwykły przelew<br>
                        </form><br><br>
                    </div>
                </div>
                <p>Dane do dostawy:</p>
                <input name="Imię" placeholder="Imię" required="yes">
                <input name="Nazwisko" placeholder="Nazwisko" required="yes"><br>
                <input name="Ulica" placeholder="Ulica i numer domu" required="yes">
                <input name="Miasto" placeholder="Miasto i kod pocztowy" required="yes"><br>
                <input type="tel" name="phone" placeholder="Numer telefonu" required="yes">
                <input type="email" name="email" placeholder="Adres Email" required="yes"><br>
                <div class="total-price">Łączna cena: <span id="total-price">0 zł</span><br>
                    <button class="submit-order">Złóż zamówienie</button>
                </div>
            </div>
        </div>
        <?php include '../Include/footer.html'; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cartItemsDiv = document.getElementById('cart-items');
            var totalPriceSpan = document.getElementById('total-price');

            function updateCart() {
                cartItemsDiv.innerHTML = ''; // Wyczyść poprzednie elementy koszyka
                var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                var totalPrice = 10; // Zmienna przechowująca łączną cenę

                cart.forEach(function (item) {
                    var cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item');

                    cartItem.innerHTML = `
                        <div class="left-content">
                            <div class="name">${item.name}</div>
                            <div class="info">Autor: ${item.author}, Kategoria: ${item.category}</div>
                        </div>
                        <div class="right-content">
                            <div class="quantity">Ilość: ${item.quantity}</div>
                            <div class="price">${item.price * item.quantity} zł</div>
                            <button class="remove-from-cart" data-id="${item.id}">Usuń</button>
                            <button class="increase-quantity" data-id="${item.id}">Zwiększ ilość</button>
                        </div>
                    `;

                    cartItemsDiv.appendChild(cartItem);

                    totalPrice += item.price * item.quantity;

                });

                // Zaktualizuj wyświetlaną łączną cenę
                totalPriceSpan.textContent = totalPrice + ' zł';
            }

            updateCart();

            cartItemsDiv.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-from-cart')) {
                    var itemId = event.target.getAttribute('data-id');
                    console.log("Id produktu do usunięcia:", itemId);

                    var cart = JSON.parse(sessionStorage.getItem('cart')) || [];

                    // Znajdź indeks elementu w koszyku
                    var indexToRemove = cart.findIndex(function (item) {
                        return item.id === parseInt(itemId);
                    });

                    // Usuń jedną sztukę produktu z koszyka
                    if (indexToRemove !== -1) {
                        if (cart[indexToRemove].quantity > 1) {
                            cart[indexToRemove].quantity--;
                        } else {
                            // Jeśli ilość wynosi 1, usuń cały produkt z koszyka
                            cart.splice(indexToRemove, 1);
                        }

                        console.log("Zaktualizowany koszyk po usunięciu:", cart);
                        sessionStorage.setItem('cart', JSON.stringify(cart));

                        updateCart();
                    }
                } else if (event.target.classList.contains('increase-quantity')) {
                    var itemId = event.target.getAttribute('data-id');
                    console.log("Id produktu do zwiększenia ilości:", itemId);

                    var cart = JSON.parse(sessionStorage.getItem('cart')) || [];

                    // Znajdź indeks elementu w koszyku
                    var indexToIncrease = cart.findIndex(function (item) {
                        return item.id === parseInt(itemId);
                    });

                    // Zwiększ ilość produktu w koszyku o 1
                    if (indexToIncrease !== -1) {
                        cart[indexToIncrease].quantity++;

                        console.log("Zaktualizowany koszyk po zwiększeniu ilości:", cart);
                        sessionStorage.setItem('cart', JSON.stringify(cart));

                        updateCart();
                    }
                }
            });


            // Timer na usuwanie koszyka po 10 minutach nieaktywności
            var timeout;
            function resetCart() {
                sessionStorage.removeItem('cart');
                updateCart();
            }

            function startTimer() {
                clearTimeout(timeout);
                timeout = setTimeout(resetCart, 600000);
            }

            startTimer();

            // Dodaje obsługę zdarzenia kliknięcia na koszyk, aby zresetować timer
            document.addEventListener('click', function () {
                startTimer();
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // ...

            document.querySelector('.submit-order').addEventListener('click', function () {
                // Sprawdzanie czy koszyk nie jest pusty
                var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
                if (cart.length === 0) {
                    alert('Nie możesz złożyć zamówienia, koszyk jest pusty.');
                    return;
                }

                // Sprawdzanie czy została wybrana dostawa i płatność
                var selectedDelivery = document.querySelector('input[name="dostawa"]:checked');
                var selectedPayment = document.querySelector('input[name="platnosc"]:checked');
                if (!selectedDelivery || !selectedPayment) {
                    alert('Proszę wybrać sposób dostawy i płatności.');
                    return;
                }

                // Pobieranie danych do dostawy
                var firstName = document.querySelector('input[name="Imię"]').value.trim();
                var lastName = document.querySelector('input[name="Nazwisko"]').value.trim();
                var address = document.querySelector('input[name="Ulica"]').value.trim();
                var city = document.querySelector('input[name="Miasto"]').value.trim();
                var phone = document.querySelector('input[name="phone"]').value.trim();
                var email = document.querySelector('input[name="email"]').value.trim();

                // Sprawdzanie czy wszystkie pola są wypełnione
                if (!firstName || !lastName || !address || !city || !phone || !email) {
                    alert('Proszę wypełnić wszystkie pola.');
                    return;
                }

                // Wyświetl komunikat potwierdzający zamówienie
                alert('Twoje zamówienie zostało złożone, w celu dokonania płatności odwiedź swoją pocztę email, dokładne informacje znajdziesz w wiadomości od naszego sklepu. Dziękujemy za zakup na naszej stronie!');
                window.location.reload();
            });
        });

    </script>
</body>

</html>