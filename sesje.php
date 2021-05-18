<?php
session_start();

if( !isset($_SESSION['ostatniRefresh']) ) //sprawdź czy istnieje taka zmienna w sesji
{
    $_SESSION['ostatniRefresh'] = time(); //jeżeli nie istnieje taka zmienna w sesji to zapisz obecny czas
    $_SESSION['skladWody'] = 0;
}
else
{
    $staryCzas = date('H:i:s d.m.Y', $_SESSION['ostatniRefresh']); // czas pierwszego odświeżenia strony
    $nowyCzas = date('H:i:s d.m.Y'); // czas teraz
    $iloscSekund = time() - $_SESSION['ostatniRefresh'];
    echo "Od $staryCzas do teraz ($nowyCzas) minęło $iloscSekund sekund<br>";
    $produkcjaWody = 1000;
    $_SESSION['skladWody'] += $iloscSekund * ( $produkcjaWody / 3600 );
    echo "Skład wody: ".floor($_SESSION['skladWody'])."<br>";
    $_SESSION['ostatniRefresh'] = time();
}

?>