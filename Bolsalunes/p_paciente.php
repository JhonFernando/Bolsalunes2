<?php
include_once("adm/model/m_sucursal.php");
include_once("adm/model/m_util.php");
$obj_sucursal = new m_sucursal();
$obj_util = new m_util();

$p_id_sucursal = 0;
$p_id_empresa = 1;
$lista_sucursal = $obj_sucursal->dame_sucursal_xempresa($p_id_sucursal, $p_id_empresa);
$lista_civil = $obj_util->llena_combito("D");
$lista_instruccion = $obj_util->llena_combito("E");
$lista_depa = $obj_util->llena_combito("P");

$p_id_paciente = $_REQUEST["p_id_paciente"];
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


    $(document).ready(function () {
        var p_id_paciente = $('#p_id_paciente').val();

        $.post('adm/controller/c_paciente.php', {
            p_id_paciente: p_id_paciente,
            p_accion: "B"
        }, function (data) {

            var res = data.split(";");

            $('#p_id_paciente').val(res[0]);
            $('#p_ape_paterno').val(res[1]);
            $('#p_ape_materno').val(res[2]);
            $('#p_nombre').val(res[3]);
            $('#p_dni').val(res[4]);
            if (res[5] == "M") {
                $("#p_sexo1").prop("checked", "checked");
            } else {
                $("#p_sexo2").prop("checked", "checked")
            }
            $('#p_fecha_nacimiento').val(res[6]);
            $('#p_celular').val(res[7]);
            $('#p_telefono').val(res[8]);
            $('#p_nacimiento').val(res[9]);
            $('#p_direccion').val(res[10]);
            $('#dd_civil').val(res[11]);
            $('#dd_instruccion').val(res[12]);
            $('#p_correo').val(res[13]);
            $('#p_departamento').val(res[16]);
            mostrar_provincia_a(res[15]);
            mostrar_distrito_a(res[14], res[15]);
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
        if (p_accion == 'A') {
            var p_id_paciente = $('#p_id_paciente').val();
        } else {
            var p_id_paciente = 0;
        }

        var p_nombre = $('#p_nombre').val();
        var p_ape_paterno = $('#p_ape_paterno').val();
        var p_ape_materno = $('#p_ape_materno').val();
        var p_dni = $('#p_dni').val();
        var p_sexo = $('input:radio[name=p_sexo]:checked').val();
        var p_fecha_nacimiento = $('#p_fecha_nacimiento').val();
        var p_telefono = $('#p_telefono').val();
        var p_celular = $('#p_celular').val();
        var p_nacimiento = $('#p_nacimiento').val();
        var p_direccion = $('#p_direccion').val();
        var p_civil = $('#dd_civil').val();
        var p_instruccion = $('#dd_instruccion').val();

        var p_distrito = $('#p_distrito').val();
        var p_correo = $('#p_correo').val();

        console.log("p_id_paciente= " + p_id_paciente);
        console.log("p_nombre= " + p_nombre);
        console.log("p_ape_paterno= " + p_ape_paterno);
        console.log("p_ape_materno= " + p_ape_materno);
        console.log("p_dni= " + p_dni);
        console.log("p_sexo= " + p_sexo);
        console.log("p_fecha_nacimiento= " + p_fecha_nacimiento);
        console.log("p_telefono= " + p_telefono);
        console.log("p_celular= " + p_celular);
        console.log("p_nacimiento= " + p_nacimiento);
        console.log("p_direccion= " + p_direccion);
        console.log("p_civil= " + p_civil);
        console.log("p_instruccion= " + p_instruccion);
        console.log("p_id_pagina= " + p_id_pagina);
        console.log("p_correo= " + p_correo);
        console.log("p_distrito= " + p_distrito);
        console.log("p_accion= " + p_accion);

        $.post('adm/controller/c_paciente.php', {
            p_id_paciente: p_id_paciente,
            p_nombre: p_nombre,
            p_ape_paterno: p_ape_paterno,
            p_ape_materno: p_ape_materno,
            p_dni: p_dni,
            p_sexo: p_sexo,
            p_fecha_nacimiento: p_fecha_nacimiento,
            p_telefono: p_telefono,
            p_celular: p_celular,
            p_nacimiento: p_nacimiento,
            p_direccion: p_direccion,
            p_civil: p_civil,
            p_instruccion: p_instruccion,
            p_correo: p_correo,
            p_distrito: p_distrito,
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

<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <form class="form-horizontal col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <fieldset>
            <legend>Pacientes</legend>
            <div class="form-group">
                <label class="col-md-2 control-label">Nombre:</label>
                <div class="col-md-10">
                    <input class="form-control"   type="text" name="p_nombre" id="p_nombre">
                    <input type="hidden" name="p_id_paciente" id="p_id_paciente" value="<?php echo $p_id_paciente; ?>"/>

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
                <label class="col-md-2 control-label">Fecha Nacimiento:</label>
                <div class="col-md-4">
                    <input class="form-control"  type="text" id="p_fecha_nacimiento">

                </div>
                <label class="col-md-2 control-label">Estado Civil:</label>
                <div class="col-md-4">
                    <select id="dd_civil" class="form-control" name="dd_civil">

                        <?php
                        for ($i = 0; $i < count($lista_civil); $i++) {
                            $codigo = $lista_civil[$i]["id_estado_civil"];
                            $descripcion = $lista_civil[$i]["nombre"];
                            ?>
                            <option value='<?php echo $codigo; ?>'><?php echo $descripcion; ?></option>
                        <?php } ?>
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

                <label class="col-md-2 control-label">G.Instrucción:</label>
                <div class="col-md-4">
                    <select id="dd_instruccion" class="form-control" name="dd_instruccion">

                        <?php
                        for ($i = 0; $i < count($lista_instruccion); $i++) {
                            $codigo = $lista_instruccion[$i]["id_grado_instruccion"];
                            $descripcion = $lista_instruccion[$i]["nombre"];
                            ?>
                            <option value='<?php echo $codigo; ?>'><?php echo $descripcion; ?></option>
                        <?php } ?>
                    </select>

                </div>
                <label class="col-md-2 control-label">Lugar Nacimiento:</label>
                <div class="col-md-4">
                    <input class="form-control"   type="text" id="p_nacimiento">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Departamento:</label>
                <div class="col-md-4 icon-addon addon-md">
                    <select class="form-control  " id='p_departamento' onchange="mostrar_provincia();">
                        <option value="0">Seleccione</option>
                        <?php for ($i = 0; $i < count($lista_depa); $i++) { ?>
                            <option value="<?php echo $lista_depa[$i]["id_departamento"]; ?>"><?php echo $lista_depa[$i]["nombre"]; ?></option>
                        <?php } ?>
                            
                    </select>
                 </div>
                <label class="col-md-2 control-label">Provincia:</label>
                <div class="col-md-4">
                    <select class="form-control" id='p_provincia' onchange="mostrar_distrito();"></select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Distrito:</label>
                <div class="col-md-4">
                    <select class="form-control" id='p_distrito'></select>
                </div>
                <label class="col-md-2 control-label">Correo:</label>
                <div class="col-md-4">
                    <input class="form-control"   type="text" id="p_correo">

                </div>
            </div>


            <div class="form-group">

                <label class="col-md-2 control-label">Direccion:</label>
                <div class="col-md-10">
                    <input class="form-control"   type="text" id="p_direccion">
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-2 control-label">Auto Complete</label>
                <div class="col-md-10">
                    <input class="form-control" placeholder="Type somethine..." type="text" list="list">
                    <datalist id="list">
                        <option value="0">Seleccione</option>
                        <?php for ($i = 0; $i < count($lista_depa); $i++) { ?>
                            <option value="<?php  echo $lista_depa[$i]["nombre"]; ?>"><?php echo $lista_depa[$i]["id_departamento"]; ?></option>
                        <?php } ?>

                    </datalist>
                    <p class="note"><strong>Note:</strong> works in Chrome, Firefox, Opera and IE10.</p>
                </div>

                
            </div>
            <div class="form-group">

                <label class="control-label col-md-2" for="prepend">Select Medium</label>
                <div class="col-md-10">
                    <div class="icon-addon addon-md">
                        <select class="form-control">
                            <option>Select Option</option>
                            <option>Sample</option>
                            <option>Sample</option>
                            <option>Sample</option>
                            <option>juan</option>
                            <option>julio</option>
                            <option>alexis</option>
                            <option>Sample</option>

                        </select>
                         <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="  " data-original-title="email"></label>
                    </div>
                </div>

            </div>

        </fieldset>

    </form>

</article>
<script>
    function mostrar_provincia_a(id_provincia) {
        var items = new Array();

        p_departamento = $("#p_departamento").val();


        $.post('adm/controller/c_paciente.php', {p_accion: 'carga_provincia', p_departamento: p_departamento}, function (data) {

            items = data.split("*");
            document.getElementById("p_provincia").innerHTML = "";

            console.log("items = " + items);
            for (var i in items) {

                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");

                if (valores[0] != '') {

                    option.value = valores[0];
                    option.text = valores[1];
                    console.log("i = " + i);
                    console.log("valor = " + valores[0]);
                    console.log("nombre = " + valores[1]);
                }


                document.getElementById("p_provincia").appendChild(option);
            }
            $("#p_provincia").val(id_provincia);
        });
    }


    function mostrar_distrito_a(id_distrito, id_provincia) {
        var items = new Array();

        $.post('adm/controller/c_paciente.php', {p_accion: 'carga_distrito', p_provincia: id_provincia}, function (data) {

            items = data.split("*");
            document.getElementById("p_distrito").innerHTML = "";

            console.log("items = " + items);
            for (var i in items) {

                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");

                if (valores[0] != '') {

                    option.value = valores[0];
                    option.text = valores[1];
                    console.log("i = " + i);
                    console.log("valor = " + valores[0]);
                    console.log("nombre = " + valores[1]);
                }


                document.getElementById("p_distrito").appendChild(option);
            }
            $("#p_distrito").val(id_distrito);
        });
    }


</script>




<script>

    function mostrar_provincia() {
        var items = new Array();

        p_departamento = $("#p_departamento").val();

        $.post('adm/controller/c_paciente.php', {p_accion: 'carga_provincia', p_departamento: p_departamento}, function (data) {

            items = data.split("*");
            document.getElementById("p_provincia").innerHTML = "";

            console.log("items = " + items);
            for (var i in items) {

                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");

                if (valores[0] != '') {

                    option.value = valores[0];
                    option.text = valores[1];
                    console.log("i = " + i);
                    console.log("valor = " + valores[0]);
                    console.log("nombre = " + valores[1]);
                }


                document.getElementById("p_provincia").appendChild(option);
            }
        });
    }
    function mostrar_distrito() {
        var items = new Array();

        p_provincia = $("#p_provincia").val();

        $.post('adm/controller/c_paciente.php', {p_accion: 'carga_distrito', p_provincia: p_provincia}, function (data) {

            items = data.split("*");
            document.getElementById("p_distrito").innerHTML = "";

            console.log("items = " + items);
            for (var i in items) {

                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");

                if (valores[0] != '') {

                    option.value = valores[0];
                    option.text = valores[1];
                    console.log("i = " + i);
                    console.log("valor = " + valores[0]);
                    console.log("nombre = " + valores[1]);
                }


                document.getElementById("p_distrito").appendChild(option);
            }
        });
    }
</script>



