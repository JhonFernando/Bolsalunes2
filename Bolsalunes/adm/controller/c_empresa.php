<?php

@session_start();
include_once("../model/m_empresa.php");
$obj = new m_empresa();
$p_accion = $_REQUEST["p_accion"];
$p_id_empresa_cliente = $_REQUEST["p_id_empresa_cliente"];
$usuario_reg = $_SESSION['usuario'];
    
switch ($p_accion) {
    case "I":
        $p_ruc = $_REQUEST["p_ruc"];
        $p_razon_social = $_REQUEST["p_razon_social"];
        $p_actividad_economica = $_REQUEST["p_actividad_economica"];
        $p_lugar_trabajo = $_REQUEST["p_lugar_trabajo"];
        $p_id_distrito = $_REQUEST["p_distrito"];
        $id_persona = $_SESSION['id_persona'];
        $res = $obj->sp_crud_empresa_cliente($p_id_empresa_cliente, $p_ruc, $p_razon_social, $p_actividad_economica, $p_lugar_trabajo, $p_id_distrito, $id_persona, $p_accion);
        echo "OK";
        break;
    
    
     case "A":
        $p_id_empresa_cliente = $_REQUEST["p_id_empresa_cliente"];
        $p_ruc = $_REQUEST["p_ruc"];
        $p_razon_social = $_REQUEST["p_razon_social"];
        $p_actividad_economica = $_REQUEST["p_actividad_economica"];
        $p_lugar_trabajo = $_REQUEST["p_lugar_trabajo"];
        $p_id_distrito = $_REQUEST["p_distrito"];
        $id_persona = $_SESSION['id_persona'];
        $res = $obj->sp_crud_empresa_cliente($p_id_empresa_cliente, $p_ruc, $p_razon_social, $p_actividad_economica, $p_lugar_trabajo, $p_id_distrito, $id_persona, $p_accion);
        echo "OK";
        break;
    
    case "E":
        $p_ruc = "0";
        $p_razon_social = "0";
        $p_actividad_economica = "0";
        $p_lugar_trabajo = "0";
        $p_id_distrito = "0";
        $id_persona = "0";
        $res = $obj->sp_crud_empresa_cliente($p_id_empresa_cliente, $p_ruc, $p_razon_social, $p_actividad_economica, $p_lugar_trabajo, $p_id_distrito, $id_persona, $p_accion);
        echo "OK";
        break;
}
if ($p_accion == 'I_CONTRATA') {

    $id_contrata= $_REQUEST["id_contrata"];
    $ruc= $_REQUEST["ruc"];
    $nombre= $_REQUEST["nombre"];
    $id_empresa= $_REQUEST["id_empresa"];
    $id_pagina= $_REQUEST["id_pagina"]; 
    $res = $obj->sp_crud_contrata(0, $ruc, $nombre, $id_empresa, $usuario_reg, "I");
     
    $cuerpo = "";
    $listax = $obj->sp_dame_contrata($id_empresa);
    $nro = count($listax);

    $cabecera = "<table class='table table-hover' align='center' width='80%'>
                     <thead>
                        <tr class='tr_titulo'>
                                  <td width='3%'>código</td>
                                    <td width='10%'>ruc</td>
                                    <td width='10%'>razón social</td> 
                                    <td width='10%'>usuario reg</td>
                                    <td width='15%'>fecha reg</td>
                                    <td width='10%'>Acciones</td>
                        </tr>
                     </thead>
                     <tbody>";
    if ($nro > 0) {
        for ($i = 0; $i < $nro; $i++) {
             $id_contrata = $listax[$i]['id_contrata'];
             $ruc = $listax[$i]['ruc'];
             $nombre = $listax[$i]['nombre'];
             $usuario_reg = $listax[$i]['usuario_reg'];
             $fecha_reg = $listax[$i]['fecha_reg'];
    

            $cuerpo = $cuerpo . "<tr class='registro'>
            <td align='center' width='3%'>$id_contrata</td>
            <td align='center' width='10%'>$ruc</td>
            <td align='left' width='10%'>$nombre</td>
            <td align='left' width='10%'>$usuario_reg</td> 
            <td align='left' width='15%'>$fecha_reg</td>
            <td>
                <a href='javascript:void(0);' onclick='preguntar_eliminar($id_contrata,$id_pagina);' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>";
    } else {
        echo $cabecera . "<tr class='registro'><td colspan='6'>Sin datos</td></tr></tbody></table>";
    }
}


if ($p_accion == 'E_CONTRATA') {

    $id_contrata= $_REQUEST["id_contrata"];
    $ruc= "ok";
    $nombre= "ok";
    $id_empresa= $_REQUEST["id_empresa"];
    $id_pagina= $_REQUEST["id_pagina"];
    $res = $obj->sp_crud_contrata($id_contrata, $ruc, $nombre, $id_empresa, $usuario_reg, "E");
     
    $cuerpo = "";
    $listax = $obj->sp_dame_contrata($id_empresa);
    $nro = count($listax);

    $cabecera = "<table class='table table-hover' align='center' width='80%'>
                     <thead>
                        <tr class='tr_titulo'>
                                  <td width='3%'>código</td>
                                    <td width='10%'>ruc</td>
                                    <td width='10%'>razón social</td> 
                                    <td width='10%'>usuario reg</td>
                                    <td width='15%'>fecha reg</td>
                                    <td width='10%'>Acciones</td>
                        </tr>
                     </thead>
                     <tbody>";
    if ($nro > 0) {
        for ($i = 0; $i < $nro; $i++) {
             $id_contrata = $listax[$i]['id_contrata'];
             $ruc = $listax[$i]['ruc'];
             $nombre = $listax[$i]['nombre'];
             $usuario_reg = $listax[$i]['usuario_reg'];
             $fecha_reg = $listax[$i]['fecha_reg'];
    

            $cuerpo = $cuerpo . "<tr class='registro'>
            <td align='center' width='3%'>$id_contrata</td>
            <td align='center' width='10%'>$ruc</td>
            <td align='left' width='10%'>$nombre</td>
            <td align='left' width='10%'>$usuario_reg</td> 
            <td align='left' width='15%'>$fecha_reg</td>
            <td>
                <a href='javascript:void(0);' onclick='preguntar_eliminar($id_contrata,$id_pagina);' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>";
    } else {
        echo $cabecera . "<tr class='registro'><td colspan='6'>Sin datos</td></tr></tbody></table>";
    }
}



if ($p_accion == 'A_CONTRATA') {
    $id_contrata= $_REQUEST["id_contrata"];
    $ruc= $_REQUEST["ruc"];
    $nombre= $_REQUEST["nombre"];
    $id_empresa= $_REQUEST["id_empresa"]; 
    $res = $obj->sp_crud_contrata($id_contrata, $ruc, $nombre, $id_empresa, $usuario_reg, "A");
    echo "OK";
}

    

if ($p_accion == 'B_U') {
    $p_id_empresa_cliente = $_REQUEST["p_id_empresa_cliente"];
    $resp = $obj->sp_dame_empresa_cliente($p_id_empresa_cliente);
    
    if ($resp != null) {
        echo $resp[0]["id_empresa_cliente"] . ";" .
        $resp[0]["ruc"] . ";" .
        $resp[0]["razon_social"] . ";" .
        $resp[0]["actividad_economica"] . ";" .
        $resp[0]["ubicacion_empresa"] . ";" .
        $resp[0]["id_distrito"] . ";" .
        $resp[0]["id_provincia"] . ";" .
        $resp[0]["id_departamento"];
    } else {
        echo $resp;
    }
}
if ($p_accion == 'I_MEDICO_EXT') {

    $p_id_medico= $_REQUEST["id_medico"]; 
    $p_id_empresa= $_REQUEST["id_empresa"];
    $id_pagina= $_REQUEST["id_pagina"]; 
    $res = $obj->sp_crud_empresa_medico(0, $p_id_empresa, $p_id_medico, $usuario_reg, "I");
     
    $cuerpo = "";
    $listax = $obj->sp_dame_medicos_empresa($p_id_empresa);
    $nro = count($listax);

    $cabecera = "<table class='table table-hover' align='center' width='80%'>
                     <thead>
                        <tr class='tr_titulo'>
                              <td width='3%'>código</td>
                                    <td width='10%'>Médico</td> 
                                    <td width='10%'>usuario reg</td>
                                    <td width='15%'>fecha reg</td>
                                    <td width='10%'>Acciones</td>
                        </tr>
                     </thead>
                     <tbody>";
    if ($nro > 0) {
        for ($i = 0; $i < $nro; $i++) {
            $id_empresa_medico = $listax[$i]['id_empresa_medico'];
                                    $id_empresa = $listax[$i]['id_empresa'];
                                    $medico = $listax[$i]['medico'];
                                    $usuario_reg = $listax[$i]['usuario_reg'];
                                    $fecha_reg = $listax[$i]['fecha_reg'];

            $cuerpo = $cuerpo . "<tr class='registro'>
            <td align='center' width='3%'>$id_empresa_medico</td>
            <td align='center' width='10%'>$medico</td> 
            <td align='left' width='10%'>$usuario_reg</td> 
            <td align='left' width='15%'>$fecha_reg</td>
            <td>
                <a href='javascript:void(0);' onclick='preguntar_eliminar($id_empresa_medico,$id_pagina);' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>";
    } else {
        echo $cabecera . "<tr class='registro'><td colspan='6'>Sin datos</td></tr></tbody></table>";
    }
}
if ($p_accion == 'E_MEDICO_EXT') {

    $id_empresa_medico= $_REQUEST["id_empresa_medico"]; 
    $p_id_empresa= $_REQUEST["id_empresa"];
    $id_pagina= $_REQUEST["id_pagina"]; 
    $res = $obj->sp_crud_empresa_medico($id_empresa_medico, $p_id_empresa, 0, $usuario_reg, "E");
     
    $cuerpo = "";
    $listax = $obj->sp_dame_medicos_empresa($p_id_empresa);
    $nro = count($listax);

    $cabecera = "<table class='table table-hover' align='center' width='80%'>
                     <thead>
                        <tr class='tr_titulo'>
                              <td width='3%'>código</td>
                                    <td width='10%'>Médico</td> 
                                    <td width='10%'>usuario reg</td>
                                    <td width='15%'>fecha reg</td>
                                    <td width='10%'>Acciones</td>
                        </tr>
                     </thead>
                     <tbody>";
    if ($nro > 0) {
        for ($i = 0; $i < $nro; $i++) {
            $id_empresa_medico = $listax[$i]['id_empresa_medico'];
                                    $id_empresa = $listax[$i]['id_empresa'];
                                    $medico = $listax[$i]['medico'];
                                    $usuario_reg = $listax[$i]['usuario_reg'];
                                    $fecha_reg = $listax[$i]['fecha_reg'];

            $cuerpo = $cuerpo . "<tr class='registro'>
            <td align='center' width='3%'>$id_empresa_medico</td>
            <td align='center' width='10%'>$medico</td> 
            <td align='left' width='10%'>$usuario_reg</td> 
            <td align='left' width='15%'>$fecha_reg</td>
            <td>
                <a href='javascript:void(0);' onclick='preguntar_eliminar($id_empresa_medico,$id_pagina);' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>";
    } else {
        echo $cabecera . "<tr class='registro'><td colspan='6'>Sin datos</td></tr></tbody></table>";
    }
}


?>
