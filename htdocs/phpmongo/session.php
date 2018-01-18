<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
http://php.net/manual/en/sqlite3result.fetcharray.php
http://www.genecasanova.com/labs/memberships/form-sessions-php.html
https://stackoverflow.com/questions/28597617/convert-pdofetch-assoc-to-sqlite
http://php.net/manual/en/sqlite3result.fetcharray.php
*/
// Datenbankverbindung herstellen
require 'vendor/autoload.php';
session_start();
$user_check = $_SESSION['login_user'];

$uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
$client = new MongoDB\Client($uri);
$collection = $client->backshop->users;
$result = $collection->find( [ 'accesslevel' => $user_check] );
// Start a Session

$user_check = $_SESSION['login_user'];

foreach ($result as $entry) {
    //print_r($data);
    if (!isset($entry['email'])) continue;

    $login_session = $entry['email'];

}


if (!isset($login_session)) {
    // Redirecting To Home Page
    header('Location: index.php');
}
?>