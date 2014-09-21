<?php
ob_start();
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

session_start();
//require_once("squarer.php");
// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
$targetDir = '../userimgs';

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

$myFile = "testFile.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $_REQUEST["name"]."\n";
fwrite($fh, $stringData);
fclose($fh);

//echo $_REQUEST["chunk"];
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);

	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;

	$fileName = $fileName_a . '_' . $count . $fileName_b;
}

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
echo $filePath;

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
	echo "h";
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

	//PNG images we will force to JPG (even when uploaded as PNG)
	/*
	
	*/
	if (strpos($filePath,'png') !== false) {
		$elfile = explode('/', $filePath);
		$elext = explode('.', $elfile[2]);

		$input_file = $filePath;
		$output_file = "../userimgs/".$elext[0].".jpg";

		$input = imagecreatefrompng($input_file);
		list($width, $height) = getimagesize($input_file);
		$output = imagecreatetruecolor($width, $height);
		$white = imagecolorallocate($output,  255, 255, 255);
		imagefilledrectangle($output, 0, 0, $width, $height, $white);
		imagecopy($output, $input, 0, 0, 0, 0, $width, $height);
		imagejpeg($output, $output_file);

		$filePath = str_replace("png","jpg",$filePath);

	}
	/*
	$myFile = "testFile.txt";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = $filePath."\n";
	fwrite($fh, $stringData);
	fclose($fh);
*/
	
	createthumb($filePath);
}

function createthumb($name)
{
	//$new_w = 194,$new_w320 = 320,$new_w194 = 194,$new_w800 = 800	;
	
	global $targetDir;
	echo "<br> >>>FILENAME: ".$name."<br><br>";

	//we gonna do thumbnails in all these resolutions:
	$new_w = array(194,320);

	//get name
	$namet = explode('/', $name);

	//get extension
	if (preg_match("/png/",$namet[7]))
	{
		$src_img=imagecreatefrompng($name);
	}
	else if (preg_match("/gif/",$namet[7]))
	{
		$src_img=imagecreatefromgif($name);
	}
	else 
	{
		$src_img=imagecreatefromjpeg($name);	
	}
	
	$system=explode(".",$name);
	
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);

	//ok so let's get an aspect ratio
	$ar = $old_x / $old_y;
	
	//so what's the smallest one?
	$smaller = "y";
	$diffo = 0;
	if ($old_x >= $old_y)
	{
		$smaller = "y";
	} 
	else
	{
		$smaller = "x";
	}

	//194w pic STARTS
	$i194w = 194;
	$i194h = round(194/$ar);
	echo "W: ".$i194w;
	echo "H: ".$i194h;
	$dst_img194=ImageCreateTrueColor($i194w,$i194h);
	imagecopyresampled($dst_img194,$src_img,0,0,0,0,$i194w,$i194h,$old_x,$old_y);

	$thumbPath = $targetDir."/thumbs194/";
	$filename = $thumbPath.$namet[2];


	imagejpeg($dst_img194,$filename,85);
	imagedestroy($dst_img194);
	//194w pic ENDS

	//320w pic STARTS
	$i320w = 320;
	$i320h = round(320/$ar);
	$dst_img320=ImageCreateTrueColor($i320w,$i320h);
	imagecopyresampled($dst_img320,$src_img,0,0,0,0,$i320w,$i320h,$old_x,$old_y);

	$thumbPath = $targetDir."/thumbs320/";
	$filename = $thumbPath.$namet[2];

	imagejpeg($dst_img320,$filename,85);
	imagedestroy($dst_img320);
	//320w pic END
}

die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
