<?php
session_start(); // sesja

$host = "localhost";
$user = "root";
$password = "";
$baza_danych = "teb_4";

$polaczenie = new mysqli($host, $user, $password, $baza_danych);

if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

function filtruj($dane) {
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = filtruj($_POST["login"]);
    $password = filtruj($_POST["password"]);
    $password_powtorz = filtruj($_POST["password_powtorz"]);

    // validacja hasel
    if ($password !== $password_powtorz) {
        $_SESSION['komunikat_rejestracja'] = "Hasła nie są identyczne. Spróbuj ponownie.";
        header("Location: ../../rejestracja.php"); // header
        exit();
    }

    // validacja loginu
    $zapytanie_sprawdzenie = "SELECT * FROM user WHERE login = '$login'";
    $wynik_sprawdzenie = $polaczenie->query($zapytanie_sprawdzenie);

    if ($wynik_sprawdzenie === false) {
        die("Błąd zapytania do bazy danych: " . $polaczenie->error);
    }

    if ($wynik_sprawdzenie->num_rows > 0) {
        $_SESSION['komunikat_rejestracja'] = "Użytkownik o podanym loginie już istnieje.";
        header("Location: ../../rejestracja.php"); // header
        exit();
    }

    $user_access = 2;// xD lux robota
    $zapytanie_dodanie = "INSERT INTO user (login, password, access_level_id) VALUES ('$login', '$password', '$user_access')";
    $wynik_dodanie = $polaczenie->query($zapytanie_dodanie);

    if ($wynik_dodanie === true) {
        $_SESSION['komunikat_rejestracja'] = "Rejestracja pomyślna. Możesz się teraz zalogować.";
        header("Location: ../../logowanie.php"); // header
        exit();
    } else {
        $_SESSION['komunikat_rejestracja'] = "Błąd rejestracji. Spróbuj ponownie.";
        header("Location: ../../rejestracja.php"); // header
        exit();
    }
}

$polaczenie->close();
?>