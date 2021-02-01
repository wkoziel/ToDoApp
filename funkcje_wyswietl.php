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
  <!-- <h1>Dodawaj nowe zadania</h1>
  <h1>Zobacz swoje najważniejsze obecnie zadania</h1>
  <h1>Rejestruj czas i sprawdź, jak efektywna jest Twoja praca</h1> -->

  </header>
  <main>

  <section class="glass">
    <div class="dashboard">
  
<?php
}

function wyswietl_form_log() {
?>
  <div class="marketing">
    <h1>Dodawaj nowe zadania,</h1>
    <h1>Zobacz swoje najważniejsze obecnie zadania,</h1>
    <h1>Rejestruj czas i sprawdź, jak efektywna jest Twoja praca!</h1>
  </div>
  
  <br>
  <!-- <hr size="6" color="#426696"> -->
  <br>

  <form method="post" action="czlonek.php">
  
    
    

    <div class="logging">
      <!-- <hr size="6" width="30%" color="#426696"> -->
      <h1>LOGOWANIE</h1>
      <!-- <hr size="6" width="30%" color="#426696"> -->
    </div>
     
       <br>
       

      <table class="center">
        <tr>
        <td><h3>Nazwa użytkownika: </h3></td>
        <td valign="top"><input type="text" name="nazwa_uz" size="16" maxlength="16" required/></td></tr>
        </tr>

        <tr>
        <td><h3>Hasło: </h3></td>
        <td valign="top"><input type="password" name="haslo" size="16" maxlength="16" required/></td></tr>
        </tr>
      </table>

     <br> <br>

     <div class="mini-stopka">
      
      <div class="stopka-link">
      <a href="zapomnij_formularz.php"><h2>Zapomniane hasło?</h2></a>
      </div>

      <input type="submit" value="Zaloguj się"/>

      <div class="stopka-link">
      <a href="formularz_rejestracji.php"><h2>Nie masz konta? <br>Zarejestruj się</h2></a>
      </div>
      
      
      
     </div>
     
   </form>
</div> <!--koniec div dashboard-->

<?php
}

function wyswietl_form_rej() {
?>
  <h1>REJESTRACJA</h1>
  <br>
 <form method="post" action="nowa_rejestracja.php">
 <table class="center">
   <tr>
     <td><h3>Adres poczty elektronicznej:</h3></td>
     <td><input type="text" name="email" size="35" maxlength="100" required></td></tr>
   <tr>
     <td><h3>Nazwa użytkownika:</h3></td>
     <td valign="top"><input type="text" name="nazwa_uz" size="16" maxlength="16" required/></td></tr>
   <tr>
     <td><h3>Hasło:</h3></td>
     <td valign="top"><input type="password" name="haslo" size="16" maxlength="16" required/></td></tr>
   <tr>
     <td><h3>Potwierdź hasło:</h3></td>
     <td><input type="password" name="haslo2" size="16" maxlength="16" required/></td></tr>

      
 </table>
 <br> <br>

 <div class="mini-stopka">
      <div class="stopka-link">
      <a href="zapomnij_formularz.php"><h2>Zapomniane hasło?</h2></a>
      </div>

      <input type="submit" value="Zarejestruj się">

      <div class="stopka-link">
      <a href="logowanie.php"><h2>Masz już konto?<br>Zaloguj się</h2></a>
      </div>

     </div>

</form>
<?php

}

