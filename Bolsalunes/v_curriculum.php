<?php
@session_start();
require_once("inc/init.php");
include_once("adm/model/m_util.php");
include_once("adm/model/m_formulario_rol.php");
$obj_util = new m_util();

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


$lista_modulo = $obj_util->llena_combito("A");
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
    function valida() {
        $(".error").remove();
        if ($('#dd_modulo').val() == "0") {
            alert("Seleccione el modulo, por favor.");
            return true;
        }

        if ($('#txt_nombre').val() == "") {
            alert("Ingrese el nombre de la pagina, por favor.");
            return true;
        }
        if ($('#txt_url').val() == "") {
            alert("Ingrese la url de la pagina, por favor.");
            return true;
        }
    }

    function limpiar_formulario() {
        $('#txt_nombre').val("");
        $('#txt_url').val("");
    }

    function ver_paginas_x_modulo(id_pagina) {

        var p_id_modulo = $('#dd_modulo').val();
        var forma = "bus_pxm";
        $("#cargando").css("display", "block");
        msjLoadList("#cargando", "buscando..");
        $.post('adm/controller/c_pagina.php', {
            forma: forma,
            p_id_modulo: p_id_modulo,
            p_id_pagina: id_pagina
        }, function (data) {
            MostrarData("#tabla_paginas", data);
            $("#cargando").css("display", "none");

        });
    }

    function agregar_pagina_x_modulo(id_pagina) {

        if (valida()) {
            return;
        }
        ;

        var id_modulo = $('#dd_modulo').val();
        var nombre = $('#txt_nombre').val();
        var url = $('#txt_url').val();
        var estado = $('#cb_estado').is(':checked');
        var forma = "ins_pxm";
        $.post('adm/controller/c_pagina.php', {
            id_modulo: id_modulo,
            nombre: nombre,
            url: url,
            estado: estado,
            forma: forma

        }, function (data) {
            ver_paginas_x_modulo(id_pagina);
            limpiar_formulario();
            mostrar_ok();
        });
    }

    function preguntar_eliminar(codigo, id_pagina2) {
        bootbox.confirm("¿Deseas eliminar este registro?", function (result) {
            if (result) {
                eliminar(codigo, id_pagina2);
            }
        });
    }

    function eliminar(codigo, id_pagina2)
    {
        var codigo = codigo;
        var forma = "del_pxm";
        $.post('adm/controller/c_pagina.php', {
            id_pagina: codigo,
            forma: forma

        }, function (data) {
            ver_paginas_x_modulo(id_pagina2);
            activar_success();
        });

    }

</script>
<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i> Curriculum <span>>
                Curriculum Vitae </span></h1>
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
                    <h2>#Curriculum vitae </h2>
                </header>

                <!-- widget div-->

                <div>


                    <!-- widget content -->
                    <div class="widget-body">


                        <fieldset>
                            <legend>
                                Estudios Realizados: Primaria
                            </legend>

                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="row">

                                    <div class="  col-md-5">
                                        <label class="control-label">Nro: Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_nombre" id="txt_nombre"/>
                                    </div>

                                    <div class=" col-md-5">
                                        <label class="control-label">Nombre de Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_url"  id="txt_url"/>
                                    </div>
                                    <div class=" col-md-2" >
                                        <label class="control-label"> Accion: </label>
                                        <?php if ($flag_nuevo == 1) { ?>
                                            <button href="javascript:void(0);" onclick="agregar_formulario_rol();" class="btn btn-default"><span class="icon icon-plus"></span>Agregar</button>
                                        <?php } ?>
                                    </div>


                                </div>



                            </div>
                        </fieldset>

                    </div>
                    <!-- end widget content -->
                    <div class="widget-body">


                        <fieldset>
                            <legend>
                                Estudios Realizados: Primaria
                            </legend>

                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="row">

                                    <div class="  col-md-5">
                                        <label class="control-label">Nro: Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_nombre" id="txt_nombre"/>
                                    </div>

                                    <div class=" col-md-5">
                                        <label class="control-label">Nombre de Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_url"  id="txt_url"/>
                                    </div>
                                    <div class=" col-md-2" >
                                        <label class="control-label"> Accion: </label>
                                        <?php if ($flag_nuevo == 1) { ?>
                                            <button href="javascript:void(0);" onclick="agregar_formulario_rol();" class="btn btn-default"><span class="icon icon-plus"></span>Agregar</button>
                                        <?php } ?>
                                    </div>


                                </div>



                            </div>
                        </fieldset>

                    </div>
                    <div class="widget-body">


                        <fieldset>
                            <legend>
                                Estudios Realizados: Primaria
                            </legend>

                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <div class="row">

                                    <div class="  col-md-5">
                                        <label class="control-label">Nro: Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_nombre" id="txt_nombre"/>
                                    </div>

                                    <div class=" col-md-5">
                                        <label class="control-label">Nombre de Institución Educativa:</label>
                                        <input type="text" class="form-control" name="txt_url"  id="txt_url"/>
                                    </div>
                                    <div class=" col-md-2" >
                                        <label class="control-label"> Accion: </label>
                                        <?php if ($flag_nuevo == 1) { ?>
                                            <button href="javascript:void(0);" onclick="agregar_formulario_rol();" class="btn btn-default"><span class="icon icon-plus"></span>Agregar</button>
                                        <?php } ?>
                                    </div>


                                </div>



                            </div>
                        </fieldset>

                    </div>
                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </div>

    </div>

    <!-- end row -->

</section>

<script>

    function preguntar_eliminar(codigo, id_pagina) {

        $.SmartMessageBox({
            title: "Eliminacion!",
            content: "Deseas eliminar realmente este registro?",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                eliminar(codigo, id_pagina);
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
        var eliminar = function () {
        }
        loadScript("js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", eliminar);
    });

</script>

<!-- end widget grid -->
