<?php
    
    include("../logon.php");
    include("../mysqlcon.php");

    $quer = "UPDATE users SET 
    nombre = ?, 
    apellidos = ?, 
    nick = ?, 
    calle_num = ?, 
    colonia = ?, 
    zip_code = ?, 
    municipio = ?, 
    estado = ?, 
    telefono = ?, 
    e_mail = ?, 
    nacimiento = ? 
    WHERE code = ?";

    //prepare nos cuida de inyecciones de código
    if ($stmt = $con->prepare($quer)) {
    	//hay que poner tantas 's' como parámetros haya
		$stmt->bind_param("ssssssssssss", 
			$_POST['name'],
			$_POST['last'],
			$_POST['nick'],
			//$_POST['address'],
            $_POST['calle_num'],
            $_POST['colonia'],
            $_POST['zip_code'],
            $_POST['municipio'],
            $_POST['estado'],
			$_POST['tel'],
			$_POST['email'],
			$_POST['birth'],
			$_POST['code']);
		if($stmt->execute()){
			echo "1";
		}
	} else {
		echo "0".$con->error;
	}

    //esto no es siempre necesario en este caso actualizamos
    //la información de la sesión
    /*
    $_SESSION['nombre'] = $_POST['name'];
    $_SESSION['apellidos'] = $_POST['last'];
    $_SESSION['qnick'] = $_POST['nick'];
    $_SESSION['direccion'] = $_POST['address'];
    $_SESSION['telefono'] = $_POST['tel'];
    $_SESSION['e_mail'] = $_POST['email'];
    $_SESSION['qnac'] = $_POST['birth'];   
    */

    //echo $quer."<br><br>";
    mysqli_query($con,$quer);

?>