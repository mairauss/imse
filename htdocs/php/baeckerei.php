<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM baeckerei";
    $result = $db->query($sql);
    
    ?>


<!DOCTYPE html>
<html>
<title>Lecker</title>
<head>
 <link rel="stylesheet" href="index.css" />
<style>
td{
    text-align: center;
}
</style>
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
		<li><a href="./session/logout.php">Logout</a></li>			
       </ul>

<br></br>

<div id="wrapper">
<center>
 
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM baeckerei";
  

  // execute sql statement
    $result= $db->query($sql);

?>
  <h1>Baeckerei</h1>
<table style="width:70%">
    <thead>
      <tr>
        <th>Baeckerei</th>
        <th>FirmaNr</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      ?>
<tr>
    <td><?php echo $r['bname']; ?></td>
    <td><?php echo  $r['firmanr']; ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>

<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM anschrift";
  

  // execute sql statement
    $result= $db->query($sql);

?>

<table style="width:70%">
    <thead>
      <tr>
        <th>Adresse</th>
      </tr>
    </thead>
    <tbody>
<?php
    // fetch rows of the executed sql query
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
<tr>
<td><?php echo $r['bezeichnung']; ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>


<h1>Kueche</h1>
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM kueche";
  

  // execute sql statement
    $result= $db->query($sql);
?>

<table style="width:70%">
    <thead>
      <tr>
        <th>Kueche Nr.</th>
        <th>Grundflaeche</th>
        <th>Kuehlraum Nr.</th>
      </tr>
    </thead>
    <tbody>
<?php
    // fetch rows of the executed sql query
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
<tr>
<td><?php echo $r['kuecheNr']; ?></td>
<td><?php echo  $r['grundflaeche']; ?></td>
<td><?php echo  $r['kuehlraumNr']; ?></td>
</tr>
<?php } ?>

    </tbody>
  </table>

<h1>Kuehlraum</h1>
<?php
  // check if search view of list view
  
    $sql = "SELECT * FROM kuehlraum";
  

  // execute sql statement
    $result= $db->query($sql);

?>

<table style="width:70%">
    <thead>
      <tr>
        <th>Kuehlraum Nr.</th>
        <th>Temp.</th>
        <th>Grundflaeche</th>
    </tr>
    </thead>
    <tbody>
<?php
    // fetch rows of the executed sql query
    while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
<tr>
<td><?php echo $r['kuehlraumNr']; ?></td>
<td><?php echo  $r['temp']; ?></td>
<td><?php echo  $r['grundflaeche']; ?></td>
</tr>
<?php } ?>

    </tbody>
  </table>

</center>
<br></br>
</div>
</body>
</html>
