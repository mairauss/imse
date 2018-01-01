
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
<title>Lecker: Views</title>
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
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a class="active" href="view.php">Views</a></li>	
		<li><a href="./session/logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
<h1>Min.Gehalt aller Konditoren</h1>
  <?php
    $sql = "Select * From konditor_min_gehalt";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
  <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>PersonalNr</th>
        <th>Gehalt</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['PERSONALNR'] . "</td>";
    echo "<td>" . $row['GEHALT'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<h1>Durschnittspreis aller Backwaren</h1>
  <?php
    $sql = "Select * From priseAVG";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
  <table style='border: 5px solid #DDDDDD'>
        <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BPREIS'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<h1>Die Summe aller Backwaren</h1>
  <?php
    $sql = "Select * From priseSUM";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
  <table style='border: 5px solid #DDDDDD'>
        <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BPREIS'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<h1>Die Anzahl der Kunden</h1>
  <?php
    $sql = "Select * From kunde_count";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
  <table style='border: 5px solid #DDDDDD'>
        <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['KNAME'] . "</td>";
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
