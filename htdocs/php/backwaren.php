
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
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='backwaren.php' method='get'>
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
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

  

<div>

  <form id='insertform' action='backwaren.php' method='get'>
<center>
    Neue Backwaren einfuegen:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	      <th>ArtikelNr</th>
	      <th>Name</th>
  	      <th>Preis</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
	        <td>
	           <input id='artikelnr' name='artikelnr' type='number' size='10' value='<?php if (isset($_GET['artikelnr'])) echo $_GET['artikelnr']; ?>' />
                </td>
                <td>
                   <input id='gname' name='gname' type='text' size='30' value='<?php if (isset($_GET['gname'])) echo $_GET['gname']; ?>' />
                </td>
		<td>
                   <input id='bpreis' name='bpreis' type='number' size='10' value='<?php if (isset($_GET['bpreis'])) echo $_GET['bpreis']; ?>' />
                </td>
	      </tr>
           </tbody>

	<table style='border: 5px solid #DDDDDD'>
	<thead>
	    <tr>
           <th>Herstell.Datum</th>
	   <th>Haltbar.Dauer</th>
	    </tr>
	  </thead>
		<tbody>
	        <tr>
         	<td>
                   <input id='bhersdatum' name='bhersdatum' type='text' size='10' value='<?php if (isset($_GET['bhersdatum'])) echo $_GET['bhersdatum']; ?>' />
                </td>
		<td>
                   <input id='bhaltdauer' name='bhaltdauer' type='text' size='10' value='<?php if (isset($_GET['bhaltdauer'])) echo $_GET['bhaltdauer']; ?>' />
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
   if (isset($_GET['artikelnr'])) 
  {


    //Prepare insert statementd
    $sql = "INSERT INTO backwaren VALUES(" . $_GET['artikelnr'] . ",'"  . $_GET['gname'] . "'," . $_GET['bpreis'] .
 ",to_date('" . $_GET['bhersdatum'] . "','yyyymmdd')  , to_date('" . $_GET['bhaltdauer'] . "','yyyymmdd') )";
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
        <th>Name</th>
	<th>Preis</th>
	<th>Herstell.Datum</th>
	<th>Haltbar.Dauer</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['ARTIKELNR'] . "</td>";
    echo "<td>" . $row['GNAME'] . "</td>";
    echo "<td>" . $row['BPREIS'] . "</td>";
    echo "<td>" . $row['BHERSDATUM'] . "</td>";
    echo "<td>" . $row['BHALTDAUER'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Backwaren gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>

<?php
oci_close($conn);
?>
</div>
</body>
</html>
