<?php

include_once("../model/m_grado_instruccion.php");
$obj_grado_instruccion = new m_grado_instruccion();

$p_accion = $_REQUEST["p_accion"];
$p_id_grado_instruccion= $_REQUEST["p_id_grado_instruccion"];
$p_nombre = $_REQUEST["p_nombre"];
$p_estado = $_REQUEST["p_estado"];

if ($p_estado == 'true') {
    $p_estado = "A";
} else {
    $p_estado = "I";
}

switch ($p_accion) {
    case "I":
        $res = $obj_grado_instruccion->crud_grado_instruccion($p_id_grado_instruccion, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "A":
        $res = $obj_grado_instruccion->crud_grado_instruccion($p_id_grado_instruccion, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "E":
        $res = $obj_grado_instruccion->crud_grado_instruccion($p_id_grado_instruccion, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "B_UNO":
        $resp = $obj_grado_instruccion->lis_grado_instruccion($p_id_grado_instruccion);
        if ($resp != null) {
            echo $resp[0]["id_grado_instruccion"] . "," . $resp[0]["nombre"]  . "," . $resp[0]["estado"];
        } else {
            echo $resp;
        }
        break;
}
?>
