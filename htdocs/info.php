<?php
require 'php/vendor/autoload.php';

	$doc = array(
		"artikelnr" => 291,
		"bhersdatum" => '2018-01-20',
		"gname" => "Vollkornbrot",
		"bpreis" => 2,
		"bhaltdauer" => '2018-01-22',
		"menge" => 16
	);
	print_r($doc);
	echo "<br>";
	
	$connection = new MongoDB\Client("mongodb://team10:pass10@ds159187.mlab.com:59187/backshop");
	$collection = $connection->backshop->backwaren;
	$collectionEinkauf = $connection->backshop->einkaeufe;
	
	//insert
	$result = $collection->insertOne($doc);
	echo "Anzahl der eingefügten Dokumente: " . $result->getInsertedCount() . "<br>";
	
	
	//update
	$update = $collection->updateOne(
		['bhersdatum' => "2018-01-20", 'artikelnr' => 1011],
		['$set' => ['bpreis' => 111]]
	);
	
	$suchbegriff = 1014;
	//select
	$result = $collection->find(['artikelnr' => $suchbegriff]);
	foreach ($result as $entry) {
		echo $entry['gname'], "<br>";
	}
	
	//delete
	$delete = $collection->deleteOne(['artikelnr' => 291, 'bpreis' => 2]);
	echo "Anzahl der gelöschten Dokumente: " . $delete->getDeletedCount() . "<br>";
	
	$result = $collectionEinkauf->find(['bestellnr' => 1]);
	foreach ($result as $entry) {
		echo $entry['email'], "<br>";
	}
	
	
?>