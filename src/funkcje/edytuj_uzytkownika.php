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

if (isset($_GET['user_id'])) {
    $user_id_to_edit = $_GET['user_id'];

    // access lvl
    if ($_SESSION['ACCESS_LEVEL_ID'] === '1' || $_SESSION['ID_USER'] == $user_id_to_edit) {
        
        if (isset($_POST['zapisz_login'])) {
            $nowy_login = $_POST['nowy_login'];

            // update
            $zapytanie_aktualizacja_login = "UPDATE user SET LOGIN = '$nowy_login' WHERE ID_USER = '$user_id_to_edit'";
            $wynik_aktualizacja_login = $polaczenie->query($zapytanie_aktualizacja_login);

            if ($wynik_aktualizacja_login === false) {
                die("Błąd aktualizacji loginu użytkownika: " . $polaczenie->error);
            }

            // header
            header("Location: ../../admin.php");
            exit();
        }

        // update
        if (isset($_POST['zapisz_haslo'])) {
            $nowe_haslo = $_POST['nowe_haslo'];

            $zapytanie_aktualizacja_haslo = "UPDATE user SET PASSWORD = '$nowe_haslo' WHERE ID_USER = '$user_id_to_edit'";
            $wynik_aktualizacja_haslo = $polaczenie->query($zapytanie_aktualizacja_haslo);

            if ($wynik_aktualizacja_haslo === false) {
                die("Błąd aktualizacji hasła użytkownika: " . $polaczenie->error);
            }

            // header
            header("Location: ../../admin.php");
            exit();
        }
    } else {
        // header
        header("Location: ../../admin.php");
        exit();
    }
} else {
    // Jheader
    header("Location: ../../admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Użytkownika - Biblioteka</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="login_container">
    <h2>Edycja Użytkownika</h2><br>

    <form method="post" action="">
        <input class="login_input" type="text" name="nowy_login" placeholder="Edytuj Login"><br>
        <input class="btn" type="submit" name="zapisz_login" value="Zapisz Login">
    </form>

    <form method="post" action="">
        <input class="login_input" type="password" name="nowe_haslo" placeholder="Edytuj Hasło"><br>
        <input class="btn" type="submit" name="zapisz_haslo" value="Zapisz Hasło">
    </form>
</div>
</body>
</html>