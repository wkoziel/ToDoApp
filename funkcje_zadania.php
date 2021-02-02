<?php
require_once('funkcje_bazy.php');

//Odbieranie zmiennych
if (isset($_GET['usun_id']))
{
  usun_zadanie($_GET['usun_id']);
}

if (isset($_GET['do_w_trakcie']))
{
  przenies_do_w_trakcie($_GET['do_w_trakcie']);
}

if (isset($_GET['do_zrobienia']))
{
  przenies_do_do_zrobienia($_GET['do_zrobienia']);
}

if (isset($_GET['do_gotowe']))
{
  przenies_do_gotowe($_GET['do_gotowe']);
}

function pobierz_zadania_uzyt($nazwa_uz) {
  // pobranie z bazy danych wszystkich URL-i danego użytkownika
  $lacz = lacz_bd();
  $wynik = $lacz->query("select *
                         from zadanie
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    return false;
  }

  $rezultaty = array();
  while($obj = $wynik->fetch_object())
  {
    array_push($rezultaty, $obj);
  }
  
  return $rezultaty;
}

function dodaj_zadanie($nowe_zad, $nowy_termin, $nowy_czas) {
  // dodawanie nowych zakładek do bazy danych

  echo "Próba dodania ".htmlspecialchars($nowe_zad)."<br />";
  $prawid_uzyt = $_SESSION['prawid_uzyt'];

  $lacz = lacz_bd();

  // umieszczenie nowej zakladki
  if (!$lacz->query("insert into zadanie (nazwa_uz, zadanie, termin, szacowany_czas, kolumna) values
                     ('".$prawid_uzyt."', '".$nowe_zad."', '".$nowy_termin."', '".$nowy_czas."', 'do_zrobienia')")) {

    throw new Exception('<br><h1>Wstawienie nowego zadania nie powiodło się.</h1>
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

  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/czlonek.php");
}

function usun_zadanie($id) {
  // usunięcie jednego URL-a z bazy danych

  $lacz = lacz_bd();
   // usunięcie zakładki
  if (!$lacz->query("delete from zadanie
                     where id='".$id."'")) {
    throw new Exception('<br><h1>Usunięcie zadania nie powiodło się.</h1>
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
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/czlonek.php");
}

function przenies_do_w_trakcie($id) {
  $lacz = lacz_bd();
  if (!$lacz->query("update zadanie set kolumna='w_trakcie'
                     where id='".$id."'")) {
    throw new Exception('<br><h1>Przeniesienie zadania nie powiodło się.</h1>
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
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/czlonek.php");
}

function przenies_do_do_zrobienia($id) {
  $lacz = lacz_bd();
  if (!$lacz->query("update zadanie set kolumna='do_zrobienia'
                     where id='".$id."'")) {

    throw new Exception('<br><h1>Przeniesienie zadania nie powiodło się.</h1>
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
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/czlonek.php");
}

function przenies_do_gotowe($id) {
  $lacz = lacz_bd();
  $aktualna_data = date("Y-m-d");
  if (!$lacz->query("update zadanie set kolumna='gotowe', ukonczono='".$aktualna_data."'
                     where id='".$id."'")) 
                     {
                      throw new Exception('<br><h1>Przeniesienie zadania nie powiodło się.</h1>
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
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/czlonek.php");
}

//TU JESZCZE MOŻNA DAĆ FUNKCJĘ DO POMOCY W OGARNIANIU CZASU
?>
