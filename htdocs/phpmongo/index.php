<?php
//Quellen: https://github.com/mongolab/mongodb-driver-examples/blob/master/php/php_simple_example.php
// This path should point to Composer's autoloader

require 'vendor/autoload.php';
$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;

session_start();
$error = '';
if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
    $_SESSION['login_user'] = $email;
		
	if (empty($_POST['email']) || empty($_POST['passwort'])) {
        $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
    } else {


		// Initializing $email and $passwort
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
		//MongoDB Connection
		$cursor = $collection->find(['email' => $email]);
		 foreach ($cursor as $document) {
				if ($document['email'] == $email && $document['passwort'] == $passwort) {


					// Session starten
					$_SESSION['login_user'] = $email;
					break;
				} else {
				$error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
		}
	}
		
	if (isset($_SESSION['login_user'])) {
		header("location: baeckerei.php");
	}	
	
}


?>
<!DOCTYPE html>
<html>
<title>Lecker: Kunden</title>
<head>
    <link rel="stylesheet" href="index.css"/>
    <style>
        #login {
            text-align: center;
        }

        #main {
            text-align: center;
        }
    </style>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>


<div id="main">
    <h2 style="color:rgb(150, 29, 29)">Herzlich Willkommen in der Bäckerei "Lecker"!</h2>


    <h1>Login Lecker</h1>
    <div id="login">
        <h2>Login Form</h2>
        <form action="" method="post">
            <label>E-Mail :</label>
            <input id="name" name="email" placeholder="e-mail adresse" type="text">
            <label>Passwort :</label>
            <input id="passwort" name="passwort" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
        </form>
    </div>

    <br></br>

    <div id="main">
        <h1>Register Lecker</h1>
                    <div class="container">
                        <div class="row">
                            <form method="post" class="form-horizontal col-md-20 col-md-offset-10">
                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" required class="form-control" id="input1"
                                               placeholder="E-Mail"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input1" class="col-sm-5 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" required class="form-control" id="input1"
                                               placeholder="Name"/>
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
                                    <label for="input1" class="col-sm-5 control-label">Passwort</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="passwort" required class="form-control" id="input1"
                                               placeholder="Passwort"/>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary col-md-6" value="submit" name="submit2"/>
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
		 require 'vendor/autoload.php';
		$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
                    if (isset($_POST["submit2"])) {
						echo "submit2";
						$seedData = array(
							'email' => $_POST['email'],
							'passwort' => $_POST['passwort'],
							'accesslevel' => 1,
							'geburtsdatum' => $_POST['geburtsdatum'],
							'name' => $_POST['name']
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
</div>
</body>
</html>