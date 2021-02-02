<?php

  // utworzenie krótkich nazw zmiennych
  $email=$_POST['email'];
  $nazwa_uz=$_POST['nazwa_uz'];
  $haslo=$_POST['haslo'];
  $haslo2=$_POST['haslo2'];

  // rozpoczęcie sesji, która może okazać się konieczna później
  // rozpoczęcie w tym miejscu, musi ona zostać przekazana przed nagłówkami
   session_start();

   // dołączenie plików funkcji tej aplikacji
   require_once('funkcje.php');

   try {
     // sprawdzenia wypełnienia formularzy
     if (!wypelniony($_POST)) {
      throw new Exception('<h1>Formularz wypełniony nieprawidłowo — proszę wrócić i spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <a href="logowanie.php"><h2>Zaloguj się</h2></a>
      </div>
      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Zarejestruj się</h2></a>
      </div>
      </div>');
     }

     // nieprawidłowy adres poczty elektronicznej
     if (!prawidlowy_email($email)) {
      throw new Exception('<h1>Nieprawidłowy adres poczty elektronicznej — proszę wrócić i spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <a href="logowanie.php"><h2>Zaloguj się</h2></a>
      </div>
      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Zarejestruj się</h2></a>
      </div>
      </div>');
     }

     // różne hasła
     if ($haslo != $haslo2) {
      throw new Exception('<h1>Niepasujące do siebie hasła — proszę wrócić i spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <a href="logowanie.php"><h2>Zaloguj się</h2></a>
      </div>
      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Zarejestruj się</h2></a>
      </div>
      </div>');

     }

     // sprawdzenie długości nazwy użytkownika
     if (strlen($nazwa_uz) > 16) {
      throw new Exception('<h1>Nazwa uzytkownika nie może mieć więcej niż 16 znaków — proszę wrócić i spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <a href="logowanie.php"><h2>Zaloguj się</h2></a>
      </div>
      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Zarejestruj się</h2></a>
      </div>
      </div>');
     }

     // sprawdzenie długości hasła
     // nazwę użytkownika można skrócić, lecz zbyt długiego
     // hasła skrócić nie można
     if ((strlen($haslo) < 6) || (strlen($haslo) > 16)) {
      throw new Exception('<h1>Hasło musi mieć co najmniej 6 i maksymalnie 16 znaków — proszę wrócić i spróbować ponownie.</h1>
      <br>
      <div class="mini-stopka">
      <div class="stopka-link">
      <a href="logowanie.php"><h2>Zaloguj się</h2></a>
      </div>
      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Zarejestruj się</h2></a>
      </div>
      </div>');
     }

     // próba zarejestrowania
     rejestruj($nazwa_uz, $email, $haslo);
     // rejestracja zmiennej sesji
     $_SESSION['prawid_uzyt'] = $nazwa_uz;


     // stworzenie łącza do strony członkowskiej
      $host  = $_SERVER['HTTP_HOST'];
      $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
      header("Location: http://$host$uri/czlonek.php");
   }
   catch (Exception $e) {
     tworz_naglowek_html('Problem:');
     echo $e->getMessage();
     tworz_stopke_html();
     exit;
   }
?>