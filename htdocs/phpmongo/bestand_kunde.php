
<?php
    require 'vendor/autoload.php';
    include('session.php');
    $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
    $client = new MongoDB\Client($uri);
    $collection = $client->backshop->users;
    $user_check = $_SESSION['login_user'];
    $logedinuser = $login_session;
    $cursor = $collection->find(['email' => $user_check]);
    foreach ($cursor as $document) {
        if (isset($logedinuser)) {
            //Administrator Rechte
            if ($document['accesslevel'] >= 1) {
                // echo "Access Level 9";
            } else {
                echo "Sie haben kein Zugriff auf diese Seite";
                header('Location: baeckerei.php');
            };
        } else {
            echo "Unzeireichende User Berechtigung";
        }
    }

    ?>

<html>
<title>Lecker: Bestandteil</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

<?php if (!isset($logedinuser)): ?>
    <ul>
        <li><a href="baeckerei.php">Lecker</a></li>
    </ul>
<?php endif; ?>
<?php if (isset($logedinuser)): ?>
    <?php if ($document['accesslevel'] == 9): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="mitarbeiter.php">Mitarbeiter</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="kuechengehilfe.php">Kuechengehilfe</a></li>
            <li><a href="kunde.php">Kunde</a></li>
            <li><a href="backwarenmanager.php">Backwaren Manager</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 1): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="bestand_kunde.php">Bestandteil</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 2): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
    <?php if ($document['accesslevel'] == 3): ?>
        <ul>
            <li><a href="baeckerei.php">Lecker</a></li>
            <li><a href="konditor.php">Konditor</a></li>
            <li><a href="backwaren.php">Unsere Backwaren</a></li>
            <li><a href="einkauf.php">Warenkorb</a></li>
            <li><a href="produkte.php">Produkte</a></li>
            <li><a class="active" href="bestand.php">Bestandteil</a></li>
            <li><a href="putzplan.php">Putzplan</a></li>
            <li><a href="session_logout.php">Logout</a></li>
        </ul>
    <?php endif; ?>
<?php endif; ?>

<br></br>

<div id="wrapper">
<center>
  <div>
    <form id='searchform' action='bestand_kunde.php' method='get'>
      Geben Sie Backware Name ein:
      <input id='search' name='search' type='text' size='15' value='<?php if (isset($_GET['search'])) echo $_GET['search']; ?>' />
      <input id='submit' type='submit' class="testbutton" value='Search' />
</form>
  </div>
<?php
  // check if search view of list view
  if (isset($_GET['search'])) {
      $gname = intval($_GET['search']);
      $cursor = $collection->find(['gname' => $gname]);
      $count = $collection->count(['gname' => $gname]);
  } else {
      $cursor = $collection->find();
      $count = $collection->count();
  }
?>

<br></br>
<tbody>

<?php
    foreach ($cursor as $document) {
        ?>
<tr>
<td><?php echo $document['barcode']; ?></td>
<td><?php echo $document['pname']; ?></td>
</tr>
<?php }
    ?>
</tbody>
</table>
</center>
<br></br>
</div>
</body>
</html>
