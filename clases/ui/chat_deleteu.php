<?php
    
    include("../logon.php");
    require_once('../mysqlcon.php');
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $newlist = array();

    /*For some weird reason I have to double convert this json in order to be able to use it*/
    $se = json_decode($_SESSION['qfriends'],true);
    $se1 = json_decode($se, true);
    
    foreach($se1 as $item){
        $newitem = array();
        if($item['id'] != $_POST['qfid']){
            $newitem = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'blocked' => $item['blocked'],
                'visible' => $item['visible']
            );
        } else {
            //echo 'FOUND!'.$item['id']; exit();
            $newitem = array(
                'id' => $item['id'],
                'name' => $item['name'],
                'blocked' => $_POST['qblock'],
                'visible' => $_POST['qvis']
            );
        }
        array_push($newlist, $newitem);        
    };

    $saljson = json_encode($newlist);
        
    //rebuild session
    $_SESSION['qfriends'] = $saljson;

    //save to DB
    $sql = "UPDATE users SET friends = '".$saljson."' WHERE idUsers = ".$_SESSION['idUsers'];
    //echo $sql; exit();
    if (!$con->query($sql)){
        echo '0';
    } else {
        echo '1';
    }
    
?>