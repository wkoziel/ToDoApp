<?php

session_start();

// dołączenie plików funkcji tej aplikacji
require_once('funkcje.php');

// utworzenie krótkich nazw zmiennych

$nazwa_uz = isset($_POST['nazwa_uz']) ? $_POST['nazwa_uz'] : '';
$haslo = isset($_POST['haslo']) ? $_POST['haslo'] : '';

if ($nazwa_uz && $haslo) {
// właśnie nastąpiła próba logowania
  try {
    loguj($nazwa_uz, $haslo);
    // jeżeli użytkownik znajduje się w bazie danych rejestracja identyfikatora
    $_SESSION['prawid_uzyt'] = $nazwa_uz;
  }
  catch (Exception $e) {
    // niepomyślne logowanie
    tworz_naglowek_html('Problem:');
    echo "<br>";
      echo '<h1>Zalogowanie niemożliwe.<br>Należy być zalogowanym aby oglądać tę stronę.</h1>';
      echo "<br>";
      echo "<div class=\"mini-stopka\">";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"logowanie.php\"><h2>Zaloguj się</h2></a>";  
      echo "</div>";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"formularz_rejestracji.php\"><h2>Zarejestruj się</h2></a>";  
      echo "</div>";
      echo "</div>";
    tworz_stopke_html();
    exit;
  }
}

tworz_naglowek_html('Strona główna');
sprawdz_prawid_uzyt();
// odczytanie zadań użytkownika z bazy
// if ($tablica_zadan = pobierz_zadania_uzyt($_SESSION['prawid_uzyt'])) {
//   echo "Wchodzimy";
//   wyswietl_zadania_uzyt($tablica_zadan);
// }
$tablica_zadan = pobierz_zadania_uzyt($_SESSION['prawid_uzyt']);
wyswietl_zadania_uzyt($tablica_zadan);

// tworzenie menu opcji
wyswietl_menu_uzyt();

tworz_stopke_html();
?>
