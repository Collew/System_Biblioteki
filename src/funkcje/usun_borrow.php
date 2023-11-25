<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: ../../logowanie.php");
    exit();
}

// acces level
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

// borrow
if (isset($_POST['usun_borrow'])) {
    $borrow_id_to_remove = $_POST['borrow_id'];

    // borrow
    $zapytanie_usun_borrow = "DELETE FROM borrow WHERE ID_BORROW = '$borrow_id_to_remove'";
    $wynik_usun_borrow = $polaczenie->query($zapytanie_usun_borrow);

    if ($wynik_usun_borrow === false) {
        die("Błąd usuwania wypożyczenia: " . $polaczenie->error);
    }

    // hEaDeR
    header("Location: ../../admin.php");
    exit();
}
?>