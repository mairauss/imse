<?php
/*
Quellen: https://github.com/chapagain/simple-crud-php-mongodb/blob/master/edit.php
*/
require 'vendor/autoload.php';

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$document = $collection->findOne(['email' => $_GET['email']]);

if (isset($_POST) & !empty($_POST)) {
	$id = $document['_id'];
	$user = array (
							'email' => $_POST['email'],
							'passwort' => $_POST['passwort'],
							'accesslevel' => (int) $_POST['accesslevel'],
							'geburtsdatum' => $_POST['geburtsdatum'],
							'name' => $_POST['name'],
							'gehalt' => $_POST['gehalt']
			);

		//updating the 'users' table/collection
		$collection->updateOne(
						array('email' => $_GET['email']),
						array('$set' => $user)
					);
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: mitarbeiter.php");
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
        <li><a href="putzplan.php">Putzplan</a></li>
        <li><a href="session_logout.php">Logout</a></li>
    </ul>

<div class="container">
    <div class="row">
        <form method="post" class="form-horizontal col-md-20 col-md-offset-10">
            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" required class="form-control" value="<?php echo $document['name'] ?>"
                           placeholder="Name"/>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Gehalt</label>
                <div class="col-sm-10">
                    <input type="number" min="0" name="gehalt" required class="form-control"
                           value="<?php echo $document['gehalt'] ?>" placeholder="Gehalt"/>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
                <div class="col-sm-10">
                    <input type="date" max="2000-01-01" name="geburtsdatum" required class="form-control"
                           value="<?php echo $document['geburtsdatum'] ?>" placeholder=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">Passwort</label>
                <div class="col-sm-10">
                    <input type="text" name="passwort" required class="form-control"
                           value="<?php echo $document['passwort'] ?>" placeholder="Passwort"/>
                </div>
            </div>

            <div class="form-group">
                <label for="input1" class="col-sm-2 control-label">AccessLevel</label>
                <div class="col-sm-10">
                    <select name="accesslevel" class="form-control">
                        <option>Select AccessLevel</option>
                        <option value=1 <?php if ($document['accesslevel'] == 1) {
                            echo "selected";
                        } ?>>1: Kunde
                        </option>
                        <option value=2 <?php if ($document['accesslevel'] == 2) {
                            echo "selected";
                        } ?>>2: Kückengehilfe
                        </option>
                        <option value=3 <?php if ($document['accesslevel'] == 3) {
                            echo "selected";
                        } ?>>3: Konditor
                        </option>
                        <option value=9 <?php if ($document['accesslevel'] == 9) {
                            echo "selected";
                        } ?>>9: Administrator
                        </option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
                <div class="col-sm-10">
                    <input type="email" name="email" required class="form-control" value="<?php echo $document['email'] ?>"
                           placeholder="E-Mail"/>
                </div>
            </div>

            <input type="submit" class="btn btn-primary col-md-6" value="submit" value="Update"/>
        </form>
    </div>
</div>


</body>
</html>
