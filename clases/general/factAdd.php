<?php 

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

//stream initialization
include("../logon.php");
require_once('../mysqlcon.php');


function streamAdd($user,$towho){

    //los datos del emisor los sacamos de settings
    $sql = 'SELECT f_moneda, f_lugarexp, f_em_nombre, f_em_rfc, f_em_calle, f_em_noext, f_em_col, f_em_loc, f_em_referencia, f_em_municipio, f_em_estado, f_em_pais, f_em_cp, f_em_regimen FROM settings WHERE codeEscuelas = '.$_SESSION['qescuelacode'].' LIMIT 1';
    $result = mysql_query($sql, $link) or die(mysql_error());
    $row = mysql_fetch_assoc($result);

    date_default_timezone_set('Mexico/General');
    $tstamp = time();

    $newname = "invoices_".$_SESSION['qescuelacode'];

    //we create a stream with the school's code if it doesn't exist
    $con = new Mongo(); // Connexion sur localhost:27017
    $db = $con->$newname;

    //convert string to array from data received on the post
    function shed($data){
        $sal = array();
        $pre = explode('|', $data);
        foreach ($pre as $item){ array_push($sal, $pre[$item]) }
        return $sal;
    }

    //los datos del emisor los sacamos de settings
    $emisor = array(
        //datos: nombre, rfc
        'datos' => array(
            $row['f_em_nombre'],
            $row['f_em_rfc']
            ),
        'domfiscal' => array(
            $row['f_em_calle'],
            $row['f_em_noext'],
            $row['f_em_col'],
            $row['f_em_loc'],
            $row['f_em_referencia'],
            $row['f_em_municipio'],
            $row['estado'],
            $row['pais'],
            $row['codigoPostal']
            ),
        'expen' => array(
            $row['f_em_calle'],
            $row['f_em_noext'],
            $row['f_em_col'],
            $row['f_em_loc'],
            $row['f_em_referencia'],
            $row['f_em_municipio'],
            $row['estado'],
            $row['pais'],
            $row['codigoPostal']
            ),
        'regimen' => $row['f_em_regimen'];
    };

    //user: es el usuario que genera la factura
    //tstamp es el momento en que se genera esta solicitud
    //towho es el usuario en nuestro sistema que recibe la factura
    $datos = array("user" => $user, 
                 "tstamp" => $tstamp,
                 "towho" =>  $towho,
                 "payed" => '1', 
                 "month" => date('m');
                 "year" => date('Y');
                 //ahora si los datos de la factura como tal
                 "emisor" => $emisor
            );

    $db->messages->insert($datos);
    echo $datos['_id'];
    
}

streamAdd(
    $_POST['quser'],
    $_POST['qtowho'],
    $_POST['emisor_datos'],
    $_POST['emisor_domfiscal'],
    $_POST['emisor_expen'],
    $_POST['emisor_regimen']
    );


?>