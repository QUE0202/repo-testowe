<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylebutton.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Apteka</title>
</head>
<body>
    <center><h1>Apteka</h1></center>
    <br>

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
</body>
</html>