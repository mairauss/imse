<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    ?>

<!DOCTYPE html><html>
<title>Lecker: Produkte</title>
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
		<li><a href="backwaren.php">Unsere Backwaren</a></li>
		<li><a href="einkauf.php">Warenkorb</a></li>
        <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
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

<div style="width: 500px; margin: 20px auto;">
<table width="100%" cellpadding="5" cellspacing="1" border="1">
<form action="" method="post">

<tr>
<td>Barcode</td>
<td><input type="integer" name="barcode"  required class="form-control" id="input1" placeholder="Barcode" />
</td>
</tr>


<tr>
<td>Name</td>
<td><input type="char" name="pname"  required class="form-control" id="input1" placeholder="Name" />
</td>
</tr>

<tr>
<td>Preis</td>
<td><input type="double precision" name="ppreis"  required class="form-control" id="input1" placeholder="Preis" /> </td>
</tr>

<tr>
<td>Herstell.Datum</td>
<td><input type="date" name="phersdatum" required  class="form-control" id="input1" placeholder="yyyy-mm-dd" />
</td>
</tr>

<tr>
<td>Haltbar.Dauer</td>
<td><input type="date" name="phaltdauer" required  class="form-control" id="input1" placeholder="yyyy-mm-dd" />
</td>
</tr>

<tr>
<td>Menge</td>
<td><input type="integer" name="menge" required class="form-control" id="input1" placeholder="Menge" />
</td>
</tr>

<tr>
<td>Maßeinheit</td>
<td><input type="char" name="masseinheit" required class="form-control" id="input1" placeholder="Masseinheit" />
</td>
</tr>

<br></br>
<tr>
<td><a href="produkte.php">Back</a></td>
<td><input type="submit" class="testbutton" value="Insert" name="submit" /></td>
</tr>

</form>
</div>
</center>

<?php
    if(isset($_POST["submit"])){
        try{
            require_once('dbconnection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $sql = "INSERT INTO produkt (barcode, pname, ppreis, phersdatum, phaltdauer, menge, masseinheit, kuehlraumNr)
            VALUES(:barcode, :pname, :ppreis, :phersdatum, :phaltdauer, :menge, :masseinheit, 123)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('barcode' => $_POST['barcode'],
                                          'pname' => $_POST['pname'],
                                          'ppreis' => $_POST['ppreis'],
                                          'phersdatum' => $_POST['phersdatum'],
                                          'phaltdauer' => $_POST['phaltdauer'],
                                          'masseinheit' => $_POST['masseinheit'],
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
