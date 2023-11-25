<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: ../../logowanie.php");
    exit();
}

// acces lvl
if ($_SESSION['ACCESS_LEVEL_ID'] !== '1') {
    header("Location: ../../logowanie.php"); // header
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$baza_danych = "teb_4";

$polaczenie = new mysqli($host, $user, $password, $baza_danych);

if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

// delete
if (isset($_POST['usun_ksiazke'])) {
    $book_id_to_remove = $_POST['book_id'];

    // deeletwew
    $zapytanie_usun_ksiazke = "DELETE FROM book WHERE ID_BOOK = '$book_id_to_remove'";
    $wynik_usun_ksiazke = $polaczenie->query($zapytanie_usun_ksiazke);

    if ($wynik_usun_ksiazke === false) {
        die("Błąd usuwania książki: " . $polaczenie->error);
    }

    // header
    header("Location: ../../admin.php");
    exit();
}
?>