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
		
        $DelSqlite = "DELETE FROM 'bestandteil' WHERE bestandteilNr=?";
		$result = $db->prepare($DelSqlite);
		echo "löschen";
		echo $DelSqlite;
		$res = $result -> execute(array($_GET['bestandteilNr']));
		if($res){
			header('location: bestand.php');
		} 
		else{
			echo "Löschen fehlgeschlagen";
		}		
	?>
