<?php
 include('session.php');
 try{
	require_once('dbconnection.php');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
	$error = $e->getMessage();
}

if(isset($error)){ echo $error; }

$logedinuser = $login_session;
	    if (isset($logedinuser)) {
		$resultsession = $db->query($ses_sql);
		$data = $resultsession->fetch(PDO::FETCH_ASSOC);
			//Administrator Rechte
			
			if($data['accesslevel'] == 9 || $data['accesslevel'] == 1 || $data['accesslevel'] == 2 || $data['accesslevel'] == 3){
			} else{
				echo "Sie haben kein Zugriff auf diese Seite";
				header('Location: baeckerei.php');
			};
		} 





?>

<html>
<title>Lecker: Backen</title>
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
			<?php if ($data['accesslevel'] == 9): ?>
				<ul> 
					<li><a href="baeckerei.php">Lecker</a></li>
					<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
					<li><a href="konditor.php">Konditor</a></li>
					<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
					<li><a href="kunde.php">Kunde</a></li>
					<li><a href="backwarenmanager.php">Backwaren Manager</a></li>
					<li><a href="produkte.php">Produkte</a></li>
					<li><a href="backwaren.php">Unsere Backwaren</a></li>
					<li><a class="active" href="einkauf.php">Warenkorb</a></li>
					<li><a href="backen.php">Backen</a></li>
					<li><a href="bestand.php">Bestandteil</a></li>	
					<li><a href="session_logout.php">Logout</a></li>			
			   </ul>
		   		<?php endif; ?>
				<?php if ($data['accesslevel'] == 1): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a href="backwaren.php">Unsere Backwaren</a></li>
						<li><a class="active"  href="einkauf.php">Warenkorb</a></li>
						<li><a href="bestand.php">Bestandteil</a></li>	
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
				<?php if ($data['accesslevel'] == 2): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a href="backwaren.php">Unsere Backwaren</a></li>
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
				<?php if ($data['accesslevel'] == 3): ?>
					<ul> 
						<li><a href="baeckerei.php">Lecker</a></li>
						<li><a href="backwaren.php">Unsere Backwaren</a></li>
						<li><a class="active" href="einkauf.php">Warenkorb</a></li>
						<li><a href="produkte.php">Produkte</a></li>
						<li><a href="backen.php">Backen</a></li>
						<li><a href="bestand.php">Bestandteil</a></li>	
						<li><a href="session_logout.php">Logout</a></li>			
				   </ul>
		   		<?php endif; ?>
		<?php endif; ?>

<br></br>
<?php if ($data['accesslevel'] == 9 || $data['accesslevel'] == 3): ?>
<!-- DIESER TEIL SOLLTE NUR FÜR MITARBEITER SICHTBAR SEIN -->
<div>
	<form id='searchform' action='einkauf.php' method='post'>
	<table>
	  Kunden E-Mail eingeben: 
	  <input id='searchMail' name='searchMail' type='text' size='15' value='<?php if (isset($_POST['searchMail'])) echo $_POST['searchMail']; ?>' />
	  <br> <br>
	  Bestellnumer eingeben:
	  <input id='searchNr' name='searchNr' type='text' size='15' value='<?php if (isset($_POST['searchNr'])) echo $_POST['searchNr']; ?>' />	  
	  <br> <br>
	  <input id='submit' type='submit' class="button" value='Suche Einkauf' />
	</form>
</div>
<!-- /DIESER TEIL SOLLTE NUR FÜR MITARBEITER SICHTBAR SEIN -->
 <?php endif; ?>
<?php
  $sucheEinkauf = false;
  // check if search view of list view
  if (isset($_POST['searchMail']) && isset($_POST['searchNr'])) {
	  $sucheEinkauf = true;
	  $sqlSelect = "SELECT * FROM einkauf WHERE email like '%" . $_POST['searchMail'] . "%' AND bestellnr like '%" . $_POST['searchNr'] . "%'";
  } else if (isset($_POST['searchMail']) && !isset($_POST['searchNr'])) {
	$sucheEinkauf = true;
    $sqlSelect = "SELECT * FROM einkauf WHERE email like '%" . $_POST['searchMail'] . "%'";
  } else if (isset($_POST['searchNr']) && !isset($_POST['searchMail'])){
	$sucheEinkauf = true;
	$sqlSelect = "SELECT * FROM einkauf WHERE bestellnr like '%" . $_POST['searchNr'] . "%'";
  } else {
    $sqlSelect = "SELECT * FROM einkauf";
  }
