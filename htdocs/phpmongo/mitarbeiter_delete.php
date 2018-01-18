<?php
/*
Quellen:
http://codingcyber.org/simple-crud-application-php-pdo-7284/
https://www.tutorialspoint.com/sqlite/sqlite_delete_query.htm
*/
try {
    require_once('dbconnection.php');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $error = $e->getMessage();
}

$DelSqlite = "DELETE FROM 'mitarbeiter' WHERE email=?";
$DelSqlite1 = "DELETE FROM 'konditor' WHERE email=?";
$DelSqlite2 = "DELETE FROM 'kuechengehilfe' WHERE email=?";
$result = $db->prepare($DelSqlite);
$result1 = $db->prepare($DelSqlite1);
$result2 = $db->prepare($DelSqlite2);

echo "löschen";
echo $DelSqlite;
$res = $result->execute(array($_GET['email']));
$res1 = $result1->execute(array($_GET['email']));
$res2 = $result2->execute(array($_GET['email']));


if ($res) {
    header('location: mitarbeiter.php');
} else {
    echo "Löschen fehlgeschlagen";
}

?>
