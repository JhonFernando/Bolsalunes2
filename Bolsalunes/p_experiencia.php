<?php
 


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

        $.post('adm/controller/c_experiencia.php', {
            p_id_experiencia: p_id,
            p_accion: "B_UNO"
        }, function (data) {

            var res = data.split(",");
            $('#p_id_experiencia').val(res[0]);
            $('#p_empresa').val(res[1]);
            $('#p_puesto').val(res[2]);
            $('#p_trabajo_realizado').val(res[3]);
            $('#p_fecha_inicio').val(res[4]);
            $('#p_fecha_fin').val(res[5]);
            $('#p_descripcion').val(res[6]);
        });
    });



    function adicionar_nuevo(p_accion, p_id_pagina) {

        var p_id_experiencia = $('#p_id_experiencia').val();
        var p_empresa= $('#p_empresa').val();
        var p_puesto = $('#p_puesto').val();
        var p_trabajo_realizado = $('#p_trabajo_realizado').val();
        var p_fecha_inicio = $('#p_fecha_inicio').val();
        var p_fecha_fin = $('#p_fecha_fin').val();
        var p_descripcion = $('#p_descripcion').val();



        console.log("p_id_experiencia = " + p_id_experiencia);
        console.log("p_empresa = " + p_empresa);
        console.log("p_puesto = " + p_puesto);
        console.log("p_trabajo_realizado = " + p_trabajo_realizado);
        console.log("p_fecha_inicio = " + p_fecha_inicio);
        console.log("p_fecha_fin = " + p_fecha_fin);
        console.log("p_descripcion = " + p_descripcion);
        console.log("p_accion = " + p_accion);

        $.post('adm/controller/c_experiencia.php', {
            p_accion: p_accion,
            p_id_experiencia: p_id_experiencia,
            p_empresa: p_empresa,
            p_puesto: p_puesto,
            p_trabajo_realizado: p_trabajo_realizado,
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
                    <input type="text" class="form-control" placeholder="empresa" name="p_empresa" id="p_empresa" required />
                    <input type="hidden" name="p_id_experiencia" id="p_id_experiencia" value='0'/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="puesto de trabajo" name="p_puesto" id="p_puesto" required />

                </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="trabajos realizados" name="p_trabajo_realizado" id="p_trabajo_realizado" required />

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha de inicio" name="p_fecha_inicio" id="p_fecha_inicio" required />

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha de fin" name="p_fecha_fin" id="p_fecha_fin" required />

                </div>

                 <div class="form-group">
                    <input type="text" class="form-control" placeholder="certificado" name="p_descripcion" id="p_descripcion" required />

                </div>





                


            </div>
        </div> 
    </form>
</div>
