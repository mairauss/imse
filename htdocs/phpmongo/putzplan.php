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
		if ($document['accesslevel'] >= 1) {
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

<html>
<title>Lecker: Putzplan</title>
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
            <li><a class="active" href="bestand_kunde.php">Bestandteil</a></li>
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

<?php if ($document['accesslevel'] > 1): ?>
    <div class="undermenu">
        <span class="caret"></span></button>
        <ul class="nav-menu" role="menu" aria-labelledby="menu1">
            <li><a href="putzplan_save.php">Speichern</a></li>
        </ul>
    </div>

    <br></br>

    <div id="wrapper">
        <center>
            <div>
                <form id='searchform' action='bestand.php' method='get'>
                    Geben Sie ihre PersonalNr ein:
                    <input id='search' name='search' type='text' size='15'
                           value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>'/>
                    <input id='submit' type='submit' class="testbutton" value='Search'/>
                </form>
            </div>

            <table boarder="1">
            
            <?php
            // check if search view of list view
			$collectionputzplan = $client->backshop->produkte;
            if (isset($_GET['search'])) {
            		$putzplan = intval($_GET['search']);
				$cursor2 = $collectionputzplan->find(['personalnr' => $putzplan]);
            } else {
                $cursor2 = $collectionputzplan->find();
            }
            ?>
            
            <tbody>
            <thead>
            <tr>
                <h3>Putzplan</h3>
            </tr>
            </thead>

            <table style="width:50%">
                <thead>
                <tr>
                    <th>PersonalNr</th>
                    <th>KuecheNr</th>
                    <th>Putzdatum</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    foreach ($cursor2 as $documentbestand) {
                    ?>
                    <tr>
                        <td><?php echo $documentputzplan['personalnr']; ?></td>
                        <td><?php echo $documentputzplan['kuecheNr']; ?></td>
                        <td><?php echo $documentputzplan['putzdatum']; ?></td>
                        <td><a href="putzplan_update.php?personalnr=<?php echo $documentputzplan['personalnr']; ?>">Mutieren</a>
                            <a
                                    href="putzplan_delete.php?personalnr=<?php echo $documentputzplan['personalnr']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php }  ?>
                </tbody>
            </table>
        </center>
        <br></br>
			<?php endif; ?>
</body>
</html>
