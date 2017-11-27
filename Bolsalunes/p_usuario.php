  <?php
include_once("adm/model/m_sucursal.php");
$obj_sucursal = new m_sucursal();
$p_id_persona = $_SESSION['id_persona'];

$p_id_sucursal = 0;
$p_id_empresa = 1;
$lista_sucursal = $obj_sucursal->dame_sucursal_xempresa($p_id_sucursal, $p_id_empresa);
 
?>
<script type="text/javascript">

     


    function valida() {
         
        if ($('#p_clave').val() == "") {
            alert("Ingrese clave");
            return true;
        }
        if ($('#p_nro_intentos').val() == "") {
            alert("Ingrese número de intentos");
            return true;
        }
        
    }
 
</script>

<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-eye"></i> </span>
            <h2>Default Elements</h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body">

                <form action="valida_usuario.php" method="POST" enctype="multipart/form-data">

                    <fieldset>
                        <legend>Empleados</legend>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Empleado:</label>
                            <div class="col-md-10">
                                <input class="form-control"   type="text" name="p_empleado" id="p_empleado" disabled="">
                                <input type="hidden" name="p_id_persona" id="p_id_persona" value="0"/>
                                <input type="hidden" name="p_id_usuario" id="p_id_usuario" value="0"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Usuario:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_usuario" disabled="">
                            </div>
                            <label class="col-md-2 control-label">Clave:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="password" name="p_clave" id="p_clave">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Estado:</label>
                            <div class="col-md-4">
                                <select id="dd_estado" class="form-control" name="dd_estado">
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                    <option value="B">Bloqueado</option>
                                </select>
                            </div>
                            <label class="col-md-2 control-label">Nrp.Intentos:</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" id="p_nro_intentos" name="p_nro_intentos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Cambio Clave:</label>
                            <div class="col-md-4">
                                <select id="dd_cambio" class="form-control" name="dd_cambio">
                                    <option value="S">SI</option>
                                    <option value="N" selected="">NO</option> 
                                </select>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-2 control-label">Certificados:</label>
                            <div class="col-md-10">
                                <input type="file" name="foto" id="foto">
                            </div>
                        
                    </div>


                    <div class="form-group">

                        <div class="form-group col-md-10">  </div>
                        <div class="form-group col-md-2">


                            <input class="btn btn-labeled btn-success" type="submit" name="enviar" value="Guardar">

                             

                        </div>

                    </div>

                    </fieldset>

                </form>
            </div></div></div> 
</article>




