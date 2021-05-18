<?php
require_once(__DIR__ . '/smarty/libs/Smarty.class.php');
require_once(__DIR__ . '/class/DB.class.php');
require_once(__DIR__ . '/class/GameManager.class.php');
require_once(__DIR__ . '/class/Route.class.php');

session_start();

$smarty = new Smarty();
$db = new DB();


$smarty->setTemplateDir(__DIR__ . '/smarty/templates');
$smarty->setCompileDir(__DIR__ . '/smarty/templates_c');
$smarty->setCacheDir(__DIR__ . '/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/smarty/configs');
$smarty->assign('config', array(
    'date' => '%d.%m.%Y',
    'time' => '%H:%M:%S',
    'datetime' => '%H:%M:%S %d.%m.%Y'
));

if (!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej gry
{
    $gm = new GameManager();
    $_SESSION['gm'] = $gm;
} else //mamy już gre w sesji - przywróć ją
{
    $gm = $_SESSION['gm'];
}
$v = $gm->v;
$gm->sync();

Route::add('/', function () {
    global $smarty;
    $smarty->assign('woda', $v->showStorage("woda"));
    $smarty->assign('medykamenty', $v->showStorage("medykamenty"));
    $smarty->assign('food', $v->showStorage("food"));
    $smarty->assign('mainContent', "village.tpl");
    $smarty->display('index.tpl');
});




Route::run('/');
exit;

$smarty->assign('mainContent', "village.tpl"); //default view
/* end smarty init */


if (!isset($_SESSION['player_id']) && !isset($_REQUEST['login'])) {
    $smarty->display('login.tpl');
    exit;
}
if (!isset($_SESSION['gm'])) // jeżeli nie ma w sesji naszej wioski
{
    $gm = new GameManager();
    $_SESSION['gm'] = $gm;
} else //mamy już wioskę w sesji - przywróć ją
{
    $gm = $_SESSION['gm'];
}
//niezależnie cyz nowa gra czy załadowana
//przelicz surowce

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'register':
            if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
                //zapisz usera do bazy
                $db->registerPlayer($_REQUEST['login'], $_REQUEST['password']);
            } else {
                $smarty->display('register.tpl');
                exit;
            }
            break;
        case 'login':
            if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
                //zaloguj gracza
                $db->loginPlayer($_REQUEST['login'], $_REQUEST['password']);
            } else {
                $smarty->display('login.tpl');
                exit;
            }
            break;
        case 'upgradeBuilding':
            $v->upgradeBuilding($_REQUEST['building']);
            $smarty->assign('buildingList', $v->buildingList());
            $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
            $smarty->assign('buildingUpgrades', $buildingUpgrades);
            $smarty->assign('mainContent', "townHall.tpl");
            break;
        case 'newUnit':
            if (isset($_REQUEST['spearmen'])) //kliknelismy wyszkol przy włócznikach
            {
                $count = $_REQUEST['spearmen']; //ilość nowych włóczników
                $gm->newArmy($count, 0, 0, $v); //tworz nowy oddział włóczników w wiosce w ilosci $count;
            }
            if (isset($_REQUEST['archer'])) {
                $count = $_REQUEST['archer'];
                $gm->newArmy(0, $count, 0, $v);
            }
            if (isset($_REQUEST['cavalry'])) {
                $count = $_REQUEST['cavalry'];
                $gm->newArmy(0, 0, $count, $v);
            }
            $smarty->assign('armyList', $gm->getArmyList());
            $smarty->assign('mainContent', "townSquare.tpl");
            break;
        case 'townHall':
            $smarty->assign('buildingList', $v->buildingList());
            $buildingUpgrades = $gm->s->getTasksByFunction("scheduledBuildingUpgrade");
            $smarty->assign('buildingUpgrades', $buildingUpgrades);
            $smarty->assign('mainContent', "townHall.tpl");
            break;
        case 'townSquare':
            $smarty->assign('armyList', $gm->getArmyList());
            $smarty->assign('mainContent', "townSquare.tpl");
            break;
        default:

            $gm->l->log("Nieprawidłowa zmienna \"action\"", "controller", "error");
    }
}
$smarty->assign('playerLogin', $_SESSION['player_login']);


$smarty->assign('logArray', $gm->l->getLog());
$smarty->display('index.tpl');