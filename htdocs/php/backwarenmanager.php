
<?php
  include('session.php');
  $user = '';
  $pass = '';
  $database = '';




  class DB extends SQLite3
{
    function __construct()
    {
        $this->open('../../backshop.db');
    }
}


  //$conn = open('backshop.db');
  // establish database connection
  $conn = new DB();
  if ($conn->lastErrorMsg()!="not an error") {
      die($conn->lastErrorMsg());
  }

  if (isset($logedinuser)) {
    $resultsession = $conn->query($ses_sql);
    $data = $resultsession->fetch(PDO::FETCH_ASSOC);
    //Administrator Rechte
    if ($data['accesslevel'] >= 1) {
        //echo "Access Level 3 oder 9";
    } else {
        echo "Sie haben kein Zugriff auf diese Seite";
        header('Location: baeckerei.php');
    };
} else {
    echo "Unzeireichende User Berechtigung";
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
<?php if (isset($logedinuser)): ?>
    <?php if ($data['accesslevel'] == 9): ?>
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
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($data['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="backen.php">Backen</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>
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
    $stmt = $conn->prepare( "SELECT backen.personalnr, backwaren.* from backwaren
                            inner join backen on backwaren.artikelnr like :id
                            and backen.artikelnr like backwaren.artikelnr;");
    $countstmt = $conn->prepare( "SELECT count(*) FROM backwaren WHERE artikelnr like :id ");
    $stmt->bindValue(':id',$_GET['search'],SQLITE3_INTEGER);
    $countstmt->bindValue(':id',$_GET['search'],SQLITE3_INTEGER);
  } else {
    $stmt = $conn->prepare("SELECT backen.personalnr, backwaren.* from backwaren
                          left join backen on backen.artikelnr like backwaren.artikelnr;");
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
                <input id='menge' name='menge' type='number' size='10' value='<?php if (isset($_GET['menge'])) echo $_GET['menge']; echo ''?>' />
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

      $insstmt = $conn->prepare( "INSERT INTO backwaren VALUES(:nr, :name, :preis, :herdat, :haltdat, :menge)");
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
    }
  ?>

  <table style='border: 5px solid #DDDDDD'>
      <thead>
        <tr>
          <th>Mitarbeiter</th>
          <th>ArtikelNr</th>
          <th>Name</th>
          <th>Preis</th>
          <th>Herstell.Datum</th>
          <th>Haltbar.Dauer</th>
          <th>Menge</th>
        </tr>
      </thead>
      <tbody>
  <form id='updateForm' action='backwarenmanager.php' methode='post'>
<input id ="artikel" name="artikel" type="hidden" value="artikel" />
  <?php

    // fetch rows of the executed sql query
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {

      echo "<tr>";
     echo "<td>" . $row['personalnr'] . "</td>";
     echo "<td>" . $row['artikelnr'] . "</td>";
     echo "<td>" . $row['bhersdatum'] . "</td>";
      echo "<td>" . $row['gname'] . "</td>";
      echo "<td>" . $row['bpreis'] . "</td>";
      echo "<td>" . $row['bhaltdauer'] . "</td>";
      echo "<td>" . $row['menge'] . "</td>";
      ?>

      <td>
        <input id='updatemenge' name='updatemenge' type='number' size='10' value='<?php if (isset($_GET['updatemenge'])) echo $_GET['updatemenge']; echo'' ?>' />
      </td>
      <td><input id='updateartikelnr' name= 'updateartikelnr' type="hidden" value=' <?php echo $row['artikelnr']?>'/></td>

    <?php
      echo "</tr>";
    }
  ?>

      </tbody>
    </table>
    <input type="submit" id='updateBtn' name='updateBtn' class="testbutton" value="Update"/>
  </form>
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
