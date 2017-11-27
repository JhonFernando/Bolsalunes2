<?php

@session_start();

include_once("../model/m_habilidades.php");

$obj_habilidades = new m_habilidades();

$p_accion = $_REQUEST["p_accion"];

$p_usuario_reg = $_SESSION['id_persona'];





if ($p_accion == 'I') {

    $p_id_habilidades = $_REQUEST["p_id_habilidades"];
    $p_id_tipo_habilidades = $_REQUEST["p_id_tipo_habilidades"];


    $res = $obj_habilidades->sp_crud_habilidades(0, $p_id_tipo_habilidades, $p_usuario_reg, $p_accion);
    echo "OK";
}


if ($p_accion == 'E') {

    $p_id_habilidades = $_REQUEST["p_id_habilidades"];
    $p_id_tipo_habilidades = $_REQUEST["p_id_tipo_habilidades"];

    $res = $obj_habilidades->sp_crud_habilidades($p_id_habilidades, $p_id_tipo_habilidades, $p_usuario_reg, $p_accion);
    echo "OK";
}
 
?>
