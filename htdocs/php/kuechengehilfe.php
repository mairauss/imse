<?php
    include('session.php');
    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM konditor";
    $result = $db->query($sql);
    $logedinuser = $login_session;
	    if (isset($logedinuser)) {
		$resultsession = $db->query($ses_sql);
		$data = $resultsession->fetch(PDO::FETCH_ASSOC);
			//Administrator Rechte
			
			if($data['accesslevel'] == 9 || $data['accesslevel'] == 1 || $data['accesslevel'] == 2 || $data['accesslevel'] == 3){
			} else{
				echo "Sie haben kein Zugriff auf diese Seite";
				header('Location: baeckerei.php');
			};
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
		<li><a class="active" href="kuechengehilfe.php">Kuechengehilfe</a></li>
        <li><a href="kunde.php">Kunde</a></li>
        <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
        <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backwaren.php">Unsere Backwaren</a></li>
		<li><a href="einkauf.php">Warenkorb</a></li>
		<li><a href="backen.php">Backen</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>
		<li><a href="session_logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='kuechengehilfe.php' method='get'>
      <a href='kuechengehilfe.php'>Alle Kuechengehilfe(n)</a> ---
      Suche nach Personal Nr.:
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM kuechengehilfe WHERE personalnr like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM kuechengehilfe";
  }

  // execute sql statement
    $result = $db->query($sql);
?>
<br></br>

<table style="width:70%">
    <thead>
      <tr>
          <th>Name</th>
 	      <th>Betriebsmodus</th>
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
<td><?php echo $r['betriebsmodus']; ?></td>
<td><?php echo $r['email']; ?></td>
<td><?php echo $r['kuecheNr']; ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>


<a name="Speichern">
<div class="container">
<h2>Kuechengehilfe Speichern</h2>
<div class="row">
<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Personal Nr.</label>
<div class="col-sm-10">
<input type="integer" name="personalnr"  required class="form-control" id="input1" placeholder="Personal Nr." />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Betriebsmodus</label>
<div class="col-sm-10">
<input type="char" name="betriebsmodus"  required class="form-control" id="input1" placeholder="Betriebsmodus" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">E-mail</label>
<div class="col-sm-10">
<input type="char" name="email" required  class="form-control" id="input1" placeholder="E-mail" />
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
            
            
            $sql = "INSERT INTO kuechengehilfe (personalnr, betriebsmodus, email, kuecheNr)
            VALUES(:personalnr, :betriebsmodus, :email, 987)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('personalnr' => $_POST['personalnr'],
                                          'betriebsmodus' => $_POST['betriebsmodus'],
                                          'email' => $_POST['email'],
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
