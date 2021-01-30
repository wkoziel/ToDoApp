<?php
    $zadanie = $_POST['zadanie'];
    $termin = $_POST['termin'];
    $szacowany_czas = $_POST['szacowny_czas'];

    session_start();

    require_once('funkcje.php');
      
     tworz_naglowek_html('Dodawanie zadań');
   
     try {
       sprawdz_prawid_uzyt();
       if (!wypelniony($_POST)) {
       throw new Exception('Formularz wypełniony niewłaściwie. Proszę spróbować ponownie.');
       }
   
       // próba dodania zakładki
       dodaj_zadanie($zadanie, $termin, $szacowany_czas);
       echo 'Zadanie dodane.';

     }
     catch (Exception $e) {
       echo $e->getMessage();
     }
     wyswietl_menu_uzyt();
     tworz_stopke_html();
?>