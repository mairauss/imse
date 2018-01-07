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

    </table>
    </center>
    <input id='submit' type='submit' class="testbutton" value='Insert' />
  </form>
  </div>

  <?php
    //Handle insert
     if (isset($_GET['artikelnr']))
    {

      $insstmt = $conn->prepare( "INSERT INTO backwaren VALUES(:nr, :name, :preis, :herdat, :haltdat)");
      $insstmt->bindValue(':nr',$_GET['artikelnr'],SQLITE3_INTEGER);
      $insstmt->bindValue(':name',$_GET['gname'],SQLITE3_TEXT);
      $insstmt->bindValue(':preis',$_GET['bpreis'],SQLITE3_FLOAT);
      $insstmt->bindValue(':herdat',$_GET['bhersdatum'],SQLITE3_BLOB);
      $insstmt->bindValue(':haltdat',$_GET['bhaltdauer'],SQLITE3_BLOB);
      $insresult = NULL;
      try{
        $conn->enableExceptions(true);
        // execute sql statement
        $insresult = $insstmt->execute();
      } catch(Exception $e){
        echo "could not insert";
      }
      if($insresult){
        print("Successfully inserted");
        print("<br>");
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
          <th>Name</th>
          <th>Preis</th>
          <th>Herstell.Datum</th>
          <th>Haltbar.Dauer</th>
        </tr>
      </thead>
      <tbody>
  <?php
    // fetch rows of the executed sql query
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      echo "<tr>";
      echo "<td>" . $row['artikelnr'] . "</td>";
      echo "<td>" . $row['gname'] . "</td>";
      echo "<td>" . $row['bpreis'] . "</td>";
      echo "<td>" . $row['bhersdatum'] . "</td>";
      echo "<td>" . $row['bhaltdauer'] . "</td>";
      ?>
      <form id='deleteForm' action='backwarenmanager.php' methode='delete'>
      <input id='submit' type='submit' class="testbutton" value='Search' />
    <?php
      echo "</tr>";
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
