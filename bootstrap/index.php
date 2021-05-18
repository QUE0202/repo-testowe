<?php 
        require_once('./class/GameManager.class.php');
        session_start();
        if(!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej wioski
        {
            
            $_SESSION['gm'] = $gm;
        } 
        else //mamy już wioskę w sesji - przywróć ją
        {
            $gm = $_SESSION['gm'];
        }
        $v = $gm->v; //neizależnie cyz nowa gra czy załadowana
        $gm->sync(); //przelicz surowce
        
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




        
        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<?php
	//Przykładowa składnia połączenia z bazą danych dla PHP i MySQL.
	
	//Łączenie z bazą danych
	
	$hostname="twoja_nazwa_hosta";
	$username="twoja_nazwa_użytkownika_w_bazie_danych";
	$password="twoje_hasło_do_bazy_danych";
	$dbname="twoja_nazwa_użytkownika_w_bazie_danych";
	$usertable="nazwa_twojej_tabeli";
	$yourfield = "twoje_pole";
	
	
	
	
?>

  <button style="border-width: 10px; border-style: double; border-color: rgb(24, 11, 0); margin-left: 50px; margin-top: 50px;" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
  Gracz
  </button>
  <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
  <a class="dropdown-item" href="#">Nick:</a>
    <a class="dropdown-item" href="#">Gildia:</a> 
    <a class="dropdown-item" href="#">Level:</a> 
    <button type="button" class="btn btn-outline-warning">Wyloguj</button>
  
</div>
</div>


        
        

<div class="contener" style=" float: right; margin-right: 50px; margin-top: 50px; ">
<div class="dropdown" role="group" aria-label="Basic example" >
    <button style="border-width: 10px; border-style: double; border-color: rgb(24, 11, 0);" class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5">
    Magazyn
  </button>
</p>
<div class="collapse" id="collapseExample5">
<div class="card card-body">
  <a class="dropdown-item" href="#">Woda: <?php echo $v->showStorage("woda"); ?></a> 
  <a class="dropdown-item" href="#">Medykamenty: <?php echo $v->showStorage("medykamenty"); ?></a>
  <a class="dropdown-item" href="#">Mięso <?php echo $v->showStorage("food"); ?></a>
  </div>
</div>
<br>
<div class="dropdown" role="group" aria-label="Basic example" >
    <button style="border-width: 10px; border-style: double; border-color: rgb(24, 11, 0);" class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
    Kopalnia
  </button>
</p>
<div class="collapse" id="collapseExample3">
<div class="card card-body">
  Apteka,<br>
         poziom <?php echo $v->buildingLVL("apteka"); ?> <br>
        Zysk/h: <?php echo $v->showHourGain("medykamenty"); ?><br>
        <?php if($v->checkBuildingUpgrade("apteka")) : ?>
        <a href="index.php?action=upgradeBuilding&building=apteka">
            <button type="button" class="btn btn-outline-warning">Rozbuduj apteke</button>
        </a>
        <?php else : ?>
          
            <button onclick="missingResourcesPopup()" type="button" class="btn btn-outline-warning">Rozbuduj apteke</button>
        </a>
        <?php endif; ?>
        </div>
</div>
<br>
<div class="dropdown" role="group" aria-label="Basic example" >
    <button style="border-width: 10px; border-style: double; border-color: rgb(24, 11, 0);" class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">
    Studnia
  </button>
</p>
<div class="collapse" id="collapseExample4">
<div class="card card-body">
  Studniarz,<br>
         poziom <?php echo $v->buildingLVL("studnia"); ?> <br>
        Zysk/h: <?php echo $v->showHourGain("woda"); ?><br>
        <?php if($v->checkBuildingUpgrade("studnia")) : ?>
        <a href="index.php?action=upgradeBuilding&building=studnia">
            <button type="button" class="btn btn-outline-warning">Rozbuduj studnie</button>
        </a>
        <?php else : ?>
          
            <button onclick="missingResourcesPopup()" type="button" class="btn btn-outline-warning">Rozbuduj studnie</button>
        </a>
        <?php endif; ?>
  </div>
</div>
<br>
<div class="dropdown" role="group" aria-label="Basic example" >
    <button style="border-width: 10px; border-style: double; border-color: rgb(24, 11, 0);" class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
    Łąka
  </button>
</p>
<div class="collapse" id="collapseExample2">
<div class="card card-body">
  Rozbudowa łąki,<br>
         poziom <?php echo $v->buildingLVL("łąka"); ?> <br>
        Zysk/h: <?php echo $v->showHourGain("food"); ?><br>
        <?php if($v->checkBuildingUpgrade("łąka")) : ?>
        <a href="index.php?action=upgradeBuilding&building=łąka">
            <button type="button" class="btn btn-outline-warning">Rozbudowa Łąki</button>
        </a>
        <?php else : ?>
        <button onclick="missingResourcesPopup()" type="button" class="btn btn-outline-warning">Rozbudowa Łąki</button>
        </a>
        <?php endif; ?>
        </div>
</div>
</div>

    
    
    
</header>


  <img src="plemiona1.png" alt="wioska" style=" margin-left: auto; margin-right: auto; margin-top: 100px; border-width: 10px; border-style: double; border-color: rgb(24, 11, 0);">

    

  <footer class="row">
            <div class="col-12">
            <table class="table table-bordered">
            <?php
            
                
                    
                
            
            foreach ($gm->l->getLog() as $entry) {
                $timestamp = date('d.m.Y H:i:s', $entry['timestamp']);
                $sender = $entry['sender'];
                $message = $entry['message'];
                $type = $entry['type'];
                echo "<tr>";
                echo "<td>$timestamp</td>";
                echo "<td>$sender</td>";
                echo "<td>$message</td>";
                echo "<td>$type</td>";
                echo "</tr>";
            }
            
            ?>
            </table>
            </div>
        </footer>
<script>
function missingResourcesPopup(){
    window.alert("Brakuje zasobów");
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>