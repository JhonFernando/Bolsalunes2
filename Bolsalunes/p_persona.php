 <?php
include_once("adm/model/m_sucursal.php");
$obj_sucursal = new m_sucursal();

$p_id_sucursal = 0;
$p_id_empresa = 1;
$lista_sucursal = $obj_sucursal->dame_sucursal_xempresa($p_id_sucursal, $p_id_empresa)

?>
<script type="text/javascript">

    $(function () {
        var dates = $("#p_fecha_nacimiento").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            defaultDate: "+1w",
            numberOfMonths: 1
        });
    });


    function valida() {
        $(".error").remove();
        if ($('#p_nombre').val() == "") {
            $('#p_nombre').focus().after("<span class='error'>Ingrese...</span>");
            return true;
        }
        if ($('#p_ape_paterno').val() == "") {
            $('#p_ape_paterno').focus().after("<span class='error'>Ingrese...</span>");
            return true;
        }
        if ($('#p_ape_materno').val() == "") {
            $('#p_ape_materno').focus().after("<span class='error'>Ingrese...</span>");
            return true;
        }
        if ($('#p_dni').val() == "") {
            $('#p_dni').focus().after("<span class='error'>Ingrese...</span>");
            return true;
        }
        if ($('#p_fecha_nacimiento').val() == "") {
            $('#p_fecha_nacimiento').focus().after("<span class='error'>Ingrese...</span>");
            return true;
        }
    }

    function adicionar_nuevo(p_accion, p_id_pagina) {

        if (valida()) {
            return;
        }
        ;

        var p_id_persona = $('#p_id_persona').val();
        var p_nombres = $('#p_nombres').val();
        var p_ape_paterno = $('#p_ape_paterno').val();
        var p_ape_materno = $('#p_ape_materno').val();
        var p_dni = $('#p_dni').val();
        var p_sexo = $('input:radio[name=p_sexo]:checked').val();
        var p_sucursal = $('#dd_sucursal').val();
        var p_fecha_nacimiento = $('#p_fecha_nacimiento').val();
        var p_telefono = $('#p_telefono').val();
        var p_celular = $('#p_celular').val();
        var p_correo = $('#p_correo').val();
        var p_direccion = $('#p_direccion').val();
        var cmp = $('#cmp').val();
        var externo = $('#externo').val();


        $.post('adm/controller/c_persona.php', {
            p_id_persona: p_id_persona,
            p_nombres: p_nombres,
            p_ape_paterno: p_ape_paterno,
            p_ape_materno: p_ape_materno,
            p_dni: p_dni,
            p_sexo: p_sexo,
            p_sucursal:p_sucursal,
            p_fecha_nacimiento: p_fecha_nacimiento,
            p_telefono: p_telefono,
            p_celular: p_celular,
            p_correo: p_correo,
            p_direccion: p_direccion,
            cmp:cmp,
            externo:externo,
            p_accion: p_accion

        }, function (data) {
         
            if (data == 'OK') { 
                recarga_pagina(p_id_pagina);
                cierra_modal(1);
                mostrar_ok();
            } else {
                recarga_pagina(p_id_pagina);
                cierra_modal(1);
                mostrar_ok();
            }
        });
    }
</script>

<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body">

                <form class="form-horizontal">

                    <fieldset>
                        <legend>Empleados</legend>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nombre:</label>
                            <div class="col-md-10">
                                <input class="form-control"   type="text" name="p_nombre" id="p_nombres">
                                <input type="hidden" name="p_id_persona" id="p_id_persona" value="0"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Ape.Paterno:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_ape_paterno">
                            </div>
                            <label class="col-md-2 control-label">Ape.Materno:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_ape_materno">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Dni:</label>
                            <div class="col-md-4">
                                <input class="form-control"   type="text" id="p_dni">
                            </div>
                            <label class="col-md-2 control-label">Sexo:</label>
                            <div class="col-md-4">
                                <label class="radio radio-inline">
                                    <input type="radio" name="p_sexo" checked="true" id="p_sexo1" value="M">
                                    Masculino </label>
                                <label class="radio radio-inline">
                                    <input type="radio" name="p_sexo" id="p_sexo2" value="F">
                                    Femenino </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Sucursal:</label>
                            <div class="col-md-4">
                                <select id="dd_sucursal" class="form-control" name="dd_sucursal">
                                            
                                    <?php
                                    for ($i = 0; $i < count($lista_sucursal); $i++) {
                                        $codigo = $lista_sucursal[$i]["id_sucursal"]; 
                                        $descripcion = $lista_sucursal[$i]["nombre"];
                                        ?>
                                        <option value='<?php echo $codigo; ?>'><?php echo $descripcion; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <label class="col-md-2 control-label">Fecha Nacimiento:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_fecha_nacimiento">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Codigo:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" id="cmp">
                            </div>
                            <label class="col-md-2 control-label">Externo:</label>
                            <div class="col-md-4">
                                <select id="externo" class="form-control" >
                                    <option value='S'>SI</option>
                                    <option value='N' selected="">NO</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Telefono:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" id="p_telefono">
                            </div>
                            <label class="col-md-2 control-label">Celular:</label>
                            <div class="col-md-4">
                                <input class="form-control"   type="text" id="p_celular">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Correo:</label>
                            <div class="col-md-4">
                                <input class="form-control"   type="text" id="p_correo">
                            </div>
                            <label class="col-md-2 control-label">Direccion:</label>
                            <div class="col-md-4">
                                <input class="form-control"   type="text" id="p_direccion">

                            </div>
                        </div> 

                    </fieldset>

                </form>
            </div></div></div> 
</article>




