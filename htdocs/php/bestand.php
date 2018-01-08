
<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    ?>

<html>
<title>Lecker: Bestandteil</title>
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
<li><a href="produkte.php">Produkte</a></li>
<li><a href="backwaren.php">Unsere Backwaren</a></li>
<li><a href="einkauf.php">Warenkorb</a></li>
<li><a href="backen.php">Backen</a></li>
<li><a class="active" href="bestand.php">Bestandteil</a></li>
<li><a href="session_logout.php">Logout</a></li>
</ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a href="bestand_save.php">Speichern</a></li>
</ul>
</div>
<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='bestand.php' method='get'>
      Geben Sie Backware Name ein:
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
</form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM bestandteil WHERE gname like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM bestandteil";
  }

  // execute sql statement
    $result = $db->query($sql);
?>

<tbody>

<?php
    if (isset($_GET['search'])) {
?>
        <thead>
        <tr>
        <h3>Produkte</h3>
        </tr>
        </thead>

<table style="width:50%">
<thead>
<tr>
<th>Barcode</th>
<th>Name</th>
<th>Menge</th>
<th>Maßeinheit</th>
</tr>
</thead>
<tbody>

<?php
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
<td><?php echo $r['barcode']; ?></td>
<td><?php echo $r['pname']; ?></td>
<td><?php echo $r['menge']; ?></td>
<td><?php echo $r['masseinheit']; ?></td>
<td><a href="bestand_update.php?bestandteilNr=<?php echo $r['bestandteilNr']; ?>">Mutieren</a>  <a href="bestand_delete.php?bestandteilNr=<?php echo $r['bestandteilNr']; ?>">Delete</a></td>
</tr>
<?php }}
   // else echo "Es gibt keine Infos!";
?>
</tbody>
</table>
</center>
<br></br>
</div>
</body>
</html>
