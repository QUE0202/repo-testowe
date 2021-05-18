<?php
class Village 
{
    private $buildings;
    private $storage;
    private $upgradeCost;

    public function __construct()
    {
        $this->buildings = array(
            'bunkier' => 1,
            'studnia' => 1,
            'apteka' => 1,
            'uranMine' => 1,
            'stacjaPaliw' => 1,
            'zlomowisko' => 1,
        );
        $this->storage = array(
                'woda' => 0,
                'medykamenty' => 0,
                'uran' => 0,
                'benzyna' => 0,
                'czesci' => 0,
        );
        $this->upgradeCost = array( //tablica wszystkich budynkow
            'studnia' => array(
                    2 => array(
                        'woda' => 100,
                        'medykamenty' => 50,
                    ),
                ),
            'apteka' => array(
                    1 => array(
                        'woda' => 100,
                    ),
                    2 => array(
                        'woda' => 300,
                        'medykamenty' => 100,
                    )
                ),
            'uranMine' => array(
                    1 => array(
                        'medykamenty' => 100,
                    ),
                    2 => array(
                        'woda' => 600,
                        'medykamenty' => 200,
                        'uran' => 100,
                    )
                ),
            'stacjaPaliw' => array(
                    1 => array(
                        'woda' => 500,
                    ),
                    2 => array(
                        'woda' => 1500,
                        'medykamenty' => 125,
                        'uran' => 100,
                    )
                ),
            'zlomowisko' => array(
                     1 => array(
                        'medykamenty' => 2000,
                        'uran' => 8000,
                     ),
                     2 => array(
                         'medykamenty' => 4000,
                         'uran' => 16000,
                     ),
                )
            );
    } 
    private function waterGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = pow($this->buildings['studnia'],2) * 100;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function medykamentyGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_drwala ^ 2
        $gain = pow($this->buildings['apteka'],2) * 5000;
        // liczymy zysk na sekunde (godzina/3600)
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function uranGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_Złotkina ^ 2
        $gain = pow($this->buildings['uranMine'],2) * 50;
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function benzynaGain(int $deltaTime) : float
    {
        //liczymy zysk na godzine z wzoru poziom_Kamieniarza ^ 2
        $gain = pow($this->buildings['stacjaPaliw'],2) * 50;
        $perSecondGain = $gain / 3600;
        //zwracamy zysk w czasie $deltaTime
        return $perSecondGain * $deltaTime;
    }
    private function czesciGain(int $deltaTime) : float
    {
       //liczymy zysk na godzine z wzoru poziom_Wojska ^ 2
       $gain = pow($this->buildings['zlomowisko'],2) * 50;
       $perSecondGain = $gain / 3600;
       //zwracamy zysk w casie $deltaTime
       return $perSecondGain * $deltaTime;
    }
    
    public function gain($deltaTime) 
    {
        $this->storage['woda'] += $this->waterGain($deltaTime);
        $this->storage['medykamenty'] += $this->medykamentyGain($deltaTime);
        $this->storage['uran'] += $this->uranGain($deltaTime);
        $this->storage['benzyna'] += $this->benzynaGain($deltaTime);
        $this->storage['czesci'] += $this->czesciGain($deltaTime);
    }
    public function showHourGain(string $resource) : string
    {
        switch($resource) {
            case 'woda':
                return $this->waterGain(3600);
                break;
            case 'medykamenty':
                return $this->medykamentyGain(3600);
                break;
            case 'uran':
                return $this->uranGain(3600);
                break;
            case 'benzyna':
                return $this->benzynaGain(3600);
                break;
            case 'czesci':
                return $this->czesciGain(3600);
                break;
            default:
                echo "Nie ma takiego surowca!";
            break;
        }
    }
    public function showStorage(string $resource) : string 
    {
        if(isset($this->storage[$resource]))
        {
            return floor($this->storage[$resource]);
        }
        else
        {
            return "Nie ma takiego surowca!";
        }
    }
    public function buildingLVL(string $building) : int 
    {
        return $this->buildings[$building];
    }
    public function capacity(string $resource) : int 
    {
        switch ($resource) {
            case 'woda':
                return $this->waterGain(60*60*24); //doba
                break;
            case 'medykamenty':
                return $this->medykamentyGain(60*60*12); //12 godzin
                break;
            case 'medykamenty':
                return $this->medykamentyGain(60*60*10); //10 godzin
                break;
            case 'uran':
                return $this->uranGain(60*60*9); //9 godzin
                break;
            case 'benzyna':
                return $this->benzynaGain(60*60*16); //16 godzin
                break;
            case 'czesci':
                return $this->czesciGain(60*60*20); //20 godzin
                break;
            default:
                return 0;
                break;
            
        }
    }
    public function log(string $message, string $type)
    {
        $this->gm->l->log($message, 'village', $type);
    }
}
?>
