<?php

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

$school = "i_".$_SESSION['qescuelacode'];
//vamos a chechar si existe este registro primero
$con = new Mongo(); // Connexion sur localhost:27017
$db = $con->$school;


$collection = $db->invoices;

$userfiscal = $collection->findOne(array('code' => $_GET['qcode']));

/*
if (sizeof($userfiscal) > 1){
    print_r($userfiscal);
} else {
    echo "NO DATA, looking for: ".$_GET['qcode']." from DB: ".$school;
}
*/

?>