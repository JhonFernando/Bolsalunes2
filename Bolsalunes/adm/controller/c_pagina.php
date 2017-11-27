<?php

@session_start();
include_once("../model/m_pagina.php");
$obj_pagina = new m_pagina();

$forma = $_REQUEST["forma"];

if ($forma == 'bus_pxm') {

    $p_id_modulo = $_REQUEST["p_id_modulo"];
    $p_id_pagina = $_REQUEST["p_id_pagina"];
    $cuerpo = "";

    $lista_pagina = $obj_pagina->lis_pagina($p_id_modulo);
    $nro = count($lista_pagina);
    if ($nro > 0) {
        $cabecera = "<table class='table table-hover' align='center' width='80%'>
       <thead>
                            <tr class='tr_titulo'> 
                                <td width='10%'>Código</td>
                                <td width='50%'>Nombre</td>
                                <td width='50%'>Url</td>
                                <td width='20%'>Estado</td>
                                <td width='10%'>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>";

        for ($i = 0; $i < $nro; $i++) {
            $cod_pagina = $lista_pagina[$i]['id_pagina'];
            $nombre = $lista_pagina[$i]['nombre'];
            $url = $lista_pagina[$i]['url'];
            $estado = $lista_pagina[$i]['ind_estado'];

            if ($estado == "A") {
                $msg_estado = "<span class='label label-success'>Activo</span>";
            } else {
                $msg_estado = "<span class='label label-danger'>Inactivo</span>";
            }
            $cuerpo = $cuerpo . "<tr class='registro'> 
               <td align='center'>$cod_pagina</td>
               <td align='left'>$nombre</td>
               <td align='left'>$url</td>
               <td align='center'>$msg_estado</td>
               <td><a href='javascript:void(0);' class='btn btn-xs btn-danger' onclick='preguntar_eliminar($cod_pagina,$p_id_pagina);'><i class='fa fa-times'></i></a></td></tr>";
        
            
             
            
            
            }
        echo $cabecera . " " . $cuerpo . "</tbody></table>"; //$cabecera."".$cuerpo."</table>";     
    } else {

        echo "<table class='tabla_reporte' align='center' border='1' width='80%' ><tr class='registro'><td colspan='3'>Sin datos</td></tr></table>";
    }
}

if ($forma == 'ins_pxm') {
    $id_pagina = 0;
    $id_modulo = $_REQUEST["id_modulo"];
    $nombre = $_REQUEST["nombre"];
    $url = $_REQUEST["url"];
    $estado = $_REQUEST["estado"];
    if ($estado == 'true') {
        $estado = "A";
    } else {
        $estado = "I";
    }
    $accion = 'I';
    $res = $obj_pagina->crud_pagina($id_pagina, $id_modulo, $nombre, $url, $estado, $accion);
    echo 'OK';
}
 
if ($forma == 'del_pxm') {

    $id_pagina = $_REQUEST["id_pagina"];
    $id_modulo = 0;
    $nombre = "";
    $url = "";
    $estado = "";
    $accion = 'E';
    $res = $obj_pagina->crud_pagina($id_pagina, $id_modulo, $nombre, $url, $estado, $accion);
    echo 'OK';
}
 
?>