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
        if ($document['accesslevel'] == 9) {
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
<title>Lecker: Mitarbeiter</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<?php if ($document['accesslevel'] == 9): ?>
    <ul>
        <li><a href="baeckerei.php">Lecker</a></li>
        <li><a class="active" href="mitarbeiter.php">Mitarbeiter</a></li>
        <li><a href="konditor.php">Konditor</a></li>
        <li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
        <li><a href="kunde.php">Kunde</a></li>
        <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
        <li><a href="produkte.php">Produkte</a></li>
        <li><a href="backwaren.php">Unsere Backwaren</a></li>
        <li><a href="einkauf.php">Warenkorb</a></li>
        <li><a href="bestand.php">Bestandteil</a></li>
        <li><a href="putzplan.php">Putzplan</a></li>
        <li><a href="session_logout.php">Logout</a></li>
    </ul>
<?php endif; ?>

<div class="undermenu">
    <span class="caret"></span></button>
    <ul class="nav-menu" role="menu" aria-labelledby="menu1">
        <li><a href="#Suche">Suche</a></li>
        <li><a href="#Speichern">Speichern</a></li>
    </ul>
</div>
<br>

<a name="Suche">
    <div class="container">
        <div id="wrapper">
            <center>
                <div>
                    <h2>Mitarbeiter Suchen</h2>
                    <form id='searchform' action='mitarbeiter.php' method='get'>
                        <a href='mitarbeiter.php'>Alle Mitarbeiter</a> ---
                        Suche nach PersonalNr:
                        <input id='search' name='search' type='text' size='15'
                               value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>'/>
                        <input id='submit' type='submit' class="testbutton" value='Search'/>
                    </form>
                </div>

                <table style="width:80%">
                    <?php
                    /*
                    Quellen:
                    https://docs.mongodb.com/manual/reference/method/db.collection.find/#examples
                    http://php.net/manual/fa/mongocollection.find.php
                    https://github.com/mongolab/mongodb-driver-examples/blob/master/php/php_simple_example.php
                    */
                    if (isset($_GET['search'])) {
                        $cursor = $collection->find(['personalnr' => (int)$_GET['search']]);
                    } else {
                        $query = array('personalnr' => array('$gte' => 1));
                        $options = array(
                            "sort" => array('decade' => 1),
                        );
                        $cursor = $collection->find($query, $options);
                    }
                    ?>

                    <tr>
                        <th>EMail</th>
                        <th>Name</th>
                        <th>Geburtstag</th>
                        <th>Passwort</th>
                        <th>AccessLevel</th>
                        <th>MitarbeiterNr</th>
                        <th>Gehalt</th>
                        <th>EXTRAS</th>
                    </tr>

                    <?php
                    foreach ($cursor as $document) {
                        ?>
                        <tr>
                            <td><?php echo $document['email']; ?></td>
                            <td><?php echo $document['name']; ?></td>
                            <td><?php echo $document['geburtsdatum']; ?></td>
                            <td><?php echo $document['passwort']; ?></td>
                            <td><?php echo $document['accesslevel']; ?></td>
                            <td><?php echo $document['personalnr']; ?></td>
                            <td><?php echo $document['gehalt']; ?></td>

                            <td><a href="mitarbeiter_update.php?email=<?php echo $document['email']; ?>">Mutieren</a> <a
                                        href="mitarbeiter_delete.php?email=<?php echo $document['email']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>


                <br></br>

                <a name="Speichern">

                    <div class="container">
                        <h2>Mitarbeiter Speichern</h2>
                        <div class="row">
                            <form method="post" class="form-horizontal col-md-20 col-md-offset-10">
                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required class="form-control" id="input1"
                                               placeholder="Name"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">Gehalt</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" name="gehalt" required class="form-control"
                                               id="input1" placeholder="Gehalt"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
                                    <div class="col-sm-10">
                                        <input type="date" max="2000-01-01" name="geburtsdatum" required
                                               class="form-control" id="input1" placeholder=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">PersonalNr</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="personalnr" required class="form-control" id="input1"
                                               placeholder="PersonalNr"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">Passwort</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="passwort" required class="form-control" id="input1"
                                               placeholder="Passwort"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-2 control-label">AccessLevel</label>
                                    <div class="col-sm-10">
                                        <select name="accesslevel" class="form-control">
                                            <option>Select AccessLevel</option>
                                            <option value=1>1: Kunde</option>
                                            <option value=2>2: Kückengehilfe</option>
                                            <option value=3>3: Konditor</option>
                                            <option value=9>9: Administrator</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" required class="form-control" id="input1"
                                               placeholder="E-Mail"/>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary col-md-6" value="submit" name="submit"/>

                            </form>
                        </div>
                    </div>

                    <?php
                    /*
                    Quellen:
                    http://codingcyber.org/simple-crud-application-php-pdo-7284/
                    https://www.w3schools.com/php/php_mysql_insert.asp
                    https://www.formget.com/php-data-object/
                    */
                    if (isset($_POST["submit"])) {
                        $seedData = array(
                            'email' => $_POST['email'],
                            'passwort' => $_POST['passwort'],
                            'accesslevel' => (int)$_POST['accesslevel'],
                            'geburtsdatum' => $_POST['geburtsdatum'],
                            'name' => $_POST['name'],
                            'personalnr' => (int)$_POST['personalnr'],
                            'gehalt' => (int)$_POST['gehalt']
                        );

                        $res = $collection->insertOne($seedData);
                        if ($res) {
                            echo "Ihre Daten wurden erfolgreich gespeichert";
                        } else {
                            echo "Fehler aufgetreten";
                        }

                    }
                    ?>

        </div>
</body>
</html>
