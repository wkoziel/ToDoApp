<?php
 session_start();
 require_once('funkcje.php');
 tworz_naglowek_html('Zmiana hasła');
 sprawdz_prawid_uzyt();
 
 wyswietl_haslo_form();

 wyswietl_menu_uzyt(); 
 tworz_stopke_html();
?>
