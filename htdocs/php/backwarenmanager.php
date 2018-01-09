//TODO:
//preis format
//delete
//Update
//+Menge atribute/column
<?php
  $user = '';
  $pass = '';
  $database = '';


  class DB extends SQLite3
{
    function __construct()
    {
        $this->open('backshop.db');
    }
}


  //$conn = open('backshop.db');
  // establish database connection
  $conn = new DB();
  if ($conn->lastErrorMsg()!="not an error") {
      die($conn->lastErrorMsg());
  }
  ?>

  <html>
  <title>Lecker: Backwaren</title>
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
        <li><a class="active" href="backwarenmanager.php">Backwaren Manager</a></li>
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
          <form id='searchform' action='backwarenmanager.php' method='get'>
            <a href='backwarenmanager.php'>Alle Backenwaren</a>
            Suche nach ArtikelNr:
            <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
            <input id='submit' type='submit' class="testbutton" value='Search' />
          </form>
        </div>

<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
    $stmt = $conn->prepare( "SELECT * FROM backwaren WHERE artikelnr like :id ");
    $countstmt = $conn->prepare( "SELECT count(*) FROM backwaren WHERE artikelnr like :id ");
    $stmt->bindValue(':id',$_GET['search'],SQLITE3_INTEGER);
    $countstmt->bindValue(':id',$_GET['search'],SQLITE3_INTEGER);
  } else {
    $stmt = $conn->prepare("SELECT * FROM backwaren");
    $countstmt = $conn->prepare("SELECT count(*) FROM backwaren");
  }


  // execute sql statement
  $result = $stmt->execute();
