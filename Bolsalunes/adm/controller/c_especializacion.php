 <?php
@session_start(); 
 
  include_once("../model/m_especializacion.php");
 
 $obj_especializacion = new m_especializacion();
 
$p_accion = $_REQUEST["p_accion"];
 
$p_usuario_reg = $_SESSION['id_persona'];
    




if ($p_accion == 'I') {
 
$p_id_especializacion= $_REQUEST["p_id_especializacion"];
$p_id_tipo_especializacion= $_REQUEST["p_id_tipo_especializacion"];
$p_nombre_especializacion= $_REQUEST["p_nombre_especializacion"];
$p_universidad= $_REQUEST["p_universidad"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
$p_descripcion= $_REQUEST["p_descripcion"];
    
    $res = $obj_especializacion->sp_crud_especializacion(0,$p_id_tipo_especializacion, $p_nombre_especializacion,$p_universidad,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
        echo "OK";
}
    
if ($p_accion == 'A') {
 
$p_id_especializacion= $_REQUEST["p_id_especializacion"];
$p_id_tipo_especializacion= $_REQUEST["p_id_tipo_especializacion"];
$p_nombre_especializacion= $_REQUEST["p_nombre_especializacion"];
$p_universidad= $_REQUEST["p_universidad"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
$p_descripcion= $_REQUEST["p_descripcion"];
    
    $res = $obj_especializacion->sp_crud_especializacion($p_id_especializacion,$p_id_tipo_especializacion, $p_nombre_especializacion,$p_universidad,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
        echo "OK";
}
if ($p_accion == 'E') {
 
$p_id_especializacion= $_REQUEST["p_id_especializacion"];
$p_id_tipo_especializacion= $_REQUEST["p_id_tipo_especializacion"];
$p_nombre_especializacion= $_REQUEST["p_nombre_especializacion"];
$p_universidad= $_REQUEST["p_universidad"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
$p_descripcion= $_REQUEST["p_descripcion"];
    
    $res = $obj_especializacion->sp_crud_especializacion($p_id_especializacion,$p_id_tipo_especializacion, $p_nombre_especializacion,$p_universidad,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
        echo "OK";
}
if ($p_accion == 'B_UNO') {
    $p_id_especializacion= $_REQUEST["p_id_especializacion"];
   $resp = $obj_especializacion->sp_dame_especializacion($p_id_especializacion);
        if ($resp != null) {
            echo $resp[0]["id_especializacion"] . "," . $resp[0]["id_tipo_especializacion"] . "," . $resp[0]["nombre_especializacion"] . "," . $resp[0]["universidad"]  . "," . $resp[0]["fecha_inicio"]. "," . $resp[0]["fecha_fin"]. "," . $resp[0]["descripcion"];
        } else {
            echo $resp;
        }
    
    
}
 
?>
