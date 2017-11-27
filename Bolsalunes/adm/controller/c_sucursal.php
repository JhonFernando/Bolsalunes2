<?php
include_once("../model/m_sucursal.php");
$obj = new m_sucursal();

$p_accion = $_REQUEST["p_accion"];
$p_empresa = $_REQUEST["p_empresa"];

if ($p_accion == 'B') {

    $cuerpo = "";
    $lista_surcursal = $obj->dame_sucursal_xempresa(0, $p_empresa);


    for ($i = 0; $i < count($lista_surcursal); $i++) {
        $id_sucursal = $lista_surcursal[$i]["id_sucursal"];
        $nombre = $lista_surcursal[$i]["nombre"];
      $cuerpo = $cuerpo . "<option value='$id_sucursal'>$nombre</option>";
    }  

    echo "<select id='dd_sucursal' name='dd_sucursal' style='width: 50%'>" . $cuerpo . "</select>";

}

?>