<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true || $_SESSION['ACCESS_LEVEL_ID'] !== '1') {
    header("Location: ../../logowanie.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$baza_danych = "teb_4";

$polaczenie = new mysqli($host, $user, $password, $baza_danych);

if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych " . $polaczenie->connect_error);
}

$error_message = ""; // error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dodaj_ksiazke'])) {
        $tytul = $_POST['dodaj_tytul'];
        $autor = $_POST['dodaj_autor'];
        $isbn = $_POST['dodaj_isbn'];

        $sql = "INSERT INTO book (TITLE, AUTHOR, ISBN) VALUES ('$tytul', '$autor', '$isbn')";

        if ($polaczenie->query($sql) === TRUE) {
            header("Location: ../../admin.php"); // header
        } else {
            $error_message = "Błąd przy dodawaniu";
        }
    }
}

$polaczenie->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Książki - Biblioteka</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="login_container">
    <h2>Dodaj Książkę</h2><br>

    <form method="post" action="">
        <input class="login_input" type="text" name="dodaj_tytul" placeholder="Dodaj tytuł"><br>
        <input class="login_input" type="text" name="dodaj_autor" placeholder="Dodaj autora"><br>
        <input class="login_input" type="number" name="dodaj_isbn" placeholder="Dodaj ISBN"><br>
        <input class="btn" type="submit" name="dodaj_ksiazke" value="Dodaj">
    </form>
    <?php
    if (!empty($error_message)) {
        echo "<div style='color: red;'>$error_message</div>";
    }
    ?>
</div>
</body>
</html>