<?php
    require 'vendor/autoload.php';
    $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->backwaren;
    $collection->deleteOne(['artikelnr'=>intval($_GET['artikelnr'])]);
    header('location: backwarenmanager.php');
 ?>
