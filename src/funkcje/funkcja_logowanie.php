<?php
session_start(); // sesja

$host = "localhost"; // host, login, pass, baza
$user = "root"; 
$password = ""; 
$baza_danych = "teb_4"; 

// connnnnnnnnnn
$polaczenie = new mysqli($host, $user, $password, $baza_danych);

// error
if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

// cooooo? sprawdzam!!
function filtruj($dane) {
    $dane = trim($dane);
    $dane = stripslashes($dane);
    $dane = htmlspecialchars($dane);
    return $dane;
}



// login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = filtruj($_POST["login"]);
    $password = filtruj($_POST["password"]);

    // cooooo? sprawdzam!!
    $zapytanie = "SELECT * FROM user WHERE login = '$login' AND password = '$password'";
    $wynik = $polaczenie->query($zapytanie);

    // error
    if ($wynik === false) {
        die("Błąd zapytania do bazy danych: " . $polaczenie->error);
    }


    if ($wynik->num_rows > 0) {
        $user = $wynik->fetch_assoc();
        $_SESSION['zalogowany'] = true;
        $_SESSION['login'] = $login;
        
        // cooooo? sprawdzam!! acces lvl
        $_SESSION['ACCESS_LEVEL_ID'] = $user['ACCESS_LEVEL_ID'];

        if ($_SESSION['ACCESS_LEVEL_ID'] == '1') {
            header("Location: ../../admin.php");
            exit();
        } elseif ($_SESSION['ACCESS_LEVEL_ID'] == '2') {
            header("Location: ../../biblioteka.php");
            exit();
        } 
    } else {
        $_SESSION['komunikat'] = "Błąd logowania. Sprawdź poprawność danych.";
        header("Location: ../../logowanie.php"); // header
    }

    $wynik->free_result();
}

$polaczenie->close();

?>