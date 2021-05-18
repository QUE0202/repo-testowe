<?php
class Village 
{
    private $buildings;
    private $storage;
    private $upgradeCost;

    public function __construct()
    {
        $this->buildings = array(
            'townHall' => 1,
            'woodcutter' => 1,
            'ironMine' => 1,
            'goldMine' => 1,
            'quarry' => 1,
            'barraki' => 1,
        );
        $this->storage = array(
                'wood' => 0,
                'iron' => 0,
                'gold' => 0,
                'stone' => 0,
                'weapons' => 0,
        );
        $this->upgradeCost = array( //tablica wszystkich budynkow
            'woodcutter' => array(
                    2 => array(
                        'wood' => 100,
                        'iron' => 50,
                    ),
                ),
            'ironMine' => array(
                    1 => array(
                        'wood' => 100,
                    ),
                    2 => array(
                        'wood' => 300,
                        'iron' => 100,
                    )
                ),
            'goldMine' => array(
                    1 => array(
                        'iron' => 100,
                    ),
                    2 => array(
                        'wood' => 600,
                        'iron' => 200,
                        'gold' => 100,
                    )
                ),
            'quarry' => array(
                    1 => array(
                        'wood' => 500,
                    ),
                    2 => array(
                        'wood' => 1500,
                        'iron' => 125,
                        'gold' => 100,
                    )
                ),
            'barraki' => array(
                     1 => array(
                        'iron' => 2000,
                        'gold' => 8000,
                     ),
                     2 => array(
                         'iron' => 4000,
                         'gold' => 16000,
                     ),
                )
            );
    } 
    private function woodGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = pow($this->buildings['woodcutter'],2) * 100;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function ironGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = pow($this->buildings['ironMine'],2) * 5000;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function goldGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_Złotkina ^ 2
        $gain = pow($this->buildings['goldMine'],2) * 50;
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function stoneGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_Kamieniarza ^ 2
        $gain = pow($this->buildings['quarry'],2) * 50;
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function weaponsGain(int $deltaTime) : float
    {
       //liczymy zysk na godzine z wzoru poziom_Wojska ^ 2
       $gain = pow($this->buildings['barraki'],2) * 50;
       $perSecondGain = $gain / 3600;
       //zwracamy zysk w casie $deltaTime
       return $perSecondGain * $deltaTime;
    }
    
    public function gain($deltaTime) 
    {
        $this->storage['wood'] += $this->woodGain($deltaTime);
        $this->storage['iron'] += $this->ironGain($deltaTime);
        $this->storage['gold'] += $this->goldGain($deltaTime);
        $this->storage['stone'] += $this->stoneGain($deltaTime);
        $this->storage['weapons'] += $this->weaponsGain($deltaTime);
    }

}
?>
















<?php

public function upgradeBuilding(string $buildingName) : bool
    {
        $currentLVL = $this->buildings[$buildingName];
        $cost = $this->upgradeCost[$buildingName][$currentLVL+1];
        foreach ($cost as $key => $value) {
            //key - nazwa surowca
            //value koszt surowca
            if($value > $this->storage[$key])
                return false;
        }
        foreach ($cost as $key => $value) {
            //odejmujemy surowce na budynek
            $this->storage[$key] -= $value;
        }
        //podnies lvl budynku o 1
        $this->buildings[$buildingName] += 1; 
        return true;
    }


?>





<?php 
        require('./class/Village.class.php');
        session_start();
        if(!isset($_SESSION['v'])) // jeżeli nie ma w sesji naszej wioski
        {
            echo "Tworzę nową wioskę...";
            $v = new Village();
            $_SESSION['v'] = $v;
            //reset czasu od ostatniego odświerzenia strony
            $deltaTime = 0;
        } 
        else //mamy już wioskę w sesji - przywróć ją
        {
            $v = $_SESSION['v'];
            //ilosc sekund od ostatniego odświerzenia strony
            $deltaTime = time() - $_SESSION['time'];
        }
        $v->gain($deltaTime);
        
        if(isset($_REQUEST['action'])) 
        {
            switch($_REQUEST['action'])
            {
                case 'upgradeBuilding':
                    if($v->upgradeBuilding($_REQUEST['building']))
                    {
                        echo "Ulepszono budynek: ".$_REQUEST['building'];
                    }
                    else
                    {
                        echo "Nie udało się ulepszyć budynku: ".$_REQUEST['building'];
                    }
                    
                break;
                default:
                    echo 'Nieprawidłowa zmienna "action"';
            }
        }




        $_SESSION['time'] = time();
        
        
    ?>















    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <header class="row border-bottom">
            <div class="col-12 col-md-3">
                Informacje o graczu
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-3">
                        Drewno: <?php echo $v->showStorage("wood"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Żelazo: <?php echo $v->showStorage("iron"); ?>
                    </div>
                    <div class="col-12 col-md-3">
                        Zasób 3
                    </div>
                    <div class="col-12 col-md-3">
                        Zasób 4
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                Guzik wyloguj
            </div>
        </header>
        <main class="row border-bottom">
            <div class="col-12 col-md-3 border-right">
                Lista budynków<br>
                Drwal, poziom <?php echo $v->buildingLVL("woodcutter"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("wood"); ?><br>
                <?php if($v->checkBuildingUpgrade("woodcutter")) : ?>
                <a href="index.php?action=upgradeBuilding&building=woodcutter">
                    <button>Rozbuduj drwala</button>
                </a><br>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj drwala</button><br>
                <?php endif; ?>
                Kopalnia żelaza, poziom <?php echo $v->buildingLVL("ironMine"); ?> <br>
                Zysk/h: <?php echo $v->showHourGain("iron"); ?><br>
                <?php if($v->checkBuildingUpgrade("ironMine")) : ?>
                <a href="index.php?action=upgradeBuilding&building=ironMine">
                    <button>Rozbuduj kopalnie żelaza</button>
                </a>
                <?php else : ?>
                    <button onclick="missingResourcesPopup()">Rozbuduj kopalnie żelaza</button>
                <br>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6">
                Widok wioski
            </div>
            <div class="col-12 col-md-3 border-left">
                Lista wojska
            </div>
        </main>
        <footer class="row">
            <div class="col-12">
            <pre>
            <?php
            var_dump($v);
            var_dump($_REQUEST);
            ?>
            </pre>
            </div>
        </footer>
    </div>
    <script>
        function missingResourcesPopup() {
            window.alert("Brakuje zasobów");
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>