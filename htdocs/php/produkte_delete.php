	<?php
		/*
		Quellen:
		http://codingcyber.org/simple-crud-application-php-pdo-7284/
		https://www.tutorialspoint.com/sqlite/sqlite_delete_query.htm
		*/
		try{
			require_once('dbconnection.php');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			$error = $e->getMessage();
		}
		
		$DelSqlite = "DELETE FROM 'produkt' WHERE barcode=?";
		$result = $db->prepare($DelSqlite);
		echo "löschen";
		echo $DelSqlite;
		$res = $result -> execute(array($_GET['barcode']));
		if($res){
			header('location: produkte.php');
		} 
		else{
			echo "Löschen fehlgeschlagen";
		}
		
	?>
