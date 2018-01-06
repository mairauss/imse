<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM konditor";
    $result = $db->query($sql);
    
    ?>

<!DOCTYPE html><html>
<title>Lecker: Kuechengehilfen</title>
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
		<li><a class="active" href="kuechengehilfe.php">Kuechengehilfe</a></li>
        <li><a href="kunde/kunde.php">Kunde</a></li>
        <li><a href="backwaren.php">Backwaren</a></li>
        <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
        <li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
		<li><a href="./session/logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='kuechengehilfe.php' method='get'>
      <a href='kuechengehilfe.php'>Alle Kuechengehilfe(n)</a> ---
      Suche nach Personal Nr.: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM kuechengehilfe WHERE personalnr like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM kuechengehilfe";
  }

  // execute sql statement
    $result = $db->query($sql);
?>
<br></br>

<table style="width:70%">
    <thead>
      <tr>
          <th>Name</th>
 	      <th>Betriebsmodus</th>
          <th>E-mail</th>
	      <th>Kueche Nr.</th>
      </tr>
    </thead>
    <tbody>
<?php
    // fetch rows of the executed sql query
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
<tr>
<td><?php echo $r['personalnr']; ?></td>
<td><?php echo $r['betriebsmodus']; ?></td>
<td><?php echo $r['email']; ?></td>
<td><?php echo $r['kuecheNr']; ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
