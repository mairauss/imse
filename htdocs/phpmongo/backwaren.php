<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
	require 'vendor/autoload.php';
	include('session.php');
	$connection = new MongoDB\Client("mongodb://team10:pass10@ds159187.mlab.com:59187/backshop");
	$collection = $connection->backshop->backwaren;
	$collectionuser = $connection->backshop->users;
	$user_check = $_SESSION['login_user'];
	$logedinuser = $login_session;
	$cursor = $collectionuser->find(['email' => $user_check]);
	foreach ($cursor as $document) {
	if (isset($logedinuser)) {
		//Administrator Rechte
		if ($document['accesslevel'] == 9) {
			// echo "Access Level 9";
		} else {
			echo "Sie haben kein Zugriff auf diese Seite";
			header('Location: baeckerei.php');
		};
	} else {
		echo "Unzeireichende User Berechtigung";
	}
}
	
	
?>

<html>
    <title>Lecker: Backwaren</title>
        <head>
            <link rel="stylesheet" href="index.css" />
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
			<?php if ($document['accesslevel'] == 9): ?>
				<ul> 
					<li><a href="baeckerei.php">Lecker</a></li>
					<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
					<li><a href="konditor.php">Konditor</a></li>
					<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
					<li><a href="kunde.php">Kunde</a></li>
					<li><a href="backwarenmanager.php">Backwaren Manager</a></li>
					<li><a href="produkte.php">Produkte</a></li>
					<li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
					<li><a href="einkauf.php">Warenkorb</a></li>
					<li><a href="bestand.php">Bestandteil</a></li>	
          			<li><a href="putzplan.php">Putzplan</a></li>
					<li><a href="session_logout.php">Logout</a></li>			
			   </ul>
		   		<?php endif; ?>
				<?php if ($document['accesslevel'] == 1): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
						<li><a href="einkauf.php">Warenkorb</a></li>
						<li><a href="bestand_kunde.php">Bestandteil</a></li>	
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
				<?php if ($document['accesslevel'] == 2): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
				<?php if ($document['accesslevel'] == 3): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a class="active" href="backwaren.php">Unsere Backwaren</a></li>
						<li><a href="einkauf.php">Warenkorb</a></li>
						<li><a href="produkte.php">Produkte</a></li>
						<li><a href="bestand.php">Bestandteil</a></li>
          				<li><a href="putzplan.php">Putzplan</a></li>
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
		<?php endif; ?>

            <br></br>

        <div id="wrapper">
            <center>
                    <div>
                        <form id='searchform' action='backwaren.php<?php if (isset($_GET['search'])) echo "?search=" . $_GET['search']; ?>' method='get'>
                            <a href='backwaren.php'>Alle Backenwaren</a> ---
                            Suche nach Artikelnummer:
                            <input id='search' name='search' type='double' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
                            <input id='submit' type='submit' class="testbutton" value='Search' />
                         </form>
                    </div>
            
                <?php
                    // check if search view of list view
                    if (isset($_GET['search'])) {
						$suchbegriff = intval($_GET['search']);
                    } else {
                        $suchbegriff = null;
                    }
                ?>
				<?php if ($document['accesslevel'] == 9 || $data['accesslevel'] == 3): ?>
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
                                <input id='artikelnr' name='artikelnr' type='double' size='10' value='<?php if (isset($_POST['artikelnr'])) echo $_POST['artikelnr']; ?>' />
                            </td>
                            <td>
                                <input id='bhersdatum' name='bhersdatum' type='text' size='30' value='<?php if (isset($_POST['bhersdatum'])) echo $_POST['bhersdatum']; ?>' />
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
			    <!-- /DIESER TEIL SOLLTE NUR FÜR MITARBEITER SICHTBAR SEIN -->
                <?php endif; ?>
            <?php
            //Einfügen können nur Mitarbeiter
            if (isset($_POST['artikelnr']) && $_POST['artikelnr'] >= 1) 
            {
				if (isset($_POST['bhaltdauer']) && $_POST['bhaltdauer'] != null)
					$neueWare = Artikel::constructFull($_POST['artikelnr'], $_POST['bhersdatum'], $_POST['gname'], $_POST['bpreis'], $_POST['bhaltdauer'], $_POST['menge']);
				else
					$neueWare = Artikel::construct2($_POST['artikelnr'], $_POST['bhersdatum'], $_POST['gname'], $_POST['bpreis'], $_POST['menge']);
				$doc = $neueWare->createDocument();
				$result = $collection->insertOne($doc);
                if($result->getInsertedCount() == 1){
                    print("Successfully inserted");
                    print("<br><br>");
                }
                //Print potential errors and warnings
                else{
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
                <input id ="Artikel" name="Artikel" type="hidden" value="<?php echo isset($_POST['Artikel']) ?>"/>
                    <?php
						$list = null;
                        // execute noSql statement
						if (isset($suchbegriff) && $suchbegriff != null) {
							$list = $collection->find(['artikelnr' => $suchbegriff]);
						} else {
							$list = $collection->find();
						}
                        //Indizies für die http POST Methoden
                        $mengeNr = 0;
                        $artikelNr = 100000;
                        //Arrays für Http POST
                        $artikelnr = [];
                        $bhersdatum = [];
                        $gname = [];
                        $preis = [];
                        $bhaltdauer= [];
                        $lagerMenge = [];
                        
                        $row;
                        foreach ($list as $row) {
							//Löscht aus der Datenbank, falls eine Backware nicht mehr im Lager vorhanden ist
							if ($row['menge'] <= 0){
								$del = $collection->deleteOne(['artikelnr' => $row['artikelnr'], 'bhersdatum' => $row['bhersdatum']]);
								if ($del->getDeletedCount() != 1)
									echo "Löschen ist fehlgeschlagen" . "<br>";
							} else {
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
									$artikelnr[$mengeNr] = $row['artikelnr'];
									$bhersdatum[$mengeNr] = $row['bhersdatum'];
									$gname[$mengeNr] = $row['gname'];
									$preis[$mengeNr] = $row['bpreis'];
									$lagerMenge[$mengeNr] = $row['menge'];
									?>
									<input id='<?php echo "artikelnr" . strval($artikelNr); ?>' name='<?php echo "artikelnr" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $artikelnr[$mengeNr]; ?>"'/>
									<input id='<?php echo "bhersdatum" . strval($artikelNr); ?>' name='<?php echo "bhersdatum" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $bhersdatum[$mengeNr]; ?>"'/>
									<input id='<?php echo "gname" . strval($artikelNr); ?>' name='<?php echo "gname" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $gname[$mengeNr]; ?>"'/>
									<input id='<?php echo "preis" . strval($artikelNr); ?>' name='<?php echo "preis" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $preis[$mengeNr]; ?>"'/>    
									<input id='<?php echo "lagermenge" . strval($artikelNr); ?>' name='<?php echo "lagermenge" . strval($artikelNr); ?>' type="hidden"  value='"<?php echo $lagerMenge[$mengeNr]; ?>"'/>
									<?php
									//unset($ware);
								}
								//Falls Haltedatum des Produktes nicht angegeben ist
								else{
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
                        unset($collection); 
						unset($connection)
                    ?>
                </tbody>
                </table> 
            <input  id="submit" type="submit" class="testButton" value="Zur Kassa"/>
            </form>
            </div>
                <form id='insertform' action='backwaren.php' method='post'>
                <input id='order' name='order' type='hidden' value="<?php $_POST['order'] ?>" />
                </form>
            <div>Insgesamt <?php echo $mengeNr;?> Backware(n) gefunden!</div>
            </center>
            <br></br>
            </div>
    </body>
</html>
