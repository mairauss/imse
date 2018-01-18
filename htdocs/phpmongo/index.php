<?php
/*
Quellen: 
https://www.formget.com/login-form-in-php/
http://www.genecasanova.com/labs/memberships/form-sessions-php.html
*/
session_start();
// Variable To Store Error Message
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['passwort'])) {
        $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
    } else {
        // Initializing $email and $passwort
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        // Datenbankverbindung herstellen
        try {
            require_once('dbconnection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        // SQL Select for all Registered Users
        $sql = "SELECT * FROM (SELECT email,passwort from kunde UNION select email,passwort from mitarbeiter) AS U where u.passwort='$passwort' AND u.email='$email'";
        $result = $db->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            if ($data['email'] == $email && $data['passwort'] == $passwort) {
                // Session starten
                $_SESSION['login_user'] = $email;
                // Zur Startseite weiterleiten
                header("location: index.php");
            }
        } else {
            $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
        $db = null;
    }
}


if (isset($_SESSION['login_user'])) {
    header("location: baeckerei.php");
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
                            <input type="text" name="kname" required class="form-control" id="input1"
                                   placeholder="Name"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
                        <div class="col-sm-10">
                            <input type="date" max="2000-01-01" name="kgeburtsdatum" required
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
        if (isset($_POST["submit2"])) {
            try {
                require_once('dbconnection.php');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO kunde (email, kname, kgeburtsdatum, bname, passwort, accesslevel)
            VALUES(:email, :kname, :kgeburtsdatum, 'Lecker' , :passwort, 1)";


                $result = $db->prepare($sql);
                $res = $result->execute(array('email' => $_POST['email'],
                    'kname' => $_POST['kname'],
                    'kgeburtsdatum' => $_POST['kgeburtsdatum'],
                    'passwort' => $_POST['passwort']
                ));
                if ($res) {
                    echo "Ihre Daten wurden erfolgreich gespeichert";
                } else {
                    echo "Fehler aufgetreten";
                }
                $db = null;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </div>
</div>
</body>
</html>