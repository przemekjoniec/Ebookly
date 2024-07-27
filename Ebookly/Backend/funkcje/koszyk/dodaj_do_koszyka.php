<?php
session_start();

// Sprawdź, czy użytkownik jest zalogowany
if (isset ($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
    // Sprawdź, czy parametry zostały przekazane poprawnie
    if (isset ($_POST['id_produktu'])) {
        // Pobierz id produktu
        $id_produktu = $_POST['id_produktu'];

        // Tutaj możesz dodać kod odpowiedzialny za dodanie produktu do koszyka w bazie danych lub sesji
        // Na potrzeby tego przykładu dodajemy jedynie id produktu do sesji koszyka
        $_SESSION['koszyk'][] = $id_produktu;

        // Zwróć odpowiedź AJAX
        echo json_encode(array("status" => "success"));
    } else {
        // Zwróć odpowiedź AJAX w przypadku braku parametrów
        echo json_encode(array("status" => "error", "message" => "Brak parametrów"));
    }
} else {
    // Zwróć odpowiedź AJAX w przypadku braku zalogowania
    echo json_encode(array("status" => "error", "message" => "Użytkownik niezalogowany"));
}
?>