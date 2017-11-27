/*
 
 PARAMETROS GLOBALES
 m=MODULO
 sm=SUBMODULO
 f=FORMA
 sf=SUBFORMA
 */


var vg_forma = '#frm_modal';
var vg_dlg = '#erp_dialogo';
var vg_dlg1 = '#erp_dialogo1';
var vg_dlg2 = '#erp_dialogo2';



function cargando() {
    return '&nbsp;<img src="' + vg_imgcargador + '" />';
}

function cargandot() {
    return '&nbsp;<img src="' + vg_imgcargador + '" />&nbsp;Cargando...';
}

function cargandog() {
    return '&nbsp;<img src="' + vg_imgcargador + '" />&nbsp;Grabando...';
}

function cargandou() {
    return '&nbsp;<img src="' + vg_imgcargador + '" />&nbsp;Actualizando...';
}
function cargandob() {
    return '&nbsp;<img src="' + vg_imgcargador + '" />&nbsp;Buscando...';
}

function _Redirect(url) {
    var ua = navigator.userAgent.toLowerCase(),
            verOffset = ua.indexOf('msie') !== -1,
            version = parseInt(ua.substr(4, 2), 10);

    // IE8 and lower
    if (verOffset && version < 9) {
        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();
    }

    // All other browsers
    else {
        //  window.location.href = url; 

        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();

    }
}
//dialogo

function cierra_modal(p_numero) {

    if (p_numero == 1) {
        $(vg_dlg).dialog("close");
    }
    if (p_numero == 2) {
        $(vg_dlg1).dialog("close");
    }
    if (p_numero == 3) {
        $(vg_dlg2).dialog("close");
    }
}


function erp_odialogo(p_numero) {



    if (p_numero == 1) {
        $(vg_dlg).dialog("open");
    }
    if (p_numero == 2) {
        $(vg_dlg1).dialog("open");
    }
    if (p_numero == 3) {
        $(vg_dlg2).dialog("open");
    }
}


function erp_ocultabtnsup(v_modal, div) {


    if (v_modal == 'modal') {
        $("#" + div).hide();
        $("div").removeClass("er-forma");
        $("div").removeClass("er_form_contenedor");

    }
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


function carga_modal(p_dlg, p_data, p_autoOpen, p_modal, w, p_titulo, p_posicion, p_botones) {
    var v_fdefecto = '#000';

    p_fondo = (typeof p_fondo == 'undefined') ? v_fdefecto : p_fondo;

    if (p_botones == '2') {
        $(p_dlg).html(p_data);
        $(p_dlg).dialog({
            modal: p_modal,
            width: w,
            title: p_titulo,
            position: p_posicion,
            buttons: [{text: "Aceptar", click: function () {
                        graba_modal();
                    }}, {text: "Cerrar", click: function () {
                        $(this).dialog("close");
                    }}],
            autoOpen: p_autoOpen
        });
    } else {

        $(p_dlg).html(p_data);
        $(p_dlg).dialog({
            modal: p_modal,
            width: w,
            title: p_titulo,
            position: p_posicion,
            buttons: p_botones,
            autoOpen: p_autoOpen
        });

    }

    $(p_dlg).dialog("open");



}

function carga_modal1(p_dlg, p_data, p_autoOpen, p_modal, w, p_titulo, p_posicion, p_botones, p_fondo) {
    var v_fdefecto = '#000';

    p_fondo = (typeof p_fondo == 'undefined') ? v_fdefecto : p_fondo;
    if (p_botones == '2') {
        $(p_dlg).html(p_data);
        $(p_dlg).dialog({
            modal: p_modal,
            width: w,
            title: p_titulo,
            position: p_posicion,
            buttons: [{text: "Aceptar", click: function () {
                        graba_modal();
                    }}, {text: "Cerrar", click: function () {
                        $(this).dialog("close");
                    }}],
            autoOpen: p_autoOpen,
            overlay: {
                backgroundColor: '#ffa',
                opacity: 0.9
            }
        });
    } else {

        $(p_dlg).html(p_data);
        $(p_dlg).dialog({
            modal: p_modal,
            width: w,
            title: p_titulo,
            position: p_posicion,
            buttons: p_botones,
            autoOpen: p_autoOpen,
            overlay: {
                backgroundColor: '#ffa',
                opacity: 0.9
            }
        });

    }

    $(p_dlg).dialog("open");




}


function cargar_forma1111(w, top, left, padding, margin, background, div) {
    if (div == null) {
        div = 'div_oculto';
    }
    $.blockUI({
        message: $(div),
        css: {
            padding: padding,
            margin: margin,
            width: w + 'px',
            top: top,
            left: centrar_objeto(w),
            color: '#000',
            border: '4px solid rgba(0,0,0,0.4)',
            backgroundColor: background,
            '-webkit-border-radius': '4px',
            '-webkit-border-bottom-left-radius': '4px',
            '-moz-border-radius': '4px',
            '-moz-border-radius-bottomleft': '4px',
            'border-radius': '4px',
            'border-bottom-left-radius': '4px'
        }
    });
}


//graficos

function carga_grafico(g_div, g_grafico, g_render, g_data, g_format, g_w, g_h, g_id) {

    $("#" + g_div).insertFusionCharts({
        swfUrl: "../FusionCharts/" + g_grafico + ".swf",
        renderer: g_render,
        //dataSource: '../../data.xml',
        dataSource: g_data,
        dataFormat: g_format,
        width: g_w,
        height: g_h,
        id: g_id
    });
    /*   $("#chartContainer").insertFusionCharts({
     swfUrl: "../../FusionCharts/Line.swf",
     renderer: 'javascript',
     //dataSource: '../../data.xml',
     dataSource: data,
     dataFormat: "xml",
     width: "100%",
     height: "300",
     id: "myChartId"
     });
     */
}

function mostrar_exito() {

    $(document).ready(function () {
        $('#mensajito').show();
        setTimeout(function () {

            $('#mensajito').fadeOut();
        }, 8000);

    });

}

function mostrar_error(mensaje) {

    $(document).ready(function () {
        $('#prueba').text(mensaje);
        $("#txtCodigo").focus();

        $('#mensajito2').show();
        setTimeout(function () {

            $('#mensajito2').fadeOut();
        }, 8000);

    });

}
function carga_wgrafico(g_div, g_grafico, g_render, g_data, g_format, g_w, g_h, g_id) {

    $("#" + g_div).insertFusionCharts({
        swfUrl: "../FusionWidgets/" + g_grafico + ".swf",
        renderer: g_render,
        //dataSource: '../../data.xml',
        dataSource: g_data,
        dataFormat: g_format,
        width: g_w,
        height: g_h,
        id: g_id
    });
}



