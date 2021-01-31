<?php
  session_start();
  require_once('funkcje.php');

  //create short variable names
  $usun_mnie = isset($_POST['usun_mnie']) ? $_POST['usun_mnie'] : [];
  $prawid_uzyt = $_SESSION['prawid_uzyt'];

  echo $usun_mnie;

  tworz_naglowek_html('Usuwanie zadań');
  sprawdz_prawid_uzyt();
  if (!wypelniony($_POST)) {
    echo '<p>Nie wybrane zostały żadne zadania do usunięcia.<br/>
          Proszę spróbować ponownie.</p>';
    wyswietl_menu_uzyt();
    tworz_stopke_html();
    exit;
  } else {
    if (count($usun_mnie) > 0) {
      foreach($usun_mnie as $zadanie) {
        if (usun_zadanie($zadanie)) {
          echo 'Usunięto '.htmlspecialchars($zadanie).'.<br />';
        } else {
          echo 'Nie udało się usunięcie '.htmlspecialchars($zadanie).'.<br />';
        }
      }
    } else {
      echo 'Nie wybrano żadnych zadań do usunięcia';
    }
  }

  if ($tablica_zadan = pobierz_zadania_uzyt($_SESSION['prawid_uzyt'])) {
    wyswietl_zadania_uzyt($tablica_zadan);
  }

  wyswietl_menu_uzyt();
  tworz_stopke_html();
?>