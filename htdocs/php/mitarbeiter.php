<?php

 try{
	require_once('dbconnection.php');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
	$error = $e->getMessage();
}
 
if(isset($error)){ echo $error; }
 
 $sql = "SELECT * FROM mitarbeiter";
 $result = $db->query($sql);

 ?>

<html>
<title>Lecker: Mitarbeiter</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a href="baeckerei.php">Lecker</a></li>
		<li><a class="active" href="mitarbeiter.php">Mitarbeiter</a></li>
		<li><a href="konditor.php">Konditor</a></li>
		<li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
                <li><a href="kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="view.php">Views</a></li>	
		<li><a href="logout.php">Logout</a></li>	
       </ul>

  <div class="undermenu">
    <span class="caret"></span></button>
    <ul class="nav-menu" role="menu" aria-labelledby="menu1">
		<li><a href="#Suche">Suche</a></li>
		<li><a href="#Speichern">Speichern</a></li>
    </ul>
  </div>
  <br>

<a name="Suche">
<div class="container">
<div id="wrapper">
<center>
  <div>
  <h2>Mitarbeiter Suchen</h2>
    <form id='searchform' action='mitarbeiter.php' method='get'>
      <a href='mitarbeiter.php'>Alle Mitarbeiter</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
    </form>
  </div>
  
	  <table boarder="1">
		<?php
		  if (isset($_GET['search'])) {
			$sql = "SELECT * FROM mitarbeiter WHERE mname like '" . $_GET['search'] . "'";
		  } else {
			$sql = "SELECT * FROM mitarbeiter";
		  }
		  // execute sql statement
			$result = $db->query($sql);
		?>
		
		<tr>
			<th>Name</th>
			<th>Gehalt</th>
			<th>Geburtstag</th>
			<th>PersonalNr</th>
			<th>BNAME</th>
			<th>Passwort</th>
			<th>AccessLevel</th>
			<th>EMail</th>
			<th>EXTRAS</th>
		</tr>
		
		<?php 
			while($r = $result->fetch(PDO::FETCH_ASSOC)){
			?>
			<tr>
				<td><?php echo $r['mname']; ?></td>
				<td><?php echo $r['gehalt']; ?></td>
				<td><?php echo $r['mgeburtsdatum']; ?></td>
				<td><?php echo $r['personalnr']; ?></td>
				<td><?php echo $r['bname']; ?></td>
				<td><?php echo $r['passwort']; ?></td>
				<td><?php echo $r['accesslevel']; ?></td>
				<td><?php echo $r['email']; ?></td>
				<td><a href="mitarbeiter_update.php?email=<?php echo $r['email']; ?>">Mutieren</a> <a href="mitarbeiter_delete.php?email=<?php echo $r['email']; ?>">Delete</a></td>
			</tr>
		<?php } ?>
      </table>




<br></br>

	<a name="Speichern">
	
	<div class="container">
		<h2>Mitarbeiter Speichern</h2>
		<div class="row">
				<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Name</label>
						<div class="col-sm-10">
						  <input type="text" name="mname"  class="form-control" id="input1" placeholder="Name" />
						</div>
					</div>

					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Gehalt</label>
						<div class="col-sm-10">
						  <input type="text" name="gehalt"  class="form-control" id="input1" placeholder="Gehalt" />
						</div>
					</div>					
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
						<div class="col-sm-10">
						  <input type="date" name="mgeburtsdatum"  class="form-control" id="input1" placeholder="" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">PersonalNr</label>
						<div class="col-sm-10">
						  <input type="text" name="personalnr"  class="form-control" id="input1" placeholder="PersonalNr" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Unternehmen</label>
						<div class="col-sm-10">
						  <input type="text" name="bname"  class="form-control" id="input1" placeholder="Unternehmen" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Passwort</label>
						<div class="col-sm-10">
						  <input type="text" name="passwort"  class="form-control" id="input1" placeholder="Passwort" />
						</div>
					</div>
				
				
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
						<div class="col-sm-10">
						  <input type="text" name="email"  class="form-control" id="input1" placeholder="E-Mail" />
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

				
				$sql = "INSERT INTO mitarbeiter (mname, gehalt, mgeburtsdatum, personalnr, bname, passwort, accesslevel, email) 
				VALUES(:mname, :gehalt, :mgeburtsdatum, :personalnr, :bname, :passwort, 9, :email)";
				
				
				$result = $db->prepare($sql);
				$res = $result->execute(array('mname' => $_POST['mname'],
											  'gehalt' => $_POST['gehalt'],
											  'mgeburtsdatum' => $_POST['mgeburtsdatum'],
											  'personalnr' => $_POST['personalnr'],
											  'bname' => $_POST['bname'],
											  'passwort' => $_POST['passwort'],
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
