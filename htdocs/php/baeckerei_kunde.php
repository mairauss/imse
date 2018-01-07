<?php
    session_start(); 
// Variable To Store Error Message
$error=''; 
	if(!isset($logedinuser)){
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
		<li><a class="active" href="baeckerei_kunde.php">Lecker</a></li>
        <li><a href="backwaren.php">Backwaren</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>
        <li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="session_logout.php">Logout</a></li>			
       </ul>

<br></br>
<center>
<h2 style="color:rgb(150, 29, 29)">Herzlich Willkommen in der Bäckerei "Lecker"!</h2>
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
</center>

<br></br>
</div>
</body>
</html>
