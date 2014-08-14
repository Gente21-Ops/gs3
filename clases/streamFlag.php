<?php 

include("logon.php");

function streamFlag($qmsgid,$qcodeschool,$qtype,$qrespid){

    if ($_SESSION['qstream'] != '0'){
        $newname = "streams_".$_SESSION['qstream'];
    } else {
        $newname = "streams_".$qcodeschool;
    }

    //we create a stream with the school"s code if it doesn"t exist
    $con = new MongoClient();
    $db = $con->$newname;
    $id = new MongoId($qmsgid); 
    
    

    if($qtype == "2"){

      $db->messages->update( array("_id"=>$id), array("$set" => array("flag" => "1")) );
      echo "ok";
    } else if($qtype == "1"){

      //echo"0<br>";
      //vamos a hacer esto de la forma lenta e ineficiente al reconstruir todos los mensaJES
      $collection = $db->messages;
      $cursor = $collection->find(array("_id"=>$id));
      $cursor->limit(30);
      $cursor->sort(array('tstamp' => -1));

      $newresp = array();
      foreach ($cursor as $obj) {

        for ($a = 0; $a < sizeof($obj['resp']); $a++){

          //echo"2<br>";
          if ($obj['resp'][$a]['flag'] == '0'){

            if ($obj['resp'][$a]['tstamp'] == $qrespid){
              $level = array('user'=>$obj['resp'][$a]['user'],'msg'=>$obj['resp'][$a]['msg'],'towho'=>$obj['resp'][$a]['towho'],'tstamp'=>$obj['resp'][$a]['tstamp'],'uid'=>$obj['resp'][$a]['uid'],'tstamp'=>$obj['resp'][$a]['tstamp'],'flag'=>'1');
            } else {
              $level = array('user'=>$obj['resp'][$a]['user'],'msg'=>$obj['resp'][$a]['msg'],'towho'=>$obj['resp'][$a]['towho'],'tstamp'=>$obj['resp'][$a]['tstamp'],'uid'=>$obj['resp'][$a]['uid'],'tstamp'=>$obj['resp'][$a]['tstamp'],'flag'=>$obj['resp'][$a]['flag']);
            }

            array_push($newresp, $level);
          }

        }
      }

      //print_r($newresp);
      //echo "<br>----------------<br>";

      
      //una vez reconstridos lo smensajes lo guardamos
      $db->messages->update( array("_id"=>$id), array('$set' => array("resp" => $newresp)) );
      echo "ok";

    }
}


if (isset($_POST["qcodeschool"])){
    streamFlag($_POST["qmsgid"],$_POST["qcodeschool"],$_POST["qtype"],$_POST["qrespid"]);
}


?>