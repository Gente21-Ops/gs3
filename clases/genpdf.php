<?php 

require('fpdf/fpdf.php'); 
include("logon.php");

//ok vamos a generar un registro en mongo




//EMISOR:
$conv = base64_decode($_POST['d_emisor']);
$str = iconv('UTF-8', 'ISO-8859-1', $conv);
$p_emi = explode('~', $str);
$p_emi1 =  $p_emi[2]."\n\rRFC:".$p_emi[3]."\n\r";
$p_emi1 .=  $p_emi[4]." ".$p_emi[5]." ".$p_emi[6]." ".$p_emi[7]."\n\r";
$p_emi1 .=  $p_emi[9]." ".$p_emi[10]." ".$p_emi[11]." ".$p_emi[12]."\n\r";
$p_emi1 .=  "REGIMEN FISCAL ".$p_emi[13]; 

//RECEPTOR:
$convr = base64_decode($_POST['d_rec']);
$strr = iconv('UTF-8', 'ISO-8859-1', $convr);	
$p_rec = explode('~', $strr);
$p_rec1 =  $p_rec[0]."\n\rRFC:".$p_rec[1]."\n\r";
$p_rec1 .=  $p_rec[2]." ".$p_rec[3]." ".$p_rec[4]." ".$p_rec[5]."\n\r";
$p_rec1 .=  $p_rec[6]." ".$p_rec[8]." ".$p_rec[9]." ".$p_rec[10];

//ITEMS
$p_items = explode('~', $_POST['d_items']);


$school = "i_".$_SESSION['qescuelacode'];
//vamos a chechar si existe este registro primero
$con = new Mongo(); // Connexion sur localhost:27017
$db = $con->$school;
$collection = $db->invoices;

error_reporting(E_ALL); 
ini_set( 'display_errors','1');

//we get the last id 

$getin = $collection->find(array('_id' => new MongoId($p_rec[11])));
$arr = iterator_to_array($getin); 
//print_r($array);
$number = sizeof($arr['53342874481530d436ee60a1']['invoices']) + 1;


date_default_timezone_set('Mexico/General');
$tstamp = time();

//generate new invoice data: (who es la persona que gener+o la factura)
$inv = array("factnum" => $number,
			"who" => $_SESSION['code'], 
            "aprobacion" => '616321651321651321', 
            "cert" =>  '00001000000104031354', 
            "tstamp" => $tstamp,
            "dma" => date('d_m_Y'),
            "file" => 'identifcador_del_archivo'
        );

//echo "Trying to update where ID: ".$p_rec[11]."<br>";

$collection->update(
    array('_id' => new MongoId($p_rec[11])),
    array(
        '$push' => array("invoices" => $inv),
    ),
    array("upsert" => true)
);


//ok primero vamos a generar el registro en mongo, cuando tengamos el identificador entonces si
makepdf('TEST'.date('h:i:s').'.pdf');

