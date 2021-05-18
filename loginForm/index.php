<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="./bootstrap/style.css">
</head>
    <body>
        <?php
        //pokaż formularz jeśli jeszcze nie wysłano danych  
        if(!isset($_REQUEST['username']))
        require('loginform.html');
        else
        {
            $wprowadzonyLogin = $_REQUEST['username'];
            $wprowadzoneHaslo = $_REQUEST['password'];
            //podano dane do formularza
            //$prawidlowyLogin = "jkowalski";
            //$prawidloweHasloHash = '$argon2i$v=19$m=65536,t=4,p=1$eENMYXROOFdkSlRCdkJucg$C2bWwURxUOBlZEBQ4IFVWxtDzyOvox7SzACkUQx0SVA';
    
            $db = new mysqli('localhost', 'root', '', 'genericbrowsergame');
            $sql = "SELECT * FROM `user` WHERE `username` = \"$wprowadzonyLogin\""; // znak \ rozumiemy jako "nie interpretuj, przepisz
            $wynik = $db->query($sql);
            $wiersz = $wynik->fetch_assoc();

            $hasloZbazy = $wiersz['password']; // w zmiennej mam hasha zaczynającego się od $argon2i

            //sprawdź hasło
            if(password_verify($wprowadzoneHaslo, $hasloZbazy))
            {
                echo "<p>Zalogowałeś się poprawnie</p>";
            }
            else
            {
                echo "<p>Nieprawidłowy Login lub Hasło!";
            }
        }

        ?>
        <pre>
            <?php
        
            //var_dump($_REQUEST);

            ?>
        </pre>
    </body>
</html>