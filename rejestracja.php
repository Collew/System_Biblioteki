<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Biblioteka</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>

<div class="login_container">
<img src="src/img/user.png" alt="user">
<h2>Zarejestruj się</h2><br>
<form action="src/funkcje/funkcja_rejestracji.php" method="post">
    <input class="login_input" type="text" id="login" name="login" required placeholder="Login">
    <br>
    <input class="login_input" type="password" id="password" name="password" required placeholder="Hasło">
    <br>
    <input class="login_input" type="password" id="password_powtorz" name="password_powtorz" required placeholder="Powtórz hasło">
    <br>
    <input class="btn margin_btn" type="submit" value="Zarejestruj się">

</form>
<?php
session_start();

// error
if(isset($_SESSION['komunikat_rejestracja'])) {
    echo '<p style="color: red;">' . $_SESSION['komunikat_rejestracja'] . '</p>';
    unset($_SESSION['komunikat_rejestracja']);
}
?>
<a class="rejestracja_link" href="logowanie.php">Zaloguj się</a>
</div>
</body>
</html>