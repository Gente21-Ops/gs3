<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

//primero obtengo las matarias a las que estoy suscrito
$elsql = "SELECT idFiles, name, patho FROM files WHERE code = '".$_POST['qhwid']."' ORDER BY idFiles ASC";

//echo $elsql;
$sqlt = $con->query($elsql); 
$sal = array();
while ($aRow = $sqlt->fetch_assoc()) {
    $sal[] = $aRow['idFiles'];
    $sal[] = $aRow['name'];
    $sal[] = $aRow['patho'];
}

print json_encode($sal);   

?>