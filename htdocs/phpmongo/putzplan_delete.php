<?php
/*
Quellen:
http://php.net/manual/de/mongocollection.remove.php
*/
require 'vendor/autoload.php';

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		
		$client = new MongoDB\Client($uri);
		$collectionputzplan = $client->backshop->putzplan;
		$document = $collectionputzplan->findOne(['personalnr' => $_GET['personalnr']]);
		$id = $document['_id'];
		$collectionputzplan->deleteOne(["_id" => $id]);
		header("Location: putzplan.php");
?>
