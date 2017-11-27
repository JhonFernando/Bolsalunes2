<?php

include_once("../model/m_formulario_rol.php");
include_once("../model/m_formulario.php");
$obj_formulario_rol = new m_formulario_rol();
$obj_formulario = new m_formulario();
$forma = $_REQUEST["forma"];

if ($forma == 'del_form_rol') {
    $id_rol = $_REQUEST["id_rol"];
    $id_pagina = $_REQUEST["id_pagina"];
    $accion = 'D';
    $res = $obj_formulario_rol->crud_formulario_rol_individual($id_rol, $id_pagina, $accion);
    echo "ok";
}

if ($forma == 'upd_form_rol') {
    $id_rol = $_REQUEST["id_rol"];
    $id_formulario = $_REQUEST["id_formulario"];
    $accion = 'U';
    $res = $obj_formulario_rol->upd_formulario_rol($id_rol, $id_formulario, $accion);
    echo "ok";
}

if ($forma == 'ins_form_rol') {
    $id_rol = $_REQUEST["id_rol"];
    $id_pagina = $_REQUEST["id_pagina"];
    $accion = 'I';
    $res = $obj_formulario_rol->crud_formulario_rol_individual($id_rol, $id_pagina, $accion);
    echo "ok";
}

if ($forma == 'bus_form_rol') {
    $id_rol = $_REQUEST["id_rol"];
    $lista_form_rol = $obj_formulario_rol->lis_formulario_xrol($id_rol);
    $nro = count($lista_form_rol);
    $cabecera = "";
    $cuerpo = "";
    if ($nro > 0) {
        $cabecera = $cabecera . "<table class='table table-hover' align='center'  width='90%'>" .
                "<thead>" .
                "<tr class='tr_titulo'>" .
                "<td width = '5%'>#</td>" .
                "<td width = '15%'>Módulo</td>" .
                "<td width = '25%'>Página</td>" .
                "<td width = '50%'>Formularios</td>" .
                "<td width = '5%'>Acciones</td>" .
                "</tr>" .
                "</thead>" .
                "<tbody>";

        for ($i = 0; $i < $nro; $i++) {
            $formularios = "";

            $id_pagina = $lista_form_rol[$i]['id_pagina'];
            $id_modulo = $lista_form_rol[$i]['id_modulo'];
            $id_rol = $lista_form_rol[$i]['id_rol'];
            $nombre_modulo = $lista_form_rol[$i]['nombre_modulo'];
            $nombre_pagina = $lista_form_rol[$i]['nombre_pagina'];
            $lista_formularios = $obj_formulario->lis_formulario_xpagina($id_pagina);
            $nro_form = count($lista_formularios);
            for ($j = 0; $j < $nro_form; $j++) {
                $id_formulario = $lista_formularios[$j]['id_formulario'];
                $titulo = "&nbsp&nbsp&nbsp&nbsp" . $lista_formularios[$j]['accion'] . "&nbsp";
                $lista_form_rol2 = $obj_formulario_rol->lis_formulario_xrol2($id_rol);
                $activar = "";
                for ($k = 0; $k < count($lista_form_rol2); $k++) {
                    if ($lista_form_rol2[$k]['id_formulario'] == $id_formulario) {
                        $activar = "checked";
                    }
                }

                if ($j == 0) {
                    $activar_js = "return false";
                } else {
                    $activar_js = "actualizar_formulario($id_formulario,$id_rol)";
                }

                $formularios = $formularios . $titulo . "<input type = checkbox onclick='$activar_js'   name = c1[] value = '$id_formulario' $activar  />";
            }

            $cuerpo = $cuerpo . "<tr class = 'registro'>" .
                    "<td width = '5%' align = 'center'>" . ($i + 1) . "</td>" .
                    "<td width = '15%' align = 'left'>$nombre_modulo</td>" .
                    "<td width = '25%' align = 'left'>$nombre_pagina</td>" .
                    "<td width = '50%' align = 'left'>$formularios</td>" .
                    "<td width = '5%'>
                    <a href='javascript:void(0);' class='btn btn-xs btn-danger' onclick='preguntar_eliminar($id_pagina,$id_rol);'><i class='fa fa-times'></i></a></td></tr>";
        }
        echo $cabecera . " " . $cuerpo . "</tbody></table>"; //$cabecera."".$cuerpo."</table>";     
    } else {

        echo "<table class = 'tabla_reporte' align = 'center' border = '1' width = '90%' ><tr class = 'registro'><td colspan = '3'>Sin datos</td></tr></table>";
    }
}
?>