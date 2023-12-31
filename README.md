# System do zarządzania biblioteką
Projekt bibliteki PHP / Zadanie<br>
Gracjan Pietruszkiewicz

## Dane logowania
Administrator: admin admin<br>
Użytkownik: user user
 
## Wymagania funkcjonalne 

### Poziom użytkownik powinien mieć możliwość:
1. zalogowania się do systemu ✅<br>
2. dostępu do strony z listą książek ✅<br>
3. możliwość wypożyczenia ✅<br>
4. wyświetlenie listy wszystkich wypożyczonych książek ✅<br>
5. wylogowanie z systemu ✅

### Poziom dostępu admin powinien umożliwiać:
1. zalogowanie do systemu ✅
2. dla użytkowników<br>
    a) dodanie nowego użytkownika o poziomie dostępu użytkownika ✅<br>
    b) edycję danych użytkownika w tym loginu oraz hasła niezależnie od siebie (symulacja przywrócenia utraconego hasła) ✅<br>
    c) usunięcia użytkownika ✅<br>
3. dla książek
    a) dodanie książki ✅<br>
    b) edycję książki ✅<br>
    c) usunięcie książki ✅<br>
4. wypożyczenia<br>
    a) usunięcie wpisów o wypożyczeniach ✅<br>
5. wylogowanie z systemu ✅

## Wymagania niefunkcjonalne

1. System powinien blokować dostęp dla niezalogowanych użytkowników ✅<br>
2. System powinien rozróżniać zalogowanych użytkowników i przydzielać dostęp do stron w zależności od poziomu dostępu ✅<br>
3. Wszystkie pola edycji powinny zawierać mechanizm postback - przy edycji pola powinny być uzupełnione, przy błędzie pola powinny zostać uzupełnione 🟡<br>
4. Podstawową walidację pól (sprawdzenie czy nie puste, czy dane odpowiadają polom po stronie klienta – html+JS i serwera - PHP ) 🟡<br>
5. System nie powinien wyświetlać warningów/noticów ✅<br>
6. System powinien działać na wersji PHP conajmaniej 7.4 ✅<br>
7. System powinien być oparty o bazę danych MySQL/MariaDB ✅<br>
8. Struktura oraz wygląd powinny być oparte o technologię HTML5 oraz CSS3 ✅

## Wygląd

1. Strona powinna być oparta o sekcje ✅<br>
2. Szablon strony powinien być podzielony conajmniej na dwie części (⅓ z lewej, ⅔ z prawej) ✅<br>
3. Stylizacja strony powinna być oparta o CSS, wyklucza się użycie stylowania z poziomu HTML’a oraz przy wykorzystaniu zewnętrznych bibliotek ✅<br>
4. Tabele powinny być w paski (co drugi wiersz w innym kolorze) dodatkowo po najechaniu na pole powinno się podświetlić (przybrać ciemniejszy odcień) ✅

![Screenshot1](src/img/screenshot1.png)
![Screenshot1](src/img/screenshot2.png)
![Screenshot1](src/img/screenshot3.png)
![Screenshot1](src/img/screenshot4.png)