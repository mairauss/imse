<?php
include('session.php');
require 'vendor/autoload.php';
$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
$client = new MongoDB\Client($uri);
$collection = $client->backshop->users;
$user_check = $_SESSION['login_user'];

$cursor = $collection->find(['email' => $user_check]);
$logedinuser = $login_session;
if (isset($logedinuser)) {
    //Administrator Rechte
	foreach ($cursor as $document) {
		if ($document['accesslevel'] == 9 || $document['accesslevel'] == 1 || $document['accesslevel'] == 2 || $document['accesslevel'] == 3) {
		} else {
			echo "Sie haben kein Zugriff auf diese Seite";
			header('Location: kunde.php');
		};

	}
} else {
echo "Unzeireichende User Berechtigung";
}

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
<?php if (!isset($logedinuser)): ?>
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
        <li><a href="putzplan.php">Putzplan</a><l/i>
        <li><a href="session_logout.php">Logout</a></li>
    </ul>
<?php endif; ?>
<?php if (isset($logedinuser)): ?>
    <?php if ($document['accesslevel'] == 9): ?>
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
            <li><a href="putzplan.php">Putzplan</a><l/i>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand_kunde.php">Bestandteil</a></li>
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
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a><l/i>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>
<br></br>


<?php if ($document['accesslevel'] > 1): ?>
    <div id="wrapper">
        <center>

            <?php
            // check if search view of list view

            $sql = "SELECT * FROM baeckerei";


            // execute sql statement
            $result = $db->query($sql);

            ?>
            <h1>Baeckerei</h1>
            <table style="width:70%">
                <thead>
                <tr>
                    <th>Baeckerei</th>
                    <th>FirmaNr</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // fetch rows of the executed sql query
                while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $r['bname']; ?></td>
                        <td><?php echo $r['firmanr']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php
            // check if search view of list view

            $sql = "SELECT * FROM anschrift";


            // execute sql statement
            $result = $db->query($sql);

            ?>

            <table style="width:70%">
                <thead>
                <tr>
                    <th>Adresse</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // fetch rows of the executed sql query
                while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $r['bezeichnung']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


            <h1>Kueche</h1>
            <?php
            // check if search view of list view

            $sql = "SELECT * FROM kueche";


            // execute sql statement
            $result = $db->query($sql);
            ?>

            <table style="width:70%">
                <thead>
                <tr>
                    <th>Kueche Nr.</th>
                    <th>Grundflaeche</th>
                    <th>Kuehlraum Nr.</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // fetch rows of the executed sql query
                while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $r['kuecheNr']; ?></td>
                        <td><?php echo $r['grundflaeche']; ?></td>
                        <td><?php echo $r['kuehlraumNr']; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

            <h1>Kuehlraum</h1>
            <?php
            // check if search view of list view

            $sql = "SELECT * FROM kuehlraum";


            // execute sql statement
            $result = $db->query($sql);

            ?>

            <table style="width:70%">
                <thead>
                <tr>
                    <th>Kuehlraum Nr.</th>
                    <th>Temp.</th>
                    <th>Grundflaeche</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // fetch rows of the executed sql query
                while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $r['kuehlraumNr']; ?></td>
                        <td><?php echo $r['temp']; ?></td>
                        <td><?php echo $r['grundflaeche']; ?></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>

        </center>
        <br></br>
    </div>
<?php endif; ?>

<?php if ($document['accesslevel'] == 1): ?>
    <center>
        <h2 style="color:rgb(150, 29, 29)">Herzlich Willkommen in der Bäckerei "Lecker"!</h2>
        <br></br>
        <?php
        // check if search view of list view

        $sql = "SELECT * FROM baeckerei";


        // execute sql statement
        $result = $db->query($sql);

        ?>
        <h1>Baeckerei</h1>
        <table style="width:70%">
            <thead>
            <tr>
                <th>Baeckerei</th>
                <th>FirmaNr</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // fetch rows of the executed sql query
            while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $r['bname']; ?></td>
                    <td><?php echo $r['firmanr']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <?php
        // check if search view of list view

        $sql = "SELECT * FROM anschrift";


        // execute sql statement
        $result = $db->query($sql);

        ?>

        <table style="width:70%">
            <thead>
            <tr>
                <th>Adresse</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // fetch rows of the executed sql query
            while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $r['bezeichnung']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>


        <div id="wrapper">
    </center>

<?php endif; ?>

</body>
</html>

