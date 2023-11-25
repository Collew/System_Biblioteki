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

// deeleteew
if (isset($_POST['usun_uzytkownika'])) {
    $user_id_to_remove = $_POST['user_id'];

    // delete
    $zapytanie_usun_uzytkownika = "DELETE FROM user WHERE ID_USER = '$user_id_to_remove'";
    $wynik_usun_uzytkownika = $polaczenie->query($zapytanie_usun_uzytkownika);

    if ($wynik_usun_uzytkownika === false) {
        die("Błąd usuwania użytkownika: " . $polaczenie->error);
    }

    // header
    header("Location: ../../admin.php");
    exit();
}
?>