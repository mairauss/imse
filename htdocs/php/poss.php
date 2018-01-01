
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
<title>Lecker: Possessionem</title>
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
		<li><a class="active" href="poss.php">Possessionem</a></li>
		<li><a href="view.php">Views</a></li>	
		<li><a href="./session/logout.php">Logout</a></li>	
       </ul>

<br></br>

 
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM poss";
  

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

<div id="wrapper">
<center>
 <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Baeckerei</th>
        <th>Mitarbeiter</th>
        <th>Kunden</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['BNAME'] . "</td>";
    echo "<td>" . $row['MNAME'] . "</td>";
    echo "<td>" . $row['KNAME'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> "Possessionem" gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>

<?php
oci_close($conn);
?>
</div>
</body>
</html>
