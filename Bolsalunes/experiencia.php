 <html>
    <head>
        <?php
@session_start();

require_once("inc/init.php");//
 
require_once ("conexion1.php"); 
//////////////////////////////////////////////////
 $id_persona = $_SESSION['id_persona'];
?>
        
        
        <script type="text/javascript">
$("#p_fecha_inicio").datepicker({
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
$("#p_fecha_fin").datepicker({
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

    function valida() {
        $(".error").remove();
        if ($('#p_nombre').val() == "") {
            alert("Ingrese el nombre");
            return true;
        }

    }
 

 
</script>
        
      

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body style='background-image:url(fondo/wallpaper.jpg);background-attachment:fixed;background-repeat:no-repeat;background-position:50% 50%;'>



        

    <form action="valida_experiencia.php" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-12">
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Empresa" name="p_empresa" value="" />
                     
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="puestp" name="p_puesto" value="" />
                     
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="trabajos realizados" name="p_trabajo_realizado" value="" />
                     
                </div>
                
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha de inicio" name="p_fecha_inicio" id='p_fecha_fin'  value=""/>

                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="fecha de termino" name="p_fecha_fin"  id='p_fecha_inicio' value="" />

                </div>

                <div class="form-group">
                          <input type="file" name="foto" id="foto">
                </div>
                
                <div class="form-group">

                        <div class="form-group col-md-10">  </div>
                        <div class="form-group col-md-2">


                            <input class="btn btn-labeled btn-success" type="submit" name="enviar" value="Guardar">

                            <input type="hidden" name="id_uss" value="<?php echo $id_persona; ?>" />

                        </div>

                    </div>


            </div>
       

            
            
            
            
        </div> 
    </form>
 
        
        
        
         
        
        
        
</body>
</html>