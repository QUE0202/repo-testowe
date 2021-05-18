<?php
$mainContent = "<h3>Plac wojskowy<h3>";
$mainContent = "<table class=\"table table-bordered\">";
$mainContent .= "<tr><th>Nazwa jednostki</th><th>Ilość jednostek</th>
                <th>Do stworzenia</th><th>Trenuj</th></tr>";

$mainContent .= "<tr>
                    <td>Boty Ofensywne</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"spearmen\" id=\"spearmen\"></td>
                    <td><button type=\"submit\">Stwórz</button></td>
                    </form>
                </tr>";

$mainContent .= "<tr>
                    <td>Boty Defensywne</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"archer\" id=\"archer\"></td>
                    <td><button type=\"submit\">Stwórz</button></td>
                    </form>
                </tr>";

$mainContent .= "<tr>
                    <td>Boty Latające</td>
                    <td>0</td>
                    <form method=\"get\" action=\"index.php\">
                    <input type=\"hidden\" name=\"action\" value=\"newUnit\">
                    <td><input type=\"number\" name=\"cavalry\" id=\"cavalry\"></td>
                    <td><button type=\"submit\">Stwórz</button></td>
                    </form>
                </tr>";
                
$mainContent .= "</table>";
$mainContent .= "<h3>Obecne armie:</h3>";
$armyList = $gm->getArmyList();
$mainContent .= "<table class=\"table table-bordered\">";
$mainContent .= "<tr>
                    <th>Nazwa armii</th>
                    <th>Boty Ofensywne</th>
                    <th>Boty Defensywne</th>
                    <th>Boty Latające</th>
                </tr>";
if(is_array($armyList)) 
{
    foreach($armyList as $army)
    {
        $mainContent .= "<tr>";
        $mainContent .= "<td></td>";
        $mainContent .= "<td>$army->spearmen</td>";
        $mainContent .= "<td>$army->archers</td>";
        $mainContent .= "<td>$army->cavalry</td>";
        $mainContent .= "</tr>";
    }
}

$mainContent .= "</table>";
?>