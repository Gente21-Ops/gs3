<?php

error_reporting(E_ALL); 
ini_set( 'display_errors','1');


//------------DB LOGIC STARTS ----------//
if ($_SESSION['qstream'] != '0'){
    $newname = "streams_".$_SESSION['qstream'];
} else {
    $newname = "streams_".$_SESSION['qescuelacode'];
}

$con = new MongoClient(); // Connexion sur localhost:27017
$db = $con->$newname;

$collection = $db->messages;

$cursor = $collection->find(array('flag' => 0));
$cursor->limit(30);
$cursor->sort(array('tstamp' => -1));
//---------------DB LOGIC END ----------//




//------------ DATE TRANSLATOR ----------//
function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}








?>