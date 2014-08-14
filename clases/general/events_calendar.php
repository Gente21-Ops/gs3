<?php
//date_default_timezone_set('America/Los_Angeles');
    ob_start();
    require_once('../connection.php');
    session_start();
    //$sth = mysql_query("SELECT id, start, end, allday, title FROM eventos WHERE codeEscuelas = 'c2d35dca3f4e8a58458315cb07d66c4f'");

    $sth = mysql_query("SELECT id, start, end, title FROM eventos WHERE codeEscuelas = '".$_SESSION['qescuelacode']."'");
    $rows = array();
    while($r = mysql_fetch_assoc($sth)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
?>