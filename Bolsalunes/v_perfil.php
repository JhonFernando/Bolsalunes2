<?php
@session_start();
require_once("inc/init.php");
include_once("adm/model/m_rol.php");
include_once("adm/model/m_usuario.php");
include_once("adm/model/m_formulario_rol.php");

$obj_rol = new m_rol();
$obj_usu = new m_usuario(); 

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
$lista_usuarios = $obj_usu->lis_usuarios(0);
  

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

            
            function validar() {
                $(".error").remove();
                if ($('#cb_rol').val() == "0") {
                    $('#cb_rol').focus().after("<span class='error' style='color:red;'>Ingrese...</span>");
                    return false;
                }
                if ($('#cb_usuario').val() == "0") {
                    $('#cb_usuario').focus().after("<span class='error' style='color:red;'>Ingrese...</span>");
                    return false;
                }
                return true;
            }


            function ver_detalle_perfil(id_pagina) {
                var rol = $('#cb_rol').val();
                var forma = "bus_perfil";
                $("#cargando").css("display", "block");
                msjLoadList("#cargando", "buscando..");
                $.post('adm/controller/c_perfil.php', {
                    rol: rol,
                    forma: forma,
                    id_pagina:id_pagina
                }, function (data) {
                    MostrarData("#tabla_detalle_perfil", data);
                    $("#cargando").css("display", "none");

                });
            }
            
            function agregar_perfil(id_pagina) {
                if (validar() == false) return false;
                var rol = $('#cb_rol').val();
                var usuario = $('#cb_usuario').val();
                var forma = "ins_perfil";
                $.post('adm/controller/c_perfil.php', {
                    rol: rol,
                    usuario: usuario,
                    forma: forma

                }, function (data) {
                    ver_detalle_perfil(id_pagina);
                    mostrar_ok();
                });
            }
             
            function eliminar_perfil(codigo,id_pagina)
            {
                var codigo = codigo;
                var forma = "del_perfil";

                $.post('adm/controller/c_perfil.php', {
                    codigo: codigo,
                    forma: forma
                }, function (data) {
                    ver_detalle_perfil(id_pagina); 
                });
                 
            }
            
        </script>
      
        
        
<div class="row">

    <!-- col -->
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i> Seguridad <span>>
                Perfiles de los Usuarios </span></h1>
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
                    <h2>Formulario 2 </h2>
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
                                Asignación de Usuarios por Roles
                            </legend>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2"> 
                                    </div>

                                    <div class="col-md-8 selectContainer">
                                        <label class="control-label">Rol:</label> 
                                          
                                        <select class="form-control" id="cb_rol" name="cb_rol" onchange="ver_detalle_perfil(<?php echo $id_pagina; ?>);" >
                                        <option value='0'> -- SELECCIONE -- </option>
                                        <?php
                                        for ($i = 0; $i < count($lista_roles); $i++) {
                                            $codigo = $lista_roles[$i]["id_rol"];
                                            $nombre = $lista_roles[$i]["nombre"];
                                           
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
                                        <label class="control-label">Empleado:</label>
                                        <select class="form-control" tabindex="2" id="cb_usuario" name="cb_usuario" >
                                        <option value='0'> -- SELECCIONE -- </option>
                                        <?php
                                        for ($i = 0; $i < count($lista_usuarios); $i++) {
                                            $codigo = $lista_usuarios[$i]["id_usuario"];
                                            $coddes = $lista_usuarios[$i]["coddes"];
                                            $descripcion = $lista_usuarios[$i]["descripcion"];
                                            ?>
                                            <option value='<?php echo $codigo; ?>'><?php echo $coddes; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12 col-md-2">
                                        <?php if ($flag_nuevo == 1) { ?>
                                         <button href="javascript:void(0);" onclick="agregar_perfil(<?php echo $id_pagina; ?>);" class="btn btn-default"><span class="icon icon-plus"></span>Agregar</button>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <hr>
                                    <div id="tabla_detalle_perfil"></div>
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

  function preguntar_eliminar_perfil(id_perfil,id_pagina ) {

        $.SmartMessageBox({
            title: "Eliminacion!",
            content: "Deseas eliminar realmente este registro?",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                eliminar_perfil(id_perfil,id_pagina);
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
 





