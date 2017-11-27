<?php
include_once("adm/model/m_empresa.php");
include_once("adm/model/m_util.php");
$obj = new m_empresa();
$obj_util = new m_util();

$id_empresa = $_REQUEST["id_empresa"];
$id_pagina = $_REQUEST["id_pagina"];


$lista_medico = $obj_util->llena_combito("A2");
$listax = $obj->sp_dame_medicos_empresa($id_empresa);
?>
<script type="text/javascript">
 

    function eliminar_medico(id_empresa_medico, id_pagina)
    {
        var id_empresa = $('#id_empresa').val();
        $.post('adm/controller/c_empresa.php', {
            id_empresa_medico: id_empresa_medico,
            id_pagina: id_pagina,
            id_empresa: id_empresa,
            p_accion: "E_MEDICO_EXT"
        }, function (data) {
            $('#tablita_historiax').html(data);
        });

    }


    function add_medico() {
 
        var id_empresa = $('#id_empresa').val();
        var id_medico = $('#id_medico').val(); 
        var id_pagina = $('#id_pagina').val();
 
        console.log("id_empresa =" + id_empresa);
        console.log("id_medico =" + id_medico);
        console.log("id_pagina =" + id_pagina);

        $.post('adm/controller/c_empresa.php', { 
            id_empresa: id_empresa,
            id_medico: id_medico, 
            id_pagina: id_pagina,
            p_accion: "I_MEDICO_EXT"

        }, function (data) {
            $('#tablita_historiax').html(data);
        });
    }

    function regresar() {
        var p_id_pagina = $('#id_pagina').val();
        recarga_pagina(p_id_pagina);
        cierra_modal(1);
        mostrar_ok();

    }
</script>

<input type="hidden" id="id_empresa" value="<?php echo $id_empresa; ?>"/> 
<input type="hidden" id="id_pagina" value="<?php echo $id_pagina; ?>"/>
<div class="row">
    <div class="col-sm-8">

    </div>
    <div class="col-sm-4 text-align-right">

        <div class="btn-group">
            <a href="javascript:void(0)" onclick="regresar();" class="btn btn-sm btn-danger"> <i class="fa fa-reply-all"></i> Regresar </a>
        </div>

    </div>

</div>

<section id="widget-grid" class=""> 
    <div class="row"> 
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
            <div class="form-horizontal"> 
                <fieldset> 
                    <div class="form-group">
                        <div class="col-md-1"></div>
                        <label class="col-md-1 control-label"><h4>Médicos:</h4></label>
                        <div class="col-md-3">
                            <select id='id_medico' class="form-control">
                                <option value="" selected>Seleccione</option>
                                <?php
                                for ($i = 0; $i < count($lista_medico); $i++) {
                                    $codigo = $lista_medico[$i]["id_persona"];
                                    $descripcion = $lista_medico[$i]["medico"];
                                    ?>

                                    <option value='<?php echo $codigo; ?>'><?php echo $descripcion; ?></option>
                                <?php } ?>
                            </select>
                        </div>  
                        <div class="col-md-1">
                            <button href="javascript:void(0);" onclick="add_medico();" class="btn btn-default"><span classadd_historia="icon icon-plus"></span>Agregar</button>
                        </div>
                    </div>
                    <br>

                    <div id="tablita_historiax">
                        <table class='tabla_reporte' align='center' width='100%'>
                            <thead>
                                <tr class='tr_titulo'> 
                                    <td width='3%'>código</td>
                                    <td width='10%'>Médico</td> 
                                    <td width='10%'>usuario reg</td>
                                    <td width='15%'>fecha reg</td>
                                    <td width='10%'>Acciones</td>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                for ($i = 0; $i < count($listax); $i++) {

                                    $id_empresa_medico = $listax[$i]['id_empresa_medico'];
                                    $id_empresa = $listax[$i]['id_empresa'];
                                    $medico = $listax[$i]['medico'];
                                    $usuario_reg = $listax[$i]['usuario_reg'];
                                    $fecha_reg = $listax[$i]['fecha_reg'];
                                    ?>
                                    <tr class='registro'> 
                                        <td align='center' width='3%'><?php echo $id_empresa_medico ?></td>
                                        <td align='center' width='10%'><?php echo $medico ?></td> 
                                        <td align='left' width='10%'><?php echo $usuario_reg ?></td> 
                                        <td align='left' width='15%'><?php echo $fecha_reg ?></td>
                                        <td align='center' width='10%'>
                                            <a href='javascript:void(0);' class='btn btn-xs btn-danger' onclick='preguntar_eliminar(<?php echo $id_empresa_medico ?>,<?php echo $id_pagina ?>);'><i class='fa fa-times'></i></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>   
                    </div>            

                </fieldset>
            </div> 

        </article>    
    </div>
</section>

<script>

    function preguntar_eliminar(id_empresa_medico, id_pagina) {

        $.SmartMessageBox({
            title: "Eliminacion!",
            content: "Deseas eliminar realmente este registro?",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                eliminar_medico(id_empresa_medico, id_pagina);
                $.smallBox({
                    title: "Información",
                    content: "<i class='fa fa-clock-o'></i> <i>La operación se realizó correctamente...</i>",
                    color: "#659265",
                    iconSmall: "fa fa-check fa-2x fadeInRight animated",
                    timeout: 4000
                });
            }
            if (ButtonPressed === "No") {
                $.smallBox({
                    title: "Información",
                    content: "<i class='fa fa-clock-o'></i> <i>No se realizó ninguna operación...</i>",
                    color: "#C46A69",
                    iconSmall: "fa fa-times fa-2x fadeInRight animated",
                    timeout: 4000
                });
            }

        });
        e.preventDefault();
    }

    $('#perrito').click(function (e) {
        var eliminar = function () {}
        loadScript("js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", eliminar);
    });
</script>




