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
?>

<!DOCTYPE html>
<html>
<title>Lecker: Produkte</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>
<?php if (isset($logedinuser)): ?>
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
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>
<div class="undermenu">
    <span class="caret"></span></button>
    <ul class="nav-menu" role="menu" aria-labelledby="menu1">
        <li><a href="produkte_save.php">Speichern</a></li>
    </ul>
</div>
<br></br>

<div id="wrapper">
    <center>
        <div>
            <form id='searchform' action='produkte.php' method='get'>
                <a href='produkte.php'>Alle Produkte</a> ---
                Suche nach Barcode:
                <input id='search' name='search' type='text' size='15'
                       value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>'/>
                <input id='submit' type='submit' class="testbutton" value='Search'/>
            </form>
        </div>

        <table boarder="1">
            <?php
            // check if search view of list view
            if (isset($_GET['search'])) {
                $barcode = intval($_GET['search']);
                $cursor = $collection->find(['barcode' => $barcode]);
                $count = $collection->count(['barcode' => $barcode]);
                
            } else {
                $cursor = $collection->find();
                $count = $collection->count();
            }

            // execute sql statement
            $result = $db->query($sql);
            ?>
            <br></br>

            <table style="width:70%">
                <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Preis</th>
                    <th>Herstell.Datum</th>
                    <th>Haltbar.Dauer</th>
                    <th>Menge</th>
                    <th>Maßeinheit</th>
                    <th>Kuehlraum Nr.</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    foreach ($cursor as $document) {
                        ?>
                    <tr>
                        <td><?php echo $document['barcode']; ?></td>
                        <td><?php echo $document['pname']; ?></td>
                        <td><?php echo $document['ppreis']; ?></td>
                        <td><?php echo $document['phersdatum']; ?></td>
                        <td><?php echo $document['phaltdauer']; ?></td>
                        <td><?php echo $document['menge']; ?></td>
                        <td><?php echo $document['masseinheit']; ?></td>
                        <td><?php echo $document['kuehlraumNr']; ?></td>
                        <td><a href="produkte_update.php?barcode=<?php echo $r['barcode']; ?>">Mutieren</a> <a
                                    href="produkte_delete.php?barcode=<?php echo $r['barcode']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
    </center>

    <br></br>

</body>
</html>
