<html>
    <head>
        <?php
        @session_start();

        require_once("inc/init.php"); //
        include_once("adm/model/m_util.php");
        $obj_util = new m_util();
        $lista = $obj_util->llena_combito("F");
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

  
 
</script>

        </script>  



        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body style='background-image:url(fondo/wallpaper.jpg);background-attachment:fixed;background-repeat:no-repeat;background-position:50% 50%;'>





        <form action="valida_foto.php" method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">

                        <select select class="form-control"  name='p_id_tipo_estudio' id='dd_tipo_estudio'>
                            <option value='0'>Seleccione</option>
                            <?php for ($i = 0; $i < count($lista); $i++) { ?>

                                <option value="<?php echo $lista[$i]["id_tipo_estudio"]; ?>"><?php echo $lista[$i]["tiponombre"]; ?></option>
                            <?php } ?>
                        </select>




                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="institucion" name="p_institucion" value="" />

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="fecha de inicio" name="p_fecha_inicio" id="p_fecha_inicio" value=""/>

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="fecha de termino" name="p_fecha_fin" id="p_fecha_fin" value="" />

                    </div>

                    <div class="form-group">
                        <input type="file" name="foto" id="foto">
                    </div>


                    <div class="form-group">

                        <div class="form-group col-md-10">  </div>
                        <div class="form-group col-md-2">


                            <input class="btn btn-labeled btn-success" type="submit" name="enviar" value="Enviar">

                            <input type="hidden" name="id_uss" value="<?php echo $id_persona; ?>" />

                        </div>

                    </div>


                </div>






            </div> 
        </form>








    </body>
</html>