<?php

function lacz_bd() {
   $wynik = new mysqli('localhost', 'root', '', 'zadania');
   if (!$wynik) {
      throw new Exception('Połączenie z serwerem bazy danych nie powiodło się');
   } else {
      return $wynik;
   }
}

?>
