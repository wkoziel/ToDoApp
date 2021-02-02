<?php
  session_start();
  require_once('funkcje.php');
  tworz_naglowek_html('Zmiana hasła');

  // utworzenie krótkich nazw zmiennych
  $stare_haslo = $_POST['stare_haslo'];
  $nowe_haslo = $_POST['nowe_haslo'];
  $nowe_haslo2 = $_POST['nowe_haslo2'];


 try {
   sprawdz_prawid_uzyt();
    if (!wypelniony($_POST)) {
      throw new Exception('<br><h1>Formularz nie został wypełniony całkowicie. Proszę spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <img src="https://img.icons8.com/flat_round/64/000000/home--v1.png"/>  
      <a href="czlonek.php"><h2>Strona główna</h2></a>
      </div>
      <div class="stopka-link">
      <img src="https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png"/>  
      <a href="wylog.php"><h2>Wylogowanie</h2></a>
      </div>
      </div>');
    }

    if ($nowe_haslo != $nowe_haslo2) {
      throw new Exception('<br><h1>Wprowadzone hasła nie są identyczne. Hasło nie zostało zmienione.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <img src="https://img.icons8.com/flat_round/64/000000/home--v1.png"/>  
      <a href="czlonek.php"><h2>Strona główna</h2></a>
      </div>
      <div class="stopka-link">
      <img src="https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png"/>  
      <a href="wylog.php"><h2>Wylogowanie</h2></a>
      </div>
      </div>');
    }

    if ((strlen($nowe_haslo) > 16) || (strlen($nowe_haslo) < 6)) {
      throw new Exception('<br><h1>Nowe hasło musi mieć długość co najmniej 6 i maksymalnie 16 znaków. Proszę spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <img src="https://img.icons8.com/flat_round/64/000000/home--v1.png"/>  
      <a href="czlonek.php"><h2>Strona główna</h2></a>
      </div>
      <div class="stopka-link">
      <img src="https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png"/>  
      <a href="wylog.php"><h2>Wylogowanie</h2></a>
      </div>
      </div>');
    }

    // próba uaktualnienia
    zmien_haslo($_SESSION['prawid_uzyt'], $stare_haslo, $nowe_haslo);
   $host  = $_SERVER['HTTP_HOST'];
   $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
   header("Location: http://$host$uri/czlonek.php");
 }
 catch (Exception $e) {
    echo $e->getMessage();
 }
 wyswietl_menu_uzyt();
 tworz_stopke_html();
?>