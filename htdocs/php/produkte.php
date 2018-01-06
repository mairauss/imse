
<<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM kunde";
    $result = $db->query($sql);
    
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
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a class="active" href="produkte.php">Produkte</a></li>
            	<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="logout.php">Logout</a></li>			
       </ul>
<div class="undermenu">
<span class="caret"></span></button>
<ul class="nav-menu" role="menu" aria-labelledby="menu1">
<li><a href="#Speichern">Speichern</a></li>
</ul>
</div>
<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='produkte.php' method='get'>
      <a href='produkte.php'>Alle Produkte</a> ---
      Suche nach Barcode: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>

<table boarder="1">
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM produkt WHERE barcode like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM produkt";
  }

  // execute sql statement
    $result = $db->query($sql);
?>

<table style="width:70%">
    <thead>
      <tr>
        <th>Barcode</th>
        <th>Name</th>
	<th>Preis</th>
	<th>Herstell.Datum</th>
	<th>Haltbar.Dauer</th>
	<th>Menge</th>
    <th>Kuehlraum Nr.</th>
      </tr>
    </thead>
    <tbody>

<?php
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
        ?>
<tr>
<td><?php echo $r['barcode']; ?></td>
<td><?php echo $r['pname']; ?></td>
<td><?php echo $r['ppreis']; ?></td>
<td><?php echo $r['phersdatum']; ?></td>
<td><?php echo $r['phaltdauer']; ?></td>
<td><?php echo $r['menge']; ?></td>
<td><?php echo $r['kuehlraumNr']; ?></td>
<td><a href="produkte_delete.php?barcode=<?php echo $r['barcode']; ?>">Delete</a></td>
</tr>
<?php } ?>
    </tbody>
  </table>
</center>

<a name="Speichern">
<div class="container">
<h2>Produkte Speichern</h2>
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

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Kuehlraum Nr.</label>
<div class="col-sm-10">
<input type="integer" name="kuehlraumNr" required class="form-control" id="input1" placeholder="Kuehlraum Nr." />
</div>
</div>

<input type="submit" class="btn btn-primary col-md-6" value="submit" name="submit" />
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
    if(isset($_POST["submit"])){
        try{
            require_once('dbconnection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $sql = "INSERT INTO produkt (barcode, pname, ppreis, phersdatum, phaltdauer, menge, kuehlraumNr)
            VALUES(:barcode, :pname, :ppreis, :phersdatum, :phaltdauer, :menge, :kuehlraumNr)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('barcode' => $_POST['barcode'],
                                          'pname' => $_POST['pname'],
                                          'ppreis' => $_POST['ppreis'],
                                          'phersdatum' => $_POST['phersdatum'],
                                          'phaltdauer' => $_POST['phaltdauer'],
                                          'menge' => $_POST['menge'],
                                          'kuehlraumNr' => $_POST['kuehlraumNr']
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

</div>
</body>
</html>
