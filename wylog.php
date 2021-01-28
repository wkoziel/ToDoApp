<?php

session_start();
// dołączenie plików funkcji tej aplikacji
require_once('funkcje.php');
$stary_uzyt = $_SESSION['prawid_uzyt'];

// przechowanie do sprawdzenia, czy logowanie wystąpiło
unset($_SESSION['prawid_uzyt']);
$wynik_niszcz = session_destroy();

// początek wyświetlania html
tworz_naglowek_html('Wylogowanie');

if (!empty($stary_uzyt)) {
  if ($wynik_niszcz) {
    // jeżeli użytkownik zalogowany i nie wylogowany
    echo 'Wylogowano.<br />';
    tworz_HTML_URL('logowanie.php', 'Logowanie');
  } else {
   // użytkownik zalogowany i wylogowanie niemożliwe
    echo 'Wylogowanie niemożliwe.<br />';
  }
} else {
  // jeżeli brak zalogowania, lecz w jakiś sposób uzyskany dostęp do strony
  echo 'Użytkownik niezalogowany, tak więc brak wylogowania.<br />';
  tworz_HTML_URL('logowanie.php', 'Logowanie');
}

tworz_stopke_html();

?>
