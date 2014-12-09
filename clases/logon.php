<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

require_once('connection.php');

if(isset($_SESSION['nombre']) && isset($_SESSION['pass']) && isset($_SESSION['code'])){

    $sql="SELECT nombre, pass, code FROM users WHERE nombre = '".$_SESSION['nombre']."' AND pass = '".$_SESSION['pass']."' AND code ='".$_SESSION['code']."'";
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);

    $row = mysql_fetch_row($result);
    $_SESSION['code'] = $row[2];

    //print_r($_SESSION['qfriends']);

    if(!$count==1){
    	//NO HAY USUARIOS CON ESA INFO
        header("location:index?error=1");
    }
} else {
	//NO EXISTE LA SESIÓN
	header("location:index?error=2");
}


//lenguajes
if (!isset($_SESSION['qlen'])){
	$_SESSION['qlen'] = 'es';
}

?>