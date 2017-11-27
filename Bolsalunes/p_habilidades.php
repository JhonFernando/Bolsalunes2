<?php
include_once("adm/model/m_util.php");
$obj_util = new m_util();
$lista = $obj_util->llena_combito("H");


$p_id = $_REQUEST["p_id"];
?>

<script type="text/javascript">


    function adicionar_nuevo(p_accion, p_id_pagina) {

        var p_id_habilidades = $('#p_id_habiliades').val();
        var p_id_tipo_habilidades = $('#p_id_tipo_habilidades').val();


        console.log("p_id_habilidades = " + p_id_habilidades);
        console.log("p_id_tipo_habilidades = " + p_id_tipo_habilidades);
        console.log("p_accion = " + p_accion);

        $.post('adm/controller/c_habilidades.php', {
            p_accion: p_accion,
            p_id_habilidades: p_id_habilidades,
            p_id_tipo_habilidades: p_id_tipo_habilidades,
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
                    <select class="form-control" id='p_id_tipo_habilidades'>
                        <option value='0'>Seleccione</option>
                        <?php for ($i = 0; $i < count($lista); $i++) { ?>

                            <option value="<?php echo $lista[$i]["id_tipo_habilidades"]; ?>"><?php echo $lista[$i]["nombre"]; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="p_id_habilidades" id="p_id_habilidades" value='0'/>
                </div>


            </div>
        </div> 
    </form>
</div>
