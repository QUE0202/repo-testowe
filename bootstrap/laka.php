<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylebutton.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Łąka</title>
</head>
<body>
    <center><h1>Łąka</h1></center>
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
</body>
</html>