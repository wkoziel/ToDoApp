<?php

session_start();

// dołączenie plików funkcji tej aplikacji
require_once('funkcje.php');

// początek wyświetlania HTML
tworz_naglowek_html('Dodawanie nowych zadań');

//sprawdz_prawid_uzyt();
wyswietl_dodaj_zadanie_form();

//wyswietl_menu_uzyt();
//tworz_stopke_html();

?>

