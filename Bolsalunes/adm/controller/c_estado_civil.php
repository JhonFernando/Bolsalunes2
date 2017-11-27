<?php

include_once("../model/m_estado_civil.php");
$obj_estado_civil= new m_estado_civil();

$p_accion = $_REQUEST["p_accion"];
$p_id_estado_civil= $_REQUEST["p_id_estado_civil"];
$p_nombre = $_REQUEST["p_nombre"];
$p_estado = $_REQUEST["p_estado"];

if ($p_estado == 'true') {
    $p_estado = "A";
} else {
    $p_estado = "I";
}

switch ($p_accion) {
    case "I":
        $res = $obj_estado_civil->crud_estado_civil($p_id_estado_civil, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "A":
        $res = $obj_estado_civil->crud_estado_civil($p_id_estado_civil, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "E":
        $res = $obj_estado_civil->crud_estado_civil($p_id_estado_civil, $p_nombre,  $p_estado, $p_accion);
        echo "OK";
        break;
    case "B_UNO":
        $resp = $obj_estado_civil->lis_estado_civil($p_id_estado_civil);
        if ($resp != null) {
            echo $resp[0]["id_estado_civil"] . "," . $resp[0]["nombre"]  . "," . $resp[0]["estado"];
        } else {
            echo $resp;
        }
        break;
}
?>
