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
    if ($document['accesslevel'] > 1) {
        // echo "Access Level 9";
    } else {
        echo "Sie haben kein Zugriff auf diese Seite";
        header('Location: baeckerei.php');
    };
} else {
    echo "Unzeireichende User Berechtigung";
}
}

    $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
    $client = new MongoDB\Client($uri);
    $collection = $client->backshop->bestandteil;
    $document = $collection->findOne(['bestandteilNr' => $_GET['bestandteilNr']]);
    
    if (isset($_POST) & !empty($_POST)) {
        $id = $document['_id'];
        $bestandteil = array (
                           'menge' = $_POST['menge'];
                           'masseinheit' = $_POST['masseinheit'];
                           );
        
        //updating the 'users' table/collection
        $collection->updateOne(
                               array('bestandteilNr' => $_GET['bestandteilNr']),
                               array('$set' => $bestandteil)
                               );
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: bestand.php");
    }
    
?>

<!DOCTYPE html>
<html>
<title>Lecker: Bestandteile</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

    <?php if ($data2['accesslevel'] == 9): ?>
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
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data2['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a class="active" href="bestand_kunde.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data2['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data2['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<div class="undermenu">
    <span class="caret"></span></button>
    <ul class="nav-menu" role="menu" aria-labelledby="menu1">
        <li><a href="bestand_save.php">Speichern</a></li>
    </ul>
</div>

<div id="wrapper">
    <center><h2>Bestandteil Update</h2>
        <div style="width: 500px; margin: 20px auto;">
            <table width="100%" cellpadding="5" cellspacing="1" border="1">
                <form action="" method="post">
                    <input type="hidden" name="bestandteilNr" value="<?php echo $bestandteilNr; ?>">
                    <tr>
                        <td>Menge</td>
                        <td><input name="menge" type="integer" value="<?php echo $data['menge']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Maßeinheit</td>
                        <td><input name="masseinheit" type="char" value="<?php echo $data['masseinheit']; ?>"></td>
                    </tr>
                    <tr>
                        <td><a href="bestand.php">Back</a></td>
                        <td><input name="submit_data" class="testbutton" type="submit" value="Update"></td>
                    </tr>
                </form>
            </table>
        </div>
</body>
</html>
