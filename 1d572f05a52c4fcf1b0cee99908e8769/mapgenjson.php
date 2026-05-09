<html>
    <head>
        <title>Map-Struktur erstellen</title>
        <style>
            body {background-color: floralWhite; margin-left: 50; margin-top: 30; font-family: Verdana; }
            table {border-collapse: separate;}
            table td { border: 1px solid #000000 }
			.textbox {background-color: white; padding: 10; width: max-content; border: solid 1px black;}
			.hinweis {background-color: lightYellow; padding: 5; width: max-content; border: solid 1px black; font-size: 0.8em; }
        </style>
    </head>
    <body>
        <?php
            if (array_key_exists('schreiben', $_POST)) {
                $mapnametmp = ($_POST['mapname']);
                $mapname = '"'.$mapnametmp.'"';
                $anzahlpfade = ($_POST['anzahlpfade']);
                $pfadzahl = "0";
                $csv = "#~~~Edumaps~~~#\r\n".$mapname.",,,i33,,0,0,";
                
                $tmpName = tempnam(sys_get_temp_dir(), $mapname);
                $file = fopen($tmpName, 'w');
                fwrite($file, $csv);

                while ($pfadzahl < $anzahlpfade) {
                    $pfadzahl++;
                    $pfadabfrage = "pfad".$pfadzahl;
                    $farbabfrage = "pfadfarbe".$pfadzahl;
                    $pfadnametmp = ($_POST[$pfadabfrage]);
                    $pfadname = '"'.$pfadnametmp.'"';
                    $pfadfarbe = ($_POST[$farbabfrage]);  
                    if ($pfadfarbe == "#FFFFFF") {$textfarbe = "4"; } else {$textfarbe = "0"; }  
                    $boxzahl = "0";
                    $boxabfrage = "boxeninpfad".$pfadzahl;
                    $boxeninpfad = ($_POST[$boxabfrage]);
                    $boxfarbabfrage = "boxfarbe".$pfadzahl;
                    $boxfarbe = ($_POST[$boxfarbabfrage]);
                    $mapcode = "\r\n".$pfadname.",,,,,".$pfadfarbe.",".$textfarbe."\r\n";   
                    fwrite($file, $mapcode);
    
                    while ($boxzahl < $boxeninpfad) {
                        $boxzahl++; 
                        $boxnameabfrage = "box".$pfadzahl."-".$boxzahl;
                        $boxfoldabfrage = "boxfold".$pfadzahl."-".$boxzahl;
                        $boxfillabfrage = "boxfill".$pfadzahl."-".$boxzahl;
                        $boxnametmp = ($_POST[$boxnameabfrage]);
                        $boxname = '"'.$boxnametmp.'"';
                        $boxfold = ($_POST[$boxfoldabfrage]);
                        $boxfill = ($_POST[$boxfillabfrage]);
                        if ($boxfold == "1" AND $boxfill == "1") {
                            $boxeigenschaften = "20"; }
                        else { if ($boxfold == "1") {
                                   $boxeigenschaften = "4"; }
                               else if ($boxfill == "1") {
                                        $boxeigenschaften = "16"; }
                                    else { $boxeigenschaften = "0"; }
                            }

                            if ($boxfarbe == "#FFFFFF") { $boxeigenschaften = $boxeigenschaften + 8; }

                        $boxcode = $boxname.",,,,,0,".$boxfarbe.",".$boxeigenschaften.",'0 0'\r\n";
                        fwrite($file, $boxcode);
                    }

                }
                fclose($file);

$csv= file_get_contents($tmpName);
$array = array_map("str_getcsv", explode("\n", $csv));
$json = json_encode($array);
file_put_contents($tmpName, $json);

                header('Content-Description: File Transfer');
                header('Content-Type: text/csv');
                $filename = substr(strtolower(preg_replace('/[^A-Za-z0-9_]+/', '', str_replace(array('Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', ' '), array('ae', 'oe', 'ue', 'ae', 'oe', 'ue', 'ss', '_'), $mapname))), 0, 30).".csv";
                header('Content-Disposition: attachment; filename= '.$filename);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($tmpName));
                
                ob_clean();
                flush();
                readfile($tmpName);
                unlink($tmpName);

            }
            
            else {
            
            if (array_key_exists('pfade', $_POST)) {
                $anzahlpfade = ($_POST['pfade']);
                $mapname = ($_POST['mapname']);
                if ($mapname == "Name eingeben") {$mapname = "unbenannte Map"; }
                $farbschema = ($_POST['farbschema']);
                $pfadzahl = "0"; 
                echo "
                    <h1>".$mapname."</h1>
                    <form method='post'>
                    <input type='hidden' name='anzahlpfade' value='".$anzahlpfade."'>
                    <input type='hidden' name='mapname' value='".$mapname."'>
                    <h3><label for='Pfadeigenschaften'>Pfadeigenschaften:</label></h3>
                    <table cellspacing='15' cellpadding='5'><tr>
					<div class='hinweis'>Pfadnamen eingeben, Farben und Anzahl der Boxen w&auml;hlen</div>
					
                ";
                if ($farbschema == "standard") {
                while ($pfadzahl < $anzahlpfade){
                    $pfadzahl++;
                    echo "<td border: 1px solid black; style='text-align:right'>
                        <input type='name' id='pfad".$pfadzahl."' name='pfad".$pfadzahl."' min='1' size='35' value='Name von Pfad ".$pfadzahl."'><br><br>
                        <label for='farbepfad'>Pfadfarbe: </label>
                        <select  name='pfadfarbe".$pfadzahl."' id='pfadfarbe".$pfadzahl."'>
                            <option value='#FFFFFF' style='color: #999999'>Wei&szlig;</option>
                            <option value='#000000' style='color: #000000'>Schwarz</option>
                            <option value='#888888' style='color: #888888'>Grau</option>
                            <option value='#444444' style='color: #444444'>Dunkelgrau</option>
                            <option value='#2A2A48' style='color: #2A2A48'>Nachtblau</option>
                            <option value='#34495E' style='color: #34495E'>Blaugrau</option>
                            <option value='#0000FF' style='color: #0000FF'>K&ouml;nigsblau</option>
                            <option value='#0087CD' style='color: #0087CD'>Blau</option>
                            <option value='#4267F5' style='color: #4267F5'>Hellblau</option>
                            <option value='#0074D9' style='color: #0074D9'>Himmelblau</option>
                            <option value='#42782E' style='color: #42782E'>Dunkelgr&uuml;n</option>
                            <option value='#3D9970' style='color: #3D9970'>Limette</option>
                            <option value='#2ECC40' style='color: #2ECC40'>Gr&uuml;n</option>
                            <option value='#45B39D' style='color: #45B39D'>Blaugr&uuml;n</option>
                            <option value='#39CCCC' style='color: #39CCCC'>Cyan</option>
                            <option value='#B12C21' style='color: #B12C21'>Dunkelrot</option>
                            <option value='#FF3125' style='color: #FF3125'>Rot</option>
                            <option value='#D35400' style='color: #D35400'>Orange (dunkel)</option>
                            <option value='#FF851B' style='color: #FF851B'>Orange</option>
                            <option value='#E49600' style='color: #E49600'>Orange (hell)</option>
                            <option value='#F012BE' style='color: #F012BE'>Magenta (hell)</option>
                            <option value='#B10DC9' style='color: #B10DC9'>Magenta (dunkel)</option>
                            <option value='#85144B' style='color: #85144B'>Pink</option>
                            <option value='#A569BD' style='color: #A569BD'>Violet</option>
                        </select><br><br>
                        <label for='farbebox'>Boxfarbe: </label>
                        <select  name='boxfarbe".$pfadzahl."' id='boxfarbe".$pfadzahl."'>
                            <option value='wiepfad' style='color: #000000' selected>-- wie Pfad --</option>
                            <option value='---leer' style='color: #999999' disabled> </option>
                            <option value='#FFFFFF' style='color: #999999'>Wei&szlig;</option>
                            <option value='#000000' style='color: #000000'>Schwarz</option>
                            <option value='#888888' style='color: #888888'>Grau</option>
                            <option value='#444444' style='color: #444444'>Dunkelgrau</option>
                            <option value='#2A2A48' style='color: #2A2A48'>Nachtblau</option>
                            <option value='#34495E' style='color: #34495E'>Blaugrau</option>
                            <option value='#0000FF' style='color: #0000FF'>K&ouml;nigsblau</option>
                            <option value='#0087CD' style='color: #0087CD'>Blau</option>
                            <option value='#4267F5' style='color: #4267F5'>Hellblau</option>
                            <option value='#0074D9' style='color: #0074D9'>Himmelblau</option>
                            <option value='#42782E' style='color: #42782E'>Dunkelgr&uuml;n</option>
                            <option value='#3D9970' style='color: #3D9970'>Limette</option>
                            <option value='#2ECC40' style='color: #2ECC40'>Gr&uuml;n</option>
                            <option value='#45B39D' style='color: #45B39D'>Blaugr&uuml;n</option>
                            <option value='#39CCCC' style='color: #39CCCC'>Cyan</option>
                            <option value='#B12C21' style='color: #B12C21'>Dunkelrot</option>
                            <option value='#FF3125' style='color: #FF3125'>Rot</option>
                            <option value='#D35400' style='color: #D35400'>Orange (dunkel)</option>
                            <option value='#FF851B' style='color: #FF851B'>Orange</option>
                            <option value='#E49600' style='color: #E49600'>Orange (hell)</option>
                            <option value='#F012BE' style='color: #F012BE'>Magenta (hell)</option>
                            <option value='#B10DC9' style='color: #B10DC9'>Magenta (dunkel)</option>
                            <option value='#85144B' style='color: #85144B'>Pink</option>
                            <option value='#A569BD' style='color: #A569BD'>Violet</option>
                        </select>
                        <br><br>  
                        <label for='boxen'>Anzahl Boxen: </label>
                        <input type='number' id='boxeninpfad".$pfadzahl."' name='boxeninpfad".$pfadzahl."' min='0' max='20' value='0'>           
                    </td>";          
                } 
                echo "</tr></table><input type='submit' value='Weiter'></form>";                       
                }
            else {
                while ($pfadzahl < $anzahlpfade){
                    $pfadzahl++;
                    echo "<td border: 1px solid black; style='text-align:right'>
                        <input type='name' id='pfad".$pfadzahl."' name='pfad".$pfadzahl."' min='1' size='35' value='Name von Pfad ".$pfadzahl."'><br><br>
                        <label for='farbepfad'>Pfadfarbe: </label>
                        <select  name='pfadfarbe".$pfadzahl."' id='pfadfarbe".$pfadzahl."'>
                            <option value='#EEBB11' style='color: #EEBB11'>Gelb</option>
                            <option value='#92C512' style='color: #92C512'>Gr&uuml;n</option>
                            <option value='#C4452A' style='color: #C4452A'>Rot</option>
                            <option value='#3F90BD' style='color: #3F90BD'>Blau</option>
                            <option value='#888888' style='color: #888888'>Grau</option>
                            <option value='#e49e09' style='color: #e49e09'>dunkles Gelb</option>
                            <option value='#42663E' style='color: #42663E'>dunkles Gr&uuml;n</option>
                            <option value='#9E332A' style='color: #9E332A'>dunkles Rot</option>
                            <option value='#313879' style='color: #313879'>dunkles Blau</option>
                        </select><br><br>
                        <label for='farbebox'>Boxfarbe: </label>
                        <select  name='boxfarbe".$pfadzahl."' id='boxfarbe".$pfadzahl."'>
                            <option value='wiepfad' style='color: #000000' selected>-- wie Pfad --</option>
                            <option value='---leer' style='color: #999999' disabled> </option>
                            <option value='#EEBB11' style='color: #EEBB11'>Gelb</option>
                            <option value='#92C512' style='color: #92C512'>Gr&uuml;n</option>
                            <option value='#C4452A' style='color: #C4452A'>Rot</option>
                            <option value='#3F90BD' style='color: #3F90BD'>Blau</option>
                            <option value='#888888' style='color: #888888'>Grau</option>
                            <option value='#e49e09' style='color: #e49e09'>dunkles Gelb</option>
                            <option value='#42663E' style='color: #42663E'>dunkles Gr&uuml;n</option>
                            <option value='#9E332A' style='color: #9E332A'>dunkles Rot</option>
                            <option value='#313879' style='color: #313879'>dunkles Blau</option>
                        </select>
                        <br><br>  
                        <label for='boxen'>Anzahl Boxen: </label>
                        <input type='number' id='boxeninpfad".$pfadzahl."' name='boxeninpfad".$pfadzahl."' min='0' max='20' value='0'>           
                    </td>";          
                } 
                echo "</tr></table><input type='submit' value='Weiter'></form>";            
            }       
            }        
            
            else {
                    if (array_key_exists('anzahlpfade', $_POST)) { 
                        $anzahlpfade = ($_POST['anzahlpfade']);
                        $mapname = ($_POST['mapname']);
                        $pfadzahl = "0";
                        echo "
                        <h1>".$mapname."</h1>
                        <h3>Boxeigenschaften:</h3>
						<div class='hinweis'>Boxnamen eingeben und Eigenschaften festlegen (Box f&uuml;llen = die ganze Box wird farbig, auch der Texthintergrund)</div>
                        <table cellspacing='10' cellpadding='8'><tr>";
                        while ($pfadzahl < $anzahlpfade){
                            $boxzahl = "0";
                            $pfadzahl++;
                            $pfadabfrage = "pfad".$pfadzahl;
                            $farbabfrage = "pfadfarbe".$pfadzahl;
                            $pfadname = ($_POST[$pfadabfrage]);
                            $pfadfarbe = ($_POST[$farbabfrage]);
                            $boxabfrage = "boxeninpfad".$pfadzahl;
                            $boxfarbabfrage = "boxfarbe".$pfadzahl;
                            $boxeninpfad = ($_POST[$boxabfrage]);
                            $boxfarbe = ($_POST[$boxfarbabfrage]);
                            if ($boxfarbe == "wiepfad") { $boxfarbe = $pfadfarbe; }
                            echo "<td valign='top' style='border: 0px solid #000000'>
                            <form method='post'>
                            <input type='hidden' name='pfadfarbe".$pfadzahl."' value='".$pfadfarbe."'>
                            <input type='hidden' name='boxfarbe".$pfadzahl."' value='".$boxfarbe."'>
                            <input type='hidden' name='boxeninpfad".$pfadzahl."' value='".$boxeninpfad."'>
                            <table cellspacing='10' cellpadding='8'><tr style='height:60px'><td valign='top' bgcolor='".$pfadfarbe."'>
                            <input type='name' id='pfad".$pfadzahl."' name='pfad".$pfadzahl."' min='1' size='35' value='".$pfadname."'>
                            </td></tr></table>";

                                echo "<table cellspacing='10' cellpadding='0'>";
                                while ($boxzahl < $boxeninpfad){
                                    $boxzahl++;
                                    echo "<tr><td valign='top' bgcolor='#FFFFFF'>
                                        <table cellspacing='0' cellpadding='8'><tr style='height:50px;' bgcolor='".$boxfarbe."'>
                                        <td colspan='2' valign='top' align='center' style='border: 0px solid #000000;'>
                                        <input type='name' id='box".$pfadzahl."-".$boxzahl."' name='box".$pfadzahl."-".$boxzahl."' min='1' size='35' value='Box ".$pfadzahl."-".$boxzahl."'>
                                        </td></tr><tr style='height:50px;'>
                                        <td valign='bottom' style='border: 0px solid #000000;'>
                                        <input type='checkbox' id='boxfold".$pfadzahl."-".$boxzahl."' name='boxfold".$pfadzahl."-".$boxzahl."' value='1'><label for='boxfold".$pfadzahl."-".$boxzahl."'>Box einklappen</label>
                                        </td>
                                        <td valign='bottom' align='right' style='border: 0px solid #000000;'>
                                        <label for='boxfill".$pfadzahl."-".$boxzahl."'>Box f&uuml;llen</label><input type='checkbox' id='boxfill".$pfadzahl."-".$boxzahl."' name='boxfill".$pfadzahl."-".$boxzahl."' value='1'>
                                        </td>
                                        </tr></table>
                                        </td></tr>";                                  
                                        
                                }
                                echo "</table>";               
                                }
                            
                            $filename = substr(strtolower(preg_replace('/[^A-Za-z0-9_]+/', '', str_replace(array('Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', ' '), array('ae', 'oe', 'ue', 'ae', 'oe', 'ue', 'ss', '_'), $mapname))), 0, 30).".csv";
                            

                            echo "</tr></table>
							<div class= 'textbox'>
                            <b>Die n&auml;chsten Schritte</b><br><br>
                            - mit einem Klick auf <b>Struktur herunterladen</b> wird eine Datei auf dem PC gespeichert<br>
                            - in edumaps <b>Map erstellen</b> und dann <b>Map importieren</b> w&auml;hlen<br>
                            - anschlie&szlig;end rechts auf <b>Edumaps (csv)</b> klicken<br>
                            - die Datei <b>".$filename."</b> auf dem PC suchen und ausw&auml;hlen<br>
                            - die Map wird in edumaps erzeugt und ge&ouml;ffnet<br>
                            - die Datei kann vom PC gel&ouml;scht (oder als Vorlage behalten) werden</div><br><br>";

                            echo "
                            <input type='hidden' name='schreiben' value='0' id='schreiben'>
                            <input type='hidden' name='mapname' value='".$mapname."'>
                            <input type='hidden' name='anzahlpfade' value='".$anzahlpfade."'>
                            <input type='submit' value='Struktur herunterladen'></form>";

                        }  
                
                    else {
                        
                        echo "
                        <h1>Neue Map</h1>
                        <form method='post'>
                        <label for='titel'>Name der Map: </label>
                        <input type='name' id='mapname' name='mapname' min='1' size='40' value='Name eingeben'><br><br>
                        <label for='quantity'>Anzahl der Pfade (zwischen 1 und 40):</label>
                        <input type='number' id='pfade' name='pfade' min='1' max='40' value='1'><br><br>
                        Farbschema:&nbsp;&nbsp; 
                            <input type='radio' id='schema' name='farbschema' value='standard' checked>Standard &nbsp;
                            <input type='radio' id='schema' name='farbschema' value='ritterplan'>Ritterplan
                            <br>   <br>          
                            <input type='submit' value='Weiter'>
                        </form>
						<br>
						<div class= 'textbox'>
						Auf dieser Seite kann die Struktur f&uuml;r eine neue edumap schneller erstellt werden.<br>
						Es k&ouml;nnen Pfade und Boxen angelegt, Titel vergeben und die Farben gew&auml;hlt werden.<br> 
						Inhalte k&ouml;nnen hier <u>nicht</u> eingef&uuml;gt werden. Die weitere Bearbeitung geschieht in edumaps.<br><br>
						Farbschemata: &nbsp;Standard = Farben aus edumaps &nbsp;/&nbsp; Ritterplan = Farben aus dem Schullogo<br>
						Die erstellte Pinnwand (Pfade) kann in eine Timeline oder Stickerwand umgewandelt werden.<br><br>
						Die Struktur wird in einer Datei auf dem PC gespeichert und danach in edumaps importiert.<br>
						Eine detailierte Anleitung dazu folgt nach dem letzten Schritt auf dieser Seite.
						</div>
					    ";
                    }        
            }}

        ?>
    </body> 
</html>