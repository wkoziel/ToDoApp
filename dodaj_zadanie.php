<?php
    $zadanie = $_POST['zadanie'];
    $termin = $_POST['termin'];
    $szacowany_czas = $_POST['szacowny_czas'];

    session_start();

    require_once('funkcje.php');
      
     tworz_naglowek_html('Dodawanie zadań');
   
     try {
       sprawdz_prawid_uzyt();
       if (!wypelniony($_POST)) 
       {
            echo "<br>";
            echo '<h1>Formularz wypełniony niewłaściwie. Proszę spróbować ponownie.</h1>';
            echo "<br>";
            echo "<div class=\"mini-stopka\">";
            echo "<div class=\"stopka-link\">";
            echo "<img src=\"https://img.icons8.com/flat_round/64/000000/home--v1.png\"/>";  
            echo "<a href=\"czlonek.php\"><h2>Strona główna</h2></a>";
            echo "</div>";
            echo "<div class=\"stopka-link\">";
            echo "<img src=\"https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png\"/>";  
            echo "<a href=\"wylog.php\"><h2>Wylogowanie</h2></a>";
            echo "</div>";
            echo "</div>";
            throw new Exception('');
       }
   
       // próba dodania zakładki
       dodaj_zadanie($zadanie, $termin, $szacowany_czas);
       echo "<br>";
        echo '<h1>Zadanie dodane.</h1>';
        echo "<br>";
        echo "<div class=\"mini-stopka\">";
        echo "<div class=\"stopka-link\">";
        echo "<img src=\"https://img.icons8.com/flat_round/64/000000/home--v1.png\"/>";  
        echo "<a href=\"czlonek.php\"><h2>Strona główna</h2></a>";
        echo "</div>";
        echo "<div class=\"stopka-link\">";
        echo "<img src=\"https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png\"/>";  
        echo "<a href=\"wylog.php\"><h2>Wylogowanie</h2></a>";
        echo "</div>";
        echo "</div>";

     }
     catch (Exception $e) {
       echo $e->getMessage();
     }
     wyswietl_menu_uzyt();
     tworz_stopke_html();
?>