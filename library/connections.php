<?php

/**
 * Database Connections
 * THIS WORKS BASED OFF THE NAVIGATION MENU WORKING
 */
function acmeConnect(){
    $server='localhost';
    $database ='acme';
    $user = "iClient";
    $password = "tZAiecyikZJBuGcA";

    $dsn ="mysql:host=".$server.";dbname=".$database;

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $acmeLink = new PDO($dsn, $user, $password,$options);
            return $acmeLink;
        } catch (PDOException $exc) {
            header('location:../500.php');
            exit;
        }
}
acmeConnect();
?>