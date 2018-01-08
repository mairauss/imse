<?php
 try{
	require_once('dbconnection.php');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
	$error = $e->getMessage();
}

if(isset($error)){ echo $error; }
?>

<html>
<title>Lecker: Backen</title>
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
                <li><a href="backwaren.php">Unsere Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
           	<li><a href="backen.php">Backen</a></li>
     		<li><a class="active" href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
       </ul>

<br>
<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
    //Die Bestellung wird in der Datenbank aktualisiert
    $email = $_POST['email'];
    $bestellnummer = $_POST['bestellnummer'];
    $gesamtpreis = $_POST['gesamtpreis'];
    $artikel = new Artikel();
    for ($i = 0; isset($_POST[strval($i)]); $i++){
		$artikelNr = $artikel->mengeToNumber($_POST[strval($i++)]);
		$datum = $_POST[strval($i++)];
		$menge = $_POST[strval($i)];
		
		//Insert in die Tabelle Einkauf
        $sql = "INSERT INTO einkauf VALUES ( '". $email . "' , ". $artikelNr . ", " . $datum . " , " . $menge . ", " . $bestellnummer . ")";
        $db->exec($sql);
		
		//Lagermenge wird nach der Bestätigung in der Datenbank aktualisiert
		$update = "UPDATE backwaren SET menge = menge-" . $menge . " WHERE artikelnr =" . $artikelNr . " AND bhersdatum =" .  $datum ."";
		$result = $db->exec($update);
		
		//Prüft ob nach dem Einkauf noch was im Lager vorhanden ist. Falls nicht wird die Backware aus der Datenbank gelöscht
		$lagermenge = "SELECT menge FROM backwaren WHERE artikelNr=" . $artikelNr . " AND bhersdatum=" . $datum ;
		$result = $db->query($lagermenge);
		while ($row = $result->fetch(PDO::FETCH_ASSOC)){
			$lagermenge = $row['menge'];
		}
		if ($lagermenge <= 0){
			$delete = "DELETE FROM backwaren WHERE artikelNr=" . $artikelNr . " AND bhersdatum=" . $datum;
			$db->exec($delete);
		}
    }
    unset($db);
    unset($artikel);
?>

<div>
    <p>Kunden ID: <?php echo $email; ?></p>
    <p>Meine Bestellnummer: <?php echo $bestellnummer; ?></p>
  <form id='insertform' action='einkauf.php' method='post'>
<center>
    <br> <br>
    
	<table style='border: 5px solid #DDDDDD'>
	  <tbody>
	    <tr>
        <?php
            echo "Vielen Dank für Ihre Bestellung!" . "<br>";
            echo "Rechnungsbetrag: " . $_POST['gesamtpreis'] . "€ <br> <br>";
			unset($db);
        ?>
	    </tr>
      </tbody>
    </table>
</center>
</form>         
</div>
<br>
</body>
</html>
