<?php
require 'vendor/autoload.php';
include('session.php');
$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$collectionbestandteile = $client->backshop->bestandteile;
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

?>

<!DOCTYPE html>
<html>
<title>Lecker: Bestandteil</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>
<?php if (!isset($logedinuser)): ?>
    <ul>
        <li><a href="baeckerei.php">Lecker</a></li>
    </ul>
<?php endif; ?>
<?php if (isset($logedinuser)): ?>
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
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
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
            <li><a href="produkte.php">Produkte</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>
<div class="undermenu">
    <span class="caret"></span></button>
    <ul class="nav-menu" role="menu" aria-labelledby="menu1">
        <li><a class="active" href="bestand_save.php">Speichern</a></li>
    </ul>
</div>

<div id="wrapper">
    <center><h2>Bestandteile Speichern</h2>

        <div style="width: 500px; margin: 20px auto;">
            <table width="100%" cellpadding="5" cellspacing="1" border="1">
                <form action="" method="post">

                    <tr>
                        <td>Backware Artikel Nr.</td>
                        <td><input type="integer" name="artikelnr" required class="form-control" id="input1"
                                   placeholder="Artikel Nr."/>
                        </td>
                    </tr>

                    <tr>
                        <td>Produkt Barcode</td>
                        <td><input type="integer" name="barcode" required class="form-control" id="input1"
                                   placeholder="Barcode"/></td>
                    </tr>


                    <tr>
                        <td>Produkt Name</td>
                        <td><input type="char" name="pname" required class="form-control" id="input1"
                                   placeholder="Produkt Name"/>
                        </td>
                    </tr>


                    <tr>
                        <td>Backware Name</td>
                        <td><input type="char" name="gname" required class="form-control" id="input1"
                                   placeholder="Backware Name"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Produkt Menge</td>
                        <td><input type="integer" name="menge" required class="form-control" id="input1"
                                   placeholder="Menge"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Maßeinheit</td>
                        <td><input type="char" name="masseinheit" required class="form-control" id="input1"
                                   placeholder="Masseinheit"/>
                        </td>
                    </tr>

                    <br></br>
                    <tr>
                        <td><a href="bestand.php">Back</a></td>
                        <td><input type="submit" class="testbutton" value="Insert" name="submit"/></td>
                    </tr>

                </form>
        </div>
    </center>

    <?php
        if(isset($_POST["submit"])){

            $seedData = array(
                              'artikelnr' => $_POST['artikelnr'],
                              'barcode' => $_POST['barcode'],
                              'pname' => $_POST['pname'],
                              'gname' => $_POST['gname'],
                              'menge' => $_POST['menge'],
                              'masseinheit' => $_POST['masseinheit']
                              );
            $res = $collectionbestandteile->insertOne($seedData);
            if ($res) {
                echo "Ihre Daten wurden erfolgreich gespeichert";
            } else {
                echo "Fehler aufgetreten";
            }
        }
        ?>
</body>
</html>