?>

<div id="wrapper">
<center>
<table style='border: 5px solid #DDDDDD'>
    <form id='searchform' action='einkauf.php' method='post'>
	  <br>
	  <thead>
	    <tr>
			<?php
			if ((isset($_POST['searchMail']) && $_POST['searchMail'] != null) || (isset($_POST['searchNr']) && $_POST['searchNr'] != null)) {
				echo "<th>E-Mail des Kunden</th>";
				echo "<th>Artikelnummer</th>";
				echo "<th>Herstellungsdatum</th>";
				echo "<th>Menge</th>";
				echo "<th>Bestellnummer</th>";
			}
			?>
	    </tr>
	  </thead>
	  <tbody>
		<tr>
			<?php
			  if ((isset($_POST['searchMail']) && $_POST['searchMail'] != null) || (isset($_POST['searchNr']) && $_POST['searchNr'] != null)){
				$result = $db->query($sqlSelect);
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
					echo "<tr>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td>" . $row['artikelnr'] . "</td>";
					echo "<td>" . $row['bhersdatum'] . "</td>";
					echo "<td>" . $row['menge'] . "</td>";
					echo "<td>" . $row['bestellnr'] . "</td>";
					echo "</tr>";
				}
			  }
			?>
		</tr>
	  </tbody>
	</form>
  </div>
</table>
</center>
<br>

<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
?>
    
<?php
    //Die Bestellung annehmen
	//HIER WIRD PRIMARY KEY (E-MAIL) DES KUNDEN ALS PARAMETER FÜR DEN KONSTRUKTOR ANGEGEBEN!!!
    $order = new Warenkorb($data['email']);
    $artikelNr = 100000;
    $ware = new Artikel();
    $gesamtPreis = 0;
    $num = 0;
    //angekommene Informationen über die Bestellung werden in Objekte zusammengefasst und zu POST Variablen zugewiesen
    for ($i = 0; isset($_POST["artikelnr" . strval($artikelNr)]); $i++){
        if (isset($_POST[strval($i)]) && $_POST[strval($i)] >= 1){
          if (isset($_POST['bhaltdauer' . strval($artikelNr)])){
            $ware = Artikel::constructFull($_POST["artikelnr" . strval($artikelNr)], $_POST["bhersdatum" . strval($artikelNr)], $_POST["gname" . strval($artikelNr)], $ware->mengeToNumber($_POST["preis" . strval($artikelNr)]), $_POST["bhaltdauer" . strval($artikelNr)], $ware->mengeToNumber($_POST["lagermenge" . strval($artikelNr)])); 
            if ($ware->getLagerMenge() >= $_POST[strval($i)])
                $ware->setBestellMenge($_POST[strval($i)]);
            else
                $ware->setBestellMenge($ware->getLagerMenge());
            $gesamtPreis = $gesamtPreis + ($ware->getPreis() * $ware->getBestellMenge());
          } else {
            $ware = Artikel::construct2($_POST["artikelnr" . strval($artikelNr)], $_POST["bhersdatum" . strval($artikelNr)], $_POST["gname" . strval($artikelNr)], $ware->mengeToNumber($_POST["preis" . strval($artikelNr)]), $ware->mengeToNumber($_POST["lagermenge" . strval($artikelNr)]));
            if ($ware->getLagerMenge() >= $_POST[strval($i)])
              $ware->setBestellMenge($_POST[strval($i)]);
            else
              $ware->setBestellMenge ($ware->getLagerMenge ());			
            $gesamtPreis = $gesamtPreis + ($ware->getPreis() * $ware->getBestellMenge());
          }
          $order->setWare($ware);
          $num++;
        }
        $artikelNr++;
    }
