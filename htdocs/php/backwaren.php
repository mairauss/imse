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
                <li><a href="logout.php">Logout</a></li>	
            </ul>

            <br></br>

        <div id="wrapper">
            <center>
                    <div>
                        <form id='searchform' action='backwaren.php<?php if (isset($_GET['search'])) echo "?search=" . $_GET['search']; ?>' method='get'>
                            <a href='backwaren.php'>Alle Backenwaren</a> ---
                            Suche nach ArtikelNr:
                            <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
                            <input id='submit' type='submit' class="testbutton" value='Search' />
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
                <div>
                    <form id='searchform' action='backwaren.php' method='post'>
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
                    </form>
                </div>    
                
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
                $insert = new SQLite3('../backshop.db');
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
            //für die untere FORM mit GET für ACTION
            //<?php if(isset($_GET['session'])){ echo "?session=" . array_values($_GET['session']); }
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
                <input id ="Artikel" name="Artikel" type="hidden" value="<?php echo isset($_POST['Artikel']) ?>"/>
                    <?php
                        // fetch rows of the executed sql query
                        // execute sql statement
                        $stmt = new SQLite3('../backshop.db');
                        $list = $stmt->query($sql);
                        //Indizies für die http POST Methoden
                        $mengeNr = 0;
                        $artikelNr = 1000;
                        //Arrays für Http POST
                        $artikelnr = [];
                        $bhersdatum = [];
                        $gname = [];
                        $preis = [];
                        $bhaltdauer= [];
                        $lagerMenge = [];
                        
                        $ware;
                        while ($row = $list->fetchArray()) {
                            echo "<tr>";
                            echo "<td>" . $row['artikelnr'] . "</td>";
                            echo "<td>" . $row['bhersdatum'] . "</td>";
                            echo "<td>" . $row['gname'] . "</td>";
                            echo "<td>" . $row['bpreis'] . " €" . "</td>";
                            echo "<td>" . $row['bhaltdauer'] . "</td>";
                            echo "<td>" . $row['menge'] . "</td>";
                            ?>
                            <td> <input id='<?php echo strval($mengeNr);?>' name='<?php echo strval($mengeNr); ?>' type='number' size='4' value='"<?php echo isset($_POST[strval($mengeNr)]); ?>"'/> </td>                       
                            <?php
                            //Bestellungen werden in einem Array gespeichert
                            if ($row['bhaltdauer'] == null){
                                $ware = Artikel::construct2($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['menge']);
                                $artikel[$mengeNr] = $ware;
                                //<input id=' echo strval($artikelNr);' name=' echo strval($artikelNr); ' type='hidden' value='" echo isset($_POST[strval($artikelNr)]); "'/>
                                ?>
                                
                                <?php
                                //unset($ware);
                            }
                            //Falls Haltedatum des Produktes nicht angegeben ist
                            else{
                                //$ware = Artikel::constructFull($row['artikelnr'], $row['bhersdatum'], $row['gname'], $row['bpreis'], $row['bhaltdauer'], $row['menge']);
                                $artikelnr[$mengeNr] = $row['artikelnr'];
                                $bhersdatum[$mengeNr] = $row['bhersdatum'];
                                $gname[$mengeNr] = $row['gname'];
                                $preis[$mengeNr] = $row['bpreis'];
                                $bhaltdauer[$mengeNr] = $row['bhaltdauer'];
                                $lagerMenge[$mengeNr] = $row['menge'];
                                ?>
                                <input id='<?php echo "artikelnr" . strval($artikelNr); ?>' name='<?php echo "artikelnr" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $artikelnr[$mengeNr]; ?>"'/>
                                <input id='<?php echo "bhersdatum" . strval($artikelNr); ?>' name='<?php echo "bhersdatum" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $bhersdatum[$mengeNr]; ?>"'/>
                                <input id='<?php echo "gname" . strval($artikelNr); ?>' name='<?php echo "gname" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $gname[$mengeNr]; ?>"'/>
                                <input id='<?php echo "preis" . strval($artikelNr); ?>' name='<?php echo "preis" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $preis[$mengeNr]; ?>"'/>    
                                <input id='<?php echo "bhaltdauer" . strval($artikelNr); ?>' name='<?php echo "bhaltdauer" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $bhaltdauer[$mengeNr]; ?>"'/>
                                <input id='<?php echo "lagermenge" . strval($artikelNr); ?>' name='<?php echo "lagermenge" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $lagerMenge[$mengeNr]; ?>"'/>
                                <?php
                                //print_r($artikel[$artikelNr]);
                                //unset($ware);
                            }
                            $mengeNr++;
                            $artikelNr++;
                            
                            /*$artikelNr = $artikelNr + 0.1;
                            if (($artikelNr*10)%10 == 0)
                                $artikelNr = $artikelNr + 0.1;*/
                            echo "</tr>";   
                        }
                        if(isset($artikel[3])) 
                            print_r($artikel[3]);
                        /*$k = 1.1;
                        for ($i = 0; $i < $mengeNr; $i++){
                            echo $i . " " . $_POST[strval($k)]->getGName() . " ";
                            $k = $k + 0.1;
                            if (($k*10)%10 == 0)
                                $k = $k + 0.1;
                        }*/
                        unset($ware);
                        $stmt ->close();
                        unset($stmt);
                    ?>
                </tbody>
                </table> 
            <input  id="submit" type="submit" class="testButton" value="Zur Kassa"/>
            </form>
            </div>
                <form id='insertform' action='backwaren.php' method='post'>
                <input id='order' name='order' type='hidden' value="<?php $_POST['order'] ?>" />
                </form>
            <div>Insgesamt <?php echo $mengeNr; ?> Backwaren gefunden!</div>
            </center>
            <br></br>
            </div>
    </body>
</html>