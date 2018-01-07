<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    ?>

<!DOCTYPE html><html>
<title>Lecker: Kuechengehilfen</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a href="baeckerei.php">Lecker</a></li>
		<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
        <li><a href="kunde.php">Kunde</a></li>
        <li><a href="backwaren.php">Backwaren</a></li>
        <li><a class="active" href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>
		<li><a href="session_logout.php">Logout</a></li>
       </ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a class="active" href="produkte_save.php">Speichern</a></li>
</ul>
</div>

<div id="wrapper">
<center><h2>Produkte Speichern</h2>
<div class="row">
<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Barcode</label>
<div class="col-sm-10">
<input type="integer" name="barcode"  required class="form-control" id="input1" placeholder="Barcode" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Name</label>
<div class="col-sm-10">
<input type="char" name="pname"  required class="form-control" id="input1" placeholder="Name" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Preis</label>
<div class="col-sm-10">
<input type="double precision" name="ppreis"  required class="form-control" id="input1" placeholder="Preis" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Herstell.Datum</label>
<div class="col-sm-10">
<input type="date" name="phersdatum" required  class="form-control" id="input1" placeholder="" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Haltbar.Dauer</label>
<div class="col-sm-10">
<input type="date" name="phaltdauer" required  class="form-control" id="input1" placeholder="" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Menge</label>
<div class="col-sm-10">
<input type="integer" name="menge" required class="form-control" id="input1" placeholder="Menge" />
</div>
</div>
<br></br>

<input type="submit" class="testbutton" value="Insert" name="submit" />
</form>
</div>
</center>
<?php
    /*
     Quellen:
     http://codingcyber.org/simple-crud-application-php-pdo-7284/
     https://www.w3schools.com/php/php_mysql_insert.asp
     https://www.formget.com/php-data-object/
     */
    if(isset($_POST["submit"])){
        try{
            require_once('dbconnection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $sql = "INSERT INTO produkt (barcode, pname, ppreis, phersdatum, phaltdauer, menge, kuehlraumNr)
            VALUES(:barcode, :pname, :ppreis, :phersdatum, :phaltdauer, :menge, 123)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('barcode' => $_POST['barcode'],
                                          'pname' => $_POST['pname'],
                                          'ppreis' => $_POST['ppreis'],
                                          'phersdatum' => $_POST['phersdatum'],
                                          'phaltdauer' => $_POST['phaltdauer'],
                                          'menge' => $_POST['menge']
                                          ));
            if($res){
                echo "Ihre Daten wurden erfolgreich gespeichert";
            }else{
                echo "Fehler aufgetreten";
            }
            $db = null;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        
    }
    ?>
</body>
</html>
