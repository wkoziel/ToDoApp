<?php
function dodaj_zadanie(){
    $zadanie = $_POST['zadanie'];
    $termin = $_POST['termin'];
    $szacowny_czas = $_POST['szacowny_czas'];

    echo $zadanie;
    echo "---";
    echo $termin;
    echo "---";
    echo $szacowny_czas;

    require_once('funkcje.php');
    //session_start();
    try {
        // sprawdzenia wypełnienia formularzy
        if (!wypelniony($_POST)) {
        throw new Exception('Formularz wypełniony nieprawidłowo — proszę wrócić i spróbować ponownie.');
        }

        //Dodawanie zadania do bazy
        require_once('funkcje_bazy.php');
        $lacz = lacz_bd();
        $wynik = $lacz->query("insert into uzytkownik values
                            ('".$nazwa_uz."', sha1('".$haslo."'), '".$email."')");
        if (!$wynik) {
            throw new Exception('Rejestracja w bazie danych niemożliwa — proszę spróbować później.');
        }
    }
    catch (Exception $e) {
        tworz_naglowek_html('Problem:');
        echo $e->getMessage();
        tworz_stopke_html();
        exit;
    }
}
dodaj_zadanie();
?>