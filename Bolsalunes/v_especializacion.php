 <?php
@session_start();
require_once("inc/init.php");
include_once("adm/model/m_especializacion.php");
include_once("adm/model/m_formulario_rol.php");
$obj_especializacion = new m_especializacion();
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
$lista = $obj_especializacion->sp_dame_especializacion(0);
?>

<script>
if (screen.width >= 660) {   
    function adicionar(id_pagina) {
         
        $.post("especializacion.php", {f: 'PopupParametro'}, function (data) {
            carga_modal(vg_dlg, data, false, true, 660, '::: Registrar Estudios Univercitarios y Especializaciones :::', ['center', 120] )
        });
    }

     
        }else{
            function adicionar(id_pagina) {
       
        $.post("especializacion.php", {f: 'PopupParametro'}, function (data) {
            carga_modal(vg_dlg, data, false, true, 320, '::: Registrar Estudios Univercitarios y Especializaciones :::', ['center', 120]  )
        });
    }
 
        }
    function eliminar(codigo, id_pagina)
    {
        $.post('adm/controller/c_especializacion.php', {
            p_id_especializacion: codigo,
            p_id_tipo_especializacion: 1,
            p_accion: "E",
            p_nombre_especializacion: "x",
            p_universidad: "x",
            p_fecha_inicio: "x",
            p_fecha_fin: "x",
            p_descripcion: "x",
            p_estado: "A"
        }, function (data) {
            recarga_pagina(id_pagina);
        });

    }

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

    function recarga_pagina(id_pagina) {
        $.post('v_especializacion.php', {
            id_pagina: id_pagina,
            tip: "listar"
        }, function (data) {

            if (data == "vacio")
            {
                $('#result').html("<img src='img/cargando.gif'/><span> Espere un momento por favor..</span>");
                msjAviso("#result", "NO HAY DATOS");
            } else {
                $('#content').html("<img src='img/cargando.gif'/><span> Espere un momento por favor.. </span>");
                MostrarData("#content", data);
            }
        });
    }

</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            Administración 
            <span>> 
               Estudios Universitarios y Especializaciones
            </span>
        </h1>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">

        <?php if ($flag_nuevo == 1) { ?> <!-- Aqui Registra Especialidad del Postulante -->
            <button href='javascript:void(0);' onclick='adicionar(<?php echo $id_pagina; ?>);' class="btn btn-primary" rel="tooltip" data-placement="top" data-original-title="agregar"><i class="fa fa-plus-circle"></i> Nuevo especialización/estudio Universitario</button>
        <?php } ?>

    </div>

</div>
<br>

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
                    <h2>Especializaciones y Estudios Universitarios</h2>

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
                                     <th>Nro</th>
                                    <th>Especialidad</th>
                                    <th>Especializacion/Titulo Universitario  </th>
                                    <th>Universidad  </th>
                                    <th>fecha inicio</th>
                                    <th>fecha fin</th>
                                    <th>descripción</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                $cont = 1;
                                for ($i = 0; $i < count($lista); $i++) {
                                     $cod_especializacion = $lista[$i]["id_especializacion"];
                                    
                                    $nombre = $lista[$i]["nombre"];
                                    
                                    $nombre_especializacion = $lista[$i]["nombre_especializacion"];
                                    $universidad = $lista[$i]["universidad"];
                                    
                                    $fecha_inicio = $lista[$i]["fecha_inicio"];
                                    $fecha_fin = $lista[$i]["fecha_fin"];
                                    $descripcion = $lista[$i]["descripcion"];
                                    ?>    

                                    <tr>
                                         <td align='left' width='10%'><?php echo $cont; ?></td>
                                        <td align='left' width='15%'><?php echo $nombre; ?></td>
                                         <td align='left' width='15%'><?php echo $nombre_especializacion; ?></td>
                                        <td align='left' width='15%'><?php echo $universidad; ?></td>
                                        
                                        <td align='center' width='10%'><?php echo $fecha_inicio; ?></td>
                                        <td align='center' width='10%'><?php echo $fecha_fin; ?></td>
                                        <td align='center' width='15%'><?php echo '<img src="' . $descripcion . '" width="45" heigth="45"><br>'; ?></td>
                                        <td align='center' width='10%'>
                                            <?php if ($flag_modif == 1) { ?>
                                                 <?php
                                            }
                             
                                            if ($flag_elim == 1) {
                                                ?> 
                                                <a class="btn btn-xs btn-danger" rel="tooltip" data-placement="top" id="perrito" data-original-title="eliminar" href='javascript:void(0);' onclick='preguntar_eliminar(<?php echo $cod_especializacion; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-times"></i></a> 

                                            <?php } ?> 
                                        </td> 
                                    </tr> 
                                <?php $cont = $cont + 1;
                                
                                            } ?>
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




