<?php
require 'vendor/autoload.php';
include('session.php');
$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
$client = new MongoDB\Client($uri);
$collection = $client->backshop->users;
$user_check = $_SESSION['login_user'];
$logedinuser = $login_session;
$cursor = $collection->find(['email' => $user_check]);
foreach ($cursor as $document) {
	if (isset($logedinuser)) {
		//Admin
		if ($document['accesslevel'] == 9 || $document['accesslevel'] == 3) {
		} else {
			echo "Sie haben kein Zugriff auf diese Seite";
			header('Location: baeckerei.php');
		};
	} else {
		echo "Unzeireichende User Berechtigung";
	}
}
$collectionputzplan = $client->backshop->putzplan;
$documentputzplan = $collectionputzplan->findOne(['personalnr' => $_GET['personalnr']]);

if (isset($_POST) & !empty($_POST)) {
	$id = $documentputzplan['_id'];
	$putzplan = array (
			'personalnr' => $_GET['personalnr'],
			'kuecheNr' => $_POST['kuecheNr'],
			'putzdatum' => $_POST['putzdatum'],
	);
	
	//updating the 'users' table/collection
	$collectionputzplan->updateOne(
	array('personalnr' =>intval( $_GET['personalnr'])),
	array('$set' => $putzplan)
	);
	
	//redirectig to the display page. In our case, it is index.php
	header("Location: putzplan.php");
}
?>

<!DOCTYPE html>
<html>
<title>Lecker: Putzplan</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

    <?php if ($document['accesslevel'] == 9): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="mitarbeiter.php">Mitarbeiter</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
            <li><a href="kunde.php">Kunde</a></li>
            <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a class="active" href="putzplan.php">Putzplan</a><li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a class="active" href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>


<div id="wrapper">
    <center><h2>Putzplan Update</h2>

        <div style="width: 500px; margin: 20px auto;">
            <table width="100%" cellpadding="5" cellspacing="1" border="1">
                <form action="" method="post">
<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
<div class="form-group">        
                    <input type="hidden" name="personalnr" value="<?php echo $personalnr; ?>">
                    <tr>
                        <td>Personal Nr</td>
                        <td><input name="personalnr" type="integer" value="<?php echo $data['personalnr']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Kuechen Nr</td>
                        <td><input name="kuecheNr" type="intger" value="<?php echo $data['kuecheNr']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Putz-Datum</td>
                        <td><input name="putzdatum" type="date" value="<?php echo $data['putzdatum']; ?>"></td>
                    </tr>
                        <td><a href="putzplan.php">Back</a></td>
                        <td><input name="submit_data" class="testbutton" type="submit" value="Update"></td>
                    </tr>
                </form>
            </table>
        </div>
</body>
</html>
