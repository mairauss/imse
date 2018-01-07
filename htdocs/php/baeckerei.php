<?php
    session_start(); 
// Variable To Store Error Message
$error=''; 
if (isset($_POST['submit'])) {
	if (empty($_POST['email']) || empty($_POST['passwort'])) {	
		$error = "E-Mail Adresse oder Passwort sind fehlerhaft";
} else {
	// Initializing $email and $passwort
	$email=$_POST['email'];
	$passwort=$_POST['passwort'];
	// Datenbankverbindung herstellen
	 try{
		require_once('dbconnection.php');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(Exception $e){
		$error = $e->getMessage();
	}
	// SQL Select for all Registered Users
	$sql = "SELECT * FROM (SELECT email,passwort from kunde UNION select email,passwort from mitarbeiter) AS U where u.passwort='$passwort' AND u.email='$email'";
	$result = $db->query($sql);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	if($data){
		if ($data['email'] == $email && $data['passwort'] == $passwort ) {
		// Session starten
		$_SESSION['login_user']=$email;
		// Zur Startseite weiterleiten
		header("location: backwaren.php");
		}
	} else {
		$error = "E-Mail Adresse oder Passwort sind fehlerhaft";
	}
	}
}
	
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
        <li><a href="kunde.php">Kunde</a></li>
        <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
        <li><a href="produkte.php">Produkte</a></li>
        <li><a href="backen.php">Backen</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="session_logout.php">Logout</a></li>			
       </ul>

<br></br>

		<div id="main">
			<h1>Login Lecker</h1>
			<div id="login">
				<form action="" method="post">
					<label>E-Mail :</label>
					<input id="name" name="email" placeholder="e-mail adresse" type="text">
					<label>Passwort :</label>
					<input id="passwort" name="passwort" placeholder="**********" type="password">
					<input name="submit" type="submit" value=" Login ">
					<span><?php echo $error; ?></span>
				</form>
			</div>
		</div>
		
		<div id="main">
			<h1>Register Lecker</h1>
			<div id="login">
				<form action="" method="post">
					<button type="button" onclick="href="kunde_register.php">Click Me!</button>
				</form>
			</div>
		</div>


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
