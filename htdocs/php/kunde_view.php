

<?php

    try{
        require_once('dbconnection.php');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
    if(isset($_POST) & !empty($_POST)){
        $sql = "INSERT INTO crud (kname, email, gender, age) VALUES(:firstname, :lastname, :email, :gender, :age)";
        $result = $db->prepare($sql);
        $res = $result->execute(array(':firstname' 	=> $_POST['fname'],
            ':lastname' 	=> $_POST['lname'],
            'email' 		=> $_POST['email'],
            'gender' 		=> $_POST['gender'],
            'age' 			=> $_POST['age']
        ));
        if($res){
            echo "Successfully inserted data";
        }else{
            echo "failed to insert data";
        }
    }
?>

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
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='kunde.php' method='get'>
      <a href='kunde.php'>Alle Kunden</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM kunde WHERE kname like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM kunde";
  }

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

 

<div>

  <form id='insertform' action='kunde.php' method='get'>
<center>
    Neue Kunde einfuegen:
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
	      <th>Name</th>
	      <th>E-mail</th>
	    </tr>
	  </thead>
	  <tbody>
	     <tr>
	        <td>
	           <input id='kname' name='kname' type='text' size='50' value='<?php if (isset($_GET['kname'])) echo $_GET['kname']; ?>' />
                </td>
                <td>
                   <input id='email' name='email' type='text' size='15' value='<?php if (isset($_GET['email'])) echo $_GET['email']; ?>' />
                </td>
		
	      </tr>
           </tbody>

	<table style='border: 5px solid #DDDDDD'>
	<thead>
	    <tr>
           <th>Geburtsdatum</th>
	   <th>Baeckerei</th>
	    </tr>
	  </thead>
		<tbody>
	        <tr>
         	<td>
                   <input id='kgeburtsdatum' name='kgeburtsdatum' type='text' size='10' value='<?php if (isset($_GET['kgeburtsdatum'])) echo $_GET['kgeburtsdatum']; ?>' />
                </td>
		<td>
                   <input id='bname' name='bname' type='text' size='15' value='<?php if (isset($_GET['bname'])) echo $_GET['bname']; ?>' />
                </td>
       	      </tr>
           </tbody>
 	</table>

        </table>
</center>
        <input id='submit' type='submit' class="testbutton" value='Insert' />
  </form>
</div>

<?php
  //Handle insert
   if (isset($_GET['kname'])) 
  {


    //Prepare insert statementd
    $sql = "INSERT INTO kunde VALUES('" . $_GET['kname'] . "','"  . $_GET['email'] . "',to_date('" . $_GET['kgeburtsdatum'] . "','yyyymmdd')  ,'" . $_GET['bname'] .  "')";
    //Parse and execute statement
    $insert = oci_parse($conn, $sql);
    oci_execute($insert);


    $conn_err=oci_error($conn);
    $insert_err=oci_error($insert);
   
    if(!$conn_err & !$insert_err){
	print("Successfully inserted");
 	print("<br>");
    }
    //Print potential errors and warnings
    else{
       print($conn_err);
       print_r($insert_err);

    }
    oci_free_statement($insert);
  } 

?>

 <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
        <th>Name</th>
        <th>E-mail</th>
	<th>Geburtsdatum</th>
	<th>Baeckerei</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['KNAME'] . "</td>";
    echo "<td>" . $row['EMAIL'] . "</td>";
    echo "<td>" . $row['KGEBURTSDATUM'] . "</td>";
    echo "<td>" . $row['BNAME'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Kunde(n) gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>

<?php
oci_close($conn);
?>
</div>
</body>
</html>
