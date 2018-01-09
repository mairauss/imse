<?php
/*
Quellen:
https://www.formget.com/login-form-in-php/
http://www.genecasanova.com/labs/memberships/form-sessions-php.html
*/
// Starting Session for User Restriction
session_start();
// Variable To Store Error Message
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['passwort'])) {
        $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
    } else {
        // Initializing $email and $passwort
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        // Datenbankverbindung herstellen
        try {
            require_once('dbconnection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        // SQL Select for all Registered Users
        $sql = "SELECT * FROM (SELECT email,passwort from kunde UNION select email,passwort from mitarbeiter) AS U where u.passwort='$passwort' AND u.email='$email'";
        $result = $db->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            if ($data['email'] == $email && $data['passwort'] == $passwort) {
                // Session starten
                $_SESSION['login_user'] = $email;
                // Zur Startseite weiterleiten
                header("location: index.php");
            }
        } else {
            $error = "E-Mail Adresse oder Passwort sind fehlerhaft";
        }
        $db = null;
    }
}
?>