
<?php
  $user = '';
  $pass = '';
  $database = '';
 
  // establish database connection
  $conn = oci_connect($user, $pass, $database);
  if (!$conn) exit;

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
                <li><a href="kunde/kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
           	<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a class="active" href="bestand.php">Bestandteil</a></li>
		<li><a href="./session/logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='bestand.php' method='get'>
      <a href='bestand.php'>Alles</a> ---
      Suche nach ArtikelNr: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
</form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM bestandteil WHERE artikelnr like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM bestandteil";
  }

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
 <div>

  <form id='insertform' action='bestand.php' method='get'>
<center>
    Neue "Bestandteile" einfuegen:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	       <th>ArtikelNr</th>
		<th>Barcode</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
	        <td>
                   <input id='artikelnr' name='artikelnr' type='number' size='15' value='<?php if (isset($_GET['artikelnr'])) echo $_GET['artikelnr']; ?>' />
                </td>
		<td>
	           <input id='barcode' name='barcode' type='number' size='15' value='<?php if (isset($_GET['barcode'])) echo $_GET['barcode']; ?>' />
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
   if (isset($_GET['artikelnr'])) 
  {


    //Prepare insert statementd
    $sql = "INSERT INTO bestandteil VALUES(" . $_GET['artikelnr'] . ","  . $_GET['barcode'] . ")";
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
        <th>ArtikelNr</th>
	<th>Barcode</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
      echo "<td>" . $row['ARTIKELNR'] . "</td>";
  	echo "<td>" . $row['BARCODE'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> "Bestandteile" gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>

<?php
oci_close($conn);
?>
</div>
</body>
</html>
