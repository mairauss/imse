
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
		<li><a href="baeckerei_kunde.php">Lecker</a></li>
        <li><a href="backwaren.php">Unsere Backwaren</a></li>
		<li><a class="active" href="bestand_kunde.php">Bestandteil</a></li>
        <li><a href="einkauf.php">Warenkorb</a></li>
		<li><a href="session_logout.php">Logout</a></li>
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='bestand_kunde.php' method='get'>
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

<br></br>
<tbody>

<?php
    if (isset($_GET['search'])) {
?>
        <table style="width:30%">
        <thead>
        <tr>
        <th>Produkte</th>
        </tr>
        </thead>

<?php
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
<td><?php echo $r['pname']; ?></td>
</tr>
<?php }}?>
</tbody>
</table>
</center>
<br></br>
</div>
</body>
</html>
