
<?php
require 'vendor/autoload.php';

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->backwaren;


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
		$artikel = intval($_GET['search']);
    $cursor = $collection->find(['artikelnr' => $artikel]);
		$count = $collection->count(['artikelnr' => $artikel]);
  } else {
    $cursor = $collection->find();
		$count = $collection->count();
  }

?>



  <div>
  <form id='insertform' action='backwarenmanager.php' method='get'>
    <center>
        <!-- Neue Backwaren einfuegen: -->
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
			<input id='submit' type='submit' class="testbutton" value='Insert' />
    </table>
    </center>
  </form>
  </div>

  <?php
  if (isset($_GET['artikelnr']))
   {
		 echo 'Insert button';
		 $collection->insertOne([
			 'artikelnr'=>intval($_GET['artikelnr']),
			 'bhersdatum'=>$_GET['bhersdatum'],
			 'gname'=>$_GET['gname'],
			 'bpreis'=>$_GET['bpreis'],
			 'bhaltdauer'=>$_GET['bhaltdauer'],
			 'menge'=>$_GET['menge'],
			 'personalnr'=>$_GET['personalnr']
		 ]);
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
					<th>Kurz vor Ablauf</th>
					<th>Delete</th>
        </tr>
      </thead>
      <tbody>
<input id ="artikel" name="artikel" type="hidden" value="artikel" />
  <?php
    foreach($cursor as $row) {
      echo "<tr>";
      echo "<td>" . $row['personalnr'] . "</td>";
      echo "<td>" . $row['artikelnr'] . "</td>";
      echo "<td>" . $row['gname'] . "</td>";
      echo "<td>" . $row['bpreis'] . "</td>";
      echo "<td>" . $row['bhersdatum'] . "</td>";
      echo "<td>" . $row['bhaltdauer'] . "</td>";
      echo "<td>" . $row['menge'] . "</td>";
      ?>

      <td><a href="update_backware.php?artikelnr=<?php echo $row['artikelnr'];?>&bpreis=<?php echo $row['bpreis']?>">50% Rabatt</a></td>
			<td><a href="delete_backware.php?artikelnr=<?php echo $row['artikelnr'];?>">Delete</a></td>
    <?php
      echo "</tr>";
    }
  ?>

      </tbody>
    </table>
  <div>Insgesamt <?php echo $count; ?> Backwaren gefunden!</div>
  </center>
  <br></br>
  </div>
  </body>
  </html>
