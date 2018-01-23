<?php
/*
Quellen:
http://php.net/manual/de/mongocollection.remove.php
*/
require 'vendor/autoload.php';

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
		$client = new MongoDB\Client($uri);
		$collection = $client->backshop->users;
		$document = $collection->findOne(['email' => $_GET['email']]);
		$id = $document['_id'];
		$collection->deleteOne(["_id" => $id]);
		header("Location: kunde.php");
?>
