<?php

function lacz_bd() {
   $wynik = new mysqli('localhost', 'root', '', 'zadania');
   if (!$wynik) {
      throw new Exception('<h1>Połączenie z serwerem bazy danych nie powiodło się</h1>');
   } else {
      return $wynik;
   }
}

?>
