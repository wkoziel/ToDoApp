<?php
  require_once("funkcje.php");
  tworz_naglowek_html("Ustawianie hasła");

  // utworzenie krótkiej nazwy zmiennej
  $nazwa_uz = $_POST['nazwa_uz'];

  try {
     $haslo=ustaw_haslo($nazwa_uz);
     powiadom_haslo($nazwa_uz, $haslo);
      echo "<br>";
      echo '<h1>Nowe hasło zostało przesłane na adres poczty elektronicznej.</h1>';
      echo "<br>";
      echo "<div class=\"mini-stopka\">";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"logowanie.php\"><h2>Logowanie</h2></a>";  
      echo "</div>";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"formularz_rejestracji.php\"><h2>Rejestracja</h2></a>";  
      echo "</div>";
      echo "</div>";
  }
  catch (Exception $e) {
      echo '';
      echo "<br>";
      echo '<h1>Hasło nie mogło zostać ustawione. Proszę spróbować później.</h1>';
      echo "<br>";
      echo "<div class=\"mini-stopka\">";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"logowanie.php\"><h2>Logowanie</h2></a>";  
      echo "</div>";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"formularz_rejestracji.php\"><h2>Rejestracja</h2></a>";  
      echo "</div>";
      echo "</div>";
  }

  tworz_stopke_html();
?>