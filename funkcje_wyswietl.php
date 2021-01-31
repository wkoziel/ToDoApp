<?php

//TUTAJ WSZĘDZIE USTAWIĆ NOWE STYLE

function tworz_naglowek_html($tytul) {
  // wyświetlenie nagłówka HTML
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo $tytul;?></title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  <header>
  <!-- <h1>INTELIGENTNY PLANER</h1> -->
<?php
  if($tytul) {
    tworz_tytul_html($tytul);
    // echo $tytul;
  }
}

function tworz_stopke_html() {
  // wyświetlenie stopki HTML
?>
  </section>
  </main>
  <!-- <footer><p>Projekt wykonany przez studentów grupy PI-A: Tatianę Cieślar, Piotra Hadama i Wojciecha Kozieła</p></footer> -->
  </body>
  </html>
<?php
}

function tworz_tytul_html($tytul) {
  // wyświetlenie tytułu
?>
  <!-- <h2><?php echo $tytul;?></h2> -->
  </header>
  <main>
  
  <section class="glass">
    <div class="dashboard">


  <?php 
  global $newlinks;
  echo $newlinks;
  ?>
            
<?php
}



function tworz_HTML_URL($url, $nazwa) {
  // wyświetlenie URL-a jako łącza i nowa linia
?>
  <br /><a href="<?php echo $url;?>"><?php echo $nazwa;?></a><br />
<?php
}

function wyswietl_informacje_witryny() {
  // wyświetlenie informacji marketingowych
?>
  <ul>
  <li>Dodawaj nowe zadania</li>
  <li>Zobacz swoje najważniejsze obecnie zadania</li>
  <li>Rejestruj czas i sprawdź, jak efektywna jest Twoja praca</li>
  </ul>
  </header>
  <main>
<?php
}

function wyswietl_form_log() {
?>
  <p><a href="formularz_rejestracji.php">Nie masz jeszcze konta?</a></p>
  <form method="post" action="czlonek.php">
  <table bgcolor="#cccccc">
   <tr>
     <td colspan="2">Logowanie członków:</td>
   <tr>
     <td>Nazwa użytkownika:</td>
     <td><input type="text" name="nazwa_uz"/></td></tr>
   <tr>
     <td>Hasło:</td>
     <td><input type="password" name="haslo"/></td></tr>
   <tr>
     <td colspan="2" align=center>
     <input type="submit" value="Logowanie"/></td></tr>
   <tr>
     <td colspan="2"><a href="zapomnij_formularz.php">Zapomniane hasło?</a></td>
   </tr>
 </table></form>
<?php
}

function wyswietl_form_rej() {
?>
 <form method="post" action="nowa_rejestracja.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Adres poczty elektronicznej:</td>
     <td><input type="text" name="email" size="30" maxlength="100"></td></tr>
   <tr>
     <td>Preferowana nazwa użytkownika <br />(maksymalnie 16 znaków):</td>
     <td valign="top"><input type="text" name="nazwa_uz"
                     size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Hasło <br />(pomiędzy 6 i 16 znaków):</td>
     <td valign="top"><input type="password" name="haslo"
                     size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Potwierdź hasło:</td>
     <td><input type="password" name="haslo2" size="16" maxlength="16"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Rejestracja"></td></tr>
 </table></form>
<?php

}

