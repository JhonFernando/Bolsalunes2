<?php
include_once("adm/model/m_util.php");
$obj_util = new m_util();
$lista = $obj_util->llena_combito("I");


$p_id = $_REQUEST["p_id"];
?>

<script type="text/javascript">
    $("#p_fecha_inicio").datepicker({
        autoSize: true,
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
        firstDay: 1,
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1960:+0",
        onClose: function (selectedDate) {
            $("#p_examen_fin").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#p_fecha_fin").datepicker({
        autoSize: true,
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
        firstDay: 1,
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1960:+0",
        onClose: function (selectedDate) {
            $("#p_examen_fin").datepicker("option", "minDate", selectedDate);
        }
    });


    function valida() {
        $(".error").remove();
        if ($('#p_nombre').val() == "") {
            alert("Ingrese el nombre");
            return true;
        }

    }

    $(document).ready(function () {
        var p_id = $('#p_id').val();

        $.post('adm/controller/c_especializacion.php', {
            p_id_especializacion: p_id,
            p_accion: "B_UNO"
        }, function (data) {

            var res = data.split(",");
            $('#p_id_especializacion').val(res[0]);
            $('#dd_tipo_especializacion').val(res[1]);
            $('#p_nombre_especializacion').val(res[2]);
            $('#p_universidad').val(res[3]);
            $('#p_fecha_inicio').val(res[4]);
            $('#p_fecha_fin').val(res[5]);
            $('#p_descripcion').val(res[6]);
        });
    });



    function adicionar_nuevo(p_accion, p_id_pagina) {

        var p_id_especializacion = $('#p_id_especializacion').val();
        var p_id_tipo_especializacion = $('#dd_tipo_especializacion').val();
        var p_nombre_especializacion = $('#p_nombre_especializacion').val();
        var p_universidad = $('#p_universidad').val();
        var p_fecha_inicio = $('#p_fecha_inicio').val();
        var p_fecha_fin = $('#p_fecha_fin').val();
        var p_descripcion = $('#p_descripcion').val();



        console.log("p_id_especializacion = " + p_id_especializacion);
        console.log("p_id_tipo_especializacion = " + p_id_tipo_especializacion);
        console.log("p_nombre_especializacion = " + p_nombre_especializacion);
        console.log("p_universidad = " + p_universidad);
        console.log("p_fecha_inicio = " + p_fecha_inicio);
        console.log("p_fecha_fin = " + p_fecha_fin);
        console.log("p_descripcion = " + p_descripcion);
        console.log("p_accion = " + p_accion);

        $.post('adm/controller/c_especializacion.php', {
            p_accion: p_accion,
            p_id_especializacion: p_id_especializacion,
            p_id_tipo_especializacion: p_id_tipo_especializacion,
            p_nombre_especializacion: p_nombre_especializacion,
            p_universidad: p_universidad,
            p_fecha_inicio: p_fecha_inicio,
            p_fecha_fin: p_fecha_fin,
            p_descripcion: p_descripcion

        }, function (data) {
            console.log(data);
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


<input type="hidden" id="p_id" value="<?php echo $p_id; ?>"/>
<div class="modal-body">
    <form id="movieForm" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="form-control" id='dd_tipo_especializacion'>
                        <option value='0'>Seleccione</option>
                        <?php for ($i = 0; $i < count($lista); $i++) { ?>

                            <option value="<?php echo $lista[$i]["id_tipo_especializacion"]; ?>"><?php echo $lista[$i]["nombre"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="nombre_especializacion" name="p_nombre_especializacion" id="p_nombre_especializacion" required />
                    <input type="hidden" name="p_id_especializacion" id="p_id_especializacion" value='0'/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="universidad" name="p_universidad" id="p_universidad" required />

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha_inicio" name="p_fecha_inicio" id="p_fecha_inicio" required />

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha_fin" name="p_fecha_fin" id="p_fecha_fin" required />

                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha_fin" name="p_descripcion" id="p_descripcion" required />

                </div>








            </div>
        </div> 
    </form>
</div>
