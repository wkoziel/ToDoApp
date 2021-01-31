<?php

//TUTAJ WSZĘDZIE USTAWIĆ NOWE STYLE

function tworz_naglowek_html($tytul) {
  // wyświetlenie nagłówka HTML
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo $tytul;?></title>
    <link rel="stylesheet" type="text/css" href="styl.css" />
  </head>
  <body>
  <header>
  <h1>INTELIGENTNY PLANER</h1>
<?php
  if($tytul) {
    tworz_tytul_html($tytul);
  }
}

function tworz_stopke_html() {
  // wyświetlenie stopki HTML
?>
  </main>
  <footer><p>Projekt wykonany przez studentów grupy PI-A: Tatianę Cieślar, Piotra Hadama i Wojciecha Kozieła</p></footer>
  </body>
  </html>
<?php
}

function tworz_tytul_html($tytul) {
  // wyświetlenie tytułu
?>
  <h2><?php echo $tytul;?></h2>
  </header>
  <main>
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
  $tabela_zadan = true;
?>
  <br />
  <form name="tabela_zak" action="usun_zak.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $kolor = "#cccccc";
  echo "<tr bgcolor=\"".$kolor."\"><td><strong>Zadanie</strong></td>";
  echo "<td><strong>Termin</strong></td>";
  echo "<td><strong>Szacowany czas</strong></td>";
  echo "<td><strong>Status</strong></td>";
  echo "<td><strong>Usuń?</strong></td></tr>";
  if ((is_array($tablica_zadan)) && (count($tablica_zadan) > 0)) {
    foreach ($tablica_zadan as $zadanie) {
      if ($kolor == "#cccccc") {
        $kolor = "#ffffff";
      } else {
        $kolor = "#cccccc";
      }
      // należy pamiętać o wywołaniu htmlspecialchars() przy wyświetlaniu danych użytkownika
      echo "<tr bgcolor=\"".$kolor."\"><td>".htmlspecialchars($zadanie->zadanie)."</td>
            <td>".htmlspecialchars($zadanie->termin)."</td>
            <td>".htmlspecialchars($zadanie->szacowany_czas)."</td>
            <td>".htmlspecialchars($zadanie->kolumna)."</td>
            <td><input type=\"checkbox\" name=\"usun_mnie[]\"
             value=\"".$zadanie->id."\"/></td>
            </tr>";
      }
  } else {
    echo "<tr><td>Brak zapisanych zadań</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

//do zmiany - trzeba dać jakieś działające z naszą apką xd
function wyswietl_menu_uzyt() {
  // wyświetlenie menu opcji na stronie
?>
<hr />
<a href="czlonek.php">Home</a> &nbsp;|&nbsp;
<a href="dodaj_zadanie_formularz.php">Dodaj zadanie</a> &nbsp;|&nbsp;
<?php
  // opcja usuń jedynie w wypadku wyświetlenia tabeli zakładek
  global $tabela_zadan;
  if($tabela_zadan == true) {
    echo "<a href=\"#\" onClick=\"tabela_zadan.submit();\">Usuń zadanie</a>&nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">Usuń zadanie</span>&nbsp;|&nbsp;";
  }
?>
<a href="zmiana_hasla_formularz.php">Zmiana hasła</a>
<br />
<a href="wylog.php">Wylogowanie</a>
<hr />

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