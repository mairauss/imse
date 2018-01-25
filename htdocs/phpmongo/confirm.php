<?php
 require 'vendor/autoload.php';
	$connection = new MongoDB\Client("mongodb://team10:pass10@ds159187.mlab.com:59187/backshop");
	$collectionEinkauf = $connection->backshop->einkaeufe;
	$collectionBestellnummer = $connection->backshop->bestellnummer;
	$collectionBackwaren = $connection->backshop->backwaren;
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
    $bestellnummer = intval($_POST['bestellnummer']);
    $gesamtpreis = $_POST['gesamtpreis'];
    $artikel = new Artikel();
	$lagermenge;
    for ($i = 0; isset($_POST[strval($i)]); $i++){
		$artikelNr = $artikel->mengeToNumber($_POST[strval($i++)]);
		$datum = $_POST[strval($i++)];
		$menge = intval($_POST[strval($i++)]);
		$lagermenge = $_POST[strval($i)];
		$artikelNr = intval($artikelNr);
		$date = "";
		for ($k = 1; $k < strlen($datum)-1; $k++){
			$date = $date . $datum[$k];
		}
		$date = strval($date);
		
		//Dokument für das Einfügen
		$doc = array(
			"email" => $email,
			"artikelnr" => $artikelNr,
			"bhersdatum" => $datum,
			"menge" => $menge,
			"bestellnr" => $bestellnummer
		);
		//in die Collection Einkauf einfügen
        $result = $collectionEinkauf->insertOne($doc);
		if ($result->getInsertedCount() != 1)
			print("FAILURE");

		//neue Lagermenge wird in der Datenbank aktualisiert
		$result = $collectionBackwaren->updateOne(
			['bhersdatum' => $date, 'artikelnr' => $artikelNr],
			['$set' => ["menge" => $lagermenge-$menge]]
		);

		//Prüft ob nach dem Einkauf noch was im Lager vorhanden ist. Falls nicht wird die Backware aus der Datenbank gelöscht
		if ($lagermenge <= 0){
			$result = $collectionBackwaren->deleteOne(['artikelnr' => $artikelNr, 'bhersdatum' => $datum]);
			if ($result->getDeletedCount() != 1)
				print("Löschen fehlgeschlagen");
		}
    }
	$update = $collectionBestellnummer->updateOne(
				['nr' => $bestellnummer],
				['$set' => ['nr' => ($bestellnummer+1)]]
			); 
    unset($artikel);
	unset($collectionBackwaren);
	unset($collectionBestellnummer);
	unset($collectionEinkauf);
	unset($connection);
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
