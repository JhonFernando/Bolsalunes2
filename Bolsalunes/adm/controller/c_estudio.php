 <?php
@session_start(); 
 
  include_once("../model/m_estudio.php");
 
 $obj_estudio = new m_estudio();
 
$p_accion = $_REQUEST["p_accion"];
 
$p_usuario_reg = $_SESSION['id_persona'];
    




if ($p_accion == 'I') {
 /*
$p_id_estudio= $_REQUEST["p_id_estudio"];
$p_id_tipo_estudio= $_REQUEST["p_id_tipo_estudio"];
$p_institucion= $_REQUEST["p_institucion"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
//$p_descripcion= $_REQUEST["p_descripcion"];
 
$fotos=$_FILES["descripcion"]["name"];
$ruta=$_FILES["p_descripcion"]["tmp_name"];
$p_descripcion='fotos/'.$fotos;
copy($ruta,$p_descripcion);
    */
    
    
$p_id_tipo_estudio= $_REQUEST["p_id_tipo_estudio"];
$p_institucion= $_REQUEST["p_institucion"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= 'fotos/'.$_REQUEST["p_fecha_fin"];

$p_descripcion1=$_FILES["p_descripcion"]["name"];
$ruta=$_FILES["p_descripcion"]["tmp_name"];
$p_descripcion= 'fotos/'.$p_descripcion1;
copy($ruta,$p_descripcion);
//$id_uss = $_POST['id_uss']; 

    $res = $obj_estudio->sp_crud_estudio(0,$p_id_tipo_estudio, $p_institucion,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
      //  header("Location:  http://localhost/bolsalunes/#dashboard.php");
    echo "OK";
        
}
   




if ($p_accion == 'A') {
 
$p_id_estudio= $_REQUEST["p_id_estudio"];
$p_id_tipo_estudio= $_REQUEST["p_id_tipo_estudio"];
$p_institucion= $_REQUEST["p_institucion"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
$p_descripcion= $_REQUEST["p_descripcion"];
    
    $res = $obj_estudio->sp_crud_estudio($p_id_estudio,$p_id_tipo_estudio, $p_institucion,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
        echo "OK";
}
if ($p_accion == 'E') {
 
$p_id_estudio= $_REQUEST["p_id_estudio"];
$p_id_tipo_estudio= $_REQUEST["p_id_tipo_estudio"];
$p_institucion= $_REQUEST["p_institucion"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];
$p_descripcion= $_REQUEST["p_descripcion"];
    
    $res = $obj_estudio->sp_crud_estudio($p_id_estudio,$p_id_tipo_estudio, $p_institucion,  $p_fecha_inicio,$p_fecha_fin,$p_descripcion,$p_usuario_reg ,$p_accion);
        echo "OK";
}
if ($p_accion == 'B_UNO') {
    $p_id_estudio= $_REQUEST["p_id_estudio"];
   $resp = $obj_estudio->sp_dame_estudio($p_id_estudio);
        if ($resp != null) {
            echo $resp[0]["id_estudio"] . "," . $resp[0]["id_tipo_estudio"] . "," . $resp[0]["institucion"]  . "," . $resp[0]["fecha_inicio"]. "," . $resp[0]["fecha_fin"]. "," . $resp[0]["descripcion"];
        } else {
            echo $resp;
        }
     
    
}
 
?>
