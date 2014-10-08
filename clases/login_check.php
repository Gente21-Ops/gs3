<?php
    ob_start();
    require_once('connection.php');
    // Connect to server and select databse.

    //the array to hold the names is a session variable, 
    //so we can have all names at hand at all times
    $danames = array();
    $_SESSION['danames'] = $danames;
    
    //CAMBIAR ESTO CON HTACCESS
    $qcodescuela = 'c2d35dca3f4e8a58458315cb07d66c4f';

    // Define nombre y pass
    $nombre=$_POST['nombre']; 
    $pass=md5($_POST['pass']); 

    // To protect MySQL injection (more detail about MySQL injection)
    $nombre = stripslashes($nombre);
    $nombre = mysql_real_escape_string($nombre);
    $pass = mysql_real_escape_string($pass);
    $sql="SELECT users.idUsers AS idUsers, 
    users.tipo AS qtipo, 
    users.nombre AS nombre, 
    users.apellidos AS apellidos, 
    users.pass AS qpass, 
    users.calle_num AS calle_num, 
    users.colonia AS colonia, 
    users.zip_code AS zip_code, 
    users.municipio AS municipio, 
    users.estado AS estado, 
    users.telefono AS tel, 
    users.e_mail AS email, 
    users.code AS qcode, 
    users.friends AS qfriends, 
    users.nacimiento AS qnac, 
    users.nick AS qnick, 
    escuelas.idEscuelas AS qescuelaid, 
    settings.lenguaje AS qlen, 
    settings.stream AS qstream, 
    settings.timezone AS qtimezone 
    FROM users, escuelas, settings 
    WHERE users.nombre = '$nombre' 
    AND users.pass = '$pass' 
    AND users.codeEscuelas = escuelas.codeEscuelas 
    AND escuelas.activa = '1' AND settings.codeEscuelas = '$qcodescuela'";

    //by default the group should be 0
    $_SESSION['qidgrupo'] = '0';
    //echo $sql."<br><br>";
    
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1){

        $row = mysql_fetch_assoc($result);
        session_start();

        /*        IF I'M A STUDENT I GET THE GROUP      */
        //still doesn't solve the problem of having multiple groups
        if ($row['qtipo'] == '2'){
            $sqlstud = "SELECT idGrupos FROM map_grupos WHERE idUsers = '".$row['idUsers']."'";
            $resstud = mysql_query($sqlstud) or die(mysql_error());
            $rowstud = mysql_fetch_assoc($resstud);
            $_SESSION['qidgrupo'] = $rowstud['idGrupos'];
        }

        //Obtener ciclo activo de la escuela
        $queryCiclo = "SELECT idCiclos FROM ciclos WHERE activo = '1' AND codeEscuelas = '".$qcodescuela."'";
        $resCiclo = mysql_query($queryCiclo) or die(mysql_error());
        $rowCiclo = mysql_fetch_assoc($resCiclo);
        $_SESSION['qciclo'] = $rowCiclo['idCiclos'];

        $_SESSION['idUsers'] = $row['idUsers'];
        $_SESSION['tipo'] = $row['qtipo'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellidos'] = $row['apellidos'];
        $_SESSION['pass'] = $row['qpass'];

        //$_SESSION['direccion'] = $row['direccion']; 
        $_SESSION['calle_num'] = $row['calle_num']; 
        $_SESSION['colonia'] = $row['colonia']; 
        $_SESSION['zip_code'] = $row['zip_code']; 
        $_SESSION['municipio'] = $row['municipio']; 
        $_SESSION['estado'] = $row['estado']; 

        $_SESSION['telefono'] = $row['tel'];
        $_SESSION['e_mail'] = $row['email'];
        $_SESSION['code'] = $row['qcode'];
        $_SESSION['qescuelacode'] = $qcodescuela;
        $_SESSION['qidescuela'] = $row['qescuelaid'];
        $_SESSION['qlen'] = $row['qlen'];
        $_SESSION['qnac'] = $row['qnac'];
        $_SESSION['qnick'] = $row['qnick'];
        $_SESSION['qstream'] = $row['qstream'];
        $_SESSION['qtimezone'] = $row['qtimezone'];
        
        /*$json_string = $row['qfriends'];
        
        $farray = array();
        $parsed_json = json_decode($json_string, true);
        foreach($parsed_json as $key => $value){ $farray[$key] = $value; }
        $_SESSION['qfriends'] = $farray;        
        */
        $_SESSION['qfriends'] = json_encode($row['qfriends']);

        if ((int)$_SESSION['tipo'] == 1){ $_SESSION['tipofol'] = "teacher"; } 
        else if ((int)$_SESSION['tipo'] == 2) { $_SESSION['tipofol'] = "student"; } 
        else if ((int)$_SESSION['tipo'] == 3) { $_SESSION['tipofol'] = "admin"; }
        else if ((int)$_SESSION['tipo'] == 4) { $_SESSION['tipofol'] = "parent"; }
        header("location:../main2");
        
    } else {
        echo "Wrong Username or Password";
        //header("location:../index?error=1");
    }



    //------------ NAME TRANSLATOR ----------//


    ob_end_flush();
?>