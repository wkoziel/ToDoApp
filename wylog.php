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
    // echo 'Wylogowano.<br />';
    // tworz_HTML_URL('logowanie.php', 'Logowanie');
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri/logowanie.php");
    exit;
  } else {
   // użytkownik zalogowany i wylogowanie niemożliwe
    echo 'Wylogowanie niemożliwe.<br />';
  }
} else {
  // jeżeli brak zalogowania, lecz w jakiś sposób uzyskany dostęp do strony
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/logowanie.php");
}

tworz_stopke_html();

?>
