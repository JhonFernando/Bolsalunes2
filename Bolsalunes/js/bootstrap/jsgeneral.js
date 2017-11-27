function msjLoadList(obj, msje) { //se usa para mostrar un preload cuando se esta listando data
    $(obj).html("<div id='msjeii'><img src='img/cargando.gif'/>" + " " + msje + "</div>");
}

function MostrarData(obj, data) { //se usa para mostrar un efecto cuando hacemos un listado de filas de una BD
    $(obj).fadeOut("fast", function() {
        $(obj).html(data).fadeIn("slow");
    })
}
function removermsje(obj) {
    //$(obj).fadeOut(10000, function(){$(obj).remove().fadeOut(10000);});
    $(obj).delay(10);
    $(obj).fadeOut(10);
//  $(obj).delay(3000).remove().fadeOut(10000);
}
function verurl(url, id_pagina) {
    
//    var randomnumber = Math.random() * 11;
//    msjLoadList("#content", "Espere un momento por favor");
    $.post(url, {
//        rn: randomnumber,
        id_pagina:id_pagina
    }, function(data) {
        MostrarData("#content", data);
    });

}

function activar_success() {

    $(document).ready(function () {
        $('#mensajito').show();
        setTimeout(function () {

            $('#mensajito').fadeOut();
        }, 8000);

    });

}

function activar_warning(mensaje) {

    $(document).ready(function () {
        $('#prueba').text(mensaje);
        $("#txtCodigo").focus();

        $('#mensajito2').show();
        setTimeout(function () {

            $('#mensajito2').fadeOut();
        }, 8000);

    });

}