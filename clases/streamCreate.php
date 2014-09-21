<?php 

error_reporting(E_ALL); 
ini_set( 'display_errors','1');
echo "0<br>";
$con = new MongoClient(); // Connexion sur localhost:27017
$db = $con->invoices_c2d35dca3f4e8a58458315cb07d66c4f;

$article = array("key" => '00', 
             "value" => '01'
        );

$db->store->insert($article);
echo "OK";
?>