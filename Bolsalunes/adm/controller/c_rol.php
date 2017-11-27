<?php

include_once("../model/m_rol.php");
$obj_rol = new m_rol();

$p_accion = $_REQUEST["p_accion"];
$p_id_rol = $_REQUEST["p_id_rol"];
$p_nombre = $_REQUEST["p_nombre"];
$p_abreviatura = $_REQUEST["p_abreviatura"];
$p_estado = $_REQUEST["p_estado"];

if ($p_estado == 'true') {
    $p_estado = "A";
} else {
    $p_estado = "I";
}

switch ($p_accion) {
    case "I":
        $res = $obj_rol->crud_rol($p_id_rol, $p_nombre, $p_abreviatura, $p_estado, $p_accion);
        echo "OK";
        break;
    case "A":
        $res = $obj_rol->crud_rol($p_id_rol, $p_nombre, $p_abreviatura, $p_estado, $p_accion);
        echo "OK";
        break;
    case "E":
        $res = $obj_rol->crud_rol($p_id_rol, $p_nombre, $p_abreviatura, $p_estado, $p_accion);
        echo "OK";
        break;
    case "B_UNO":
        $resp = $obj_rol->lis_rol($p_id_rol);
        if ($resp != null) {
            echo $resp[0]["id_rol"] . "," . $resp[0]["nombre"] . "," . $resp[0]["abreviatura"] . "," . $resp[0]["ind_estado"];
        } else {
            echo $resp;
        }
        break;
}
?>
