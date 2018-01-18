<?php
//Quellen: https://github.com/mongolab/mongodb-driver-examples/blob/master/php/php_simple_example.php
// This path should point to Composer's autoloader
require 'vendor/autoload.php';

$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['passwort'])) {
        $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
    } else {
		// Initializing $email and $passwort
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
		//MongoDB Connection
 		$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$result = $collection->find( [ 'email' => $email] );
		 foreach ($result as $entry) {
			if ($entry['email']) {
				if ($entry['email'] == $email && $entry['passwort'] == $passwort) {
					// Session starten
					$_SESSION['login_user'] = $email;
					// Zur Startseite weiterleiten
					header("location: index.php");
				}
			} else {
				$error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
        $db = null;
		//echo $entry['passwort'], ': ', $entry['name'], "\n";
		}
	}
	
	if (isset($_SESSION['login_user'])) {
		header("location: baeckerei.php");
	}	
}




/*
session_start();
// Variable To Store Error Message
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['passwort'])) {
        $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
    } else {
        // Initializing $email and $passwort
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        // Datenbankverbindung herstellen
		$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$result = $collection->find( [ 'email' => $email] );
		
        if (1) {
            if ($result['email'] == $email && $result['passwort'] == $passwort) {
                // Session starten
                $_SESSION['login_user'] = $email;
                // Zur Startseite weiterleiten
                header("location: index.php");
            }
        } else {
            $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
        $db = null;
    }
}



*/

?>
<!DOCTYPE html>
<html>
<title>Lecker: Kunden</title>
<head>
    <link rel="stylesheet" href="index.css"/>
    <style>
        #login {
            text-align: center;
        }

        #main {
            text-align: center;
        }
    </style>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<div id="main">
    <h2 style="color:rgb(150, 29, 29)">Herzlich Willkommen in der Bäckerei "Lecker"!</h2>


    <h1>Login Lecker</h1>
    <div id="login">
        <h2>Login Form</h2>
        <form action="" method="post">
            <label>E-Mail :</label>
            <input id="name" name="email" placeholder="e-mail adresse" type="text">
            <label>Passwort :</label>
            <input id="passwort" name="passwort" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span></span>
        </form>
    </div>

    <br></br>

</div>
</body>
</html>