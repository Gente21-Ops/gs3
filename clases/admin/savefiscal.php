<?php

include("../logon.php");
//require_once('../mysqlcon.php');


function checkfdata(
    $qcode,
    $name,
    $dom_rfc,
    $dom_calle,
    $dom_ext,
    $dom_col,
    $dom_loc,
    $dom_mun,
    $dom_ref,
    $dom_estado,
    $dom_pais,
    $dom_cp,
    $beca ){

    $school = "i_".$_SESSION['qescuelacode'];
    //vamos a chechar si existe este registro primero
    $con = new Mongo(); // Connexion sur localhost:27017
    $db = $con->$school;
    
    $collection = $db->invoices;

    $cursor = $collection->find(array('code' => $qcode));
    $cursor->limit(1);

    if ($cursor->count() < 1){
        //echo "Object not found, creating...";

        $article = array(
            "code" => $qcode, 
            "name" => $name,
            "dom_rfc" => $dom_rfc,
            "dom_calle" => $dom_calle,
            "dom_ext" => $dom_ext,
            "dom_col" => $dom_col,
            "dom_loc" => $dom_loc,
            "dom_mun" => $dom_mun,
            "dom_ref" => $dom_ref,
            "dom_estado" => $dom_estado,
            "dom_pais" => $dom_pais,
            "dom_cp" => $dom_cp,
            "beca" => $beca,
            "invoices" => array()
        );

        $db->invoices->insert($article);
        echo "1";

    }
    //aguas aqui si si se encuentra hay que sobreescribir el dato

}
    
checkfdata(
    $_POST['code'],
    $_POST['name'],
    $_POST['dom_rfc'],
    $_POST['dom_calle'],
    $_POST['dom_ext'],
    $_POST['dom_col'],
    $_POST['dom_loc'],
    $_POST['dom_mun'],
    $_POST['dom_ref'],
    $_POST['dom_estado'],
    $_POST['dom_pais'],
    $_POST['dom_cp'],
    $_POST['beca']
);

?>