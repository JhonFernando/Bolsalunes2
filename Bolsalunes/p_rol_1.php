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
        var p_id_rol = $('#p_id_rol').val();
        var p_nombre = $('#p_nombre').val();
        var p_abreviatura = $('#p_abreviatura').val();
        var p_estado = $('#cb_estado').is(':checked');
        
        console.log("p_id_rol = " + p_id_rol);
        console.log("p_nombre = " + p_nombre);
        console.log("p_abreviatura = " + p_abreviatura);
        console.log("p_estado = " + p_estado);
        console.log("p_accion = " + p_accion);
        console.log("p_id_pagina = " + p_id_pagina); 
        
        $.post('adm/controller/c_rol.php', {
            p_accion: p_accion,
            p_id_rol: p_id_rol,
            p_nombre: p_nombre,
            p_abreviatura: p_abreviatura,
            p_estado: p_estado
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
    <form id="movieForm" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>Nombre:</h5>
                    <input type="text" class="form-control" placeholder="nombre" name="p_nombre" id="p_nombre" required />
                    <input type="hidden" name="p_id_rol" id="p_id_rol" value='0'/>
                </div>
                <div class="form-group">
                    <h5>Abreviatura:</h5>
                    <input type="text" class="form-control" placeholder="abreviatura" type=text name="p_abreviatura" id="p_abreviatura" maxlength="6" required />
                </div>
                <hr>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="cb_estado" id="cb_estado" checked/>Activo </label>
                    </div>	
                </div>
            </div>
        </div> 
    </form>
</div>
