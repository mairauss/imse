
<?php
  $user = '...';
  $pass = '...';
  $database = '...';
 
  // establish database connection
  $conn = oci_connect($user, $pass, $database);
  if (!$conn) exit;

 //var_dump($_GET);
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
                <li><a href="kunde/kunde.php">Kunde</a></li>
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="view.php">Views</a></li>	
		<li><a href="logout.php">Logout</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='mitarbeiter.php' method='get'>
      <a href='mitarbeiter.php'>Alle Mitarbeiter</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM mitarbeiter WHERE mname like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM mitarbeiter";
  }

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>

 <div>
 <form id='searchabt' action='mitarbeiter.php' method='get'>
   Suche PersonalNr einer bestimmter Mitarbeiter (name):
     <input id='nachname' name='nachname' type='text' size='20' value='<?php if (isset($_GET['mmname'])) echo $_GET['nachname']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />

 </form>
</div>

 <?php
 //Handle Stored Procedure
 if (isset($_GET['nachname']))
 {
    //Call Stored Procedure  
    $nachname = $_GET['nachname'];
    $abtnr='';
    $sproc = oci_parse($conn, 'begin persnr(:p1, :p2); end;');
    //Bind variables, p1=input (nachname), p2=output (abtnr)
    oci_bind_by_name($sproc, ':p1', $nachname);
    oci_bind_by_name($sproc, ':p2', $abtnr, 20);
    oci_execute($sproc);
    $conn_err=oci_error($conn);
    $proc_err=oci_error($sproc);
    //If there have been no Connection or Database errors, print department
    if(!$conn_err && !$proc_err){
       echo("<br><b>" . $nachname . " hat PersonalNr =  " . $abtnr . "</b><br>" );  // prints OUT parameter of stored procedure
    }
    else{
      //Print potential errors and warnings
      print($conn_err);
      print_r($proc_err);
    }  
 }
?>


<br></br>


<div>

  <form id='insertform' action='mitarbeiter.php' method='get'>

    Neue Mitarbeiter einfuegen:
<center>
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
          <th>Name</th>
          <th>Gehalt</th>
          </tr>
	  </thead>

          <tbody>
	     <tr>
                <td>
                   <input id='mname' name='mname' type='text' size='50' value='<?php if (isset($_GET['mname'])) echo $_GET['mname']; ?>' />
                </td>
                <td>
                   <input id='gehalt' name='gehalt' type='number' size='20' value='<?php if (isset($_GET['gehalt'])) echo $_GET['gehalt']; ?>' />
                </td>
                </tr>
           </tbody>
           </table>

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
                   <input id='mgeburtsdatum' name='mgeburtsdatum' type='text' size='12' value='<?php if (isset($_GET['mgeburtsdatum'])) echo $_GET['mgeburtsdatum']; ?>' />
                </td>
                <td>
                   <input id='bname' name='bname' type='text' size='12' value='<?php if (isset($_GET['bname'])) echo $_GET['bname']; ?>' />
                </td>
	      </tr>
           </tbody>
 	</table>
        

        <input id='submit' type='submit' class="testbutton" value='Insert' />
</center>
  </form>
</div>

<?php
  //Handle insert

   if (isset($_GET['mname'])) 
  {
    //Prepare insert statementd
    $sql = "INSERT INTO mitarbeiter VALUES('" . $_GET['mname'] . "'," . $_GET['gehalt'] .
 ",to_date('" . $_GET['mgeburtsdatum'] . "','yyyymmdd')  ," . " mitar_persnr.nextval" . ",'"  . $_GET['bname'] . "')";    
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
          <th>PersonalNr</th>
          <th>Name</th>
          <th>Gehalt</th>
          <th>Geburtsdatum</th>
          <th>Baeckerei</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['PERSONALNR'] . "</td>";
    echo "<td>" . $row['MNAME'] . "</td>";      
    echo "<td>" . $row['GEHALT'] . "</td>";
    echo "<td>" . $row['MGEBURTSDATUM'] . "</td>";
    echo "<td>" . $row['BNAME'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Mitarbeiter gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>


<?php
oci_close($conn);
?>
</div>
</body>
</html>
