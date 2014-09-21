<?php 

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

include("logon.php");

function streamDelPic($qid,$qfile,$quser,$qcodeschool,$qtype){


    //ok so first off let's get rid of this shit from the filesystem+
    $path = '../files/'.$qcodeschool.'/';
    unlink($path.$qfile);
    unlink($path.'/120/'.$qfile);
    unlink($path.'/320/'.$qfile);
    unlink($path.'/37/'.$qfile);
    unlink($path.'/72/'.$qfile);

    if ($_SESSION['qstream'] != '0'){
        $newname = "streams_".$_SESSION['qstream'];
    } else {
        $newname = "streams_".$qcodeschool;
    }

    //we create a stream with the school"s code if it doesn"t exist
    $con = new MongoClient();
    $db = $con->$newname;
    $id = new MongoId($qid);


    //qtype 2 son las imágenes que no existen en la DB porque no se han guardado
    if($qtype == "2"){

      echo "NOT ACTIONS PERFORMED";
      
    } else if($qtype == "1"){

      //echo"0<br>";
      //vamos a hacer esto de la forma lenta e ineficiente al reconstruir todos los mensaJES
      $collection = $db->messages;
      $cursor = $collection->find(array("_id"=>$id));
      $cursor->limit(30);
      $cursor->sort(array('tstamp' => -1));

      $newresp = array();
      foreach ($cursor as $obj) {

        for ($a = 0; $a < sizeof($obj['pics']); $a++){

          //echo"2<br>";
          if ($obj['pics'][$a] != $qfile){
            array_push($newresp, $obj['pics'][$a]);
          }

        }
      }

      //print_r($newresp);
      //echo "<br>----------------<br>";

      
      //una vez reconstridos lo smensajes lo guardamos
      $db->messages->update( array("_id"=>$id), array('$set' => array("pics" => $newresp)) );
      echo "ok";

    }
}


if (isset($_POST["qcodeschool"])){
    streamDelPic($_POST["qid"],$_POST["qfile"],$_POST["quser"],$_POST["qcodeschool"],$_POST["qtype"]);
}


?>