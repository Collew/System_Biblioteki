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

// efytuj
if (isset($_POST['edytuj_uzytkownika'])) {
    $user_id_to_edit = $_POST['user_id'];

    // header
    header("Location: edytuj_uzytkownika.php?user_id=$user_id_to_edit");
    exit();
}
?>
