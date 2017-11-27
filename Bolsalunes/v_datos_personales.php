 <?php
@session_start();
require_once("inc/init.php");//

///////////////////////////////////////////////s
include_once("adm/model/m_persona.php");
include_once("adm/model/m_formulario_rol.php");

//////////////////////////////////////////////////
$obj = new m_persona();
$obj_fxr = new m_formulario_rol();
$_SESSION['id_pagina'] = $_REQUEST['id_pagina'];
$id_pagina = $_SESSION['id_pagina'];
$id_persona = $_SESSION['id_persona'];
$listaPrivilegios = $obj_fxr->dame_privilegios_xidpagina($id_persona, $id_pagina);
$flag_nuevo = 0;
$flag_modif = 0;
$flag_elim = 0;
for ($i = 0; $i < (count($listaPrivilegios)); $i++) {
    if ($listaPrivilegios[$i]['accion'] == 'Registrar') {
        $flag_nuevo = 1;
    }
    if ($listaPrivilegios[$i]['accion'] == 'Modificar') {
        $flag_modif = 1;
    }
    if ($listaPrivilegios[$i]['accion'] == 'Eliminar') {
        $flag_elim = 1;
    }
}
$lista = $obj->dame_persona2(0);
?>
<!doctype html>
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
                    
        <script>
            
               function mostrar_ok() {

        $.smallBox({
            title: "Información!",
            content: "<i class='fa fa-clock-o'></i> <i>La operación se realizó correctamente...</i>",
            color: "#659265",
            iconSmall: "fa fa-check fa-2x fadeInRight animated",
            timeout: 4000
        });
    }

    function mostrar_error() {

        $.smallBox({
            title: "Información!",
            content: "<i class='fa fa-clock-o'></i> <i>Ocurrió algún error en la transacción...</i>",
            color: "#C46A69",
            iconSmall: "fa fa-times fa-2x fadeInRight animated",
            timeout: 4000
        });
    }
            
            
            
              function cargar_data(codigo){
                var codigo = codigo;
                var forma = "B"; 
               $.post('adm/controller/c_persona.php', {
                    p_id_persona: codigo,
                    p_accion: forma
                }, function (data) { 
                    var res = data.split(",");
                    $('#p_id_persona').val(res[0]);
                    $('#p_ape_paterno').val(res[1]); 
                    $('#p_ape_materno').val(res[2]);       
                    $('#p_nombres').val(res[3]); 
                    $('#p_dni').val(res[4]); 
                    if (res[5] == "M"){
                        $("#p_sexo1").prop("checked", "checked");
                    }else{
                        $("#p_sexo2").prop("checked", "checked")
                    } 
                    $('#dd_sucursal').val(res[6]); 
                    $('#p_fecha_nacimiento').val(res[7]); 
                    $('#p_celular').val(res[8]); 
                    $('#p_telefono').val(res[9]); 
                    $('#p_correo').val(res[10]); 
                    $('#p_direccion').val(res[11]); 
                    $('#cmp').val(res[12]);
                    $('#externo').val(res[13]);
                    
                });
            
            }        

            function modificar(p_id,id_pagina) {
                var p_accion = "A";
                $.post("p_persona.php", { f: 'PopupParametro' }, function (data) {
                    cargar_data(p_id);
                    carga_modal(vg_dlg, data, false, true, 900, ':::  Modificar Persona:::', 'top', [{
                            text: "Aceptar", click: function () {
                                adicionar_nuevo(p_accion,id_pagina);
                            }
                        }, { text: "Cerrar", click: function () { $(this).dialog("close"); } }], '#ffa')
                });
            }   
            
             function cargar_usuario(codigo){
                var codigo = codigo;
                var forma = "B_U"; 
               $.post('adm/controller/c_persona.php', {
                    p_id_persona: codigo,
                    p_accion: forma
                }, function (data) { 
                    
                    var res = data.split(";");
                    $('#p_id_usuario').val(res[0]);
                    $('#p_id_persona').val(res[1]);
                    $('#p_empleado').val(res[2]); 
                    $('#p_usuario').val(res[3]);       
                    $('#p_clave').val(res[4]); 
                    $('#dd_estado').val(res[5]); 
                    $('#p_nro_intentos').val(res[6]);  
                    $('#dd_cambio').val(res[7]);   
                    
                });
            
            }
            /*
             function cambio_clave(p_id,id_pagina) {
                var p_accion = "A_U";
                $.post("p_usuario.php", { f: 'PopupParametro' }, function (data) {
                    cargar_usuario(p_id);
                    carga_modal(vg_dlg, data, false, true, 900, '::: Modificar Persona:::', 'top', [{
                            text: "Aceptar", click: function () {
                                adicionar_nuevo(p_accion,id_pagina);
                            }
                        }, { text: "Cerrar", click: function () { $(this).dialog("close"); } }], '#ffa')
                });
            }   */


       function cambio_clave(p_id) {
                 
                $.post("p_usuario_1.php", { f: 'PopupParametro' }, function (data) {
                    cargar_usuario(p_id);
                    carga_modal(vg_dlg, data, false, true, 660, '::: Modificar Persona:::', ['center', 120] )
                });
            } 
            
              function recarga_pagina(id_pagina) {
                $.post('v_datos_personales.php', {
                    id_pagina: id_pagina,
                    tip: "listar"
                }, function (data) {

                    if (data == "vacio")
                    {
                        $('#result').html("<img src='img/cargando.gif'/><span> Espere un momento por favor..</span>");
                        msjAviso("#result", "NO HAY DATOS");
                    }
                    else {
                        $('#content').html("<img src='img/cargando.gif'/><span> Espere un momento por favor.. </span>");
                        MostrarData("#content", data);
                    }
                });
            }
             
            function listar(id_pagina) {
                var p_accion = "Listar";
                
                $.post('v_persona.php', {
                    id_pagina: id_pagina,
                    tip: p_accion
                }, function(data) {

                    if (data == "vacio")
                    {
                        $('#result').html("<img src='images/preload3.gif'/><span> Espere un momento por favor..</span>");
                        msjAviso("#result", "NO HAY DATOS");
                    }
                    else {
                        $('#content').html("<img src='img/cargando.gif'/><span> Espere un momento por favor.. </span>");
                        MostrarData("#content", data);
                    }
                });
            }
            function generar_reporte_pdf(id_persona) {
                    window.open('p_curriculum_pdf.php?id_persona=' + id_persona, 'mywindow', 'width=600,height=450,screenX=350,screenY=250,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=no');
               
            }
            
        </script>
   
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            Administración 
            <span>> 
                Empleados <?php echo $id_persona; ?>
            </span>
        </h1>
    </div>

