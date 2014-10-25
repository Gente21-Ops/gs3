<?php
    require_once('../connection.php');
    session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $alldata = array(
        'idUsers' => $_SESSION['idUsers'],
        'tipo' => $_SESSION['tipo'],
        'nombre' => $_SESSION['nombre'],
        'apellidos' => $_SESSION['apellidos'],
        'pass' => $_SESSION['pass'],

        'calle_num' => $_SESSION['calle_num'],
        'colonia' => $_SESSION['colonia'],
        'zip_code' => $_SESSION['zip_code'],
        'municipio' => $_SESSION['municipio'],
        'estado' => $_SESSION['estado'],

        'telefono' => $_SESSION['telefono'],
        'e_mail' => $_SESSION['e_mail'],
        'coder' => $_SESSION['code'],
        'qescuelacode' => $_SESSION['qescuelacode'],
        'qidescuela' => $_SESSION['qidescuela'],
        'qlen' => $_SESSION['qlen'],
        'qnac' => $_SESSION['qnac'],
        'qnick' => $_SESSION['qnick']
    );
    echo json_encode($alldata);
    //print_r($alldata);
?>