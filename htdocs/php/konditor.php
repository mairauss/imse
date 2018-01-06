<?php
    
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM konditor";
    $result = $db->query($sql);
    
    ?>

<!DOCTYPE html>
<html>
<title>Lecker: Konditoren</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a href="baeckerei.php">Lecker</a></li>
		<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a class="active" href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a href="kunde/kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
		<li><a href="./session/logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='konditor.php' method='get'>
      <a href='konditor.php'>Alle Konditoren</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM konditor WHERE personalnr like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM konditor";
  }

  // execute sql statement
    $result = $db->query($sql);

?>


<br></br>
<table style="width:70%">
    <thead>
      <tr>
          <th>Personal Nr.</th>
          <th>Berufserfahrung</th>
          <th>Ausbildung</th>
            <th>Bonus</th>
            <th>E-mail</th>
	     <th>Kueche Nr.</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
      ?>
<tr>
<td><?php echo $r['personalnr']; ?></td>
<td><?php echo $r['berufserfahrung']; ?></td>
<td><?php echo $r['ausbildung']; ?></td>
<td><?php echo $r['bonus']; ?></td>
<td><?php echo $r['email']; ?></td>
<td><?php echo $r['kuecheNr']; ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>
</center>
<br></br>


<a name="Speichern">
<div class="container">
<h2>Konditor Speichern</h2>
<div class="row">
<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Personal Nr.</label>
<div class="col-sm-10">
<input type="integer" name="personalnr"  required class="form-control" id="input1" placeholder="Personal Nr." />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Berufserfahrung</label>
<div class="col-sm-10">
<input type="integer" name="berufserfahrung"  required class="form-control" id="input1" placeholder="Berufserfahrung" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Ausbildung</label>
<div class="col-sm-10">
<input type="varchar" name="ausbildung"  required class="form-control" id="input1" placeholder="Ausbildung" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Bonus</label>
<div class="col-sm-10">
<input type="double precision" name="bonus" required  class="form-control" id="input1" placeholder="Bonus" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">E-mail</label>
<div class="col-sm-10">
<input type="char" name="email" required  class="form-control" id="input1" placeholder="E-mail" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Kueche Nr.</label>
<div class="col-sm-10">
<input type="integer" name="kuecheNr" required  class="form-control" id="input1" placeholder="Kueche Nr." />
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
            
            
            $sql = "INSERT INTO konditor (personalnr, berufserfahrung, ausbildung, bonus, email, kuecheNr)
            VALUES(:personalNr, :berufserfahrung, :ausbildung, :bonus, :email, :kuecheNr)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('personalnr' => $_POST['personalnr'],
                                          'berufserfahrung' => $_POST['berufserfahrung'],
                                          'ausbildung' => $_POST['ausbildung'],
                                          'bonus' => $_POST['bonus'],
                                          'email' => $_POST['email'],
                                          'kuecheNr' => $_POST['kuecheNr'],
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
