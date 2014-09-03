<?php
//echo "SE<br>";
include("../logon.php");
require_once('../mysqlcon.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

        $elsql7 = "SELECT DISTINCT idMaterias AS qmaterias FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
            AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '".$_GET['qparcial']."'";
        $result7 = $con->query($elsql7);
        
        /*echo "<br><br>";
        print_r($elsql7);
        echo "<br><br>";*/

        if ($result7) { 
            if($result7->num_rows === 0){
                //throw new Exception("Database Error [{$this->database->errno}] {$this->database->error}");
                    //$chido = [];
                    $chido[] = '';
                    $output['aaData'][] = '';
                    echo json_encode( $output );
            } else {    
                
                while ($aRow7 = $result7->fetch_assoc()) { 
                    $elsql8 = "SELECT COUNT(idMaterias) as total FROM faltas WHERE idCiclos = '".$_SESSION['qciclo']."'
                    AND idUsers = '".$_SESSION['idUsers']."' AND idParciales = '".$_GET['qparcial']."' AND idMaterias = '".$aRow7['qmaterias']."'";
                    $result8 = $con->query($elsql8);

                    //print_r($elsql8);
                    //echo "<br><br>";
                    $query9 = "SELECT idMaterias, nombre FROM materias WHERE idMaterias = '".$aRow7['qmaterias']."'";
                    $result9 = mysqli_query($con, $query9);
                    $row9 = mysqli_fetch_assoc($result9);

                    while ($aRow8 = $result8->fetch_assoc()) { 
                        //$JsonArray[] = array( $aRow7['qmaterias'] => $aRow8['total'] );
                        //$data1[] = array ($aRow7['qmaterias'], $aRow8['total']);
                        //$JsonArray[] = array( $row9['nombre'], $aRow8['total'] );

                        $chido = [];

                        $chido[] = $row9['idMaterias'];
                        $chido[] = $row9['nombre'];
                        $chido[] = $aRow8['total'];  
                        /*$chido[] = '<div class="formRow" style="border-bottom:0; padding:0;">
                                        <div class="grid3">
                                            <input id="caja_'.$aRow['qiduser'].'" 
                                            data-iduser="'.$aRow['qiduser'].'" 
                                            data-nameuser="'.$aRow['qnombre'].' '.$aRow['qapellidos'].'" 
                                            data-parcialuser="'.$row3['idParciales'].'" 
                                            type="text" name="qcalif" placeholder="0.00" value="'.$calo.'" />
                                        </div>
                                    </div> ';*/
                        $output['aaData'][] = $chido;
                    }
                }
                echo json_encode( $output );

            }

        }


    

?>