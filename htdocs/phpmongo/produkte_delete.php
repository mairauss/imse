	<?php
		/*
		Quellen:
		http://codingcyber.org/simple-crud-application-php-pdo-7284/
		https://www.tutorialspoint.com/sqlite/sqlite_delete_query.htm
		*/
        require 'vendor/autoload.php';

        $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
        $client = new MongoDB\Client($uri);
        $collection = $client->backshop->produkte;
        $document = $collection->findOne(['barcode' => $_GET['barcode']]);
        $id = $document['_id'];
        $collection->deleteOne(["_id" => $id]);
        header("Location: produkte.php");
	?>
