<?php 


error_reporting(E_ALL); 
ini_set( 'display_errors','1');

require_once('connection.php');
//include('logon.php');


//------------ NAME TRANSLATOR ----------//

//the array to hold the names is a session variable, 
//so we can have all names at hand at all times
//$danames = array();

function getnames($qcodeuser){

    //if I am myself (doh) I get my name in return
    if ($qcodeuser == $_SESSION['code']){
        return $_SESSION['qnick'];
    } else {
        //if it's not myself I'm going to see if it's on the 
        
        if (!isset($_SESSION['danames'])){
            $danames = array();
            $_SESSION['danames'] = $danames;
        }

        $found = false;
        for ($t = 0; $t < sizeof($_SESSION['danames']); $t++){
            if (in_array($qcodeuser, $_SESSION['danames'][$t][0])){
                $found = true;
                return $_SESSION['danames'][$t][1];
            }
        }
        //if not found we will look into the datase to retrieve the name
        if ($found == false){

            $sql = "SELECT nick FROM users WHERE code = '".$qcodeuser."'"; 
            $result=mysql_query($sql);
            $count=mysql_num_rows($result);
            //echo "NOT FOUND, sql: ".$sql;
            /*
            error_reporting(E_ALL); 
            ini_set( 'display_errors','1');
            */
            if($count==1){
                $row = mysql_fetch_assoc($result);
                //we save the name to the array
                $newarr = array($qcodeuser,$row['nick']);
                array_push($newarr,$_SESSION['danames']);
                //we return the nick from the DB
                //echo $row['nick'];
                return $row['nick'];
            } else {
                echo "<br>Nu5: ".$sql."<br>";
                //if we really can't figure it out we return the id
                return $qcodeuser;
            }
        }

    }

}

//run if coming from JS
if (isset($_GET['js_qc'])){
    getnames($_GET['js_qc']);
}


function ext($qs,$type){
    $sal = explode('.', $qs);
    return $sal[$type];
}

function pjpg($name){
    return str_replace('.png', '.jpg', $name);
}

 ?>