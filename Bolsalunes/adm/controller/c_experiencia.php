<?php

@session_start();

include_once("../model/m_experiencia.php");

$obj_experiencia = new m_experiencia();

$p_accion = $_REQUEST["p_accion"];

$p_usuario_reg = $_SESSION['id_persona'];




//hace el envio de datoa a ingresar al procedimiento almacenado
if ($p_accion == 'I') {

    $p_id_experiencia = $_REQUEST["p_id_experiencia"];
    $p_empresa = $_REQUEST["p_empresa"];
    $p_puesto = $_REQUEST["p_puesto"];
    $p_trabajo_realizado = $_REQUEST["p_trabajo_realizado"];
    $p_fecha_inicio = $_REQUEST["p_fecha_inicio"];
    $p_fecha_fin = $_REQUEST["p_fecha_fin"];
    $p_descripcion = $_REQUEST["p_descripcion"];

    $res = $obj_experiencia->sp_crud_experiencia(0, $p_empresa, $p_puesto, $p_trabajo_realizado, $p_fecha_inicio, $p_fecha_fin, $p_descripcion, $p_usuario_reg, $p_accion);
    echo "OK";
}
//envia data para la actualización
if ($p_accion == 'A') {

    $p_id_experiencia = $_REQUEST["p_id_experiencia"];
    $p_empresa = $_REQUEST["p_empresa"];
    $p_puesto = $_REQUEST["p_puesto"];
    $p_trabajo_realizado = $_REQUEST["p_trabajo_realizado"];
    $p_fecha_inicio = $_REQUEST["p_fecha_inicio"];
    $p_fecha_fin = $_REQUEST["p_fecha_fin"];
    $p_descripcion = $_REQUEST["p_descripcion"];

    $res = $obj_experiencia->sp_crud_experiencia($p_id_experiencia,$p_empresa, $p_puesto, $p_trabajo_realizado, $p_fecha_inicio, $p_fecha_fin, $p_descripcion, $p_usuario_reg, $p_accion);
    echo "OK";
}
 //aca es que va a eliminar la data
if ($p_accion == 'E') {

    $p_id_experiencia = $_REQUEST["p_id_experiencia"];
    $p_empresa = $_REQUEST["p_empresa"];
    $p_puesto = $_REQUEST["p_puesto"];
    $p_trabajo_realizado = $_REQUEST["p_trabajo_realizado"];
    $p_fecha_inicio = $_REQUEST["p_fecha_inicio"];
    $p_fecha_fin = $_REQUEST["p_fecha_fin"];
    $p_descripcion = $_REQUEST["p_descripcion"];

    $res = $obj_experiencia->sp_crud_experiencia($p_id_experiencia,$p_empresa, $p_puesto, $p_trabajo_realizado, $p_fecha_inicio, $p_fecha_fin, $p_descripcion, $p_usuario_reg, $p_accion);
    echo "OK";
}
//muestra datos para las actualizaciones rese

if ($p_accion == 'B_UNO') {
    $p_id_experiencia = $_REQUEST["p_id_experiencia"];
    $resp = $obj_experiencia->sp_dame_experiencia($p_id_experiencia);
    if ($resp != null) {
        echo $resp[0]["id_experiencia"] . "," . $resp[0]["empresa"] . "," . $resp[0]["puesto"] . "," . $resp[0]["trabajo_realizado"] . "," . $resp[0]["fecha_inicio"] . "," . $resp[0]["fecha_fin"] . "," . $resp[0]["descripcion"];
    } else {
        echo $resp;
    }
}
?>
