
<?php
  $user = '...';
  $pass = '...';
  $database = '...';
 
  // establish database connection
  $conn = oci_connect($user, $pass, $database);
  if (!$conn) exit;

 //var_dump($_GET);
?>

<html>
<title>Lecker: Produkte</title>
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
                <li><a class="active" href="produkte.php">Produkte</a></li>
            	<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='produkte.php' method='get'>
      <a href='produkte.php'>Alle Produkte</a> ---
      Suche nach Barcode: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM produkt WHERE barcode like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM produkt";
  }

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
<div>

  <form id='insertform' action='produkte.php' method='get'>
<center>
    Neue Produkt einfuegen:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	      <th>Barcode</th>
	      <th>Name</th>
  	      <th>Preis</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
	        <td>
	           <input id='barcode' name='barcode' type='number' size='10' value='<?php if (isset($_GET['barcode'])) echo $_GET['barcode']; ?>' />
                </td>
                <td>
                   <input id='pname' name='pname' type='text' size='30' value='<?php if (isset($_GET['pname'])) echo $_GET['pname']; ?>' />
                </td>
		<td>
                   <input id='ppreis' name='ppreis' type='number' size='10' value='<?php if (isset($_GET['ppreis'])) echo $_GET['ppreis']; ?>' />
                </td>
	      </tr>
           </tbody>

	<table style='border: 5px solid #DDDDDD'>
	<thead>
	    <tr>
           <th>Herstell.Datum</th>
	   <th>Haltbar.Dauer</th>
	   <th>Temp°</th>
	    </tr>
	  </thead>
		<tbody>
	        <tr>
         	<td>
                   <input id='phersdatum' name='phersdatum' type='text' size='10' value='<?php if (isset($_GET['phersdatum'])) echo $_GET['phersdatum']; ?>' />
                </td>
		<td>
                   <input id='phaltdauer' name='phaltdauer' type='text' size='10' value='<?php if (isset($_GET['phaltdauer'])) echo $_GET['phaltdauer']; ?>' />
                </td>
		<td>
                   <input id='temp' name='temp' type='text' size='5' value='<?php if (isset($_GET['temp'])) echo $_GET['temp']; ?>' />
                </td>

       	      </tr>
           </tbody>
 	</table>

        </table>
</center>
        <input id='submit' type='submit' class="testbutton" value='Insert' />
  </form>
</div>

<?php
  //Handle insert
   if (isset($_GET['barcode'])) 
  {


    //Prepare insert statementd
    $sql = "INSERT INTO produkt VALUES(" . $_GET['barcode'] . ",'"  . $_GET['pname'] . "'," . $_GET['ppreis'] .
 ",to_date('" . $_GET['phersdatum'] . "','yyyymmdd')  , to_date('" . $_GET['phaltdauer'] . "','yyyymmdd')," . $_GET['temp'] . ")";
    //Parse and execute statement
    $insert = oci_parse($conn, $sql);
    oci_execute($insert);


    $conn_err=oci_error($conn);
    $insert_err=oci_error($insert);
   
    if(!$conn_err & !$insert_err){
	print("Successfully inserted");
 	print("<br>");
    }
    //Print potential errors and warnings
    else{
       print($conn_err);
       print_r($insert_err);

    }
    oci_free_statement($insert);
  } 

?>


  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Barcode</th>
        <th>Name</th>
	<th>Preis</th>
	<th>Herstell.Datum</th>
	<th>Haltbar.Dauer</th>
	<th>Temp°</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BARCODE'] . "</td>";
    echo "<td>" . $row['PNAME'] . "</td>";
    echo "<td>" . $row['PPREIS'] . "</td>";
    echo "<td>" . $row['PHERSDATUM'] . "</td>";
    echo "<td>" . $row['PHALTDAUER'] . "</td>";
    echo "<td>" . $row['TEMP'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Produkt(e) gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>



<?php
oci_close($conn);
?>
</div>
</body>
</html>