?>
<div>

    <p><?php 
	if ($sucheEinkauf == false) {
		echo "Kunden ID: " . $order->getEmail();
	}
	   ?>
	</p>
	
    <p> <?php 
		//setzt die Bestellnummer und inkrementiert sie in der Datenbank für die nächste Bestellung
		if ($gesamtPreis > 0) {
			$sql = "SELECT * FROM bestellnummerzaehler";
			$list = $db->query($sql);
			while($row = $list->fetch(PDO::FETCH_ASSOC)){
				$order->setBestellNr($row['nr']);
			}
			$sql = "UPDATE bestellnummerzaehler set nr=nr+1 where nr=" . $order->getBestellnummer();
			$db->exec($sql);    
			echo "Meine Bestellnummer: " . $order->getBestellnummer();
		}
		?></p>
  <form id='insertform' action='confirm.php' method='post'>
<center>
    <?php if ($sucheEinkauf == false) echo "Warenkorb:"; ?>
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
		<?php
			if ($sucheEinkauf == false) {
	          echo "<th>ArtikelNr</th>";
              echo "<th>Bezeichnung</th>";
              echo "<th>Herstellungsdatum</th>";
              echo "<th>Preis (inkl. UST)</th>";
              echo "<th>Menge</th>";
			}
		?>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
                <?php
					if ($sucheEinkauf == false){
						$bestellung = $order->getWaren();
						for ($i = 0; isset($bestellung[$i]); $i++){
							echo "<tr>";
							echo "<td>" . $bestellung[$i]->getArtikelNr() . "</td>";
							echo "<td>" . $bestellung[$i]->getGName() . "</td>";
							echo "<td>" . $bestellung[$i]->getBhersDatum() . "</td>";
							echo "<td>" . $bestellung[$i]->getPreis() . "</td>";
							echo "<td>" . $bestellung[$i]->getBestellMenge() . "</td>";
							echo "</tr>";
						}
					}
                ?>
	      </tr>
              
           </tbody>
           
        </table>
    <br>
    <?php
	  if ($sucheEinkauf == false){
        $ust = $order->getUst($gesamtPreis);
        $netto = $gesamtPreis - $ust;
        echo "<tr>";
        echo "Preis exkl. Umsatzsteuer: " . $netto . " €  <br>";
        echo "10 % Ust: " . $ust . " € <br>";
        echo "Rechnungsbetrag inkl. Ust: " . $gesamtPreis . " € <br>";
        echo "</tr>";
	  }
    ?>

</center>
<center>
      <br>
      <div> <?php if ($sucheEinkauf == false) echo $num . " Artikel im Warenkorb"; ?></div>
      <br>
      <input id ="gesamtpreis" name="gesamtpreis" type="hidden" value="<?php echo $gesamtPreis ?>" /> 
      <input id="email" name="email" type="hidden" value="<?php echo $order->getEmail() ?>" />
      <input id="bestellnummer" name="bestellnummer" type="hidden" value="<?php echo $order->getBestellnummer() ?>" />
        <?php
        //Informationen für einen Einkauf werden mit Http-Post für die Speicherung bereitgestellt
        if ($gesamtPreis > 0 && $sucheEinkauf == false){
            $a = 0;
            for ($gr = 0; isset($bestellung[$gr]); $gr++){
                echo "<input id='" . strval($a) ."' name='" . strval($a) . "' type='hidden' value='" . $bestellung[$gr]->getArtikelNr() . "' />";
                $a++;
                echo "<input id='" . strval($a) ."' name='" . strval($a) . "' type='hidden' value='" . $bestellung[$gr]->getBhersDatum() . "' />";
                $a++;
                echo "<input id='" . strval($a) ."' name='" . strval($a) . "' type='hidden' value='" . $bestellung[$gr]->getBestellMenge() . "' />";
                $a++;
            }
            echo "<input id='submit' type='submit' class='testbutton' value='Bestellung bestätigen' />";
        }
        else
            if ($sucheEinkauf == false) echo "Keine Bestellung angegeben. ";
		unset($db);
        ?>
  </form>
</div>
    </tbody>
</center>
<br></br>

</div>
</body>
</html>
