
<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
http://php.net/manual/en/sqlite3result.fetcharray.php
http://www.genecasanova.com/labs/memberships/form-sessions-php.html
https://stackoverflow.com/questions/28597617/convert-pdofetch-assoc-to-sqlite
http://php.net/manual/en/sqlite3result.fetcharray.php
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
	$ses_sql = "SELECT * FROM (SELECT email,passwort,accesslevel from kunde UNION select email,passwort,accesslevel from mitarbeiter) AS U where U.email= '$user_check'";
	//$row = fetchArray($ses_sql);
	$result = $db->query($ses_sql);

	$result_items = array();
	while($data = $result->fetch(PDO::FETCH_ASSOC)) {
		//print_r($data);
		if(!isset($data['email'])) continue;
		
			$login_session =$data['email'];

	}

	
	

	
if(!isset($login_session)){
  // Redirecting To Home Page
  header('Location: baeckerei.php'); 
}
?>