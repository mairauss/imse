<?php
    include('session.php');

    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    
    if(isset($error)){ echo $error; }
    
    $sql = "SELECT * FROM kunde";
    $result = $db->query($sql);
		

	$logedinuser = $login_session;
	    if (isset($logedinuser)) {
        $sql = "SELECT * FROM kunde WHERE email  '$logedinuser'";
		$result = $db->query($ses_sql);
		$data = $result->fetch(PDO::FETCH_ASSOC);
			//Administrator Rechte
			if($data['accesslevel'] == 9){
				echo "Access Level 0";
			} else{
				echo "Access Level ungleich 9 unzureichende Berechtigung";
				header('Location: baeckerei.php');
			};
		} else {
        echo "Unzeireichende User Berechtigung";
		}
	
    ?>

<!DOCTYPE html>
<html>
<title>Lecker: Kunden</title>
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
<li><a class="active" href="kunde.php">Kunde</a></li>
<li><a href="backwarenmanager.php">Backwaren Manager</a></li>
<li><a href="produkte.php">Produkte</a></li>
<li><a href="backen.php">Backen</a></li>
<li><a href="bestand.php">Bestandteil</a></li>
<li><a href="session_logout.php">Logout</a></li>
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
<h2>Kunde Suchen</h2>
<form id='searchform' action='kunde.php' method='get'>
<a href='kunde.php'>Alle Kunden</a> ---
Suche nach Name:
<input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
<input id='submit' type='submit' class="testbutton" value='Search' />
</form>
</div>


<table style="width:70%">
<?php
    if (isset($_GET['search'])) {
        $sql = "SELECT * FROM kunde WHERE kname like '" . $_GET['search'] . "'";
    } else {
        $sql = "SELECT * FROM kunde";
    }
    // execute sql statement
    $result = $db->query($sql);
    ?>

<tr>
<th>E-mail</th>
<th>Name</th>
<th>Geburtstag</th>
<th>Bname</th>
<th>Passwort</th>
<th>AccesLevel</th>
<th>EXTRAS</th>
</tr>

<?php
    while($r = $result->fetch(PDO::FETCH_ASSOC)){
        ?>
<tr>
<td><?php echo $r['email']; ?></td>
<td><?php echo $r['kname']; ?></td>
<td><?php echo $r['kgeburtsdatum']; ?></td>
<td><?php echo $r['bname']; ?></td>
<td><?php echo $r['passwort']; ?></td>
<td><?php echo $r['accesslevel']; ?></td>
<td><a href="kunde_update.php?email=<?php echo $r['email']; ?>">Mutieren</a> <a href="kunde_delete.php?email=<?php echo $r['email']; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>


<a name="Speichern">

<div class="container">
<h2>Kunde Speichern</h2>
<div class="row">
<form method="post" class="form-horizontal col-md-20 col-md-offset-10">
<div class="form-group">
<label for="input1" class="col-sm-5 control-label">E-Mail Adresse</label>
<div class="col-sm-10">
<input type="email" name="email"  required class="form-control" id="input1" placeholder="E-Mail" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Name</label>
<div class="col-sm-10">
<input type="text" name="kname"  required class="form-control" id="input1" placeholder="Name" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Geburtsdatum</label>
<div class="col-sm-10">
<input type="date" max="2000-01-01" name="kgeburtsdatum" required  class="form-control" id="input1" placeholder="" />
</div>
</div>

<div class="form-group">
<label for="input1" class="col-sm-5 control-label">Passwort</label>
<div class="col-sm-10">
<input type="text" name="passwort" required class="form-control" id="input1" placeholder="Passwort" />
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
            
            $sql = "INSERT INTO kunde (email, kname, kgeburtsdatum, bname, passwort, accesslevel)
            VALUES(:email, :kname, :kgeburtsdatum, 'Lecker' , :passwort, 1)";
            
            
            $result = $db->prepare($sql);
            $res = $result->execute(array('email' => $_POST['email'],
                                          'kname' => $_POST['kname'],
                                          'kgeburtsdatum' => $_POST['kgeburtsdatum'],
                                          'passwort' => $_POST['passwort']
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
