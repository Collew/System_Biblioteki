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

    
    if ($_SESSION['ACCESS_LEVEL_ID'] === '1' || $_SESSION['ID_USER'] == $user_id_to_edit) {
        // click
        if (isset($_POST['zapisz_tytul'])) {
            $nowy_tytul = $_POST['nowy_tytul'];

            // title
            $zapytanie_aktualizacja_tytul = "UPDATE book SET TITLE = '$nowy_tytul' WHERE ID_BOOK = '$user_id_to_edit'";
            $wynik_aktualizacja_tytul = $polaczenie->query($zapytanie_aktualizacja_tytul);

            if ($wynik_aktualizacja_tytul === false) {
                die("Błąd aktualizacji Tytułu: " . $polaczenie->error);
            }

            header("Location: ../../admin.php");
            exit();
        }

        // click
        if (isset($_POST['zapisz_autor'])) {
            $nowe_autor = $_POST['nowe_autor'];

            // author
            $zapytanie_aktualizacja_autor = "UPDATE book SET AUTHOR = '$nowe_autor' WHERE ID_BOOK = '$user_id_to_edit'";
            $wynik_aktualizacja_autor = $polaczenie->query($zapytanie_aktualizacja_autor);

            if ($wynik_aktualizacja_autor === false) {
                die("Błąd aktualizacji Autora: " . $polaczenie->error);
            }

            header("Location: ../../admin.php");
            exit();
        }

        // click
        if (isset($_POST['zapisz_isbn'])) {
            $nowe_isbn = $_POST['nowe_isbn'];

            // Update isbn
            $zapytanie_aktualizacja_isbn = "UPDATE book SET ISBN = '$nowe_isbn' WHERE ID_BOOK = '$user_id_to_edit'";
            $wynik_aktualizacja_isbn = $polaczenie->query($zapytanie_aktualizacja_isbn);

            if ($wynik_aktualizacja_isbn === false) {
                die("Błąd aktualizacji ISBN: " . $polaczenie->error);
            }
            header("Location: ../../admin.php");
            exit();
        }
    } else {
        header("Location: ../../admin.php");
        exit();
    }
} else {
    header("Location: ../../admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Książki - Biblioteka</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="login_container">
    <h2>Edycja Książkę</h2><br>

    <form method="post" action="">
        <input class="login_input" type="text" name="nowy_tytul" placeholder="Edytuj Tytuł"><br>
        <input class="btn" type="submit" name="zapisz_tytul" value="Zapisz Tytul">
    </form>

    <form method="post" action="">
        <input class="login_input" type="text" name="nowe_autor" placeholder="Edytuj Autora"><br>
        <input class="btn" type="submit" name="zapisz_autor" value="Zapisz Autota">
    </form>

    <form method="post" action="">
        <input class="login_input" type="number" name="nowe_isbn" placeholder="Edytuj ISBN"><br>
        <input class="btn" type="submit" name="zapisz_isbn" value="Zapisz ISBN">
    </form>
</div>
</body>
</html>