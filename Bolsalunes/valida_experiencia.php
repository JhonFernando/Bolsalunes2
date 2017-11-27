 

<?php
require_once 'conexion1.php';


 
$p_empresa= $_REQUEST["p_empresa"];
$p_puesto= $_REQUEST["p_puesto"];
$p_trabajo_realizado= $_REQUEST["p_trabajo_realizado"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];

$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino= 'experiencia/'.$foto;
copy($ruta,$destino);
$id_uss = $_POST['id_uss'];
 




mysqli_query($mysqli,"insert into experiencia(empresa,puesto,trabajo_realizado,fecha_inicio,fecha_fin,descripcion,usuario_reg) values('$p_empresa','$p_puesto','$p_trabajo_realizado','$p_fecha_inicio','$p_fecha_fin','$destino',$id_uss)");
header("Location:  http://localhost/bolsalunes/#dashboard.php");
?>

?>
