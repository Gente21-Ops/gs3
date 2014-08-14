<?php
ob_start();

include("logon.php");
error_reporting(E_ALL);
ini_set('display_errors', '1');


//echo "UPLOADPICS INITIALIZES"
/**
 * upload.php
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

// HTTP headers for no cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//session_start();

include('general/passgen.php');
include('connection.php');

$targetDir = "../files/".$_GET['qcodeschool'];

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;


$_REQUEST["name"] = strtolower ($_REQUEST["name"]);

if (strpos($_REQUEST["name"],'jpeg') !== false) {
	$_REQUEST["name"] = str_replace("jpeg","jpg",$_REQUEST["name"]);
}

//echo $_REQUEST["chunk"];
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);


//--comienza hack de nombres--///////////////////////////////////////////////
//voy a forzar el cambio de nombre para evitar duplicaciones 
$oldname = $fileName;
$isimg = 0;
//tengo que apendearle la extensión para que el resto del programa funcione
$exte = explode('.', $oldname);

$new0 = generatePassword(32);
$newname = $new0.'.'.end($exte);
//echo "FIRSTFILENAME: ".$oldname." -  SECONDFILENAME: ".$newname."<br>";
$fileName = $newname;

$newpatho = str_replace('.png', '.jpg', $newname);

//se va a la db
$sqlt = "INSERT INTO files (name, patho, code, codeUser) VALUES ('".$oldname."', '".$newpatho."', '".$_GET['qcodetareas']."', '".$_GET['qusercode']."')";
//echo $sqlt."<br>";

mysql_query($sqlt) or die(mysql_error());  


//--termina hack de nombres--////////////////////////////////////////////////


// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);

	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;

	//esto numera los archivos
	//$fileName = $fileName_a . '_' . $count . $fileName_b;
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
//echo $filePath."<br>";

// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);

// Remove old temp files	
if ($cleanupTargetDir) {
	if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
		while (($file = readdir($dir)) !== false) {
			$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

			// Remove temp file if it is older than the max age and is not the current file
			if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
				@unlink($tmpfilePath);
			}
		}
		closedir($dir);
	} else {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}
}	

// Look for the content type header
if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

if (isset($_SERVER["CONTENT_TYPE"]))
	$contentType = $_SERVER["CONTENT_TYPE"];

// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
if (strpos($contentType, "multipart") !== false)
{
	//echo "h";
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']))
	{
		// Open temp file
		$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out)
		{
			// Read binary input stream and append it to temp file
			$in = @fopen($_FILES['file']['tmp_name'], "rb");

			if ($in) {
				while ($buff = fread($in, 4096))
					fwrite($out, $buff);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			@fclose($in);
			@fclose($out);
			@unlink($_FILES['file']['tmp_name']);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	}
	else
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}'.var_dump($_FILES['file']));
}
else
{
	// Open temp file
	$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
	if ($out) {
		// Read binary input stream and append it to temp file
		$in = @fopen("php://input", "rb");

		if ($in) {
			while ($buff = fread($in, 4096))
				fwrite($out, $buff);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

		@fclose($in);

		@fclose($out);
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);

	//PNG images we will forced to JPG (even when uploaded as PNG)
	/*
	*/

	function strposa($haystack, $needle, $offset=0) {
	    if(!is_array($needle)) $needle = array($needle);
	    foreach($needle as $query) {
	        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;
	}


	$imgtypes = array('gif','GIF','jpg','jpeg','png','PNG','JPG','JPEG');
	//let's check if it's an image, if so we do the thumbnailing logic
	if (strposa($filePath, $imgtypes)) {
		//echo "<br>This is an image, it will be postprocessed!<br>";

		$isimg = 1;

		///CHECK IF PNG///
		if (strpos($filePath,'png') !== false) {
			
			$input_file = $filePath;
			//new file name on jpg
			$output_file = "../files/".$_GET['qcodeschool']."/".$new0.".jpg";

			$input = imagecreatefrompng($input_file);
			list($width, $height) = getimagesize($input_file);
			$output = imagecreatetruecolor($width, $height);
			$white = imagecolorallocate($output,  255, 255, 255);
			imagefilledrectangle($output, 0, 0, $width, $height, $white);
			imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
			imagejpeg($output, $output_file);

			//we kill the png original image from server
			unlink($input_file);

			$filePath = str_replace("png","jpg",$filePath);
		}
		///CHECK IF PNG ENDS///
		createthumb($filePath);
	} else {
		//echo "<br>Not an image, process ends.<br>";
	}

	
}

function createthumb($name)
{
	global $targetDir;
	global $src_img;

	function squareme($largo,$qname,$qual){
		global $src_img;
		global $targetDir;

		$new_w = $largo;
		$new_h = $largo;
			
		$orig_w = imagesX($src_img);
		$orig_h = imagesY($src_img);
			
		$w_ratio = ($new_w / $orig_w);
		$h_ratio = ($new_h / $orig_h);
			
		if ($orig_w > $orig_h ) {//landscape
			$crop_w = round($orig_w * $h_ratio);
			$crop_h = $new_h;
		} elseif ($orig_w < $orig_h ) {//portrait
			$crop_h = round($orig_h * $w_ratio);
			$crop_w = $new_w;
		} else {//square
			$crop_w = $new_w;
			$crop_h = $new_h;
		}
		$dest_img = imagecreatetruecolor($new_w,$new_h);
		imagecopyresampled($dest_img, $src_img, 0 , 0 , 0, 0, $crop_w, $crop_h, $orig_w, $orig_h);

		//$thumbPath = $targetDir."/".$largo;
		
		$thumbPath = "../files/".$_GET['qcodeschool']."/".$largo."/";
		$filename = $thumbPath.$qname;

		//echo "<br>--------------".$filename."-----------------------<br>";

		if (!imagejpeg($dest_img,$filename,$qual)){
			echo "JPEG ERROR!!!, thumbPath: ".$thumbPath;
		}
		imagedestroy($dest_img);
	}	

	//$new_w = 194,$new_w320 = 320,$new_w194 = 194,$new_w800 = 800	;

	//get name (fixed bug with backslash)
	$name = str_replace('\\', '/', $name);
	$namet = explode('/', $name);
	//file
	$filo = end($namet);
	//get extension
	if (preg_match("/png/",$filo))
	{
		$src_img=imagecreatefrompng($name);
	}
	else if (preg_match("/gif/",$filo))
	{
		$src_img=imagecreatefromgif($name);
	}
	else 
	{
		$src_img=imagecreatefromjpeg($name);	
	}
	
	$system=explode(".",$name);

	//echo "Trying to create: ".$name;
	//print_r($namet);
	
	squareme(320,end($namet),70);
	squareme(120,end($namet),70);
	squareme(72,end($namet),70);
	squareme(37,end($namet),80);

}

//echo $isimg."<br>";

die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "new" : "'.$newname.'", "isimg" : "'.$isimg.'"}');

//die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "original" : "'.$oldname.'", "new" : "'.$newname.'"}');
