
//<?php
//  $user = '';
//  $pass = '';
//  $database = '';
 
  // establish database connection
//  $conn = oci_connect($user, $pass, $database);
//  if (!$conn) exit;

 //var_dump($_GET);
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
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
           	<li><a href="backen.php">Backen</a></li>
     		<li><a class="active" href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
       </ul>

<br>
<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
    //Die Bestellung wird in der Datenbank aktualisiert
    $email = $_POST['email'];
    $bestellnummer = $_POST['bestellnummer'];
    $gesamtpreis = $_POST['gesamtpreis'];
    $db = new SQLite3('../backshop.db');
    $artikel = new Artikel();
    for ($i = 0; isset($_POST[strval($i)]); $i++){
        $sql = "INSERT INTO einkauf VALUES ( '". $email . "' , ". $artikel->mengeToNumber($_POST[strval($i++)]) . ", '" . $_POST[strval($i++)] . "' , " . $_POST[strval($i)] . ", " . $bestellnummer . ")";
        $db->exec($sql);
        $i = $i - 2;
        $artikel->updateLagermenge($artikel->mengeToNumber($_POST[strval($i++)]), $_POST[strval($i++)], $_POST[strval($i)]);
    }
    $db->close();
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
	  <thead>
	    <tr>
	      <th>ArtikelNr</th>
              <th>Bezeichnung</th>
              <th>Herstellungsdatum</th>
              <th>Preis</th>
              <th>Menge</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
                <?php
                    echo "Vielen Dank für Ihre Bestellung" . "<br>";
                    echo "Rechnungsbetrag: " . $_POST['gesamtpreis'] . "€ <br> <br>";
                ?>
	      </tr>
              Warenkorb: <br>
           </tbody>
        </table>
    </center>
      </form>         
</div>
<br>
</body>
</html>
