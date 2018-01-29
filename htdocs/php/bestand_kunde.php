<?php
    require 'vendor/autoload.php';
    include('session.php');
    $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
    $client = new MongoDB\Client($uri);
    ?>

<html>
<title>Lecker: Bestandteil</title>
<head>
 <link rel="stylesheet" href="index.css" />
</head>
<body>
<img src="b5.png" alt="logo" width="500" height="300">
<br></br>

        <ul> 
		<li><a href="baeckerei.php">Lecker</a></li>
        <li><a href="backwaren.php">Unsere Backwaren</a></li>
        <li><a href="einkauf.php">Warenkorb</a></li>
        <li><a class="active" href="bestand_kunde.php">Bestandteil</a></li>
		<li><a href="session_logout.php">Logout</a></li>
       </ul>

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
<table boarder="1">
<?php
    // check if search view of list view
    $collectionbestandteile = $client->backshop->bestandteile;
    if (isset($_GET['search'])) {
        //$artikel = intval($_GET['search']);
        $cursor2 = $collectionbestandteile->find(['gname' => $_GET['search']]);
    } else {
        $cursor2 = $collectionbestandteile->find();
    }
    ?>


<br></br>
<tbody>

<?php
    if (isset($_GET['search'])) {
?>
        <table style="width:30%">
        <thead>
        <tr>
        <th>Produkte</th>
        </tr>
        </thead>

<?php
    foreach ($cursor2 as $documentbestand) {
        ?>
<tr>
<td><?php echo $documentbestand['pname']; ?></td>
</tr>
<?php }  ?>
</tbody>
</table>
</center>
<br></br>
</div>
</body>
</html>
