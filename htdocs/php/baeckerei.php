
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
<title>Lecker</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a class="active" href="baeckerei.php">Lecker</a></li>
		<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a href="kunde/kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
                <li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>
		<li><a href="../session/logout.php">Logout</a></li>			
       </ul>

<br></br>

<div id="wrapper">
<center>
 
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM baeckerei";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
  <h1>Baeckerei</h1>
  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Baeckerei</th>
        <th>FirmaNr</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BNAME'] . "</td>";
    echo "<td>" . $row['FIRMANR'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM anschrift";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Anschrift</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BEZEICHNUNG'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>


<h1>Kueche</h1>
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM kueche";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Ausstattung</th>
        <th>Grundflaeche</th>
        <th>Temp.</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['AUSSTATTUNG'] . "</td>";
    echo "<td>" . $row['GRUNDFLAECHE'] . "</td>";
    echo "<td>" . $row['TEMP'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<h1>Kuehlraum</h1>
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM kuehlraum";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Temp.</th>
        <th>Grundflaeche</th>
        <th>Regelung </th>
	<th>Ausstattung</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['TEMP'] . "</td>";
    echo "<td>" . $row['GRUNDFLAECHE'] . "</td>";
    echo "<td>" . $row['REGELUNG'] . "</td>";
    echo "<td>" . $row['AUSSTATTUNG'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

</center>
<br></br>
<?php  oci_free_statement($stmt); ?>


<?php
oci_close($conn);
?>
</div>
</body>
</html>
