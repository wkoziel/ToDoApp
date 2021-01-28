<?php

function wypelniony($zmienne_formularza) {
  // sprawdzenie, czy każda zmienna posiada wartość
  foreach ($zmienne_formularza as $klucz => $wartosc) {
     if ((!isset($klucz)) || ($wartosc == '')) {
        return false;
     }
  }
  return true;
}

function prawidlowy_email($adres) {
  // sprawdzenie prawidłowości adresu  poczty elektronicznej
  $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
  if (preg_match($pattern, $adres)) {
    return true;
  } else {
    return false;
  }
}

?>
