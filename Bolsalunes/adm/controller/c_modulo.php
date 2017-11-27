<?php
@session_start();
include_once("../model/m_modulo.php");
$obj_modulo = new m_modulo();
    
$p_accion = $_REQUEST["p_accion"];
$p_id_modulo = $_REQUEST["p_id_modulo"];
$p_nombre = $_REQUEST["p_nombre"];
$p_abreviatura = $_REQUEST["p_abreviatura"];
$p_estado = $_REQUEST["p_estado"];
$p_icono = $_REQUEST["p_icono"];
$p_orden = $_REQUEST["p_orden"];
$p_usuario = $_SESSION['id_persona'];

if ($p_estado == 'true') {
    $p_estado = "A";
} else {
    $p_estado = "I";
}

switch ($p_accion) {
    case "I":
        $res = $obj_modulo->sp_crud_modulo($p_id_modulo, $p_nombre, $p_abreviatura, $p_estado, $p_orden, $p_icono, $p_usuario, $p_accion);
        echo "OK";
        break;
    case "A":
        $res = $obj_modulo->sp_crud_modulo($p_id_modulo, $p_nombre, $p_abreviatura, $p_estado, $p_orden, $p_icono, $p_usuario, $p_accion);
        echo "OK";
        break;
    case "E":
        $res = $obj_modulo->sp_crud_modulo($p_id_modulo, $p_nombre, $p_abreviatura, $p_estado, $p_orden, $p_icono, $p_usuario, $p_accion);
        echo "OK";
        break;
    case "B_UNO":
        $resp = $obj_modulo->lis_modulo($p_id_modulo);
        if ($resp != null) {
            echo $resp[0]["id_modulo"] . "," . $resp[0]["nombre"] . "," . $resp[0]["abreviatura"] . "," . $resp[0]["ind_estado"]. "," . $resp[0]["orden"]. "," . $resp[0]["icono"];
        } else {
            echo $resp;
        }
        break;
}
?>
