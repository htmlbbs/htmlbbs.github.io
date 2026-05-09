<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selbststudium: PHP if-Anweisungen</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; background-color: #f4f4f9; color: #333; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #2980b9; border-bottom: 3px solid #3498db; padding-bottom: 10px; }
        h2 { color: #2c3e50; margin-top: 30px; }
        h3 { color: #e74c3c; border-left: 5px solid #e74c3c; padding-left: 10px; margin-top: 20px; }
        .code-block { background: #ecf0f1; border: 1px solid #ddd; padding: 15px; border-radius: 5px; overflow-x: auto; margin-bottom: 15px; }
        .aufgabe { background-color: #d9edf7; border: 1px solid #bce8f1; padding: 15px; border-radius: 5px; margin-top: 20px; }
        .ergebnis { margin-top: 20px; padding: 15px; border: 2px dashed #27ae60; background-color: #e6ffe6; font-weight: bold; color: #27ae60; }
        pre { margin: 0; }
        code { color: #c0392b; }
    </style>
</head>
<body>

<div class="container">
    <h1>🚀 Selbststudium: Kontrollstrukturen in PHP (`if`, `if-else`, `if-elseif-else`)</h1>
    <p><strong>Ziel:</strong> Verstehen und Anwenden von bedingten Anweisungen, um den Programmfluss zu steuern.</p>
    
    <?php
        // -------------------------------------------------------------------
        // PHP-Variablen für die Aufgaben (Dummy-Daten)
        // DIESE WERTE ÄNDERN SIE FÜR DIE TESTS
        // -------------------------------------------------------------------
        $punkte_test = 85; 
        $wochentag = "Dienstag";
        $alter = 17;
        $kunde_vip = false;
    ?>

    <h2>1. Die einfache `if`-Anweisung (Selektion)</h2>
    <p>Die einfache `if`-Anweisung prüft eine **Bedingung**. Ist die Bedingung **wahr (`true`)**, wird der Code innerhalb der geschweiften Klammern ausgeführt. Ist sie falsch (`false`), wird der Block ignoriert.</p>

    <h3>Syntax</h3>
    <div class="code-block">
        <pre><code>if (Bedingung) {
    // Code wird nur ausgeführt, wenn die Bedingung WAHR ist
}</code></pre>
    </div>

    <h3>Beispiel: Prüfung auf Bestehen</h3>
    <p>Wir prüfen, ob die Variable <code>$punkte_test</code> größer oder gleich 50 ist.</p>
    <div class="code-block">
        <pre><code>$punkte_test = <?php echo $punkte_test; ?>;
if ($punkte_test >= 50) {
    echo "Herzlichen Glückwunsch! Sie haben den Test bestanden. &lt;br&gt;";
}
echo "Die weitere Ausführung des Programms.";</code></pre>
    </div>
    
    <p><strong>Aktuelle Ausgabe (mit <code>$punkte_test = <?php echo $punkte_test; ?></code>):</strong></p>
    <div class="ergebnis">
        <?php
        if ($punkte_test >= 50) {
            echo "Herzlichen Glückwunsch! Sie haben den Test bestanden. <br>";
        }
        echo "Programm wird weiter ausgeführt.";
        ?>
    </div>

    <hr>

    <h2>2. Die verzweigte `if-else`-Anweisung (Alternative)</h2>
    <p>Die `if-else`-Anweisung bietet zwei Pfade: Wird die Bedingung von `if` nicht erfüllt (`false`), springt das Programm automatisch in den `else`-Block.</p>

    <h3>Syntax</h3>
    <div class="code-block">
        <pre><code>if (Bedingung) {
    // Code wird ausgeführt, wenn WAHR
} else {
    // Code wird ausgeführt, wenn FALSCH
}</code></pre>
    </div>
    
    <h3>Beispiel: Wochentags-Check</h3>
    <p>Prüfe, ob heute Wochenende ist (Freitag, Samstag oder Sonntag ist für uns Wochenende).</p>

    <div class="code-block">
        <pre><code>$wochentag = "<?php echo $wochentag; ?>";
if ($wochentag == "Samstag" || $wochentag == "Sonntag" || $wochentag == "Freitag") {
    echo "Es ist Wochenende oder kurz davor. Chillen! &lt;br&gt;";
} else {
    echo "Es ist ein normaler Arbeitstag. Dranbleiben! &lt;br&gt;";
}</code></pre>
    </div>
    
    <p><strong>Aktuelle Ausgabe (mit <code>$wochentag = "<?php echo $wochentag; ?>"</code>):</strong></p>
    <div class="ergebnis">
        <?php
        if ($wochentag == "Samstag" || $wochentag == "Sonntag" || $wochentag == "Freitag") {
            echo "Es ist Wochenende oder kurz davor. Chillen! <br>";
        } else {
            echo "Es ist ein normaler Arbeitstag. Dranbleiben! <br>";
        }
        ?>
    </div>

    <hr>

    <h2>3. Die mehrfach verzweigte `if-elseif-else`-Anweisung (Mehrfach-Selektion)</h2>
    <p>Diese Struktur ermöglicht die Prüfung mehrerer voneinander abhängiger Bedingungen. Sobald **eine Bedingung** erfüllt ist, werden die restlichen `elseif`- und der `else`-Block **ignoriert**.</p>

    <h3>Syntax</h3>
    <div class="code-block">
        <pre><code>if (Bedingung 1) {
    // Wenn Bedingung 1 WAHR
} elseif (Bedingung 2) {
    // Wenn Bedingung 1 FALSCH, aber Bedingung 2 WAHR
} elseif (Bedingung 3) {
    // Wenn Bedingung 1 und 2 FALSCH, aber Bedingung 3 WAHR
} else {
    // Wenn KEINE der Bedingungen WAHR war
}</code></pre>
    </div>
    
    <h3>Beispiel: Alterskontrolle für den Event-Planer</h3>
    <p>Regeln: Über 18 (Voller Zugang), 16 bis 18 (Eingeschränkter Zugang), unter 16 (Kein Zugang).</p>

    <div class="code-block">
        <pre><code>$alter = <?php echo $alter; ?>;
if ($alter >= 18) {
    echo "Zugang gewährt: Volle Funktionen verfügbar (Tickets kaufen). &lt;br&gt;";
} elseif ($alter >= 16) {
    echo "Eingeschränkter Zugang: Nur Browsing-Funktionen (Konzerte ansehen). &lt;br&gt;";
} else {
    echo "Zugang verweigert: Sie sind unter 16 Jahren. &lt;br&gt;";
}</code></pre>
    </div>
    
    <p><strong>Aktuelle Ausgabe (mit <code>$alter = <?php echo $alter; ?></code>):</strong></p>
    <div class="ergebnis">
        <?php
        if ($alter >= 18) {
            echo "Zugang gewährt: Volle Funktionen verfügbar (Tickets kaufen). <br>";
        } elseif ($alter >= 16) {
            echo "Eingeschränkter Zugang: Nur Browsing-Funktionen (Konzerte ansehen). <br>";
        } else {
            echo "Zugang verweigert: Sie sind unter 16 Jahren. <br>";
        }
        ?>
    </div>

    <hr>

    <h2>4. 🎯 Anwendungsaufgaben zum Selbststudium</h2>

    <h3>Aufgabe A: Einfache `if` (Tickets & VIP-Status)</h3>
    <div class="aufgabe">
        <p><strong>Szenario:</strong> Im Event-Planer erhalten VIP-Kunden einen speziellen Hinweis.</p>
        <p><strong>Code-Setup:</strong> <code>$kunde_vip = <?php echo $kunde_vip ? 'true' : 'false'; ?>;</code></p>
        <p><strong>Anweisung:</strong> Erstellen Sie eine **einfache `if`-Anweisung**, die prüft, ob die Variable <code>$kunde_vip</code> **wahr** ist. Wenn ja, geben Sie aus: **"Willkommen VIP-Kunde! Sie haben Zugriff auf Pre-Sales-Tickets."**</p>

        <h3>Ihre Lösung (Überprüfen Sie den Code durch Ändern von <code>$kunde_vip</code> oben):</h3>
        <div class="ergebnis">
            <?php
            // Lösungsbereich A:
            if ($kunde_vip == true) { // Oder einfach: if ($kunde_vip)
                echo "Willkommen VIP-Kunde! Sie haben Zugriff auf Pre-Sales-Tickets.";
            } else {
                echo "Normaler Kunde. Kein VIP-Zugriff.";
            }
            ?>
        </div>
    </div>

    <h3>Aufgabe B: Mehrfach verzweigte `if-elseif-else` (Notenberechnung)</h3>
    <div class="aufgabe">
        <p><strong>Szenario:</strong> Das System soll die Note basierend auf der erreichten Punktzahl des Tests (<code>$punkte_test</code>) ausgeben.</p>
        <p><strong>Code-Setup:</strong> <code>$punkte_test = <?php echo $punkte_test; ?>;</code></p>
        <p><strong>Anweisung:</strong> Nutzen Sie eine **mehrfach verzweigte `if`-Anweisung** (`if-elseif-else`), um die Note nach folgendem Schema auszugeben:</p>
        <ul>
            <li>>= 92 Punkte: Note 1 (Sehr gut)</li>
            <li>>= 81 Punkte: Note 2 (Gut)</li>
            <li>>= 67 Punkte: Note 3 (Befriedigend)</li>
            <li>>= 50 Punkte: Note 4 (Ausreichend)</li>
            <li>< 50 Punkte: Note 5 (Ungenügend/Nicht bestanden)</li>
        </ul>

        <h3>Ihre Lösung (Überprüfen Sie den Code durch Ändern von <code>$punkte_test</code> oben):</h3>
        <div class="ergebnis">
            <?php
            // Lösungsbereich B:
            $note = "";
            if ($punkte_test >= 92) {
                $note = "1 (Sehr gut)";
            } elseif ($punkte_test >= 81) {
                $note = "2 (Gut)";
            } elseif ($punkte_test >= 67) {
                $note = "3 (Befriedigend)";
            } elseif ($punkte_test >= 50) {
                $note = "4 (Ausreichend)";
            } else {
                $note = "5 (Ungenügend/Nicht bestanden)";
            }
            echo "Mit $punkte_test Punkten haben Sie die Note: $note.";
            ?>
        </div>
    </div>
	
	 <?php
        // -------------------------------------------------------------------
        // PHP VERARBEITUNG: Formulardaten abrufen und Standardwerte setzen
        // -------------------------------------------------------------------
        // Holt die Werte aus dem Formular ($_POST), oder setzt Standardwerte,
        // wenn das Formular noch nicht gesendet wurde.
        $punkte_test = isset($_POST['punkte_test']) ? intval($_POST['punkte_test']) : 85; 
        
        // Checkbox: Wenn sie gesendet wird ('on'), ist sie true. Sonst false.
        $kunde_vip = isset($_POST['kunde_vip']) ? true : false; 
    ?>
	
<div <div class="interaktive-uebung">
        <h2>🎯 Interaktive Anwendungsaufgaben</h2>
        <p>Geben Sie die Testpunkte ein und setzen Sie den VIP-Status, um die Funktionsweise der if-Anweisungen direkt zu testen.</p>

        <form method="POST" action="">
            <div class="form-group">
                <label for="punkte_test">1. Erreichte Testpunkte (0 - 100):</label>
                <input type="number" id="punkte_test" name="punkte_test" min="0" max="100" value="<?php echo $punkte_test; ?>" required>
            </div>
            <div class="form-group">
                <label for="kunde_vip">2. Kunde ist VIP:</label>
                <input type="checkbox" id="kunde_vip" name="kunde_vip" <?php echo $kunde_vip ? 'checked' : ''; ?>>
            </div>
            
            <button type="submit">Ergebnisse berechnen</button>
        </form>

        <div class="ergebnis-container">
            <h3>&#x1F4CB; Aktuelle Ergebnisse der if-Anweisungen:</h3>
            
            <div class="ergebnis-meldung">
                <strong>Aufgabe A: VIP-Status (Einfache `if`)</strong>
                <?php
                if ($kunde_vip) { 
                    echo "Willkommen VIP-Kunde! Sie haben Zugriff auf Pre-Sales-Tickets.";
                } else {
                    echo "Normaler Kunde. Kein VIP-Zugriff.";
                }
                ?>
            </div>

            <div class="ergebnis-meldung">
                <strong>Aufgabe B: Notenberechnung (Verzweigte `if-elseif-else`)</strong>
                <?php
                $note = "";
                
                // NOTENLOGIK (Die Schüler sollen diese Logik im Kopf nachvollziehen)
                if ($punkte_test >= 92) {
                    $note = "1 (Sehr gut)";
                } elseif ($punkte_test >= 81) {
                    $note = "2 (Gut)";
                } elseif ($punkte_test >= 67) {
                    $note = "3 (Befriedigend)";
                } elseif ($punkte_test >= 50) {
                    $note = "4 (Ausreichend)";
                } else {
                    $note = "5 (Ungenügend/Nicht bestanden)";
                }
                
                echo "Mit **$punkte_test** Punkten ergibt sich die Note: **$note**.";
                ?>
            </div>
        </div>
</div>
</body>
</html>