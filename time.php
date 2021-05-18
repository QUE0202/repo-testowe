<?php
$teraz = time();
echo "teraz jest: ".date('H:i:s d.m.Y', $teraz)."<br>";
$losowaLiczbaSekund = rand(0,7200); //od 0 sekund do 2 godzin
$przeszlosc = $teraz - $losowaLiczbaSekund;
echo "W przeszłości ".date('H:i:s d.m.Y', $przeszlosc)." od tego czasu minęło $losowaLiczbaSekund sekund"."<br>";


$produkcjaWodyGodzine = 1000;
$produkcja = ($produkcjaWodyGodzine / 3600) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcja)." Sztuk Wody<br>";

$czasUlepszeniaStudni = 2700; //45min

echo "Rozpoczęto ulepszanie Studni na następny poziom<br>";
$studniaGotowy = time() + $czasUlepszeniaStudni;
echo "Studnia będzie gotowy ".date('H:i:s d.m.Y', $studniaGotowa);


$produkcjaUranuGodzine = 250;
$produkcjaZ = ($produkcjaUranuGodzine / 900) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcjaZ)." Uranu<br>";

$czasUlepszeniaKopalniUranu = 2700; //45min

echo "Rozpoczęto ulepszanie budynku na następny poziom<br>";
$kopalniaUranu = time() + $czasUlepszeniaKopalniUranu;
echo "Kopalnia Uranu będzie gotowa ".date('H:i:s d.m.Y', $kopalniaUranuGotowa);


$produkcjaMedykamentowGodzine = 500;
$produkcjaZe = ($produkcjaMedykamentowGodzine / 1800) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcjaZe)." medykamentów<br>";

$czasUlepszeniaApteki = 7200; //2h

echo "Rozpoczęto ulepszanie budynku na następny poziom<br>";
$aptekaGotowy = time() + $czasUlepszeniaApteki;
echo "Apteka będzie gotowa ".date('H:i:s d.m.Y', $aptekaGotowy);


$produkcjaBenzynyGodzine = 1500; 
$produkcjaK = ($produkcjaBenzynyGodzine / 5400) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcjaK)." Benzyny<br>";

$czasUlepszeniaStacjiPaliw = 1500; //25min

echo "Rozpoczęto ulepszanie budynku na następny poziom<br>";
$stacjaPaliwGotowy = time() + $czasUlepszeniaStacjiPaliw;
echo "Stacja Paliw będzie gotowa ".date('H:i:s d.m.Y', $stacjaPaliwGotowy);


$produkcjaCzesciGodzine = 1500; 
$produkcjaB = ($produkcjaCzesciGodzine / 5400) * $losowaLiczbaSekund;
echo "Od przeszłości do teraz wyprodukowano ".floor($produkcjaB)." Części<br>";

$czasUlepszeniaZlomowiska = 1500; //25min

echo "Rozpoczęto ulepszanie budynku na następny poziom<br>";
$zlomowiskoGotowe = time() + $czasUlepszeniaZlomowiska;
echo "Złomowisko będzie gotowe ".date('H:i:s d.m.Y', $zlomowiskoGotowe);


$czasUlepszeniaBunkru = 10800; //3h

echo "Rozpoczęto ulepszanie Ratusza na następny poziom<br>";
$bunkierGotowy = time() + $czasUlepszeniaBunkru;
echo "Bunkier będzie gotowy".date('H:i:s d.m.Y', $bunkierGotowy);
?>