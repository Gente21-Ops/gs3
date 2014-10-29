<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');
//este es un hack relativo a windows:
//require_once('general/number_format.php');
//$code = '36e96b9d7e22904131f30d9857a9a6c1';

//DICCIONARIO el diccionario de los botones va aquí (since I can't access the dict from here)
    if($_SESSION['qlen'] == "es"){
    $texts = array(
        "goto" => "Ir a actividad", 
        "view" => "Descargar");
    } else if($_SESSION['qlen'] == "en"){
        $texts = array(
        "goto" => "Go to activity", 
        "view" => "Donwload");
    } else if($_SESSION['qlen'] == "fr"){
        $texts = array(
        "goto" => "Aller &agrave; l'activit&eacute;", 
        "view" => "T&eacute;l&eacute;charger");
    }

    
    //these array of columns is the order in which they wil appear on the table
    $aColumns = array('pathe','name','qnombre','code','patho','qpublic');
    
    $elsql = "SELECT files.idFiles, files.name, files.public AS qpublic, files.code, files.patho AS pathe, files.patho AS patho, tareas.nombre AS qnombre FROM files, tareas WHERE files.codeUser = '".$_SESSION['code']."' AND files.code = tareas.code ORDER BY files.idFiles DESC";

    //echo $elsql;
    $sqlt = $con->query($elsql); 


    if($sqlt->num_rows === 0){
    
        $chido = array();
        echo json_encode( $chido );

    } else {  
   
        while ($aRow = $sqlt->fetch_assoc()) {
            $row = array();
            $elid = '0';
            $elpatho = '';
            for ( $i=0 ; $i<sizeof($aColumns) ; $i++ ) {   
                
                //get the id
                if ($i == 0){ $elid = $aRow[ $aColumns[$i] ]; }
                //get the patho
                if ($i == 4){ $elpatho = $aRow[ $aColumns[$i] ]; }

                if ($i == 1){
                    $row[] = str_replace('_', ' ', $aRow[ $aColumns[$i] ]);
                } else if ($i == 3){
                    $row[] = '<a href="#" onclick="assignme(\'students_homework_do.php?qcode='.$aRow[$aColumns[$i]].'\',\'content\'); return false;" class="buttonM bGreen"><span class="icol-add"></span><span>'.$texts['goto'].'</span></a>';
                } else if ($i == 4){
                    $row[] = '<a href="files/'.$_SESSION['qescuelacode'].'/'.$aRow[$aColumns[$i]].'" target="_blank" class="buttonM bGreyish"><span class="icon-download"></span><span>'.$texts['view'].'</span></a>';
                } else if ($i == 5){
                    $ischecked = '';
                    if ($aRow[$aColumns[$i]] == '1'){
                        $ischecked = ' checked="checked"';
                    }
                    $row[] = '<div class="on_off" onclick="setshared(\''.$elid.'\',\''.$elpatho.'\'); return false;">
                                <input type="checkbox" id="check'.$elid.'" '.$ischecked.' name="chbox" />
                            </div>';
                } else {
                    $row[] = $aRow[ $aColumns[$i] ];
                }

                            
            };

            $output['aaData'][] = $row;
        }
        print json_encode($output);

    }

    
    

?>