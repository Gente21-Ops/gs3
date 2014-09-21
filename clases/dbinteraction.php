<?php



/*

BEHOLD THE ALMIGHTY GENERIC INSERT >:)

*/



//some standar shit




//security layer

//require_once('secu.php');

//session_start();



//los types son: INSERT SELECT & UPDATE

//minimum requirements: qtable, qdata & qtype



if (isset($_POST['qtable']) && isset($_POST['qdata']) && isset($_POST['qtype'])) {

	require_once('mysqlcon.php');
	mysqli_set_charset($con, "utf8");
	
	$qtable = $_POST['qtable'];

	//$qcolumna = $_POST['qcolumna'];
	if (isset($_POST['qcolumna'])) { $qcolumna = $_POST['qcolumna']; }
	if (isset($_POST['qid'])) { $qid = $_POST['qid']; }
	//WHERE (include spaces!!!)

	$qwhere = "";
	if (strlen($_POST['qwhere']) > 0){ $qwhere = $_POST['qwhere']; }

	//AND (include spaces!!!)

	$qand = "";

	if (strlen($_POST['qand']) > 0){ $qand = $_POST['qand']; }
	//GROUP BY (include spaces!!!)

	$qgroupby = "";

	if (strlen($_POST['qgroupby']) > 0){ $qand = $_POST['qgroupby']; }
	//ORDER BY (include spaces!!!)

	$qorderby = "";

	if (strlen($_POST['qorderby']) > 0){ $qand = $_POST['qorderby']; }
	//TYPE AND DATA (include spaces!!!)

	$qtype = $_POST['qtype'];
	$data = json_decode($_POST['qdata'], true);
	extract($data);

	//let's construct a fucking query:

	$query = "";
	$allkeys = "";
	$allvals = "";

	if ($qtype == 'insert'){

		foreach($data as $key => $value) {
			$allkeys .= $key.", ";
			$allvals .= "'".$value."', ";
		}

		$allkeys = substr_replace($allkeys,"",-2);
		$allvals = substr_replace($allvals,"",-2);

		$query = "INSERT INTO ".$qtable." (".$allkeys.") VALUES (".$allvals.")";
		//echo $query;

		//UNCOMMENT THIS FOR DEBUGGING

	} 

	//FOR UPDATES
	else if ($qtype == 'update'){

		foreach($data as $key => $value) {
			$allkeys .= $key." = '".$value."', ";
		}

		$allkeys = substr_replace($allkeys,"",-2);
		$query = "UPDATE ".$qtable." SET ".$allkeys." WHERE ".$_POST['qkey']." = ".$qid.";";
		
		//UNCOMMENT THIS FOR DEBUGGING
		//echo $query."<br><br>";
		//UNCOMMENT THIS FOR DEBUGGING

	//FOR DELETES
	} else if ($qtype == 'delete'){
		$query = "DELETE FROM ".$qtable." WHERE ".$qcolumna." = ".$qid ."";
		//UNCOMMENT THIS FOR DEBUGGING
		//echo $query."<br><br>";
		//UNCOMMENT THIS FOR DEBUGGING

	} 

	if (!mysqli_query($con,$query)){
		echo "0ˆ".mysqli_error($con);
	} else {
		echo "1";
	}

	//PARA INVOICES
	if (!mysqli_query($con,$query2)){
		echo "0ˆ".mysqli_error($con);
	} else {
		echo "1";
	}

} else {
	echo "0ˆDatabase, data or type not provided";
}



?>