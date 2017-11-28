
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
                <li><a href="backwaren.php">Backwaren</a></li>
                <li><a href="produkte.php">Produkte</a></li>
		<li><a href="backen.php">Backen</a></li>
     		<li><a href="einkauf.php">Einkauf</a></li>
		<li><a href="bestand.php">Bestandteil</a></li>	
		<li><a href="view.php">Views</a></li>	
       </ul>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='kuechengehilfe.php' method='get'>
      <a href='kuechengehilfe.php'>Alle Kuechengehilfe(n)</a> ---
      Suche nach Name: 
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
    </form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $sql = "SELECT * FROM kuechengehilfe WHERE mname like '%" . $_GET['search'] . "%'";
  } else {
    $sql = "SELECT * FROM kuechengehilfe";
  }

  // execute sql statement
  $stmt = oci_parse($conn, $sql);
  oci_execute($stmt);
?>
<div>

  <form id='insertform' action='kuechengehilfe.php' method='get'>

    Neue Kuechegehilfe einfuegen:
<center>
	<table style='border: 5px solid #DDDDDD'>
	  <thead>
	    <tr>
          <th>Name</th>
	  <th>Betriebsmodus</th>          	
	  <th>Eistell.Datum</th>
          </tr>
	  </thead>

          <tbody>
	     <tr>
                <td>
                   <input id='mname' name='mname' type='text' size='30' value='<?php if (isset($_GET['mname'])) echo $_GET['mname']; ?>' />
                </td>
                <td>
                   <input id='betriebsmodus' name='betriebsmodus' type='text' size='15' value='<?php if (isset($_GET['betriebsmodus'])) echo $_GET['betriebsmodus']; ?>' />
                </td>
		 <td>
                   <input id='einstelldatum' name='einstelldatum' type='text' size='10' value='<?php if (isset($_GET['einstelldatum'])) echo $_GET['einstelldatum']; ?>' />
                </td>
               </tr>
           </tbody>
           </table>

<table style='border: 5px solid #DDDDDD'>
	<thead>
	    <tr>
           <th>Kleidung</th>
	    </tr>
	  </thead>
		<tbody>
	        <tr>
         	<td>
                   <input id='kkleidung' name='kkleidung' type='text' size='50' value='<?php if (isset($_GET['kkleidung'])) echo $_GET['kkleidung']; ?>' />
                </td>
       	      </tr>
           </tbody>
 	</table>
        
              <table style='border: 5px solid #DDDDDD'>
		<thead>
		    <tr>
		<th>Ausstattung</th>
		</tr>
		  </thead>
		<tbody>
		<tr>
		 <td>
                   <input id='ausstattung' name='ausstattung' type='text' size='80' value='<?php if (isset($_GET['ausstattung'])) echo $_GET['ausstattung']; ?>' />
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

   if (isset($_GET['betriebsmodus'])) 
  {
    //Prepare insert statementd
    $sql = "INSERT INTO kuechengehilfe VALUES('" .  $_GET['mname'] . "','" . $_GET['betriebsmodus'] . "',to_date('" . $_GET['einstelldatum'] . "','yyyymmdd')  ,'"
 . $_GET['kkleidung'] . "','"  . $_GET['ausstattung'] . "')";    
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


<div>
 <form id='delete' action='kuechengehilfe.php' method='get'>
  Loeschen die Konditoren (Name):
     <input id='mmname' name='mmname' type='text' size='30' value='<?php if (isset($_GET['mmname'])) echo $_GET['mmname']; ?>' />
     <input id='submit' type='submit' class="testbutton" value='Delete' />
 </form>
</div>

<?php
 //Handle Stored Procedure
 if (isset($_GET['mmname']))
 {
    //Call Stored Procedure  
    $nachname = $_GET['mmname'];
    $sproc = oci_parse($conn, 'begin kuch(:p1); end;');
    //Bind variables, p1=input (nachname)
    oci_bind_by_name($sproc, ':p1', $nachname);
    oci_execute($sproc);
    $conn_err=oci_error($conn);
    $proc_err=oci_error($sproc);
    //If there have been no Connection or Database errors, print department
    if(!$conn_err && !$proc_err){
if(!$nachname)
{
echo("<br><b>" . " Geben Sie bitte Name ein! ");
}
else
{
 echo("<br><b>" . $nachname . " wurde geloescht! ");
     oci_free_statement($sproc);
}      
}
    else{
      //Print potential errors and warnings
      print($conn_err);
      print_r($proc_err);
    }  
 }
 // clean up connections
?>

<br></br>

 <table style='border: 5px solid #DDDDDD'>
    <thead>
      <tr>
          <th>Name</th>
 	  <th>Betriebsmodus</th>
          <th>Einstell.Datum</th>
          <th>Kleidung</th>	
	  <th>Ausstattung</th>
      </tr>
    </thead>
    <tbody>
<?php
  // fetch rows of the executed sql query
  while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr>";
    echo "<td>" . $row['MNAME'] . "</td>";  
    echo "<td>" . $row['BETRIEBSMODUS'] . "</td>";
    echo "<td>" . $row['EINSTELLDATUM'] . "</td>";
    echo "<td>" . $row['KKLEIDUNG'] . "</td>";
    echo "<td>" . $row['AUSSTATTUNG'] . "</td>";
    echo "</tr>";
  }
?>
    </tbody>
  </table>

<div>Insgesamt <?php echo oci_num_rows($stmt); ?> Kuechengehilfe(n) gefunden!</div>
</center>
<br></br>
<?php  oci_free_statement($stmt); ?>


<?php
oci_close($conn);
?>
</div>
</body>
</html>