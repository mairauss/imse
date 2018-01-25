<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
http://www.genecasanova.com/labs/memberships/form-sessions-php.html
*/
// Starting Session for User Restriction
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
        // MongoDB Abfrage
		$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$cursor = $collection->find(['email' => $_POST['email']]);
        
		foreach ($cursor as $document) {
            if ($document['email'] == $email && $document['passwort'] == $passwort) {
                // Session starten
                $_SESSION['login_user'] = $email;
                // Zur Startseite weiterleiten
                header("location: index.php");
            } else {
            $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
        }
		}
    }
}
?>