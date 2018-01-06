
//<?php
//  $user = '';
//  $pass = '';
//  $database = '';
 
  // establish database connection
//  $conn = oci_connect($user, $pass, $database);
//  if (!$conn) exit;

 //var_dump($_GET);
//?>

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
        <li><a href="backwaren.php">Backwaren</a></li>
     	<li><a class="active" href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
        <li><a href="session_logout.php">Logout</a></li>
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='einkauf.php' method='get'>
      <a href='einkauf.php'>Alles</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
</form>
  </div>

<?php
    require_once 'Artikel.php';
    require_once 'Warenkorb.php';
?>
    
<?php
    //Die Bestellung annehmen
    $order = new Warenkorb('onur@mail.com');
    $artikelNr = 1000;
    $ware = new Artikel();
    $gesamtPreis = 0;
    $num = 0;
    //angekommene Informationen über die Bestellung werden in Objekte zusammengefasst
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
          $gesamtPreis = $gesamtPreis + $_POST[strval($i)];
          $order->setWare($ware);
          $num++;
        }
        $artikelNr++;
        
    }

    
    /*$bestellung = $order->getWaren();
    for ($i = 0; isset($bestellung[$i]); $i++){
        echo $bestellung[$i]->getArtikelNr() . " " . $bestellung[$i]->getBestellMenge() . "</br>";
    }*/
?>
    
    
    
   <form id='searchform' action='einkauf.php' method='post'>
<?php
  // check if search view of list view
  if (isset($_POST['search'])) {
    $sqlSelect = "SELECT * FROM einkauf WHERE kname like '%" . $_POST['search'] . "%'";
  } else {
    $sqlSelect = "SELECT * FROM einkauf";
  }
?>
   </form>
<div>

    <p>Kunden ID: <?php echo $order->getEmail(); ?></p>
    <p> <?php if ($gesamtPreis > 0) {$order->setBestellNr(); echo "Meine Bestellnummer: " . $order->getBestellnummer();} ?></p>
  <form id='insertform' action='confirm.php' method='post'>
<center>
    Warenkorb:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	      <th>ArtikelNr</th>
              <th>Bezeichnung</th>
              <th>Herstellungsdatum</th>
              <th>Preis (inkl. UST)</th>
              <th>Menge</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
                <?php
                    $bestellung = $order->getWaren();
                    for ($i = 0; isset($bestellung[$i]); $i++){
                        echo "<tr>";
                        echo "<td>" . $bestellung[$i]->getArtikelNr() . "</td>";
                        echo "<td>" . $bestellung[$i]->getGName() . "</td>";
                        echo "<td>" . $bestellung[$i]->getBhersDatum() . "</td>";
                        echo "<td>" . $bestellung[$i]->getPreis() . "</td>";
                        echo "<td>" . $bestellung[$i]->getBestellMenge() . "</td>";
                        echo "</tr>";
                        //$gesamtPreis = $gesamtPreis + ($bestellung[$i]->getPreis() * $bestellung[$i]->getBestellMenge());
                    }
                ?>
	      </tr>
              
           </tbody>
           
        </table>
    <br>
    <?php
        $ust = $order->getUst($gesamtPreis);
        $netto = $gesamtPreis - $ust;
        echo "<tr>";
        echo "Preis exkl. Umsatzsteuer: " . $netto . " €  <br>";
        echo "10 % Ust: " . $ust . " € <br>";
        echo "Rechnungsbetrag inkl. Ust: " . $gesamtPreis . " € <br>";
        echo "</tr>";
    ?>

</center>

      <br>
      <div> <?php echo $num; ?> Artikel im Warenkorb</div>
      <br>
      <input id ="gesamtpreis" name="gesamtpreis" type="hidden" value="<?php echo $gesamtPreis ?>" /> 
      <input id="email" name="email" type="hidden" value="<?php echo $order->getEmail() ?>" />
      <input id="bestellnummer" name="bestellnummer" type="hidden" value="<?php echo $order->getBestellnummer() ?>" />
        <?php
        //Informationen für einen Einkauf werden mit Http-Post für die Speicherung bereitgestellt
        if ($gesamtPreis > 0){
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
            echo "Keine Bestellung angegeben. ";
        ?>
  </form>
</div>
    </tbody>
</center>
<br></br>

</div>
</body>
</html>
