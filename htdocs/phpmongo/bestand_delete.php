	<?php
		/*
		Quellen:
		http://codingcyber.org/simple-crud-application-php-pdo-7284/
		https://www.tutorialspoint.com/sqlite/sqlite_delete_query.htm
		*/

        require 'vendor/autoload.php';

        $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
        $client = new MongoDB\Client($uri);
				$collectionbestandteile = $client->backshop->bestandteile;
				$collectionbestandteile->deleteOne(['bestandteilNr'=>intval($_GET['bestandteilNr'])]);
        header("Location: bestand.php");
	?>
