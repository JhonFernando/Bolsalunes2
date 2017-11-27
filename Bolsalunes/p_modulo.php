<script type="text/javascript">

    function valida() {
        $(".error").remove();
        if ($('#p_nombre').val() == "") {
            alert("Ingrese el nombre");
            return true;
        }
        if ($('#p_abreviatura').val() == "") {
            alert("Ingrese la abreviatura");
            return true;
        }
    }

    function adicionar_nuevo(p_accion, p_id_pagina) {
        if (valida()) {
            return;
        }
        var p_id_modulo = $('#p_id_modulo').val();
        var p_nombre = $('#p_nombre').val();
        var p_abreviatura = $('#p_abreviatura').val();
        var p_orden = $('#p_orden').val();
        var p_icono = $('#p_icono').val();
        var p_estado = $('#cb_estado').is(':checked');

        console.log("p_id_modulo = " + p_id_modulo);
        console.log("p_nombre = " + p_nombre);
        console.log("p_abreviatura = " + p_abreviatura);
        console.log("p_estado = " + p_estado);
        console.log("p_accion = " + p_accion);
        console.log("p_id_pagina = " + p_id_pagina);

        $.post('adm/controller/c_modulo.php', {
            p_accion: p_accion,
            p_id_modulo: p_id_modulo,
            p_nombre: p_nombre,
            p_abreviatura: p_abreviatura,
            p_estado: p_estado,
            p_orden: p_orden,
            p_icono: p_icono
        }, function (data) {
            console.log(data);
            if (data == 'OK') {
                recarga_pagina(p_id_pagina);
                cierra_modal(1);
                mostrar_ok();
            } else {
                recarga_pagina(p_id_pagina);
                cierra_modal(1);
                mostrar_error();
            }
        });
    }
</script>

<div class="modal-body">
    <div class="form-horizontal"> 

        <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
                <label><input type="checkbox" name="cb_estado" id="cb_estado" checked/>Activo </label>
            </div>	
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" placeholder="nombre" name="p_nombre" id="p_nombre" required />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Abreviatura:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" placeholder="abreviatura" type=text name="p_abreviatura" id="p_abreviatura" maxlength="6" required />
            </div> 
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Orden:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" placeholder="abreviatura" type=text name="p_abreviatura" id="p_orden" maxlength="2" required />
            </div> 
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Icono:</label>
            <div class="col-md-10">
                <input type="text" class="form-control" placeholder="abreviatura" type=text name="p_abreviatura" id="p_icono" required />
            </div> 
        </div>
    </div>

</div>
<input type="hidden" name="p_id_modulo" id="p_id_modulo" value='0'/>
