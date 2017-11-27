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
        var p_id_empresa = $('#p_id_empresa').val();
        var p_razonsocial = $('#p_razonsocial').val();
        var p_ruc = $('#p_ruc').val();
        var p_direccion = $('#p_direccion').val();
        var p_telefono = $('#p_telefono').val();
        var p_email = $('#p_email').val();
        
        console.log("p_id_empresa = " + p_id_empresa);
        console.log("p_razonsocial = " + p_razonsocial);
        console.log("p_ruc = " + p_ruc);
        console.log("p_direccion=" + p_direccion);
        console.log("p_telefono=" + p_telefono);
        console.log("p_emaiil=" + p_email);
        console.log("p_accion = " + p_accion);
        console.log("p_id_pagina = " + p_id_pagina); 
        
        $.post('adm/controller/c_empresa.php', {
            
            p_id_empresa: p_id_empresa,
            p_razonsocial: p_razonsocial,
            p_ruc:p_ruc,
            p_direccion:p_direccion,
            p_telefono:p_telefono,
            p_email:p_email,
            p_accion:p_accion
            
            
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
                    <label>Razon Social</label>
                    <input type="text" class="form-control" placeholder="razon social" name="p_razonsocial" id="p_razonsocial" required />
                    <input type="hidden" name="p_id_empresa" id="p_id_empresa" value='0'/>
                </div>
                
                <div class="form-group">
                    <div class="checkbox">
                        <label>Ruc</label>
                         <input type="text" class="form-control" placeholder="ruc" name="p_ruc" id="p_ruc" required />
                    </div>	
                </div>
                 <div class="form-group">
                    <div class="checkbox">
                        <label>Dirección</label>
                         <input type="text" class="form-control" placeholder="Dirección" name="p_direccion" id="p_direccion" required />
                    </div>	
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>Teléfono</label>
                         <input type="text" class="form-control" placeholder="Teléfono" name="p_telefono" id="p_telefono" required />
                    </div>	
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>Email</label>
                         <input type="text" class="form-control" placeholder="Email" name="p_email" id="p_email" required />
                    </div>	
                </div>
            </div>
        </div> 
    </form>
</div>
