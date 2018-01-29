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
    //Administrator Rechte
    if ($document['accesslevel'] == 9 || $document['accesslevel'] == 3) {
        // echo "Access Level 9";
    } else {
        echo "Sie haben kein Zugriff auf diese Seite";
        header('Location: baeckerei.php');
    };
} else {
    echo "Unzeireichende User Berechtigung";
}
}

$collectionputzplan = $client->backshop->putzplan;

?>

<!DOCTYPE html><html>
<title>Lecker: Putzplan</title>
<head>
 <link rel="stylesheet" href="index.css" />
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
            <li><a class="active" href="produkte.php">Produkte</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a class="active" href="produkte.php">Produkte</a></li>
            <li><a href="backen.php">Backen</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a class="active" href="putzplan_save.php">Speichern</a></li>
</ul>
</div>

<div id="wrapper">
<center><h2>Putzplan Speichern</h2>

<div style="width: 500px; margin: 20px auto;">
<table width="100%" cellpadding="5" cellspacing="1" border="1">
<form action="" method="post">

<tr>
<td>PersonalNr</td>
<td><input type="integer" name="personalnr"  required class="form-control" id="input1" placeholder="PersonalNr" />
</td>
</tr>


<tr>
<td>KuecheNr</td>
<td><input type="integer" name="kuecheNr"  required class="form-control" id="input1" placeholder="KuecheNr" />
</td>
</tr>

<tr>
<td>Putzdatum</td>
<td><input type="date" name="putzdatum"  required class="form-control" id="input1" placeholder="Putzdatum" /> </td>
</tr>



<br></br>
<tr>
<td><a href="putzplan.php">Zurück</a></td>
<td><input type="submit" class="testbutton" value="Insert" name="submit" /></td>
</tr>

</form>
</div>
</center>

<?php
    if(isset($_POST["submit"])){

        $seedData = array(
                          'personalnr' => $_POST['personalnr'],
                          'kuecheNr' => $_POST['kuecheNr'],
                          'putzdatum' => $_POST['putzdatum'],
                          );
        $res = 	$collectionputzplan->insertOne($seedData);
        if ($res) {
            echo "Daten wurden erfolgreich gespeichert";
        } else {
            echo "Fehler aufgetreten";
        }
    }
    ?>
</body>
</html>
