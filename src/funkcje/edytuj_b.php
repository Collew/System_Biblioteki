<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$baza_danych = "teb_4";

$polaczenie = new mysqli($host, $user, $password, $baza_danych);

if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

// edycja
if (isset($_POST['edytuj_ksiazke'])) {
    $book_id_to_edit = $_POST['book_id'];

    // header
    header("Location: edytuj_ksiazke.php?user_id=$book_id_to_edit");
    exit();
}
?>