</div>
 

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Abogados</h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <div class="table-responsive">
                        <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
                             <thead>
                            <tr>
                                <th>Nro.</th>
                                <th>Sucursal</th>
                                <th>Apellidos y nombres</th>
                                <th>Dni</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Foto Perfil</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cont = 1;

                            for ($i = 0; $i < count($lista); $i++) {

                                $cod_persona = $lista[$i]["id_persona"]; 
                                $persona = $lista[$i]["persona"];
                                $sucursal = $lista[$i]["sucursal"];
                                $dni = $lista[$i]["dni"];
                                $celular = $lista[$i]["celular"];
                                $email = $lista[$i]["correo"];
                                $descripcion = $lista[$i]["descripcion"];
                                $login = $lista[$i]["usuario"];
                                $estado = $lista[$i]["estado"];

                                if ($estado == 'A') {
                                        $msg_estado = "<span class='label label-success'>Activo</span>";
                                    } else {
                                        $msg_estado = "<span class='label label-danger'>Inactivo</span>";
                                    }
                                ?>

                                <tr> 
                                    <td class='center' width='5%'><?php echo $cont; ?></td>  
                                    <td class='center' width='5%'><?php echo $sucursal; ?></td> 
                                    <td class='left' width='30%'><?php echo $persona ;?></td>
                                    <td class='left' width='5%'><?php echo $dni; ?></td>
                                    <td class='left' width='5%'><?php echo $celular; ?></td>
                                    <td class='left' width='15%'><?php echo $email; ?></td>
                                    <td   align='center' width='5%'><?php echo '<img src="' . $descripcion . '" width="100" heigth="100"><br>'; ?></td>
                                    <td class='left' width='5%'><?php echo $login; ?></td>
                                    <td class='left' width='5%'><?php echo $msg_estado; ?></td>
                                    <td class='center' width='10%'>
                                        <?php if ($flag_modif == 1) { ?>
                                         <a class="btn btn-xs btn-primary" rel="tooltip" data-placement="top" data-original-title="editar" href='javascript:void(0);' onclick='modificar(<?php echo $cod_persona; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-pencil"></i></a> 
                                            <?php
                                        }
                                   
                                        if ($flag_elim == 1) {
                                            ?>
                                           
                                            <a href='javascript:void(0);' class="btn btn-xs btn-warning" rel="tooltip" data-placement="top" data-original-title="cambiar clave" onclick='cambio_clave(<?php echo $cod_persona; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-unlock-alt"></i></a> 
                                             <a class="btn btn-xs btn-danger" rel="tooltip" data-placement="top" data-original-title="Descargar Curriculum" href='javascript:void(0);' onclick='generar_reporte_pdf(<?php echo $cod_persona; ?>);' ><i class="fa fa-arrow-circle-o-down"></i></a>
                                        <?php } ?> 
                                    </td>  
                                </tr> 
                                <?php
                                $cont = $cont + 1;
                            }
                            ?>
                        </tbody>
                    </table>
                        </div>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     *
     * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
     *
     * // activate tooltips
     * $("[rel=tooltip]").tooltip();
     *
     * // activate popovers
     * $("[rel=popover]").popover();
     *
     * // activate popovers with hover states
     * $("[rel=popover-hover]").popover({ trigger: "hover" });
     *
     * // activate inline charts
     * runAllCharts();
     *
     * // setup widgets
     * setup_widgets_desktop();
     *
     * // run form elements
     * runAllForms();
     *
     ********************************
     *
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */

    pageSetUp();

    /*
     * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
     * eg alert("my home function");
     * 
     * var pagefunction = function() {
     *   ...
     * }
     * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
     * 
     */

    // PAGE RELATED SCRIPTS

    // pagefunction	
    var pagefunction = function () {




        //console.log("cleared");

        /* // DOM Position key index //
         
         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing 
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class
         
         Also see: http://legacy.datatables.net/usage/features
         */

        /* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        /* TABLETOOLS */
        $('#datatable_tabletools').dataTable({
            // Tabletools options: 
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sTitle": "PacificoNorte_PDF",
                        "sPdfMessage": "PacificoNorte PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by PacificoNorte <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

        /* END TABLETOOLS */

    };

    // load related plugins

    loadScript("js/plugin/datatables/jquery.dataTables.min.js", function () {
        loadScript("js/plugin/datatables/dataTables.colVis.min.js", function () {
            loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function () {
                loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function () {
                    loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                });
            });
        });
    });
//  



    function preguntar_eliminar(codigo, id_pagina) {

        $.SmartMessageBox({
            title: "Eliminacion!",
            content: "Deseas eliminar realmente este registro?",
            buttons: '[No][Yes]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                eliminar(codigo, id_pagina);
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



