<?php
session_start();

if (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true || $_SESSION['ACCESS_LEVEL_ID'] !== '1') {
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

// book
$zapytanie_books = "SELECT * FROM book";
$wynik_books = $polaczenie->query($zapytanie_books);

if ($wynik_books === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}


$host = "localhost";
$user = "root";
$password = "";
$baza_danych = "teb_4";

$polaczenie = new mysqli($host, $user, $password, $baza_danych);

if ($polaczenie->connect_error) {
    die("Błąd połączenia z bazą danych: " . $polaczenie->connect_error);
}

// books - cos  tu zjebalem
$zapytanie_user = "SELECT ID_USER, LOGIN FROM user";
$wynik_user = $polaczenie->query($zapytanie_user);

if ($wynik_user === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}


// borrow
$zapytanie_borrow = "SELECT borrow.ID_BORROW, book.TITLE, book.AUTHOR, book.ISBN, user.LOGIN, borrow.DATE_START, borrow.DATE_BACK 
                    FROM borrow 
                    JOIN user ON borrow.USER_ID = user.ID_USER
                    JOIN book ON borrow.BOOK_ID = book.ID_BOOK";
$wynik_borrow = $polaczenie->query($zapytanie_borrow);

if ($wynik_borrow === false) {
    die("Błąd zapytania do bazy danych: " . $polaczenie->error);
}


// logout
if (isset($_POST['wyloguj'])) {
    session_unset();
    session_destroy();
    header("Location: logowanie.php");
    exit();
}

if (isset($_POST['biblioteka'])) {
    header("Location: biblioteka.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Biblioteka</title>
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>



<section class="panel">
<div class="sidebar">
    
<div class="user_info">
    <img src="src/img/user.png" alt="user">
<h2>Witaj, <?php echo $_SESSION['login']; ?>! Jesteś na stronie administratora.</h2><br>
<form method="post" action="">
    <input class="btn margin_btn" type="submit" name="biblioteka" value="Biblioteka"> 
    <input class="btn margin_btn" type="submit" name="wyloguj" value="Wyloguj">
</form>
</div>

</div>

<div class="content">
<div class="title_div">
    <h2>Książki</h2>
    <form method="post" action="src/funkcje/dodaj_ksiazke.php">
        <button type="submit"><svg width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.288"></g><g id="SVGRepo_iconCarrier"><path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM16 12.75H12.75V16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16V12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H11.25V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z" fill="#00AAFF"></path></g></svg>
        </button>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th class="th_btn">Edytuj</th>
            <th class="th_btn">Usuń</th>
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
    echo "<form method='post' action='src/funkcje/edytuj_b.php'>";
    echo "<input type='hidden' name='book_id' value='" . $row['ID_BOOK'] . "'>";
    echo "<button class='btn' type='submit' name='edytuj_ksiazke'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='20px' height='20px' viewBox='0,0,256,256'>
    <g fill='#fbfbfb' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray='' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><g transform='scale(10.66667,10.66667)'><path d='M18.41406,2c-0.25587,0 -0.51203,0.09747 -0.70703,0.29297l-1.70703,1.70703l4,4l1.70703,-1.70703c0.391,-0.391 0.391,-1.02406 0,-1.41406l-2.58594,-2.58594c-0.1955,-0.1955 -0.45116,-0.29297 -0.70703,-0.29297zM14.5,5.5l-11.5,11.5v4h4l11.5,-11.5z'></path></g></g>
    </svg></button>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    echo "<form method='post' action='src/funkcje/usun_ksiazke.php'>";
    echo "<input type='hidden' name='book_id' value='" . $row['ID_BOOK'] . "'>";
    echo "<button class='btn delete_btn' type='submit' name='usun_ksiazke'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='20px' height='20px' viewBox='0,0,256,256'>
    <g fill='#fbfbfb' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray='' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><g transform='scale(10.66667,10.66667)'><path d='M10,2l-1,1h-5v2h16v-2h-5l-1,-1zM5,7v13c0,1.1 0.9,2 2,2h10c1.1,0 2,-0.9 2,-2v-13zM8,9h2v11h-2zM14,9h2v11h-2z'></path></g></g>
    </svg></button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
        }
        ?>
    </tbody>
</table>

<br><br>

<div class="title_div">
    <h2>Użytkownicy</h2>
    <form method="post" action="src/funkcje/dodaj_uzytkownika.php">
        <button type="submit"><svg width="30px" height="30px" viewBox="-2.4 -2.4 28.80 28.80" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.288"></g><g id="SVGRepo_iconCarrier"><path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM16 12.75H12.75V16C12.75 16.41 12.41 16.75 12 16.75C11.59 16.75 11.25 16.41 11.25 16V12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H11.25V8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z" fill="#00AAFF"></path></g></svg>
        </button>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th class="th_btn">Edytuj</th>
            <th class="th_btn">Usuń</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = $wynik_user->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['ID_USER'] . "</td>";
            echo "<td>" . $row['LOGIN'] . "</td>";
            echo "<td>";
            echo "<form method='post' action='src/funkcje/edytuj_u.php'>";
            echo "<input type='hidden' name='user_id' value='" . $row['ID_USER'] . "'>";
            echo "<button class='btn' type='submit' name='edytuj_uzytkownika'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='20px' height='20px' viewBox='0,0,256,256'>
            <g fill='#fbfbfb' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray='' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><g transform='scale(10.66667,10.66667)'><path d='M18.41406,2c-0.25587,0 -0.51203,0.09747 -0.70703,0.29297l-1.70703,1.70703l4,4l1.70703,-1.70703c0.391,-0.391 0.391,-1.02406 0,-1.41406l-2.58594,-2.58594c-0.1955,-0.1955 -0.45116,-0.29297 -0.70703,-0.29297zM14.5,5.5l-11.5,11.5v4h4l11.5,-11.5z'></path></g></g>
            </svg></button>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post' action='src/funkcje/usun.php'>";
            echo "<input type='hidden' name='user_id' value='" . $row['ID_USER'] . "'>";
            echo "<button class='btn delete_btn' type='submit' name='usun_uzytkownika'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='20px' height='20px' viewBox='0,0,256,256'>
            <g fill='#fbfbfb' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray='' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><g transform='scale(10.66667,10.66667)'><path d='M10,2l-1,1h-5v2h16v-2h-5l-1,-1zM5,7v13c0,1.1 0.9,2 2,2h10c1.1,0 2,-0.9 2,-2v-13zM8,9h2v11h-2zM14,9h2v11h-2z'></path></g></g>
            </svg></button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<br><br>
<div class="title_div"><h2>Wypożyczone Książki</h2></div>
<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Użytkownik</th>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Data Wypożyczenia</th>
                    <th>Data zwrotu</th>
                    
                    <th class="th_btn">Usuń</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $wynik_borrow->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ID_BORROW'] . "</td>";
                    echo "<td>" . $row['LOGIN'] . "</td>";
                    echo "<td>" . $row['TITLE'] . "</td>";
                    echo "<td>" . $row['AUTHOR'] . "</td>";
                    echo "<td>" . $row['ISBN'] . "</td>";
                    echo "<td>" . $row['DATE_START'] . "</td>";
                    echo "<td>" . $row['DATE_BACK'] . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='src/funkcje/usun_borrow.php'>";
                    echo "<input type='hidden' name='borrow_id' value='" . $row['ID_BORROW'] . "'>";
                    echo "<button class='btn delete_btn' type='submit' name='usun_borrow'><svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' width='20px' height='20px' viewBox='0,0,256,256'>
                        <g fill='#fbfbfb' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray='' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><g transform='scale(10.66667,10.66667)'><path d='M10,2l-1,1h-5v2h16v-2h-5l-1,-1zM5,7v13c0,1.1 0.9,2 2,2h10c1.1,0 2,-0.9 2,-2v-13zM8,9h2v11h-2zM14,9h2v11h-2z'></path></g></g>
                        </svg></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>






</div>

</section>

</body>
</html>
