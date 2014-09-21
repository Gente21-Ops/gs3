<?php
include("../logon.php");
include('passgen.php');

function inter($qcode){
	include 'etherpad-lite-client.php';
	$instance = new EtherpadLiteClient('jEq10TD3IzUpwUu3pdpyyvFc1Y8skcw2','http://107.22.250.130:9001/api');

	echo "<h1>Pads</h1>";

	try {
	  $authormap = $instance->createAuthorIfNotExistsFor($_SESSION['qnick'], $_SESSION['code']);
	} catch (Exception $e) {
	  echo "0ˆcreateAuthorIfNotExistsFor Failed with message ". $e->getMessage();
	}

	/* Example: Create a new Pad */
	try {
	  $instance->createPad($qcode,$_POST['qpadtext']);
	  echo "1ˆ".$qcode;
	} catch (Exception $e) {
	  echo "0ˆcreatePad Failed with message ". $e->getMessage();
	}
}

if (isset($_POST['qpadname']) && isset($_POST['qpadtext'])){

	$code = generatePassword(16);
	//let's create in the database
	$sql = "INSERT INTO pads (name, code, usercode) VALUES ('".$_POST['qpadname']."', '".$code."', '".$_SESSION['code']."')";
	echo "GENERATING PAD (LOCAL): ".$sql;

    if(!mysql_query($sql)){
    	echo "0ˆNo valid sql data: ".$sql;
    } else {
    	inter($code);
    }

} else {
	echo "0ˆNo valid user data";
}

?>