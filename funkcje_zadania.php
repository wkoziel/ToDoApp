<?php
require_once('funkcje_bazy.php');

function pobierz_zadania_uzyt($nazwa_uz) {
  // pobranie z bazy danych wszystkich URL-i danego użytkownika
  $lacz = lacz_bd();
  $wynik = $lacz->query("select *
                         from zadanie
                         where nazwa_uz = '".$nazwa_uz."'");
  if (!$wynik) {
    return false;
  }

  // tworzenie tablicy zadań
  $wynik = $wynik->fetch_all();
  $tablica_zadan = array(); 
  //for ($licznik = 0; $rzad = $wynik->fetch_row(); ++$licznik) {
  //  $tablica_zadan[$licznik] = $rzad[0];
  //}

  return $wynik;
}

function dodaj_zadanie($nowe_zad, $nowy_termin, $nowy_czas) {
  // dodawanie nowych zakładek do bazy danych

  echo "Próba dodania ".htmlspecialchars($nowe_zad)."<br />";
  $prawid_uzyt = $_SESSION['prawid_uzyt'];

  $lacz = lacz_bd();

  // umieszczenie nowej zakladki
  if (!$lacz->query("insert into zadanie (nazwa_uz, zadanie, termin, szacowany_czas, kolumna) values
                     ('".$prawid_uzyt."', '".$nowe_zad."', '".$nowy_termin."', '".$nowy_czas."', 'do_zrobienia')")) {
    throw new Exception('Wstawienie nowego zadania nie powiodło się');
  }

  return true;
}

function usun_zadanie($uzytkownik, $id) {
  // usunięcie jednego URL-a z bazy danych
  $lacz = lacz_bd();
   // usunięcie zakładki
  if (!$lacz->query("delete from zadanie
                     where nazwa_uz='".$uzytkownik."' and id='".$id."'")) {
    throw new Exception('Usunięcie zadania nie powiodło się.');
  }
  return true;
}

//TU JESZCZE MOŻNA DAĆ FUNKCJĘ DO POMOCY W OGARNIANIU CZASU
?>
