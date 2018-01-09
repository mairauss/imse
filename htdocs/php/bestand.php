<?php
include('session.php');

try {
    require_once('dbconnection.php');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (isset($error)) {
    echo $error;
}
$logedinuser = $login_session;

if (isset($logedinuser)) {
    $resultsession = $db->query($ses_sql);
    $data = $resultsession->fetch(PDO::FETCH_ASSOC);
    //Administrator Rechte
    if ($data['accesslevel'] >= 1) {
        //echo "Access Level 3 oder 9";
    } else {
        echo "Sie haben kein Zugriff auf diese Seite";
        header('Location: baeckerei.php');
    };
} else {
    echo "Unzeireichende User Berechtigung";
}

?>

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
    <?php if ($data['accesslevel'] == 9): ?>
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
            <li><a href="backen.php">Backen</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a class="active" href="bestand_kunde.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="backen.php">Backen</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<?php if ($data['accesslevel'] != 1): ?>
    <div class="undermenu">
        <span class="caret"></span></button>
        <ul class="nav-menu" role="menu" aria-labelledby="menu1">
            <li><a href="bestand_save.php">Speichern</a></li>
        </ul>
    </div>

    <br></br>

    <div id="wrapper">
        <center>
            <div>
                <form id='searchform' action='bestand.php' method='get'>
                    Geben Sie Backware Name ein:
                    <input id='search' name='search' type='text' size='15'
                           value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>'/>
                    <input id='submit' type='submit' class="testbutton" value='Search'/>
                </form>
            </div>
            <?php
            // check if search view of list view
            if (isset($_GET['search'])) {
                $sql = "SELECT * FROM bestandteil WHERE gname like '%" . $_GET['search'] . "%'";
            } else {
                $sql = "SELECT * FROM bestandteil";
            }

            // execute sql statement
            $result = $db->query($sql);
            ?>

            <tbody>

            <?php
            if (isset($_GET['search'])) {
            ?>
            <thead>
            <tr>
                <h3>Produkte</h3>
            </tr>
            </thead>

            <table style="width:50%">
                <thead>
                <tr>
                    <th>Barcode</th>
                    <th>Name</th>
                    <th>Menge</th>
                    <th>Maßeinheit</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $r['barcode']; ?></td>
                        <td><?php echo $r['pname']; ?></td>
                        <td><?php echo $r['menge']; ?></td>
                        <td><?php echo $r['masseinheit']; ?></td>
                        <td><a href="bestand_update.php?bestandteilNr=<?php echo $r['bestandteilNr']; ?>">Mutieren</a>
                            <a
                                    href="bestand_delete.php?bestandteilNr=<?php echo $r['bestandteilNr']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php }
                }
                // else echo "Es gibt keine Infos!";
                ?>
                </tbody>
            </table>
        </center>
        <br></br>
    </div>
<?php endif; ?>

</div>
</body>
</html>
