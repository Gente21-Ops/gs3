<?php 



error_reporting(E_ALL); 
ini_set( 'display_errors','1');

//stream initialization
include("logon.php");

function streamAdd($name,$user,$msg,$towho,$qpics){

    date_default_timezone_set('Mexico/General');
    //$tstamp = date('d-m-Y H:i:s');
    $tstamp = time();

    if ($_SESSION['qstream'] != '0'){
        $newname = "streams_".$_SESSION['qstream'];
    } else {
        $newname = "streams_".$_SESSION['qescuelacode'];
    }

    //we create a stream with the school's code if it doesn't exist
    $con = new MongoClient(); // Connexion sur localhost:27017
    $db = $con->$newname;

    //are there any images? if so let's create an array for them
    $lespics = array();
    if (strlen($qpics) > 1){
      $pics = explode('|', $qpics);
      for ($t=0; $t < sizeof($pics); $t++){
        array_push($lespics, $pics[$t]);
      }
    }

    $msgs = array("user" => $user, 
                 "msg" => $msg, 
                 "towho" =>  $towho, 
                 "tstamp" => $tstamp,
                 "flag" => 0,
                 "scode" => $name,
                 "pics" => $lespics,
                 "resp" => array()
            );

    $db->messages->insert($msgs);
    echo $msgs['_id'];
    
}

streamAdd($_POST['qscode'],$_POST['quser'],$_POST['qmsg'],$_POST['qtowho'],$_POST['qpics']);


?>