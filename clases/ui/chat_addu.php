<?php

    header("Content-Type: text/html; charset=utf-8");
    
    include("../logon.php");
    require_once('../mysqlcon.php');
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //this one we'll use if the friends array is empty
    $se1 = array();

    //these are the friends that I've got now
    $se = json_decode($_SESSION['qfriends'],true);
    //If I've no friends this prevents to write to an empty array
    if (sizeof($se) > 0){
        $se1 = json_decode($se, true);
    }    

    //these are my new fiends
    $new = json_decode($_POST['qnewf'],true);

    /*print_r($se1);
    echo "<br>///////////////////////////////////<br>";
    print_r($new);
    echo "<br>///////////////////////////////////<br>";*/
    
    foreach($new as $item){
        $newitem = array(
            'id' => $item['id'],
            'name' => $item['name'],
            'blocked' => 0,
            'visible' => 1
        );  
        /*print_r($newitem);
        echo "<br>-------------------------------<br>";*/      
        array_push($se1, $newitem);
    };

    $saljson = json_encode($se1);
    //print_r($saljson);

    //rebuild session
    $_SESSION['qfriends'] = $saljson;

    //save to DB
    $sql = "UPDATE users SET friends = '".$saljson."' WHERE idUsers = ".$_SESSION['idUsers'];
    //echo $sql; exit();
    if (!$con->query($sql)){
        echo '0';
    } else {
        echo $saljson;
    }
    
?>