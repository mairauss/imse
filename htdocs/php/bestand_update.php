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
        $bestandteilNr = $_POST['bestandteilNr'];
        $menge = $_POST['menge'];
        $masseinheit = $_POST['masseinheit'];
        
        // Makes query with post data
        $query = "UPDATE bestandteil SET menge=$menge, masseinheit='$masseinheit' WHERE bestandteilNr=$bestandteilNr";
        
        // Executes the query
        // If data inserted then set success message otherwise set error message
        // Here $db
        if( $db->exec($query)){
            echo "Data is updated successfully.";
        }else{
            echo "Sorry, Data is not updated.";
        }
    }
    
    $bestandteilNr = $_GET['bestandteilNr'];
    // Prepar the query to get the row data with barcode
    $query = "SELECT bestandteilNr, * FROM bestandteil WHERE bestandteilNr=$bestandteilNr";
    $result = $db->query($query);
    $data = $result->fetch(PDO::FETCH_ASSOC);// set the row in $data
    ?>

<!DOCTYPE html>
<html>
<title>Lecker: Bestandteile</title>
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
<li><a href="produkte.php">Produkte</a></li>
<li><a href="backen.php">Backen</a></li>
<li><a class="active" href="bestand.php">Bestandteil</a></li>
<li><a href="session_logout.php">Logout</a></li>
</ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a href="bestand_save.php">Speichern</a></li>
</ul>
</div>

<div id="wrapper">
<center><h2>Bestandteil Update</h2>

<div style="width: 500px; margin: 20px auto;">
<table width="100%" cellpadding="5" cellspacing="1" border="1">
<form action="" method="post">
<input type="hidden" name="bestandteilNr" value="<?php echo $bestandteilNr;?>">
<tr>
<td>Menge</td>
<td><input name="menge" type="integer" value="<?php echo $data['menge'];?>"></td>
</tr>
<tr>
<td>Maßeinheit</td>
<td><input name="masseinheit" type="char" value="<?php echo $data['masseinheit'];?>"></td>
</tr>
<tr>
<td><a href="bestand.php">Back</a></td>
<td><input name="submit_data" class="testbutton" type="submit" value="Update"></td>
</tr>
</form>
</table>
</div>
</body>
</html>
