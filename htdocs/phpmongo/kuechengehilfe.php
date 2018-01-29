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

<!DOCTYPE html>
<html>
<title>Lecker: Kuechengehilfen</title>
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
<li><a class="active" href="kuechengehilfe.php">Kuechengehilfe</a></li>
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

<br></br>

<div id="wrapper">
    <center>
        <div>
            <form id='searchform' action='kuechengehilfe.php' method='get'>
                <a href='kuechengehilfe.php'>Alle Kuechengehilfe(n)</a> ---
                Suche nach Personal Nr.:
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
        $cursor = $collection->find(['accesslevel' => 2]);
    }
    ?>

        <br></br>

        <table style="width:70%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Betriebsmodus</th>
                <th>E-mail</th>
                <th>Kueche Nr.</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // fetch rows of the executed sql query
                foreach ($cursor as $document) {
                ?>
                <tr>

                    <td><?php echo $document['personalnr']; ?></td>
                    <td><?php echo $document['betriebsmodus']; ?></td>
                    <td><?php echo $document['email']; ?></td>
                    <td><?php echo $document['kuecheNr']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>


        <a name="Speichern">
            <div class="container">
                <h2>Kuechengehilfe Speichern</h2>
                <div class="row">
                    <form method="post" class="form-horizontal col-md-20 col-md-offset-10">
                        <div class="form-group">
                            <label for="input1" class="col-sm-5 control-label">Personal Nr.</label>
                            <div class="col-sm-10">
                                <input type="integer" name="personalnr" required class="form-control" id="input1"
                                       placeholder="Personal Nr."/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input1" class="col-sm-5 control-label">Betriebsmodus</label>
                            <div class="col-sm-10">
                                <input type="char" name="betriebsmodus" required class="form-control" id="input1"
                                       placeholder="Betriebsmodus"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input1" class="col-sm-5 control-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="char" name="email" required class="form-control" id="input1"
                                       placeholder="E-mail"/>
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
                          'personalnr' => $_POST['personalnr'],
                          'betriebsmodus' => $_POST['betriebsmodus'],
                          'email' => $_POST['email'],
						  'accesslevel' => 2,
                          'kuecheNr'=>123
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
