<script type="text/javascript">

    function valida() {
        $(".error").remove();
        if ($('#p_nombre').val() == "") {
            alert("Ingrese el nombre");
            return true;
        }
        
    }

    function adicionar_nuevo(p_accion, p_id_pagina) {
        if (valida()) {
            return;
        } 
        var p_id_grado_instruccion = $('#p_id_grado_instruccion').val();
        var p_nombre = $('#p_nombre').val();
        var p_estado = $('#cb_estado').is(':checked');
        
        console.log("p_id_grado_instruccion = " + p_id_grado_instruccion);
        console.log("p_nombre = " + p_nombre);
        console.log("p_estado = " + p_estado);
        console.log("p_accion = " + p_accion);
        console.log("p_id_pagina = " + p_id_pagina); 
        
        $.post('adm/controller/c_grado_instruccion.php', {
            p_accion: p_accion,
            p_id_grado_instruccion: p_id_grado_instruccion,
            p_nombre: p_nombre,
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
                    <input type="text" class="form-control" placeholder="nombre" name="p_nombre" id="p_nombre" required />
                    <input type="hidden" name="p_id_grado_instruccion" id="p_id_grado_instruccion" value='0'/>
                </div>
                
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="cb_estado" id="cb_estado" checked/>Activo </label>
                    </div>	
                </div>
            </div>
        </div> 
    </form>
</div>
