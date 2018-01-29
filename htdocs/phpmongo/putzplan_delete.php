<?php
/*
Quellen:
http://php.net/manual/de/mongocollection.remove.php
*/
require 'vendor/autoload.php';

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collectionputzplan = $client->backshop->putzplan;
		$collectionputzplan->deleteOne(["personalnr" =>intval($_GET['personalnr'])]);
		header("Location: putzplan.php");
		?>
