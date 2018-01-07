
<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM kunde";
    $result = $db->query($sql);
    
    ?>

<!DOCTYPE html>
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
        <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
        <li><a class="active" href="produkte.php">Produkte</a></li>
        <li><a href="backen.php">Backen</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>
		<li><a href="session_logout.php">Logout</a></li>
       </ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a href="produkte_save.php">Speichern</a></li>
</ul>
</div>
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

<table boarder="1">
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM produkt WHERE barcode like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM produkt";
  }

  // execute sql statement
    $result = $db->query($sql);
?>
<br></br>

<table style="width:70%">
    <thead>
      <tr>
        <th>Barcode</th>
        <th>Name</th>
	    <th>Preis</th>
	    <th>Herstell.Datum</th>
	    <th>Haltbar.Dauer</th>
	    <th>Menge</th>
        <th>Kuehlraum Nr.</th>
      </tr>
    </thead>
    <tbody>

<?php
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
        ?>
<tr>
<td><?php echo $r['barcode']; ?></td>
<td><?php echo $r['pname']; ?></td>
<td><?php echo $r['ppreis']; ?></td>
<td><?php echo $r['phersdatum']; ?></td>
<td><?php echo $r['phaltdauer']; ?></td>
<td><?php echo $r['menge']; ?></td>
<td><?php echo $r['kuehlraumNr']; ?></td>
<td><a href="produkte_update.php?barcode=<?php echo $r['barcode']; ?>">Mutieren</a> <a href="produkte_delete.php?barcode=<?php echo $r['barcode']; ?>">Delete</a></td>
</tr>
<?php } ?>
    </tbody>
  </table>
</center>

<br></br>

</body>
</html>
