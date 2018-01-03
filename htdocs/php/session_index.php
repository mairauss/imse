<?php
/*
Quellen: 
https://www.formget.com/login-form-in-php/
*/
include('kunde_login.php');

if(isset($_SESSION['login_user'])){
header("location: backwaren.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Lecker</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1>Login Lecker</h1>
<div id="login">
<h2>Login Form</h2>
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
</body>
</html>