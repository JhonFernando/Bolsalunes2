<?php 
include_once("adm/model/m_util.php"); 
$obj_util = new m_util(); 

$p_id_empresa = $_REQUEST["p_id_empresa"];
$lista_depa = $obj_util->llena_combito("P");
?>
<script type="text/javascript">

    $(document).ready(function () {
        console.log("a");// Instrucciones a ejecutar al terminar la carga
        var p_id_empresa_cliente = $('#p_id_empresa_cliente').val(); 

        $.post('adm/controller/c_empresa.php', {
            p_id_empresa_cliente: p_id_empresa_cliente,
            p_accion: "B_U"
        }, function (data) {
            
            var res = data.split(";");
            $('#p_id_empresa_cliente').val(res[0]);
            $('#p_ruc').val(res[1]);
            $('#p_razon_social').val(res[2]);
            $('#p_actividad_economica').val(res[3]);
            $('#p_lugar_trabajo').val(res[4]);
            $('#p_departamento').val(res[7]);
            mostrar_provincia_a(res[6]);
            mostrar_distrito_a(res[5],res[6]); 
        });
      });  


    function valida() {
        $(".error").remove();
        if ($('#p_ruc').val() == "") {
            alert("Ingrese el ruc de la empresa, por favor!")
            return true;
        }
        if ($('#p_razon_social').val() == "") {
            alert("Ingrese la razon social de la empresa, por favor!")
            return true;
        }
        if ($('#p_distrito').val() == "0") {
            alert("Seleccione un distrito, por favor!")
            return true;
        } 
    }

    function adicionar_nuevo(p_accion, p_id_pagina) {

        if (valida()) {
            return;
        }
        if(p_accion == 'A') {
            var p_id_empresa_cliente = $('#p_id_empresa_cliente').val();
        }else{
            var p_id_empresa_cliente = 0;
        }
        
        var p_ruc = $('#p_ruc').val();
        var p_razon_social = $('#p_razon_social').val();
        var p_actividad_economica = $('#p_actividad_economica').val();
        var p_lugar_trabajo = $('#p_lugar_trabajo').val();
        var p_distrito = $('#p_distrito').val();
        
        console.log("p_id_empresa_cliente= " + p_id_empresa_cliente);
        console.log("p_ruc= " + p_ruc);
        console.log("p_razon_social= " + p_razon_social);
        console.log("p_actividad_economica= " + p_actividad_economica);
        console.log("p_lugar_trabajo= " + p_lugar_trabajo);
        console.log("p_distrito= " + p_distrito);  
        console.log("p_accion= " + p_accion);  
        
        $.post('adm/controller/c_empresa.php', {
            p_id_empresa_cliente: p_id_empresa_cliente,
            p_ruc: p_ruc,
            p_razon_social: p_razon_social,
            p_actividad_economica: p_actividad_economica,
            p_lugar_trabajo: p_lugar_trabajo,
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

<article class="col-sm-12 col-md-12 col-lg-12"> 
            
                <form class="form-horizontal"> 
                    <fieldset>
                        <legend>Empresa</legend> 
                        <div class="form-group">
                            <label class="col-md-2 control-label">Ruc:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="hidden" id="p_id_empresa_cliente" value="<?php echo $p_id_empresa;?>">
                                <input class="form-control"  type="text" id="p_ruc">
                            </div>
                            <label class="col-md-2 control-label">Razon Social:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_razon_social">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-2 control-label">Actividad Económica:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_actividad_economica">

                            </div>
                            <label class="col-md-2 control-label">Ubicación de la Empresa:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" id="p_lugar_trabajo">
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-md-2 control-label">Departamento:</label>
                            <div class="col-md-4">
                                <select class="form-control" id='p_departamento' onchange="mostrar_provincia();">
                                            <option value="0">Seleccione</option>
                                            <?php for ($i = 0; $i < count($lista_depa); $i++) { ?>
                                            <option value="<?php echo $lista_depa[$i]["id_departamento"];?>"><?php echo $lista_depa[$i]["nombre"];?></option>
                                            <?php }?>
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
                            
                        </div>

                    </fieldset> 
                </form> 
</article>

<script>
    function mostrar_provincia_a(id_provincia) {
        var items = new Array();
        
        p_departamento = $("#p_departamento").val();
     
    
        $.post('adm/controller/c_paciente.php', { p_accion: 'carga_provincia', p_departamento: p_departamento }, function (data) {
            
            items = data.split("*");
            document.getElementById("p_provincia").innerHTML = "";
             
            console.log("items = " + items);
            for (var i in items) {
                
                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");
                
                if (valores[0] != ''){
                    
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
    function mostrar_provincia() {
        var items = new Array();
        
        p_departamento = $("#p_departamento").val();
       
    
        $.post('adm/controller/c_paciente.php', { p_accion: 'carga_provincia', p_departamento: p_departamento }, function (data) {
            
            items = data.split("*");
            document.getElementById("p_provincia").innerHTML = "";
             
            console.log("items = " + items);
            for (var i in items) {
                
                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");
                
                if (valores[0] != ''){
                    
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
    
     function mostrar_distrito_a(id_distrito,id_provincia) {
        var items = new Array();
         
        $.post('adm/controller/c_paciente.php', { p_accion: 'carga_distrito', p_provincia: id_provincia }, function (data) {
           
            items = data.split("*");
            document.getElementById("p_distrito").innerHTML = "";
             
            console.log("items = " + items);
            for (var i in items) {
                
                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");
                
                if (valores[0] != ''){
                    
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
  function mostrar_distrito() {
        var items = new Array();
        
        p_provincia = $("#p_provincia").val();
  
        $.post('adm/controller/c_paciente.php', { p_accion: 'carga_distrito', p_provincia: p_provincia }, function (data) {
           
            items = data.split("*");
            document.getElementById("p_distrito").innerHTML = "";
             
            console.log("items = " + items);
            for (var i in items) {
                
                var valores = new Array();
                valores = items[i].split(",");
                var option = document.createElement("option");
                
                if (valores[0] != ''){
                    
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








