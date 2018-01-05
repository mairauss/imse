
<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
*/
// Datenbankverbindung herstellen
	 try{
		require_once('dbconnection.php');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(Exception $e){
		$error = $e->getMessage();
	}
// Start a Session
session_start();
// Storing the current Session
$user_check=$_SESSION['login_user'];

// SQL Select for all Registered Users
	$ses_sql = "select email from kunde where='$user_check'";
	$row = count($ses_sql);
	$login_session =$row['email'];
if(!isset($login_session)){
$db = null;
// Redirecting To Home Page
//header('Location: backwaren.php'); 
}
?>