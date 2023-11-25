<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true) {
    header("Location: logowanie.php");
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



// books
$zapytanie_books = "SELECT * FROM book";
$wynik_books = $polaczenie->query($zapytanie_books);

if ($wynik_books === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}

// userid
$login = $_SESSION['login'];
$zapytanie_user = "SELECT ID_USER FROM user WHERE LOGIN = '$login'";
$wynik_user = $polaczenie->query($zapytanie_user);

if ($wynik_user === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}

$row_user = $wynik_user->fetch_assoc();
$_SESSION['ID_USER'] = $row_user['ID_USER'];


// borrow
$user_id = $_SESSION['ID_USER'];
$zapytanie_borrow = "SELECT b.ID_BORROW, b.DATE_START, b.DATE_BACK, bo.TITLE, bo.ISBN, bo.AUTHOR, u.LOGIN 
                    FROM borrow b
                    INNER JOIN book bo ON b.BOOK_ID = bo.ID_BOOK
                    INNER JOIN user u ON b.USER_ID = u.ID_USER
                    WHERE b.USER_ID = '$user_id'";
$wynik_borrow = $polaczenie->query($zapytanie_borrow);

if ($wynik_borrow === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}


// logout
if (isset($_POST['wyloguj'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: logowanie.php"); // header
    exit();
}

?>

<section class="panel">
<div class="sidebar">
    
<div class="user_info">
<img src="src/img/user.png" alt="user">
<h2>Witaj <?php echo $_SESSION['login']; ?>! jesteś w bibliotece.</h2><br>
<form method="post" action="">
    <input class="btn margin_btn" type="submit" name="wyloguj" value="Wyloguj">
</form>
</div>

</div>

<div class="content">

<h2>Książki</h2><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th class="th_btn">Wypożycz</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $wynik_books->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ID_BOOK'] . "</td>";
            echo "<td>" . $row['TITLE'] . "</td>";
            echo "<td>" . $row['AUTHOR'] . "</td>";
            echo "<td>" . $row['ISBN'] . "</td>";
            echo "<td>";
            echo "<form method='post' action='src/funkcje/funkcja_borrow.php'>";
            echo "<input type='hidden' name='book_id' value='" . $row['ID_BOOK'] . "'>";
            echo "<button class='btn' type='submit' name='wypozycz'>Wypożycz</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<br><br>
    <h2>Wypożyczone Książki</h2><br>
    <table>
        <thead>
            <tr>
                <th>Użytkownik</th>
                <th>Tytuł</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Data Wypożyczenia</th>
                <th>Data Zwrotu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $wynik_borrow->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['LOGIN'] . "</td>";
                echo "<td>" . $row['TITLE'] . "</td>";
                echo "<td>" . $row['AUTHOR'] . "</td>";
                echo "<td>" . $row['ISBN'] . "</td>";
                echo "<td>" . $row['DATE_START'] . "</td>";
                echo "<td>" . $row['DATE_BACK'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>
</section>

</body>
</html>
