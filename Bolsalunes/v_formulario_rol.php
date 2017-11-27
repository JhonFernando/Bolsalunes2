<?php
@session_start();
require_once("inc/init.php");
include_once("adm/model/m_rol.php");
include_once("adm/model/m_modulo.php");
include_once("adm/model/m_formulario_rol.php");

$obj_rol = new m_rol();
$obj_modulo = new m_modulo();

//inicio de privilegios (esto va en todas las paginas)
$obj_fxr = new m_formulario_rol();
$_SESSION['id_pagina'] = $_REQUEST['id_pagina'];
$id_pagina = $_SESSION['id_pagina'];
$id_persona = $_SESSION['id_persona'];
$listaPrivilegios = $obj_fxr->dame_privilegios_xidpagina($id_persona, $id_pagina);
$flag_nuevo = 0;
$flag_modif = 0;
$flag_elim = 0;
for ($i = 0; $i < (count($listaPrivilegios)); $i++) {
    if ($listaPrivilegios[$i]['accion'] == 'Registrar') {
        $flag_nuevo = 1;
    }
    if ($listaPrivilegios[$i]['accion'] == 'Modificar') {
        $flag_modif = 1;
    }
    if ($listaPrivilegios[$i]['accion'] == 'Eliminar') {
        $flag_elim = 1;
    }
}
//fin de privilegios

$lista_roles = $obj_rol->lis_rol(0);
$lista_modulo_pagina = $obj_modulo->lis_modulo_pagina();
?>

<script>
    function mostrar_ok() {

        $.smallBox({
            title: "Información!",
            content: "<i class='fa fa-clock-o'></i> <i>La operación se realizó correctamente...</i>",
            color: "#659265",
            iconSmall: "fa fa-check fa-2x fadeInRight animated",
            timeout: 4000
        });
    }

    function mostrar_error() {

        $.smallBox({
            title: "Información!",
            content: "<i class='fa fa-clock-o'></i> <i>Ocurrió algún error en la transacción...</i>",
            color: "#C46A69",
            iconSmall: "fa fa-times fa-2x fadeInRight animated",
            timeout: 4000
        });
    }

    function ver_detalle_formulario_rol() {

        var id_rol = $('#cb_rol').val();
        var forma = "bus_form_rol";
        $("#cargando").css("display", "block");
        msjLoadList("#cargando", "buscando..");
        $.post('adm/controller/c_formulario_rol.php', {
            id_rol: id_rol,
            forma: forma
        }, function (data) {

            MostrarData("#tabla_detalle_formulario_rol", data);
            $("#cargando").css("display", "none");

        });
    }

    function agregar_formulario_rol() {

        var id_rol = $('#cb_rol').val();
        var id_pagina = $('#cb_pagina').val();
        var forma = "ins_form_rol";
        $.post('adm/controller/c_formulario_rol.php', {
            id_rol: id_rol,
            id_pagina: id_pagina,
            forma: forma
        }, function (data) {

            ver_detalle_formulario_rol();
            //                        limpiar();
        });
    }

    function eliminar_formulario_rol(id_pagina, id_rol) {

        var forma = "del_form_rol";
            $.post('adm/controller/c_formulario_rol.php', {
                id_rol: id_rol,
                id_pagina: id_pagina,
                forma: forma

            }, function (data) {

                ver_detalle_formulario_rol();
            });

         

    }

    function actualizar_formulario(id_formulario, id_rol) {

        var forma = "upd_form_rol";
        $.post('adm/controller/c_formulario_rol.php', {
            id_rol: id_rol,
            id_formulario: id_formulario,
            forma: forma

        }, function (data) {

            ver_detalle_formulario_rol();
            //                        limpiar();
        });

    }




</script>


<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i> Seguridad <span>>
                Formularios por Roles </span></h1>
    </div>
    <!-- end col -->


    <!-- end col -->

</div>

<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET ROW START -->
        <div class="col-sm-2"></div>
        <div class="col-sm-8">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">

                <header>
                    <h2>Formulario 1</h2>
                </header>

                <!-- widget div-->

                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                        <input class="form-control" type="text">
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">


                        <fieldset>
                            <legend>
                                Asignación de Formularios por Roles
                            </legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"> 
                                    </div>

                                    <div class="col-md-8 selectContainer">
                                        <label class="control-label">Rol:</label> 
                                        <select class="form-control" id="cb_rol" name="cb_rol" onchange="ver_detalle_formulario_rol();" >
                                            <option value='0'> -- SELECCIONE -- </option>
                                            <?php
                                            for ($i = 0; $i < count($lista_roles); $i++) {
                                                $codigo = $lista_roles[$i]["id_rol"];
                                                $nombre = $lista_roles[$i]["nombre"];
                                                $descripcion = $lista_roles[$i]["descripcion"];
                                                ?>
                                                <option value='<?php echo $codigo; ?>'><?php echo $nombre; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    <div class="col-md-2"> 
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8 selectContainer">
                                        <label class="control-label">Formulario:</label>
                                        <select class="form-control"   id="cb_pagina" name="cb_pagina" >
                                        <option value='0'> -- SELECCIONE -- </option>
                                        <?php
                                        for ($j = 0; $j < count($lista_modulo_pagina); $j++) {
                                            $id_pagina = $lista_modulo_pagina[$j]["id_pagina"];
                                            $id_modulo = $lista_modulo_pagina[$j]["id_modulo"];
                                            $nombre_pagina = $lista_modulo_pagina[$j]["nombre_pagina"];
                                            ?>
                                            <option value='<?php echo $id_pagina; ?>'><?php echo $nombre_pagina; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12 col-md-2">
                                        <?php if ($flag_nuevo == 1) { ?>
                                         <button href="javascript:void(0);" onclick="agregar_formulario_rol();" class="btn btn-default"><span class="icon icon-plus"></span>Agregar</button>
                                    <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <hr>
                                    <div id="tabla_detalle_formulario_rol"></div>
                                </div>

                            </div>
                        </fieldset>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </div>

    </div>

    <!-- end row -->

</section>


<script>

  function preguntar_eliminar(id_pagina,id_rol ) {

        $.SmartMessageBox({
            title: "Eliminacion!",
            content: "Deseas eliminar realmente este registro?",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                eliminar_formulario_rol(id_pagina, id_rol);
                $.smallBox({
                    title: "Información",
                    content: "<i class='fa fa-clock-o'></i> <i>La operación se realizó correctamente...</i>",
                    color: "#659265",
                    iconSmall: "fa fa-check fa-2x fadeInRight animated",
                    timeout: 4000
                });
            }
            if (ButtonPressed === "No") {
                $.smallBox({
                    title: "Información",
                    content: "<i class='fa fa-clock-o'></i> <i>No se realizó ninguna operación...</i>",
                    color: "#C46A69",
                    iconSmall: "fa fa-times fa-2x fadeInRight animated",
                    timeout: 4000
                });
            }

        });
        e.preventDefault();
    }

    $('#perrito').click(function (e) {
        var eliminar = function () {}
        loadScript("js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", eliminar);
    });

</script>
 