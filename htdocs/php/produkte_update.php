<?php
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    // Updating the table row with submited data according to barcode once form is submited
    if( isset($_POST['submit_data']) ){
        
        // Gets the data from post
        $barcode = $_POST['barcode'];
        $pname = $_POST['pname'];
        $ppreis = $_POST['ppreis'];
        $phersdatum = $_POST['phersdatum'];
        $phaltdauer = $_POST['phaltdauer'];
        $menge = $_POST['menge'];
        $masseinheit = $_POST['masseinheit'];
        
        // Makes query with post data
        $query = "UPDATE produkt SET pname='$pname', ppreis='$ppreis', phersdatum='$phersdatum',phaltdauer='$phaltdauer', menge='$menge', masseinheit='$masseinheit' WHERE barcode=$barcode";
        
        // Executes the query
        // If data inserted then set success message otherwise set error message
        // Here $db
        if( $db->exec($query) ){
            echo "Data is updated successfully.";
        }else{
            echo "Sorry, Data is not updated.";
        }
    }
    
    $barcode = $_GET['barcode']; // barcode from url
    // Prepar the query to get the row data with barcode
    $query = "SELECT barcode, * FROM produkt WHERE barcode=$barcode";
    $result = $db->query($query);
    $data = $result->fetch(PDO::FETCH_ASSOC);// set the row in $data
    ?>

<!DOCTYPE html>
<html>
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
<li><a href="backwarenmanager.php">Backwaren Manager</a></li>
<li><a class="active" href="produkte.php">Produkte</a></li>
<li><a href="backen.php">Backen</a></li>
<li><a href="bestand.php">Backen</a></li>
<li><a href="session_logout.php">Logout</a></li>
</ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a href="produkte_save.php">Speichern</a></li>
</ul>
</div>

<div id="wrapper">
<center><h2>Produkte Update</h2>

<div style="width: 500px; margin: 20px auto;">
<table width="100%" cellpadding="5" cellspacing="1" border="1">
<form action="" method="post">
<input type="hidden" name="barcode" value="<?php echo $barcode;?>">
<tr>
<td>Name</td>
<td><input type="char" name="pname" value="<?php echo $data['pname'];?>"> </td>
</tr>
<tr>
<td>Preis</td>
<td><input name="ppreis" type="double precision" value="<?php echo $data['ppreis'];?>"></td>
</tr>
<tr>
<td>Hers.datum</td>
<td><input name="phersdatum" type="date" value="<?php echo $data['phersdatum'];?>"></td>
</tr>
<tr>
<td>Haltdauer</td>
<td><input name="phaltdauer" type="date" value="<?php echo $data['phaltdauer'];?>"></td>
</tr>
<tr>
<td>Menge</td>
<td><input name="menge" type="integer" value="<?php echo $data['menge'];?>"></td>
</tr>
<tr>
<td>Maßeinheit</td>
<td><input name="masseinheit" type="char" value="<?php echo $data['masseinheit'];?>"></td>
</tr>
<tr>
<td><a href="produkte.php">Back</a></td>
<td><input name="submit_data" class="testbutton" type="submit" value="Update"></td>
</tr>
</form>
</table>
</div>
</body>
</html>
