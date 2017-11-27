<?php
@session_start();
require_once("inc/init.php");
include_once("adm/model/m_paciente.php");
include_once("adm/model/m_formulario_rol.php");
$obj = new m_paciente();
$obj_fxr = new m_formulario_rol();
$_SESSION['id_pagina'] = $_REQUEST['id_pagina'];
$id_pagina = $_SESSION['id_pagina'];
$id_persona = $_SESSION['id_persona'];
$id_sucursal = $_SESSION['id_sucursal'];
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
date_default_timezone_set('America/New_York');
$hoy_con_hora = date("Y-m-d H:i:s");
$hoy_inicio = date("Y-m-d");
$hoy_fin = date("Y-m-d");

$p_accion = $_REQUEST['p_accion'];

if ($p_accion == "L") {
    $p_examen_inicio = $_REQUEST['p_examen_inicio'];
    $p_examen_fin = $_REQUEST['p_examen_fin'];
    $hoy_inicio = $p_examen_inicio;
    $hoy_fin = $p_examen_fin;
} else {
    $p_examen_inicio = $hoy_inicio;
    $p_examen_fin = $hoy_fin;
}



$lista = $obj->dame_paciente(0, $id_sucursal, $p_examen_inicio, $p_examen_fin);
?>
<!doctype html>
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <script>

            $(document).ready(function () {

                $("#p_examen_inicio").datepicker({
                    autoSize: true,
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
                    firstDay: 1,
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1960:+0",
                    onClose: function (selectedDate) {
                        $("#p_examen_fin").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#p_examen_fin").datepicker({
                    autoSize: true,
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
                    firstDay: 1,
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    minDate: "0"
                });
            });



            function adicionar(id_pagina) {
                var p_accion = "I";
                $.post("p_paciente.php", {f: 'PopupParametro'}, function (data) {
                    carga_modal(vg_dlg, data, false, true, 900, '::: Registrar Persona :::', 'top', [
                        {text: "Aceptar", click: function () {
                                adicionar_nuevo(p_accion, id_pagina);
                            }},
                        {text: "Cerrar", click: function () {
                                $(this).dialog("close");
                            }}], '#ffa')
                });
            }

            function modificar(p_id, id_pagina) {
                var p_accion = "A";
                $.post("p_paciente.php", {p_id_paciente: p_id}, function (data) {
                    carga_modal(vg_dlg, data, false, true, 900, '::: Modificar Persona:::', 'top', [{
                            text: "Aceptar", click: function () {
                                adicionar_nuevo(p_accion, id_pagina);
                            }
                        }, {text: "Cerrar", click: function () {
                                $(this).dialog("close");
                            }}], '#ffa')
                });
            }

            function aperturar_historia_clinica(p_id, id_pagina) {
                msjLoadList("#content", "Espere un momento por favor");
                $.post("p_historia_clinica.php", {p_id_paciente: p_id, p_id_pagina: id_pagina}, function (data) {
                    MostrarData("#content", data);
                    //cargar_data(p_id);
                });

            }

            function eliminar(codigo, id_pagina)
            {
                var codigo = codigo;
                var forma = "E";
                $.post('adm/controller/c_paciente.php', {
                    p_id_paciente: codigo,
                    p_accion: forma
                }, function (data) {
                    recarga_pagina(id_pagina);
                });

            }

            function recarga_pagina(id_pagina) {
                $.post('v_paciente.php', {
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

            function listar(id_pagina) {
                var p_accion = "Listar";

                $.post('v_paciente.php', {
                    id_pagina: id_pagina,
                    tip: p_accion
                }, function (data) {

                    if (data == "vacio")
                    {
                        $('#result').html("<img src='images/preload3.gif'/><span> Espere un momento por favor..</span>");
                        msjAviso("#result", "NO HAY DATOS");
                    } else {
                        $('#content').html("<img src='img/cargando.gif'/><span> Espere un momento por favor.. </span>");
                        MostrarData("#content", data);
                    }
                });
            }

            function filtro_pacientes() {
                var p_id_pagina = $('#p_id_pagina').val();
                var p_examen_inicio = $('#p_examen_inicio').val();
                var p_examen_fin = $('#p_examen_fin').val();
                console.log("p_examen_inicio =" + p_examen_inicio);
                console.log("p_examen_fin =" + p_examen_fin);
                $.post('v_paciente.php', {
                    id_pagina: p_id_pagina,
                    p_examen_inicio: p_examen_inicio,
                    p_examen_fin: p_examen_fin,
                    p_accion: "L"
                }, function (data) {

                    if (data == "vacio")
                    {
                        $('#result').html("<img src='images/preload3.gif'/><span> Espere un momento por favor..</span>");
                        msjAviso("#result", "NO HAY DATOS");
                    } else {
                        $('#content').html("<img src='img/cargando.gif'/><span> Espere un momento por favor.. </span>");
                        MostrarData("#content", data);
                    }
                });
            }


        </script>

    <div class="row">

        <table width='100%' border='0'>
            <tr>
                <td width='60%'>
                    <h1 class="page-title txt-color-blueDark">
                        <i class="fa fa-table fa-fw "></i> 
                        Ticket 
                        <span>> 
                            Pacientes
                        </span>
                    </h1>
                </td>
                <td width='15%'>
                    <input type="hidden" id='p_id_pagina' class="form-control" value="<?php echo $id_pagina; ?>"/>
                    <input type="text" id='p_examen_inicio' class="form-control" value="<?php echo $hoy_inicio; ?>"/></td>
                <td width='5%'>&nbsp;&nbsp; hasta &nbsp;&nbsp;</td>
                <td width='15%'><input type="text" id='p_examen_fin' class="form-control" value="<?php echo $hoy_fin; ?>"/></td>
                <td width='5%'>
                    <button href="javascript:void(0);" onclick="filtro_pacientes();" class="btn btn-default"><span class="fa fa-search"></span></button>
                </td>
            </tr>
        </table>


    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">

            <?php if ($flag_nuevo == 1) { ?>
                <button href='javascript:void(0);' onclick='adicionar(<?php echo $id_pagina; ?>);' class="btn btn-primary" rel="tooltip" data-placement="top" data-original-title="agregar"><i class="fa fa-plus-circle"></i> Nuevo Paciente</button>
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
                        <h2>Pacientes</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding" id='tablita_pacientex'>
                             <div class="table-responsive"> 
                            <table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#.</th>
                                        <th>Sucursal</th>
                                        <th>Nro. Hist.Clinica</th>
                                        <th>Paciente</th>
                                        <th>Dni</th> 
                                        <th>Celular</th>
                                        <th>Telefono</th>
                                        <th>Fecha Filiacion</th>
                                        <th>Estado</th>
                                        <th>usuario reg</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cont = 1;

                                    for ($i = 0; $i < count($lista); $i++) {

                                        $p_id_paciente = $lista[$i]["id_paciente"];
                                        $p_paciente = $lista[$i]["paciente"];
                                        $p_sucursal = $lista[$i]["sucursal"];
                                        $p_dni = $lista[$i]["dni"];
                                        $p_celular = $lista[$i]["celular"];
                                        $p_telefono = $lista[$i]["telefono"];
                                        $nro_historia_clinica = $lista[$i]["nro_historia_clinica"];
                                        $fecha_filiacion = $lista[$i]["fecha_filiacion"];
                                        $estado = $lista[$i]["estado"];
                                        $usuario_reg = $lista[$i]["usuario_reg"];

                                        if ($estado == "A") {
                                            $msg_estado = "<span class='label label-success'>Activo</span>";
                                        } else {
                                            $msg_estado = "<span class='label label-danger'>Inactivo</span>";
                                        }
                                        ?>

                                        <tr> 
                                            <td class='center' width='5%'><?php echo $cont; ?></td>  
                                            <td class='center' width='5%'><?php echo $p_sucursal; ?></td> 
                                            <td class='center' width='5%'><?php echo $nro_historia_clinica; ?></td>
                                            <td class='left' width='25%'><?php echo $p_paciente; ?></td>
                                            <td class='left' width='5%'><?php echo $p_dni; ?></td>
                                            <td class='left' width='5%'><?php echo $p_celular; ?></td>
                                            <td class='left' width='5%'><?php echo $p_telefono; ?></td> 
                                            <td class='left' width='15%'><?php echo $fecha_filiacion; ?></td> 
                                            <td class='left' width='5%'><?php echo $msg_estado; ?></td> 
                                            <td class='left' width='15%'><?php echo $usuario_reg; ?></td> 
                                            <td class='center' width='10%'>
                                                <?php if ($flag_modif == 1) { ?>
                                                    <a class="btn btn-xs btn-primary" rel="tooltip" data-placement="top" data-original-title="editar" href='javascript:void(0);' onclick='modificar(<?php echo $p_id_paciente; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-pencil"></i></a> 
                                                    <?php
                                                }
                                                if ($flag_elim == 1) {
                                                    ?>

                                                    <a class="btn btn-xs btn-danger" rel="tooltip" data-placement="top" id="perrito" data-original-title="eliminar" href='javascript:void(0);' onclick='preguntar_eliminar(<?php echo $p_id_paciente; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-times"></i></a> 

                                                    <?php
                                                }
                                                if ($flag_elim == 1) {
                                                    ?>

                                                    <a href='javascript:void(0);' class="btn btn-xs btn-warning" rel="tooltip" data-placement="top" data-original-title="aperturar Historia Clinica" onclick='aperturar_historia_clinica(<?php echo $p_id_paciente; ?>,<?php echo $id_pagina; ?>);' ><i class="fa fa-hospital-o"></i></a> 
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