function date_compare($element1, $element2) { 
  $datetime1 = strtotime($element1->termin); 
  $datetime2 = strtotime($element2->termin); 
  return $datetime1 - $datetime2; 
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

  
  <!-- <table width="300" cellpadding="2" cellspacing="0"> -->
  <?php
  $kolor = "#cccccc";

  echo "<div class=\"link\">";
  echo "<img src=\"https://img.icons8.com/flat_round/64/000000/home--v1.png\"/>";  
  echo "<a href=\"czlonek.php\"><h2>Strona główna</h2></a>";
  echo "</div>";
  echo "<div class=\"link\">";
  echo "<img src=\"https://img.icons8.com/flat_round/64/000000/plus.png\"/>";
  echo "<a href=\"dodaj_zadanie_formularz.php\"><h2>Dodaj zadanie</h2></a>";
  echo "</div>";
  
  // echo "<tr bgcolor=\"".$kolor."\"><td><strong>Zadanie</strong></td>";
  // echo "<td><strong>Termin</strong></td>";
  // echo "<td><strong>Szacowany czas</strong></td>";
  // echo "<td><strong>Status</strong></td>";
  // echo "<td><strong>Usuń?</strong></td></tr>";
  if ((is_array($tablica_zadan)) && (count($tablica_zadan) > 0)) 
  {
    usort($tablica_zadan, 'date_compare'); 
    foreach ($tablica_zadan as $zadanie) {
      if ($kolor == "#cccccc") {
        $kolor = "#ffffff";
      } else {
        $kolor = "#cccccc";
      }

      if ($zadanie->kolumna == "do_zrobienia")
      {
        $datetime1 = strtotime($zadanie->termin); 
        $datetime2 = strtotime(date("Y-m-d"));
        $roznica = ($datetime1-$datetime2) / 86400;
        $kiedy_zaczac = $roznica - $zadanie->szacowany_czas;
        if ($kiedy_zaczac <= 1)
          $todo .= <<<XYZ
          <div class="card">
                    <div class="card-info">
                      <h2>$zadanie->zadanie</h2>
                      <p>Termin oddania: $zadanie->termin</p>
                      <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                      <div class="progress">
                        <p>Powinieneś już zacząć wykonywać zadanie</p>
                      </div>
                      <div class="dropdown">
                        <button class="dropbtn">Opcje</button>
                        <div class="dropdown-content">
                        <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                        <a href="funkcje_zadania.php?do_w_trakcie=$zadanie->id">W trakcie</a>
                        <a href="funkcje_zadania.php?do_gotowe=$zadanie->id">Gotowe</a>
                      </div>
                    </div>
                    <!--<h2 class="delete-task">Usuń zadanie: <input type="checkbox" name="usun_mnie[]" value="$zadanie->id"/></h2>-->
                  </div>
                </div>
          XYZ;
        else
          $todo .= <<<XYZ
          <div class="card">
                    <div class="card-info">
                      <h2>$zadanie->zadanie</h2>
                      <p>Termin oddania: $zadanie->termin</p>
                      <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                      <div class="progress">
                        <p> Czas do końca zadania: $roznica dni</p>
                        <p> Zadanie powinieneś rozpocząć za $kiedy_zaczac dni </p>
                      </div>
                      <div class="dropdown">
                        <button class="dropbtn">Opcje</button>
                        <div class="dropdown-content">
                        <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                        <a href="funkcje_zadania.php?do_w_trakcie=$zadanie->id">W trakcie</a>
                        <a href="funkcje_zadania.php?do_gotowe=$zadanie->id">Gotowe</a>
                      </div>
                    </div>
                    <!--<h2 class="delete-task">Usuń zadanie: <input type="checkbox" name="usun_mnie[]" value="$zadanie->id"/></h2>-->
                  </div>
                </div>
          XYZ;
        
        
      }
      else if($zadanie->kolumna == "w_trakcie")
      {
        $datetime1 = strtotime($zadanie->termin); 
        $datetime2 = strtotime(date("Y-m-d"));
        $roznica = ($datetime1-$datetime2) / 86400;
        $during .= <<<XYZ
        <div class="card">
                 
                  <div class="card-info">
                    <h2>$zadanie->zadanie</h2>
                    <p>Termin oddania: $zadanie->termin</p>
                    <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                    <div class="progress">
                      <p> Czas do planowanego ukończenia zadania: $roznica dni </p>
                    </div>
                  </div>
                  <div class="dropdown">
                      <button class="dropbtn">Opcje</button>
                      <div class="dropdown-content">
                      <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                      <a href="funkcje_zadania.php?do_zrobienia=$zadanie->id">Do zrobienia</a>
                      <a href="funkcje_zadania.php?do_gotowe=$zadanie->id">Gotowe</a>
                    </div>
                </div>    
        </div>
        XYZ;
      }
      else if ($zadanie->kolumna == "gotowe")
      {  
        $datetime1 = strtotime($zadanie->termin); 
        $datetime2 = strtotime($zadanie->ukonczono);
        $roznica = ($datetime1-$datetime2) / 86400;
        
        if ($roznica > 0)
          $done .= <<<XYZ
          <div class="card">
                  
                    <div class="card-info">
                      <h2>$zadanie->zadanie</h2>
                      <p>Termin oddania: $zadanie->termin</p>
                      <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                      <div class="progress">
                        <p> Ukończono $roznica dni przed terminem </p>
                      </div>
                      <div class="dropdown">
                        <button class="dropbtn">Opcje</button>
                        <div class="dropdown-content">
                        <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                        <a href="funkcje_zadania.php?do_zrobienia=$zadanie->id">Do zrobienia</a>
                        <a href="funkcje_zadania.php?do_w_trakcie=$zadanie->id">W trakcie</a>
                      </div>
                    </div>
                  </div>
          </div>
          XYZ;
        else if ($roznica < 0)
        {
          $roznica = $roznica * -1;
          $done .= <<<XYZ
          <div class="card">
                  
                    <div class="card-info">
                      <h2>$zadanie->zadanie</h2>
                      <p>Termin oddania: $zadanie->termin</p>
                      <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                      <div class="progress">
                        <p> Ukończono $roznica dni po terminie </p>
                      </div>
                      <div class="dropdown">
                        <button class="dropbtn">Opcje</button>
                        <div class="dropdown-content">
                        <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                        <a href="funkcje_zadania.php?do_zrobienia=$zadanie->id">Do zrobienia</a>
                        <a href="funkcje_zadania.php?do_w_trakcie=$zadanie->id">W trakcie</a>
                      </div>
                    </div>
                  </div>
          </div>
          XYZ;
        }
        else
          $done .= <<<XYZ
          <div class="card">
                  
                    <div class="card-info">
                      <h2>$zadanie->zadanie</h2>
                      <p>Termin oddania: $zadanie->termin</p>
                      <p>Szacowany czas: $zadanie->szacowany_czas dni</p>
                      <div class="progress">
                        <p> Ukończono w terminie </p>
                      </div>
                      <div class="dropdown">
                        <button class="dropbtn">Opcje</button>
                        <div class="dropdown-content">
                        <a href="funkcje_zadania.php?usun_id=$zadanie->id">Usuń zadanie</a>
                        <a href="funkcje_zadania.php?do_zrobienia=$zadanie->id">Do zrobienia</a>
                        <a href="funkcje_zadania.php?do_w_trakcie=$zadanie->id">W trakcie</a>
                      </div>
                    </div>
                  </div>
          </div>
          XYZ;

      }
      // należy pamiętać o wywołaniu htmlspecialchars() przy wyświetlaniu danych użytkownika
      
      }
  } else {
    //echo "<tr><td>Brak zapisanych zadań</td></tr>";
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
          <div class="autorzy">
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

?>

<?php
}

//wyświetl dodaj zadanie
function wyswietl_dodaj_zadanie_form() {
?>
<form name="tabela_zadan" action="dodaj_zadanie.php" method="post">
  <h1>Dodaj zadanie:</h1>
  <label for="zadanie"><h3>Zadanie:</h3></label><br>
  <textarea style="resize: none" name="zadanie" rows="6" cols="29" required></textarea><br>

  <label for="date"><h3>Data zakończenia:</h3></label><br>
  <input type="date" name="termin" min="2021-01-01" required><br>

  <label for="szacowny_czas"><h3>Szacowany czas(dni):</h3></label><br>
  <input type="number" name="szacowny_czas" min="1" required><br>
  <br>

  <div class="mini-stopka">
  <div class="stopka-link">
      <img src="https://img.icons8.com/flat_round/64/000000/home--v1.png"/>  
      <a href="czlonek.php"><h2>Strona główna</h2></a>
      </div>
  
    
      <input type="submit">
      <div class="stopka-link">
        <img src="https://img.icons8.com/ios-glyphs/30/000000/logout-rounded-left.png"/>
        <a href="wylog.php"><h2>Wylogowanie</h2></a>
  </div>
  </div>
  
  
</form>
<?php
}

function wyswietl_haslo_form() {
  // wyświetlenie formularza zmiany hasła
?>
   <br />
   <form action="zmiana_hasla.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0">
   <tr><td>Poprzednie hasło:</td>
       <td><input type="password" name="stare_haslo" size="16" maxlength="16" required/></td>
   </tr>
   <tr><td>Nowe hasło:</td>
       <td><input type="password" name="nowe_haslo" size="16" maxlength="16" required/></td>
   </tr>
   <tr><td>Powtórzenie nowego hasła:</td>
       <td><input type="password" name="nowe_haslo2" size="16" maxlength="16" required/></td>
   </tr>
   <tr><td colspan="2" ><input type="submit" value="Zmiana hasła"/>
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
   <table width="250" cellpadding="2" cellspacing="0">
   <tr><td>Nazwa użytkownika</td>
       <td><input type="text" name="nazwa_uz" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2"><input type="submit" value="Zmiana hasła"/>
   </td></tr>
   </table>
   <br />
<?php
}
?>