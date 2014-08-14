<?php
$sqlmaterias = "SELECT materias.idMaterias,
    materias.nombre, 
        mapmaterias.idUsers, 
        mapmaterias.idMaterias
        FROM materias, mapmaterias
        WHERE mapmaterias.idUsers = '".$_SESSION['idUsers']."' 
        AND materias.idMaterias = mapmaterias.idMaterias ORDER BY materias.nombre DESC";
    $resultmaterias = mysql_query($sqlmaterias);
    $rowmaterias = mysql_fetch_array($resultmaterias);

$resulto = "";
$count = 0;
//echo $_SESSION['idUsers'];
while($rowmaterias = mysql_fetch_array($resultmaterias)){

    $resulto .= '<tr class="gradeA">
    <td>'.$rowmaterias['idMaterias'].'</td>
    <td>'.$rowmaterias['nombre'].'</td>
    <td class="tableActs">
        <a href="#" class="tablectrl_small bDefault tipS" title="Ver detalle"><span class="iconb" data-icon="&#xe1db;"></span></a>
        <!--<a href="#" class="tablectrl_small bDefault tipS" title="Remove"><span class="iconb" data-icon="&#xe136;"></span></a>
        <a href="#" class="tablectrl_small bDefault tipS" title="Options"><span class="iconb" data-icon="&#xe1f7;"></span></a>-->
    </td>

    </tr>';

    $count += 1;

}
//empty or sum?
if ($count == 0){
    //echo $_SESSION['idUsers'];
    $resulto .= '<tr><td colspan="3" height="100"><span style="font-size:24px">No hay materias asignadas para éste alumno</span></td></tr>';
} 


//$resulto = substr($resulto,0,-1);

echo $resulto;


?>