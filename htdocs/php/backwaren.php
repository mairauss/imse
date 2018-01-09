<?php
include('session.php');
try {
    require_once('dbconnection.php');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (isset($error)) {
    echo $error;
}

$logedinuser = $login_session;
if (isset($logedinuser)) {
    $resultsession = $db->query($ses_sql);
    $data = $resultsession->fetch(PDO::FETCH_ASSOC);
    //Administrator Rechte

    if ($data['accesslevel'] == 9 || $data['accesslevel'] == 1 || $data['accesslevel'] == 2 || $data['accesslevel'] == 3) {
    } else {
        echo "Sie haben kein Zugriff auf diese Seite";
        header('Location: baeckerei.php');
    };
}


?>

<?php
require_once 'Artikel.php';
require_once 'Warenkorb.php';
?>

<html>
<title>Lecker: Backwaren</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<?php if (!isset($logedinuser)): ?>
    <ul>
        <li><a href="baeckerei.php">Lecker</a></li>
        <li><a href="backwaren.php">Unsere Backwaren</a></li>
        <li><a href="einkauf.php">Warenkorb</a></li>
        <li><a href="bestand.php">Bestandteil</a></li>
        <li><a href="session_logout.php">Logout</a></li>
    </ul>
<?php endif; ?>
<?php if (isset($logedinuser)): ?>
    <?php if ($data['accesslevel'] == 9): ?>
        <ul>
            <li><a class="active" href="baeckerei.php">Lecker</a></li>
            <li><a href="mitarbeiter.php">Mitarbeiter</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
            <li><a href="kunde.php">Kunde</a></li>
            <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="backen.php">Backen</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="backen.php">Backen</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<br></br>

<div id="wrapper">
    <center>
        <div>
            <form id='searchform'
                  action='backwaren.php<?php if (isset($_GET['search'])) echo "?search=" . $_GET['search']; ?>'
                  method='get'>
                <a href='backwaren.php'>Alle Backenwaren</a> ---
                Suche nach Artikelnummer:
                <input id='search' name='search' type='text' size='15'
                       value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>'/>
                <input id='submit' type='submit' class="testbutton" value='Search'/>
            </form>
        </div>


        <?php
        // check if search view of list view
        if (isset($_GET['search'])) {
            $sql = "SELECT * FROM backwaren WHERE artikelnr like '%" . $_GET['search'] . "%'";
        } else {
            $sql = "SELECT * FROM backwaren";
        }
        // execute sql statement
        //$s    tmt = new SQLite3('backshop.db');
        //$list = $stmt ->query($sql);
        //$stmt ->close();
        //unset($stmt);
        ?>
        <?php if ($data['accesslevel'] == 9 || $data['accesslevel'] == 3): ?>
            <!-- DIESER TEIL SOLLTE NUR FÜR MITARBEITER SICHTBAR SEIN -->
            <div>
                <form id='insertform' action='backwaren.php' method='post'>
                    <center>
                        Neue Backwaren einfuegen:
                        <table style='border: 5px solid #DDDDDD'>
                            <thead>
                            <tr>
                                <th>ArtikelNr</th>
                                <th>Herstellungsdatum</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input id='artikelnr' name='artikelnr' type='number' size='10'
                                           value='<?php if (isset($_POST['artikelnr'])) echo $_POST['artikelnr']; ?>'/>
                                </td>
                                <td>
                                    <input id='bhersdatum' name='bhersdatum' type='text' size='30'
                                           value='<?php if (isset($_POST['bhersdatum'])) echo $_POST['bhersdatum']; ?>'/>
                                </td>
                                <td>
                                    <input id='gname' name='gname' type='text' size='10'
                                           value='<?php if (isset($_GET['gname'])) echo $_POST['gname']; ?>'/>
                                </td>
                            </tr>
                            </tbody>

                            <table style='border: 5px solid #DDDDDD'>
                                <thead>
                                <tr>
                                    <th>Preis</th>
                                    <th>Haltbar.Dauer</th>
                                    <th>Menge</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input id='bpreis' name='bpreis' type='double' size='10'
                                               value='<?php if (isset($_POST['bpreis'])) echo $_POST['bpreis']; ?>'/>
                                    </td>
                                    <td>
                                        <input id='bhaltdauer' name='bhaltdauer' type='text' size='10'
                                               value='<?php if (isset($_POST['bhaltdauer'])) echo $_POST['bhaltdauer']; ?>'/>
                                    </td>
                                    <td>
                                        <input id='menge' name='menge' type='number' size='10'
                                               value='<?php if (isset($_POST['menge'])) echo $_POST['menge']; ?>'/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    </center>
                    <input id='submit' type='submit' class="testbutton" value='Insert'/>
                </form>
            </div>
            <!-- /DIESER TEIL SOLLTE NUR FÜR MITARBEITER SICHTBAR SEIN -->
        <?php endif; ?>
        <?php
        //Einfügen können nur Mitarbeiter
        if (isset($_POST['artikelnr']) && $_POST['artikelnr'] >= 1) {
            //Prepare insert statementd
            $insertstmt = "INSERT INTO backwaren VALUES(" . $_POST['artikelnr'] . ",'" . $_POST['bhersdatum'] . "', '" . $_POST['gname'] .
                "', " . $_POST['bpreis'] . ", '" . $_POST['bhaltdauer'] . "', " . $_POST['menge'] . ")";
            //Parse and execute statement
            $result = $db->exec($insertstmt);
            if ($result) {
                print("Successfully inserted");
                print("<br><br>");
            } //Print potential errors and warnings
            else {
                print("FAILURE");
            }
        }
        ?>

        <div>
            <form action='einkauf.php' method='post'>
                <table style='border: 4px solid #DDDDDD'>
                    <thead>
                    <tr>
                        <th>ArtikelNr</th>
                        <th>Herstellungsdatum</th>
                        <th>Produkt</th>
                        <th>Preis (inkl. UST)</th>
                        <th>HaltbarBis</th>
                        <th>Menge</th>
                        <th>Bestellmenge</th>
                    </tr>
                    </thead>
                    <tbody>
                    <input id="Artikel" name="Artikel" type="hidden" value="<?php echo isset($_POST['Artikel']) ?>"/>
                    <?php
                    // fetch rows of the executed sql query
                    // execute sql statement
                    //$stmt = new SQLite3('../backshop.db');
                    $list = $db->query($sql);
                    //Indizies für die http POST Methoden
                    $mengeNr = 0;
                    $artikelNr = 100000;
                    //Arrays für Http POST
                    $artikelnr = [];
                    $bhersdatum = [];
                    $gname = [];
                    $preis = [];
                    $bhaltdauer = [];
                    $lagerMenge = [];

                    $ware;
                    while ($row = $list->fetch(PDO::FETCH_ASSOC)) {
                        $del;
                        //Löscht aus der Datenbank, falls eine Backware nicht mehr im Lager vorhanden ist
                        if ($row['menge'] <= 0) {
                            $del = "DELETE FROM backwaren WHERE artikelnr=" . $row['artikelnr'] . " AND bhersdatum='" . $row['bhersdatum'] . "'";
                            $db->exec($del);
                        } else {
                            echo "<tr>";
                            echo "<td>" . $row['artikelnr'] . "</td>";
                            echo "<td>" . $row['bhersdatum'] . "</td>";
                            echo "<td>" . $row['gname'] . "</td>";
                            echo "<td>" . $row['bpreis'] . " €" . "</td>";
                            echo "<td>" . $row['bhaltdauer'] . "</td>";
                            echo "<td>" . $row['menge'] . "</td>";
                            ?>
                            <td><input id='<?php echo strval($mengeNr); ?>' name='<?php echo strval($mengeNr); ?>'
                                       type='number' size='4' value='"<?php echo isset($_POST[strval($mengeNr)]); ?>"'/>
                            </td>
                            <?php
                            //Bestellungen werden in einem Array gespeichert
                            if ($row['bhaltdauer'] == null) {
                                //$ware = Artikel::construct2($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['menge']);
                                $artikelnr[$mengeNr] = $row['artikelnr'];
                                $bhersdatum[$mengeNr] = $row['bhersdatum'];
                                $gname[$mengeNr] = $row['gname'];
                                $preis[$mengeNr] = $row['bpreis'];
                                $lagerMenge[$mengeNr] = $row['menge'];
                                ?>
                                <input id='<?php echo "artikelnr" . strval($artikelNr); ?>'
                                       name='<?php echo "artikelnr" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $artikelnr[$mengeNr]; ?>"'/>
                                <input id='<?php echo "bhersdatum" . strval($artikelNr); ?>'
                                       name='<?php echo "bhersdatum" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $bhersdatum[$mengeNr]; ?>"'/>
                                <input id='<?php echo "gname" . strval($artikelNr); ?>'
                                       name='<?php echo "gname" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $gname[$mengeNr]; ?>"'/>
                                <input id='<?php echo "preis" . strval($artikelNr); ?>'
                                       name='<?php echo "preis" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $preis[$mengeNr]; ?>"'/>
                                <input id='<?php echo "lagermenge" . strval($artikelNr); ?>'
                                       name='<?php echo "lagermenge" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $lagerMenge[$mengeNr]; ?>"'/>
                                <?php
                                //unset($ware);
                            } //Falls Haltedatum des Produktes nicht angegeben ist
                            else {
                                //$ware = Artikel::constructFull($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['bhaltdauer'], $row['menge']);
                                $artikelnr[$mengeNr] = $row['artikelnr'];
                                $bhersdatum[$mengeNr] = $row['bhersdatum'];
                                $gname[$mengeNr] = $row['gname'];
                                $preis[$mengeNr] = $row['bpreis'];
                                $bhaltdauer[$mengeNr] = $row['bhaltdauer'];
                                $lagerMenge[$mengeNr] = $row['menge'];
                                ?>
                                <input id='<?php echo "artikelnr" . strval($artikelNr); ?>'
                                       name='<?php echo "artikelnr" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $artikelnr[$mengeNr]; ?>"'/>
                                <input id='<?php echo "bhersdatum" . strval($artikelNr); ?>'
                                       name='<?php echo "bhersdatum" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $bhersdatum[$mengeNr]; ?>"'/>
                                <input id='<?php echo "gname" . strval($artikelNr); ?>'
                                       name='<?php echo "gname" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $gname[$mengeNr]; ?>"'/>
                                <input id='<?php echo "preis" . strval($artikelNr); ?>'
                                       name='<?php echo "preis" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $preis[$mengeNr]; ?>"'/>
                                <input id='<?php echo "bhaltdauer" . strval($artikelNr); ?>'
                                       name='<?php echo "bhaltdauer" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $bhaltdauer[$mengeNr]; ?>"'/>
                                <input id='<?php echo "lagermenge" . strval($artikelNr); ?>'
                                       name='<?php echo "lagermenge" . strval($artikelNr); ?>' type="hidden"
                                       value='"<?php echo $lagerMenge[$mengeNr]; ?>"'/>
                                <?php
                            }
                            $mengeNr++;
                            $artikelNr++;

                            /*$artikelNr = $artikelNr + 0.1;
                            if (($artikelNr*10)%10 == 0)
                                $artikelNr = $artikelNr + 0.1;*/
                            echo "</tr>";
                        }
                    }
                    /*$k = 1.1;
                    for ($i = 0; $i < $mengeNr; $i++){
                        echo $i . " " . $_POST[strval($k)]->getGName() . " ";
                        $k = $k + 0.1;
                        if (($k*10)%10 == 0)
                            $k = $k + 0.1;
                    }*/
                    unset($ware);
                    unset($stmt);
                    ?>
                    </tbody>
                </table>
                <input id="submit" type="submit" class="testButton" value="Zur Kassa"/>
            </form>
        </div>
        <form id='insertform' action='backwaren.php' method='post'>
            <input id='order' name='order' type='hidden' value="<?php $_POST['order'] ?>"/>
        </form>
        <div>Insgesamt <?php echo $mengeNr;
            unset($db); ?> Backware(n) gefunden!
        </div>
    </center>
    <br></br>
</div>
</body>
</html>