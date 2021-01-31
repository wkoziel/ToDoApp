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
    echo 'Zalogowanie niemożliwe.
          Należy być zalogowanym aby oglądać tę stronę.';
    tworz_HTML_URL('logowanie.php', 'Logowanie');
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
