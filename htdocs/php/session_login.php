<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
*/
// Starting Session for User Restriction
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
	$sql = "select * from kunde where passwort='$passwort' AND email='$email'";
	$rows = count($sql);
	//$result = $db->query($sql);
	if ($rows == 1) {
		// Session starten
		$_SESSION['login_user']=$email;
		// Zur Startseite weiterleiten
		header("location: backwaren.php");
	} else {
		$error = "E-Mail Adresse oder Passwort sind fehlerhaft";
	}
	$db=null;
	}
}
?>