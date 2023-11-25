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
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

$error_message = ""; // error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dodaj_user'])) {
        $login = $_POST['dodaj_login'];
        $haslo = $_POST['dodaj_haslo'];
        $powtorzHaslo = $_POST['powtorz_haslo'];

        // validacja
        if (empty($login) || empty($haslo) || empty($powtorzHaslo)) {
            $error_message = "Wszystkie pola są wymagane";
        } elseif ($haslo != $powtorzHaslo) {
            $error_message = "Hasła nie są identyczne";
        } else {
            // validacja
            $sqlCheckLogin = "SELECT * FROM user WHERE LOGIN = '$login'";
            $result = $polaczenie->query($sqlCheckLogin);

            if ($result->num_rows > 0) {
                $error_message = "Użytkownik o podanym loginie już istnieje";
            } else {
                $sqlAddUser = "INSERT INTO user (LOGIN, PASSWORD, ACCESS_LEVEL_ID) VALUES ('$login', '$haslo', '2')";

                if ($polaczenie->query($sqlAddUser) === TRUE) {
                    header("Location: ../../admin.php");
                    exit();
                } else {
                    $error_message = "Błąd podczas dodawania użytkownika " . $polaczenie->error;
                }
            }
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
    <title>Dodaj Użytkownika - Biblioteka</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="login_container">
    <h2>Dodaj Użytkownika</h2><br>

    <form method="post" action="">
        <input class="login_input" type="text" name="dodaj_login" placeholder="Dodaj login"><br>
        <input class="login_input" type="password" name="dodaj_haslo" placeholder="Dodaj hasło"><br>
        <input class="login_input" type="password" name="powtorz_haslo" placeholder="Powtórz hasło"><br>
        <input class="btn" type="submit" name="dodaj_user" value="Dodaj">
    </form>
    <?php
    if (!empty($error_message)) {
        echo "<div style='color: red;'>$error_message</div>";
    }
    ?>
</div>
</body>
</html>
