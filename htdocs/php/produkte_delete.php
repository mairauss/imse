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
        $DelSqlite1 = "DELETE FROM 'bestandteil' WHERE barcode=?";
		$result = $db->prepare($DelSqlite);
        $result1 = $db->prepare($DelSqlite1);
		echo "löschen";
		echo $DelSqlite;
		$res = $result -> execute(array($_GET['barcode']));
        $res1 = $result1 -> execute(array($_GET['barcode']));
		if($res){
			header('location: produkte.php');
		} 
		else{
			echo "Löschen fehlgeschlagen";
		}
		
	?>
