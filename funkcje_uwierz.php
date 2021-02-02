<?php
require_once('funkcje_bazy.php');

// Zarejestrowanie nowej osoby w bazie danych
function rejestruj($nazwa_uz, $email, $haslo) {

  $lacz = lacz_bd();

  $wynik = $lacz->query("select * from uzytkownik where nazwa_uz='".$nazwa_uz."'");
  if (!$wynik) {
     throw new Exception('<h1>Wykonanie zapytania nie powiodło się.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
  }

  if ($wynik->num_rows>0) {

     throw new Exception('<h1>Nazwa użytkownika zajęta — proszę wrócić i wybrać inną.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
  }

  $wynik = $lacz->query("insert into uzytkownik values
                       ('".$nazwa_uz."', sha1('".$haslo."'), '".$email."')");

  if (!$wynik) {
    throw new Exception('<h1>Rejestracja w bazie danych niemożliwa — proszę spróbować później.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
  }
  return true;
}

// Logowanie użytkownika do bazy danych
function loguj($nazwa_uz, $haslo) {
  
  $lacz = lacz_bd();

  // sprawdzenie unikatowości nazwy użytkownika
  $wynik = $lacz->query("select * from uzytkownik
                         where nazwa_uz='".$nazwa_uz."'
                         and haslo = sha1('".$haslo."')");
  if (!$wynik) {
     throw new Exception('<h1>Logowanie nie powiodło się.</h1><br>
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

  if ($wynik->num_rows>0) {
     return true;
  } else {
    throw new Exception('<h1>Logowanie nie powiodło się.</h1><br>
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
}

function sprawdz_prawid_uzyt() {
// sprawdzenie czy użytkownik jest zalogowany i powiadomienie go jeżeli nie
  if (isset($_SESSION['prawid_uzyt'])) {
      echo "<div class=\"user\">";
      echo "<h3>Zalogowano jako: </h3>";
      echo "<p>".$_SESSION['prawid_uzyt']."</p>";
      echo "</div>";
      echo "<div class=\"links\">";

  } else {
     // nie jest zalogowany
     echo '<h1>Brak zalogowania.</h1><br />';
     echo "<div class=\"mini-stopka\">";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"logowanie.php\"><h2>Logowanie</h2></a>";  
      echo "</div>";
      echo "<div class=\"stopka-link\">";
      echo "<a href=\"formularz_rejestracji.php\"><h2>Rejestracja</h2></a>";  
      echo "</div>";
      echo "</div>";
     tworz_stopke_html();
     exit;
  }
}

function zmien_haslo($nazwa_uz, $stare_haslo, $nowe_haslo) {
// zmiana hasła użytkownika ze stare_haslo na nowe_haslo
// zwraca true lub false

  // jeżeli stare hasło jest prawidłowe zmiana nowe_haslo i zwrócenie true
  // w przeciwnym wypadku wyrzucenie wyjątku
  loguj($nazwa_uz, $stare_haslo);
  $lacz = lacz_bd();
  $wynik = $lacz->query("update uzytkownik
                         set haslo = sha1('".$nowe_haslo."')
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    throw new Exception('<h1>Zmiana hasła nie powiodła się.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
  } else {
    return true;  // zmiana udana
  }
}

function pobierz_losowe_slowo($dlugosc_min, $dlugosc_max) {
//pobranie losowego słowa ze słownika o określonej długości zwrócenie go

  // generowanie losowego słowa
  $slowo = '';
  // tę ścieżkę należy dostosować do ustawień własnego systemu
  $slownik = '/usr/dict/words';  // słownik ispell
  $wp = @fopen($slownik, 'r');
  if(!$wp) {
    return false;
  }
  $wielkosc = filesize($slownik);

  // przejście do losowej pozycji w słowniku
  $losowa_pozycja = rand(0, $wielkosc);
  fseek($wp, $losowa_pozycja);

  // pobranie ze słownika następnego pełnego słowa o właściwej długości
  while ((strlen($slowo) < $dlugosc_min) || (strlen($slowo)>$dlugosc_max) || strstr($slowo, "'")) {
     if (feof($wp)) {
        fseek($wp, 0);        // jeżeli koniec pliku, przeskocz na początek
     }
     $slowo = fgets($wp, 80);  // przeskoczenie pierwszego słowa bo może być niepełne
     $slowo = fgets($wp, 80);  // potencjalne hasło
  }
  $slowo = trim($slowo); // obcięcie początkowego \n z funkcji fgets
  return $slowo;
}

function ustaw_haslo($nazwa_uz) {
// ustawienie hasła użytkownika na losową wartość
// zwraca nowe hasło lub false w przypadku niepowodzenia

  // pobranie losowego słowa ze słownika o długości pomiędzy 6 i 13 znaków
  $nowe_haslo = pobierz_losowe_slowo(6, 13);

  if($nowe_haslo == false) {
    throw new Exception('<h1>Wygenerowanie nowego hasła nie powiodło się.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
  }

  // dodanie liczby pomiędzy 0 i 999 w celu stworzenia lepszego hasła
  $losowa_liczba = rand(0, 999);
  $nowe_haslo .= $losowa_liczba;

  // ustawienie nowego hasła w bazie danych lub zwrócenie false
  $lacz = lacz_bd();
      return false;
  $wynik = $lacz->query("update uzytkownik
                         set haslo = sha1('".$nowe_haslo."')
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    throw new Exception('<h1>Zmiana hasła nie powiodła się.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
     // hasło nie zmienione
  } else {
    return $nowe_haslo;  // hasło zmienione pomyślnie
  }
}

function powiadom_haslo($nazwa_uz, $haslo) {
// powiadomienie użytkownika o zmianie hasła

    $lacz = lacz_bd();
    $wynik = $lacz->query("select email from uzytkownik
                           where nazwa_uz='".$nazwa_uz."'");
    if (!$wynik) {
      throw new Exception('<h1>Nie znaleziono adresu e-mail.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
    } 
    else if ($wynik->num_rows == 0) {
      // nazwy użytkownika nie ma w bazie danych
      throw new Exception('<h1>Nie znaleziono adresu e-mail.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
    } 
    else {
      $wiersz = $wynik->fetch_object();
      $email = $wiersz->email;
      $od = "From: obsluga@zadanie.pl \r\n";
      $wiad = "Hasło systemu Inteligentny Planer zostało zmienione na $haslo \r\n"
              ."Proszę zmienić je przy następnym logowaniu. \r\n";


      if (mail($email, 'Informacja o logowaniu', $wiad, $od)) {
        return true;
      } 
      else {
        throw new Exception('<h1>Wysłanie e-maila nie powiodło się.</h1><br>
     <div class="mini-stopka">
     <div class="stopka-link">
     <a href="logowanie.php"><h2>Logowanie</h2></a>
     </div>
     <div class="stopka-link">
     <a href="formularz_rejestracji.php"><h2>Rejestracja</h2></a>
     </div>
     </div>');
      }
    }
}

?>