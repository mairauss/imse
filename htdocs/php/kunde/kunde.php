<?php
 try{
	require_once('../dbconnection.php');
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
<title>Lecker: Kunden</title>
<head>
 <link rel="stylesheet" href="../index.css" />
</head>
<body>
<img src="../b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a href="../baeckerei.php">Lecker</a></li>
		<li><a href="../mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="../konditor.php">Konditor</a></li>
		<li><a href="../kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a class="active" href="kunde.php">Kunde</a></li>
                <li><a href="../backwaren.php">Backwaren</a></li>
                <li><a href="../produkte.php">Produkte</a></li>
		<li><a href="../backen.php">Backen</a></li>
     		<li><a href="../einkauf.php">Einkauf</a></li>
		<li><a href="../bestand.php">Bestandteil</a></li>	
		<li><a href="../view.php">Views</a></li>	
		<li><a href="../session/logout.php">Logout</a></li>	
       </ul>

<br></br>


<div class="container">
<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='kunde.php' method='get'>
      <a href='kunde.php'>Alle Kunden</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
  

	  <table boarder="1">
		<?php
		  if (isset($_GET['search'])) {
			$sql = "SELECT * FROM kunde WHERE kname like '" . $_GET['search'] . "'";
		  } else {
			$sql = "SELECT * FROM kunde";
		  }
		  // execute sql statement
			$result = $db->query($sql);
		?>
		
		<tr>
			<th>E-mail</th>
			<th>Name</th>
			<th>Geburtstag</th>
			<th>Bname</th>
			<th>Passwort</th>
			<th>EXTRAS</th>
		</tr>
		
		<?php 
			while($r = $result->fetch(PDO::FETCH_ASSOC)){
			?>
			<tr>
				<td><?php echo $r['email']; ?></td>
				<td><?php echo $r['kname']; ?></td>
				<td><?php echo $r['kgeburtsdatum']; ?></td>
				<td><?php echo $r['bname']; ?></td>
				<td><?php echo $r['passwort']; ?></td>
				<td><a href="#">Edit</a> <a href="#">Delete</a></td>
			</tr>
		<?php } ?>
      </table>
	  
	  
	  
	  
</body>
</html>
