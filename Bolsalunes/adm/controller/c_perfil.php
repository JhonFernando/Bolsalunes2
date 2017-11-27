<?php

include_once("../model/m_perfil.php");
$obj_perfil = new m_perfil();

$forma = $_REQUEST["forma"];

if ($forma == 'bus_perfil') {
    $id_pagina = $_REQUEST['id_pagina'];
    $id_rol = $_REQUEST["rol"];

    $cuerpo = "";
    $lista_perfil = $obj_perfil->lis_perfil($id_rol);
    $nro = count($lista_perfil);

    $cabecera = "<table class='table table-hover' align='center'  width='70%'>
                     <thead>
                        <tr class='tr_titulo'>
                           <td width='10%'>#.</td>
                           <td width='20%'>Usuario</td>
                           <td width='60%'>Persona</td>
                           <td width='10%'>Acciones</td>
                        </tr>
                     </thead>
                     <tbody>";
    if ($nro > 0) {
        for ($i = 0; $i < $nro; $i++) {
            $cod_perfil = $lista_perfil[$i]['id_perfil'];
            $usuario = $lista_perfil[$i]['usuario'];
            $persona = $lista_perfil[$i]['persona'];

            $cuerpo = $cuerpo . "<tr class='registro'>
            <td width='10%' align='center'>" . ($i + 1) . "</td>
            <td width='20%' align='left'>$usuario</td>
            <td width='60%' align='left'>$persona</td>
            <td width='10%'><a href='javascript:void(0);' class='btn btn-xs btn-danger' onclick='preguntar_eliminar_perfil($cod_perfil,$id_pagina);'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>";
    } else {
        echo $cabecera . "<tr class='registro'><td colspan='4'>Sin datos</td></tr></tbody></table>";
    }
}

if ($forma == 'del_perfil') {
    $id_perfil = $_REQUEST["codigo"];
    $id_rol = 0;
    $id_usuario = 0;
    $accion = 'D';
    $res = $obj_perfil->crud_perfil($id_perfil, $id_rol, $id_usuario, $accion);
    echo 'OK';
}

if ($forma == 'ins_perfil') {
    $id_perfil = 0;
    $id_rol = $_REQUEST["rol"];
    $id_usuario = $_REQUEST["usuario"];
    $accion = 'I';
    $res = $obj_perfil->crud_perfil($id_perfil, $id_rol, $id_usuario, $accion);
    echo 'OK';
}
?>