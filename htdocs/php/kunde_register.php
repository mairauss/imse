<html>
<title>Lecker: Kunden</title>
<head>
    <link rel="stylesheet" href="index.css"/>
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<ul>
    <li><a href="baeckerei.php">Login</a></li>
</ul>

<div class="container">
    <div class="row">
        <form method="post" class="form-horizontal col-md-20 col-md-offset-10">
            <h3>Kundenregistrierung für Lecker</h2>
                <div class="form-group">
                    <label for="input1" class="col-sm-15 control-label">E-Mail Adresse</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="input1" placeholder="E-Mail"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-15 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="kname" class="form-control" id="input1" placeholder="Name"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
                    <div class="col-sm-10">
                        <input type="date" name="kgeburtsdatum" class="form-control" id="input1" placeholder=""/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-5 control-label">Unternehmen</label>
                    <div class="col-sm-10">
                        <input type="text" name="bname" class="form-control" id="input1" placeholder="Unternehmen"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="input1" class="col-sm-5 control-label">Passwort</label>
                    <div class="col-sm-10">
                        <input type="text" name="passwort" class="form-control" id="input1" placeholder="Passwort"/>
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
    try {
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "INSERT INTO kunde (email, kname, kgeburtsdatum, bname, passwort) 
				VALUES(:email, :kname, :kgeburtsdatum, :bname, :passwort)";


        $result = $db->prepare($sql);
        $res = $result->execute(array('email' => $_POST['email'],
            'kname' => $_POST['kname'],
            'kgeburtsdatum' => $_POST['kgeburtsdatum'],
            'bname' => $_POST['bname'],
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
</body>
</html>