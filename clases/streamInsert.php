<?php 

include('general/passgen.php');
include("logon.php");

function streaminsert($qmsgid,$qcodeschool,$qiduser,$qmsg,$qtowho,$qpics){

    date_default_timezone_set('Mexico/General');
    //$tstamp = date('d-m-Y H:i:s');
    $tstamp = time();

    if ($_SESSION['qstream'] != '0'){
        $newname = "streams_".$_SESSION['qstream'];
    } else {
        $newname = "streams_".$qcodeschool;
    }

    //we create a stream with the school's code if it doesn't exist
    $con = new MongoClient(); // Connexion sur localhost:27017
    $db = $con->$newname;

    $id = new MongoId($qmsgid); 

    $singled = generatePassword(6);

    //are there any images? if so let's create an array for them
    $lespics = array();
    if (strlen($qpics) > 1){
      $pics = explode('|', $qpics);
      for ($t=0; $t < sizeof($pics); $t++){
        array_push($lespics, $pics[$t]);
      }
    }

    $new_msg = array(
      "user" => $qiduser,
      "msg" => $qmsg,
      "towho" =>  $qtowho,
      "tstamp" => $tstamp,
      "uid" => $tstamp.$singled,
      "pics" => $lespics,
      "flag" => 0
    );
    
    error_reporting(E_ALL); 
    ini_set( 'display_errors','1');

    $db->messages->update( array("_id"=>$id), array('$push' => array("resp" => $new_msg)) );

    echo $tstamp.$singled;

}
 
if (isset($_POST['qcodeschool'])){
    streaminsert($_POST['qmsgid'],$_POST['qcodeschool'],$_POST['qiduser'],$_POST['qmsg'],$_POST['qtowho'],$_POST['qpics']);
}

?>