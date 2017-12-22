//<?php
//USER MUSS SICH ZUERST EINLOGGEN, DAMIT DIE SEITE AUFGERUFEN WERDEN KANN
//  $user = '';
//  $pass = '';
//  $database = '';
 
  // establish database connection
//  $conn = oci_connect($user, $pass, $database);
//  if (!$conn) exit;

 //var_dump($_GET);
//?>

<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
?>

<html>
    <title>Lecker: Backwaren</title>
        <head>
            <link rel="stylesheet" href="index.css" />
        </head>
        <body>
            <img src="b5.png" alt="logo" width="500" height="300">
            <br></br>
            <ul> 
		<li><a href="baeckerei.php">Lecker</a></li>
		<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a href="kunde.php">Kunde</a></li>
                <li><a class="active" href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
                <li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
            </ul>

            <br></br>

        <div id="wrapper">
            <center>
                    <div>
                        <form id='searchform' action='backwaren.php' method='post'>
                            <a href='backwaren.php'>Alle Backenwaren</a> ---
                            Suche nach ArtikelNr:
                            <input id='search' name='search' type='text' size='15' value='<?php if (isset($_POST['search'])) echo $_POST['search']; ?>' />
                            <input id='submit' type='submit' class="testbutton" value='Search' />
                         <!-- </form> -->
                    <!-- </div> -->
                     
                    
                <?php
                    // check if search view of list view
                    if (isset($_POST['search'])) {
                        $sql = "SELECT * FROM backwaren WHERE artikelnr like '%" . $_POST['search'] . "%'";
                    } else {
                        $sql = "SELECT * FROM backwaren";
                    }
                    // execute sql statement
                    //$s    tmt = new SQLite3('backshop.db');
                    //$list = $stmt ->query($sql);
                    //$stmt ->close();
                    //unset($stmt);
                ?>
                <div>

                    <!-- <form id='searchform' action='backwaren.php' method='get'> -->
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
                                <input id='artikelnr' name='artikelnr' type='number' size='10' value='<?php if (isset($_GET['artikelnr'])) echo $_POST['artikelnr']; ?>' />
                            </td>
                            <td>
                                <input id='bhersdatum' name='bhersdatum' type='text' size='30' value='<?php if (isset($_GET['bhersdatum'])) echo $_POST['bhersdatum']; ?>' />
                            </td>
                            <td>
                                <input id='gname' name='gname' type='text' size='10' value='<?php if (isset($_GET['gname'])) echo $_POST['gname']; ?>' />
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
                                <input id='bpreis' name='bpreis' type='double' size='10' value='<?php if (isset($_POST['bpreis'])) echo $_POST['bpreis']; ?>' />
                            </td>
                            <td>
                                <input id='bhaltdauer' name='bhaltdauer' type='text' size='10' value='<?php if (isset($_POST['bhaltdauer'])) echo $_POST['bhaltdauer']; ?>' />
                            </td>
                            <td>
                                <input id='menge' name='menge' type='number' size='10' value='<?php if (isset($_POST['menge'])) echo $_POST['menge']; ?>' />
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    </center>
                    <input id='submit' type='submit' class="testbutton" value='Insert' />                
                    <!-- </form> -->
                <!-- </div> -->    
                
            <?php
            //Einfügen können nur Mitarbeiter
            //Handle insert
    
            if (isset($_POST['artikelnr']) && $_POST['artikelnr'] >= 1) 
            {
                echo "  " . $_POST['artikelnr'] . "</br>";
                //Prepare insert statementd
                $insertstmt = "INSERT INTO backwaren VALUES(" . $_POST['artikelnr'] . ",'"  . $_POST['bhersdatum'] . "', '" . $_POST['gname'] .
                              "', ". $_POST['bpreis'] . ", '" . $_POST['bhaltdauer'] . "', " . $_POST['menge'] . ")";
                //Parse and execute statement
                $insert = new SQLite3('backshop.db');
                $result = $insert ->exec($insertstmt);
                $insert->close();
                unset($insert);
                if($result){
                    print("Successfully inserted");
                    print("<br>");
                }
                //Print potential errors and warnings
                else{
                    print("FAILURE");
                }
            } 
            ?>
            
            <div>
               
                <!--  <form id='insertform' action='backwaren.php' method='post'> --> 
                <table style='border: 4px solid #DDDDDD'>
                <thead>
                    <tr>
                        <th>ArtikelNr</th>
                        <th>Herstellungsdatum</th>
                        <th>Produkt</th>
                        <th>Preis</th>
                        <th>HaltbarBis</th>
                        <th>Menge</th>
                        <th>Bestellmenge</th>
                    </tr>      
                </thead>
                <tbody>
                    <?php
                        // fetch rows of the executed sql query
                        // execute sql statement
                        $stmt = new SQLite3('backshop.db');
                        $list = $stmt->query($sql);
                        $nr = 0;
                        $artikel = [];
                       
                        while ($row = $list->fetchArray()) {
                            echo "<tr>";
                            echo "<td>" . $row['artikelnr'] . "</td>";
                            echo "<td>" . $row['bhersdatum'] . "</td>";
                            echo "<td>" . $row['gname'] . "</td>";
                            echo "<td>" . $row['bpreis'] . " €" . "</td>";
                            echo "<td>" . $row['bhaltdauer'] . "</td>";
                            echo "<td>" . $row['menge'] . "</td>";
                            ?>
                            <td> <input id='<?php echo strval($nr); ?>' name='<?php echo strval($nr); ?>' type='number' size='4' value='"<?php echo isset($_POST[strval($nr)]); ?>"'/> </td>
                            <?php
                            if ($row['bhaltdauer'] == null){
                                $ware = Artikel::construct2($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['menge']);
                                $artikel[$nr] = $ware;
                                unset($ware);
                            } else {
                                $ware = Artikel::constructFull($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['bhaltdauer'], $row['menge']);
                                $artikel[$nr] = $ware;
                                unset($ware);
                            }
                            
                            $nr++;
                            echo "</tr>";   
                        }
                        $stmt ->close();
                        unset($stmt);
                    ?>
                </tbody>
                </table>
                <input id='submit' type='submit' class="testbutton" value='Hinzufügen' />
                </form>
                
                <?php
                    //Bestellungen werden in einem Array gespeichert
                    $bestellung = [];
                    $ct = 0;
                    for ($i = 0; $i < $nr; $i++){
                        if (isset($_POST[strval($i)]) && $_POST[strval($i)] >= 1){
                            $bestellung[$ct] = $artikel[$i];
                            $bestellung[$ct]->setBestellMenge($_POST[strval($i)]);
                            $ct++;
                            //echo $_POST[strval($i)] . "  " . $bestellung[$ct++]->getGName() . " ";
                        }
                    }
                    echo "</br>";
                    if (isset($bestellung[0])) {
                        for ($i = 0; $i < $ct; $i++){
                            echo $bestellung[$i]->getGName() . " " . $bestellung[$i]->getBestellMenge() . ", ";
                        }
                        if (isset($_GET['search']))
                            $_GET['search'] = $_GET['search'];
                    }
                    else {
                        echo "Bestellmenge angeben" . "</br>";
                    }
                ?>
            
            </div>  
            <div>Insgesamt <?php echo $nr; ?> Backwaren gefunden!</div>
            </center>
            <br></br>
            
            </div>
    </body>
</html>