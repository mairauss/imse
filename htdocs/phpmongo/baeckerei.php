<?php
include('session.php');
require 'vendor/autoload.php';
$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
$client = new MongoDB\Client($uri);
$collection = $client->backshop->users;
$user_check = $_SESSION['login_user'];
/*
$cursor = $collection->find(['email' => $user_check);
echo "vor if";
$logedinuser = $login_session;
if (isset($logedinuser)) {
	echo "erstes if";
    //Administrator Rechte
	foreach ($cursor as $document) {
		if ($document['accesslevel'] == 9 || $document['accesslevel'] == 1 || $document['accesslevel'] == 2 || $document['accesslevel'] == 3) {
			echo "2 if";
		} else {
			echo "Sie haben kein Zugriff auf diese Seite";
			header('Location: kunde.php');
		};

	}
} else {
echo "Unzeireichende User Berechtigung";
}
*/
?>


<!DOCTYPE html>
<html>
<title>Lecker</title>
<head>
    <link rel="stylesheet" href="index.css"/>
    <style>
        td {
            text-align: center;
        }

        #login {
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
        <li><a href="backwaren.php">Unsere Backwaren</a></li>
        <li><a href="einkauf.php">Warenkorb</a></li>
        <li><a href="bestand.php">Bestandteil</a></li>
        <li><a href="session_logout.php">Logout</a></li>
    </ul>


</body>
</html>