?>



  <div>
  <form id='insertform' action='backwarenmanager.php' method='get'>
    <center>
        Neue Backwaren einfuegen:
      <table style='border: 5px solid #DDDDDD'>
        <thead>
          <tr>
            <th>ArtikelNr</th>
            <th>Name</th>
            <th>Preis</th>
          </tr>
        </thead>
        <tbody>
           <tr>
              <td>
                 <input id='artikelnr' name='artikelnr' type='number' size='10' value='<?php if (isset($_GET['artikelnr'])) echo $_GET['artikelnr']; ?>' />
              </td>
              <td>
                 <input id='gname' name='gname' type='text' size='30' value='<?php if (isset($_GET['gname'])) echo $_GET['gname']; ?>' />
              </td>
              <td>
                 <input id='bpreis' name='bpreis' type='number' size='10' value='<?php if (isset($_GET['bpreis'])) echo $_GET['bpreis']; ?>' />
              </td>
            </tr>
        </tbody>

      <table style='border: 5px solid #DDDDDD'>
        <thead>
          <tr>
            <th>Herstell.Datum</th>
            <th>Haltbar.Dauer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                <input id='bhersdatum' name='bhersdatum' type='text' size='10' value='<?php if (isset($_GET['bhersdatum'])) echo $_GET['bhersdatum']; ?>' />
            </td>
            <td>
                <input id='bhaltdauer' name='bhaltdauer' type='text' size='10' value='<?php if (isset($_GET['bhaltdauer'])) echo $_GET['bhaltdauer']; ?>' />
            </td>
          </tr>
       </tbody>
      </table>
      <table style='border: 5px solid #DDDDDD'>
        <thead>
          <tr>
            <th>Menge</th>
            <th>Mitarbeiter</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                <input id='menge' name='menge' type='number' size='10' value='<?php if (isset($_GET['menge'])) echo $_GET['menge']; ?>' />
            </td>
            <td>
                <input id='personalnr' name='personalnr' type='text' size='10' value='<?php if (isset($_GET['personalnr'])) echo $_GET['personalnr']; ?>' />
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
     if (isset($_GET['artikelnr']))
    {

      $insstmt = $conn->prepare( "INSERT INTO backwaren VALUES(:nr, :herdat, :name, :preis, :haltdat, :menge)");
      $insstmt->bindValue(':nr',$_GET['artikelnr'],SQLITE3_INTEGER);
      $insstmt->bindValue(':name',$_GET['gname'],SQLITE3_TEXT);
      $insstmt->bindValue(':preis',$_GET['bpreis'],SQLITE3_FLOAT);
      $insstmt->bindValue(':herdat',$_GET['bhersdatum'],SQLITE3_BLOB);
      $insstmt->bindValue(':haltdat',$_GET['bhaltdauer'],SQLITE3_BLOB);
      $insstmt->bindValue(':menge',$_GET['menge'],SQLITE3_INTEGER);
      $insresult = NULL;

      $backenstmt = $conn->prepare("INSERT INTO backen VALUES(:personalnr, :artikelnr)");
      $backenstmt->bindValue(':personalnr',$_GET['personalnr'],SQLITE3_INTEGER);
      $backenstmt->bindValue(':artikelnr',$_GET['artikelnr'],SQLITE3_INTEGER);
      $backresult = NULL;
      try{
        $conn->enableExceptions(true);
        // execute sql statements
        $insresult = $insstmt->execute();
        $backresult = $backenstmt->execute();
      } catch(Exception $e){
        echo "<script type='text/javascript'>alert('Could not Insert');</script>";
      }
      if($insresult && $backresult){
        echo "<script type='text/javascript'>alert('Successfully inserted');</script>";
      }
      //Print potential errors and warnings
      // else{
      //    print("could not insert");
      // }
    }
  ?>

  <table style='border: 5px solid #DDDDDD'>
      <thead>
        <tr>
          <th>ArtikelNr</th>
          <th>Herstell.Datum</th>
          <th>Name</th>
          <th>Preis</th>
          <th>Haltbar.Dauer</th>
          <th>Menge</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
  <?php
    // fetch rows of the executed sql query
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      ?>
<form id='Form' action='backwarenmanager.php' methode='post'>
<?php
      echo "<tr>";
      echo "<td>" . $row['artikelnr'] . "</td>";
      echo "<td>" . $row['bhersdatum'] . "</td>";
      echo "<td>" . $row['gname'] . "</td>";
      echo "<td>" . $row['bpreis'] . "</td>";
      echo "<td>" . $row['bhaltdauer'] . "</td>";
      echo "<td>" . $row['menge'] . "</td>";
      ?>

      <td>
        <input id='menge' name='menge' type='number' size='10' value='<?php if (isset($_GET['menge'])) echo $_GET['menge']; ?>' />
        <input id='update' type='submit' class="testbutton" value='Update' />
        <!-- <a href="mitarbeiter_delete.php?email=<?php echo $r['email']; ?>">Delete</a>-->
      </td>
      <td>
        <input id='delete' type='submit' class="testbutton" value='Delete' />
      </td>
      <td><input id= <?php echo $row['artikelnr']?> name= <?php echo $row['artikelnr']?> type="hidden" value = <?php echo $row['artikelnr']?>/></td>
  </form>
    <?php
      echo "</tr>";
    }
    if (isset($_POST['update']))
   {
     echo "<script type='text/javascript'>alert('Updating');</script>";
     $sstmt = $conn->prepare("SELECT menge FROM backwaren WHERE artikelnr like :artikelnr");
     $sstmt->bindValue(':artikelnr', $_POST['artiketnr'], SQLITE3_INTEGER);

     $sresult = NULL;
     try{
       $conn->enableExceptions(true);
       // execute sql statements
       $sresult = $sstmt->execute();
     } catch(Exception $e){
      echo "<script type='text/javascript'>alert('Could not update');</script>";
     }
    $menge =  $sresult->fetchArray();
     echo "<script type='text/javascript'>alert('$menge');</script>";
   }
  ?>
      </tbody>
    </table>

  <div>Insgesamt
  <?php
    $countresult = $countstmt->execute();
    $count = $countresult->fetchArray();
    if(current($count)) {
      echo current($count);
    }
    else {
      echo "0";
    }
  ?>
  Backwaren gefunden!</div>
  </center>
  <br></br>

  <?php
    $conn->close();
  ?>
  </div>
  </body>
  </html>