function makepdf($name){

	global $p_emi1;
	global $p_rec1;
	global $p_items;	
	global $number;

	//create a FPDF object
	$pdf=new FPDF();

	//set document properties
	$pdf->SetAuthor('The GoSchool System a division of GIT-Gente21 www.goschool.mx');
	$pdf->SetTitle('Factura');

	//set font for the entire document
	$pdf->SetFont('Helvetica','B',8);
	$pdf->SetTextColor(51,51,51);

	//set up a page
	$pdf->AddPage('P'); 
	$pdf->SetDisplayMode('real','default');

	//insert an image and make it a link
	$imago = '../images/logos/'.$_SESSION['qescuelacode'].'.png';
	$pdf->Cell( 40, 40, $pdf->Image($imago, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

	//display the title with a border around it
	$pdf->SetXY(50,10);
	$pdf->SetDrawColor(51,51,51);
	$pdf->MultiCell( 100, 4, $p_emi1, 0, 'L');

	//receptor
	$pdf->SetXY (10,33);
	$pdf->SetFontSize(7);
	$pdf->MultiCell( 120, 4, $p_rec1, 1, 'L');

	//calculamos los ceros
	$tzeros = 8;
	$tnum = strlen("".$number);
	
	$tdif = ($tzeros - $tnum);
	//echo "LERGO DEL STRING: ".$tnum." DIF:".$tdif."<br>";
	$tsal = '';
	for ($t = 0; $t < $tdif; $t++){ $tsal .= '0'; }
	$tsal .= (string)$number;

	//datos extras
	$pdf->SetXY (135,33);
	$pdf->SetFontSize(6);
	$pdf->MultiCell( 65, 4, iconv('UTF-8', 'ISO-8859-1',"COMPROBANTE FISCAL DIGITAL\r\nFACTURA No: ".$tsal."\r\nNo. CERTIFICADO: 00001000000104031354\r\nNo. APROBACIÓN: 85317\r\nAÑO DE APROBACIÓN: ".date('Y')), 1, 'C');

	//cantidad
	$pdf->SetXY (9,54);
	$pdf->SetFontSize(10);
	$pdf->MultiCell( 50, 4, 'CONCEPTOS', 0, 'L');


	//--------------DESCRIPCIONES COMIENZA------------------//
	$titley = 60;
	$pdf->SetFontSize(7);
	
	$pdf->SetXY (10,$titley);
	$pdf->MultiCell( 120, 4, iconv('UTF-8', 'ISO-8859-1',"DESCRIPCIÓN"), 0, 'L');

	//cantidad
	$pdf->SetXY (130,$titley);
	$pdf->MultiCell( 10, 4, "CANT", 0, 'L');

	//precio unitario
	$pdf->SetXY (140,$titley);
	$pdf->MultiCell( 30, 4, "PRECIO UNITARIO", 0, 'R');

	//precio total
	$pdf->SetXY (170,$titley);
	$pdf->MultiCell( 30, 4, "TOTAL", 0, 'R');


	error_reporting(E_ALL); 
	ini_set( 'display_errors','1');

	setlocale(LC_ALL,"es_ES");

	//Set x and y position for the main text, reduce font size and write content
	$ystart = 65;
	$pdf->SetFontSize(6);
	$tot = 0;
	for ($c = 0; $c < sizeof($p_items); $c++){

		$in = explode('^', $p_items[$c]);

		//desc decoding
		$convr = base64_decode($in[0]);
		$sdesco = iconv('UTF-8', 'ISO-8859-1', $convr);

		//descripciones
		$pdf->SetXY (10,$ystart);
		$pdf->MultiCell( 120, 4, $sdesco, 1, 'L');

		//cantidad
		$pdf->SetXY (130,$ystart);
		$pdf->MultiCell( 10, 4, $in[1], 1, 'L');

		//precio unitario
		$pdf->SetXY (140,$ystart);
		$pdf->MultiCell( 30, 4, "$".number_format((float)$in[2], 2, '.', ''), 1, 'R');

		//precio total
		$pdf->SetXY (170,$ystart);
		$pdf->MultiCell( 30, 4, "$".number_format((float)$in[3], 2, '.', ''), 1, 'R');

		$tot += $in[3];

		$ystart += 3.9;
	}

	//totales
	$iva = $tot * 0.16;
	$ftot = $tot + $iva;
	$pdf->SetXY (150,($ystart + 1));
	$pdf->SetFontSize(8);
	$pdf->MultiCell( 50, 4, "SUBTOTAL $".number_format($tot, 2)."\r\nIVA $".number_format($iva, 2)."\r\nTOTAL $".number_format($ftot, 2), 0, 'R');


	//--------------DESCRIPCIONES TERMINA------------------//



	//--------------FOOTER COMIENZA------------------//
	$pdf->SetFontSize(7);
	
	//lowero 1
	$pdf->SetXY (9,210);
	
	$pdf->MultiCell( 190, 4, iconv('UTF-8', 'ISO-8859-1',"Este documento es una representación impresa de un Comprobante Fiscal Digital por Internet"), 1, 'L');

	//sello digital
	$pdf->SetXY (9,220);
	$pdf->MultiCell( 190, 4, 'SELLO DIGITAL', 0, 'L');
	$pdf->SetFontSize(5);
	$pdf->SetXY (9,225);
	$pdf->MultiCell( 190, 4, 'TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gU2VkIG5vbiByaXN1cy4gU3VzcGVuZGlzc2UgbGVjdHVzIHRvcnRvciwgZGlnbmlzc2ltIHNpdCBhbWV0LCBhZGlwaXNjaW5nIG5lY', 1, 'L');

	//cadena original
	$pdf->SetXY (9,235);
	$pdf->SetFontSize(7);
	$pdf->MultiCell( 190, 4, 'CADENA ORIGINAL', 0, 'L');
	$pdf->SetXY (9,240);
	$pdf->SetFontSize(5);
	$pdf->MultiCell( 190, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.', 1, 'L');

	//--------------FOOTER TERMINA------------------//


	$pdf->SetXY (9,270);
	$pdf->SetFontSize(4);
	$pdf->MultiCell( 190, 4, iconv('UTF-8', 'ISO-8859-1',"Generado por el sistema GoSchool www.goschool.mx, una división de GIT-Gente21"), 0, 'C');


	//Output the document
	$pdf->Output('../invoices/pdf/'.$name,'F'); 
	echo "1";
}
?>