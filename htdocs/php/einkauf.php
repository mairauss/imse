
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
		<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a href="kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
           	<li><a href="backen.php">Backen</a></li>
     		<li><a class="active" href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
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
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sqlSelect = "SELECT * FROM einkauf WHERE kname like '%" . $_GET['search'] . "%'";
  } else {
    $sqlSelect = "SELECT * FROM einkauf";
  }
?>
    
<div>
  <p>Kundennummer</p>
  <p>Meine Bestellnummer</p>
  <form id='insertform' action='einkauf.php' method='get'>
<center>
    Mein Warenkorb:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	      <th>ArtikelNr</th>
              <th>Herstellungsdatum</th>
              <th>Preis</th>
              <th>Menge</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
	        <td>
	           <input id='artikelnr' name='artikelnr' type='text' size='50' value='<?php if (isset($_GET['artikelnr'])) echo $_GET['artikelnr']; ?>' />
                </td>
                <td>
                   <input id='bersdatum' name='bhersdatum' type='text' size='15' value='<?php if (isset($_GET['bhersdatum'])) echo $_GET['bhersdatum']; ?>' />
                </td>
                <td>
                    <input id='bpreis' name='bpreis' type='text' size='15' value='<?php if (isset($_GET['bpreis'])) echo $_GET['bpreis']; ?>' />
                </td>
                <td>
                    <input id='menge' name='menge' type='text' size='15' value='<?php if (isset($_GET['menge'])) echo $_GET['menge']; ?>' />
                </td>
	      </tr>
           </tbody>
        </table>
</center>
        <input id='submit' type='submit' class="testbutton" value='Insert' />
  </form>
</div>

<?php
  //Handle insert
   if (isset($_GET['kname'])) 
  {
    //Prepare insert statement
    $sqlInsert = "INSERT INTO einkauf VALUES('" . $_GET['kname'] . "',"  . $_GET['artikelnr'] . ")";
    //Parse and execute statement
    $insert = new SQLite3('backshop.db');
    $result = $insert->exec($sqlInsert);
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

 <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Kunden Name</th>
        <th>ArtikelNr</th>
      </tr>
    </thead>
    <tbody>
<?php
  $num = 0;
  // execute sql statement
  $stmt = new SQLite3('backshop.db');
  $list = $stmt ->query($sqlSelect);
  $stmt->close();
  unset($stmt);
  // fetch rows of the executed sql query
  while ($row = $list->fetchArray()) {
    echo "<tr>";
    echo "<td>" . $row['KNAME'] . "</td>";
    echo "<td>" . $row['ARTIKELNR'] . "</td>";
    echo "</tr>";
    $num++;
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo $num; ?> "Artikel" gefunden!</div>
</center>
<br></br>

</div>
</body>
</html>