//do zmiany na wyswietl zadania
function wyswietl_zadania_uzyt($tablica_zadan) {
  //wyswietlenie URL-i użytkownika

  // ustawienie zmiennej globalnej, aby możliwe było sprawdzanie strony
  global $tabela_zadan;
  global $todo;
  global $done;
  global $during;


  $tabela_zadan = true;
?>
  
  <br />

  
  <!-- <table width="300" cellpadding="2" cellspacing="0"> -->
  <?php
  $kolor = "#cccccc";
  // echo "<tr bgcolor=\"".$kolor."\"><td><strong>Zadanie</strong></td>";
  // echo "<td><strong>Termin</strong></td>";
  // echo "<td><strong>Szacowany czas</strong></td>";
  // echo "<td><strong>Status</strong></td>";
  // echo "<td><strong>Usuń?</strong></td></tr>";
  if ((is_array($tablica_zadan)) && (count($tablica_zadan) > 0)) 
  {
    foreach ($tablica_zadan as $zadanie) {
      if ($kolor == "#cccccc") {
        $kolor = "#ffffff";
      } else {
        $kolor = "#cccccc";
      }

      if ($zadanie->kolumna == "do_zrobienia")
      {
        $todo .= <<<XYZ
        <div class="card">
                 
                  <div class="card-info">
                    <h2>$zadanie->zadanie</h2>
                    <p>Termin oddania: $zadanie->termin</p>
                    <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                    <div class="progress">
                      <input type="checkbox" name="usun_mnie[]" value="$zadanie->id"/>
                    </div>
                  </div>
                  <h2 class="delete-task">Usuń zadanie</h2>
                
        </div>
        XYZ;
        
        
      }
      else if($zadanie->kolumna == "w_trakcie")
      {
        $during .= <<<XYZ
        <div class="card">
                 
                  <div class="card-info">
                    <h2>$zadanie->zadanie</h2>
                    <p>Termin oddania: $zadanie->termin</p>
                    <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                    <div class="progress"></div>
                  </div>
                  <h2 class="delete-task">Usuń zadanie</h2>
                
        </div>
        XYZ;
      }
      else if ($zadanie->kolumna == "zrobione")
      {
        $done .= <<<XYZ
        <div class="card">
                 
                  <div class="card-info">
                    <h2>$zadanie->zadanie</h2>
                    <p>Termin oddania: $zadanie->termin</p>
                    <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                    <div class="progress"></div>
                  </div>
                  <h2 class="delete-task">Usuń zadanie</h2>
                
        </div>
        XYZ;

      }
      // należy pamiętać o wywołaniu htmlspecialchars() przy wyświetlaniu danych użytkownika
      // echo "<tr bgcolor=\"".$kolor."\"><td>".htmlspecialchars($zadanie->zadanie)."</td>
      //       <td>".htmlspecialchars($zadanie->termin)."</td>
      //       <td>".htmlspecialchars($zadanie->szacowany_czas)."</td>
      //       <td>".htmlspecialchars($zadanie->kolumna)."</td>
      //       <td><input type=\"checkbox\" name=\"usun_mnie[]\"
      //        value=\"".$zadanie->id."\"/></td>
      //       </tr>";
      }
  } else {
    echo "<tr><td>Brak zapisanych zadań</td></tr>";
  }

  if($tabela_zadan == true) {
    echo "<div class=\"link\">";
    echo "<img src=\"https://img.icons8.com/flat_round/64/000000/minus.png\"/>";
    echo "<a href=\"#\" onClick=\"tabela_zadan.submit();\"><h2>Usuń zadania</h2></a>";
    echo "</div>";
  } 
  else {
    echo "<div class=\"link\">";
    echo "<img src=\"https://img.icons8.com/flat_round/64/000000/minus.png\"/>";
    echo "<span style=\"color: #cccccc\"><h2>Usuń zadania</h2></span>";
    echo "</div>";
  }
?>

  
  <div class="link">
              <img src="https://img.icons8.com/nolan/64/re-enter-pincode.png"/>
              <a href="zmiana_hasla_formularz.php"><h2>Zmiana hasła</h2></a>
  </div>
            <div class="link">
              <img src="https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png"/>
              <a href="wylog.php"><h2>Wylogowanie</h2></a>
            </div>
  </div>
          <div class="pro">
            <h2>Autorzy: <br> Tatiana Cieślar, Piotr Hadam, Wojciech Kozieł</h2>
          </div>
        </div>

  <form name="tabela_zadan" action="usun_zadanie.php" method="post">

  <div class="tasks">
          <div class="statuses">
            <div class="todo">
              <div class="task-state">
                <h1>Do zrobienia</h1>
              </div>
              <div class="cards">
                <?php echo $todo; ?>
              </div>
            </div>
            <div class="during">
                <div class="task-state">
                  <h1>W trakcie</h1>
                </div>
                <div class="cards">
                  <?php echo $during; ?>
                </div>
            </div>
            <div class="done">
                <div class="task-state">
                  <h1>Gotowe</h1>
                </div>
              
                <div class="cards">
                  <?php echo $done; ?>
                </div>
            </div> <!--done-->
            
          </div> <!--statuses-->
  </div> <!--tasks-->
  </form>
  
<?php
}

//do zmiany - trzeba dać jakieś działające z naszą apką xd
function wyswietl_menu_uzyt() {
  // wyświetlenie menu opcji na stronie
?>
  
            
<?php


  // opcja usuń jedynie w wypadku wyświetlenia tabeli zakładek
  global $tabela_zadan;
  // if($tabela_zadan == true) {
  //   echo "<div class=\"link\">";
  //   echo "<img src=\"https://img.icons8.com/flat_round/64/000000/minus.png\"/>";
  //   echo "<a href=\"#\" onClick=\"tabela_zadan.submit();\"><h2>Usuń zadania</h2></a>";
  //   echo "</div>";
  // } 
  // else {
  //   echo "<div class=\"link\">";
  //   echo "<img src=\"https://img.icons8.com/flat_round/64/000000/minus.png\"/>";
  //   echo "<span style=\"color: #cccccc\"><h2>Usuń zadania</h2></span>";
  //   echo "</div>";

  

    
  // }
?>

  

<!-- <hr /> -->

<?php
}

//wyświetl dodaj zadanie
function wyswietl_dodaj_zadanie_form() {
?>
<form name="tabela_zadan" action="dodaj_zadanie.php" method="post">
  <label for="zadanie">Zadanie:</label><br>
  <textarea style="resize: none" name="zadanie" rows="5" cols="30"></textarea><br>

  <label for="date">Data zakończenia:</label><br>
  <input type="date" name="termin" min="2021-01-01"><br>

  <label for="szacowny_czas">Szacowany czas(dni):</label><br>
  <input type="number" name="szacowny_czas" min="1"><br>
  <br>
  <input type="submit">
</form>
<?php
}

function wyswietl_haslo_form() {
  // wyświetlenie formularza zmiany hasła
?>
   <br />
   <form action="zmiana_hasla.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Poprzednie hasło:</td>
       <td><input type="password" name="stare_haslo" size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Nowe hasło:</td>
       <td><input type="password" name="nowe_haslo" size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Powtórzenie nowego hasła:</td>
       <td><input type="password" name="nowe_haslo2" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center"><input type="submit" value="Zmiana hasła"/>
   </td></tr>
   </table>
   <br />
<?php
};

function wyswietl_zapomnij_form() {
  // wyświetlenie formularza HTML do ustawiania nowych haseł
?>
   <br />
   <form action="zapomnij_haslo.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Nazwa użytkownika</td>
       <td><input type="text" name="nazwa_uz" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center"><input type="submit" value="Zmiana hasła"/>
   </td></tr>
   </table>
   <br />
<?php
}
?>