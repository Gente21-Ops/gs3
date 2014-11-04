<?php
    require_once('../connection.php');
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $newlist = array();
    $newitem = array();

    //let's get the info from the friends session
    $json = json_decode($_SESSION['qfriends']);
    foreach($json->people as $item){
        if($item->id != $_POST['qfid']){
            $newitem = (
                'id' => $item->id;
                'name' => $item->name;
                'blocked' => $item->blocked;
                'listed' => $item->listed;
            );
        //echo $item->content;
        //A user is never deleted! this way we can know if it's blocked
        } else {
            $newitem = (
                'id' => $item->id;
                'name' => $item->name;
                'blocked' => $item->blocked;
                'listed' => 0;
            );
        }
    }

    //AQUI ME QUEDO, PROBAR QUE EL JSON SE HAYA CREADO CORRECTAMENTE
    $saljson = json_encode($newitem);
    echo $saljson;
?>