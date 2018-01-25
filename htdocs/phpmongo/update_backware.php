<?php
  require 'vendor/autoload.php';
  $uri = "mongodb://team10:pass10@ds159187.mlab.com:59187/backshop";
  $client = new MongoDB\Client($uri);
  $collection = $client->backshop->backwaren;
  $newpreis = doubleval($_GET['bpreis'])/2;
  $collection->updateOne(
    ['artikelnr' => intval($_GET['artikelnr'])],
    ['$set' => ['bpreis'=> $newpreis]]
  );
  header('location: backwarenmanager.php');

 ?>
