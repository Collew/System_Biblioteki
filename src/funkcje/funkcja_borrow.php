<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: ../../logowanie.php");
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

if (isset($_POST['wypozycz'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['ID_USER'];
    
    // data teraz
    $date_start = date("Y-m-d H:i:s");
    
    // data za tydziren
    $date_back = date("Y-m-d H:i:s", strtotime($date_start . ' + 7 days'));

    // add
    $zapytanie_insert = "INSERT INTO borrow (DATE_START, DATE_BACK, BOOK_ID, USER_ID) VALUES ('$date_start', '$date_back', '$book_id', '$user_id')";
    
    if ($polaczenie->query($zapytanie_insert) === true) {
        header("Location: ../../biblioteka.php");
        exit();
    } else {
        echo "Błąd podczas dodawania wypożyczenia: " . $polaczenie->error;
    }
}

$polaczenie->close();
?>