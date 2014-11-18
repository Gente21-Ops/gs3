<?php

    header("Content-Type: text/html; charset=utf-8");
    
    include("../logon.php");
    require_once('../mysqlcon.php');
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');/**/

    //this one we'll use if the friends array is empty
    $se1 = array();

    /*print_r($_SESSION['qfriends']);
    echo "--------qfriends before--------<br>";*/

    //these are the friends that I've got now
    $se = json_decode($_SESSION['qfriends'],true);
    $oldf = serialize($se);
    //echo "---------".$oldf."-------<br>";

    //If I've no friends this prevents to write to an empty array
    if (strlen($oldf) > 16){
        //$se1 = json_decode($se, true);
        $se1 = $se;
        //somnetimes the friend's list is enclosed within quotes, so let's remove them
        //$se1 = trim($se,'"');
    }    

    //these are my new fiends
    $new = json_decode($_POST['qnewf'],true);

    /*echo "My old friends se1<br>";
    print_r($se1);
    echo "<br>My new friends<br>";
    print_r($new);
    exit();*/

    foreach($new as $item){
        $newitem = array(
            'id' => $item['id'],
            'name' => htmlentities($item['name'], ENT_COMPAT, 'UTF-8'),
            'blocked' => 0,
            'visible' => 1
        );  
        /*print_r($newitem);
        echo "<br>-------------------------------<br>";*/     
        array_push($se1, $newitem);
    };

    $saljson = json_encode($se1);
    /*echo "<br>--------------<br>";
    print_r($saljson);
    exit();*/
    
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
    /**/
    
?>