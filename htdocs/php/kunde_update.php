<?php
		/*
		Quellen:
		http://codingcyber.org/simple-crud-application-php-pdo-7284/
		https://www.tutorialspoint.com/sqlite/sqlite_delete_query.htm
		*/
		try{
			require_once('dbconnection.php');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			$error = $e->getMessage();
		}
		//übergebenen PK E-Mail von der Adresse
		 $selsqlite = "SELECT * FROM `kunde` WHERE email=?";
		 $selresult = $db->prepare($selsqlite);
		 $selres = $selresult->execute(array($_GET['email']));
		 $r = $selresult->fetch(PDO::FETCH_ASSOC);

 
		 if(isset($_POST) & !empty($_POST)){

			$sql = "UPDATE kunde SET email=:email, kname=:kname, kgeburtsdatum=:kgeburtsdatum, bname=:bname, passwort=:passwort WHERE email=:email";
			$result = $db->prepare($sql);
			$res = $result->execute(array(    'email' => $_POST['email'],
										      'kname' => $_POST['kname'],
											  'kgeburtsdatum' => $_POST['kgeburtsdatum'],
											  'bname' => $_POST['bname'],
											  'passwort' => $_POST['passwort']
											  ));
				 if($res){
					echo "Ihre Daten wurden erfolgreich mutiert";
				 }else{
					echo "Fehler aufgetreten";
				 }
		 }
		
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
		<div class="container">
			<div class="row">
				<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
						<div class="col-sm-10">
						  <input type="text" name="email" required class="form-control" value="<?php echo $r['email']?>" placeholder="E-Mail" />
						</div>
					</div>
		 
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Name</label>
						<div class="col-sm-10">
						  <input type="text" name="kname" required class="form-control" value="<?php echo $r['kname']?>" placeholder="Name" />
						</div>
					</div>
		 
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
						<div class="col-sm-10">
						  <input type="date" max="2000-01-01" name="kgeburtsdatum" required class="form-control" value="<?php echo $r['kgeburtsdatum']?>" placeholder="" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Unternehmen</label>
						<div class="col-sm-10">
						  <input type="text" name="bname" required class="form-control" value="<?php echo $r['bname']?>" placeholder="Unternehmen" />
						</div>
					</div>
					
					<div class="form-group">
						<label for="input1" class="col-sm-5 control-label">Passwort</label>
						<div class="col-sm-10">
						  <input type="text" name="passwort" required class="form-control" value="<?php echo $r['passwort']?>" placeholder="Passwort" />
						</div>
					</div>
		 
					<input type="submit" class="btn btn-primary col-md-6" value="submit" value="Update" />
				</form>
			</div>
		</div>
		

		
	</body>
</html>