 

<?php
require_once 'conexion1.php';


 
$p_id_tipo_especializacion= $_REQUEST["p_id_tipo_especializacion"];
$p_nombre_especializacion= $_REQUEST["p_nombre_especializacion"];
$p_universidad= $_REQUEST["p_universidad"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];

$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino= 'especializacion/'.$foto;
copy($ruta,$destino);
$id_uss = $_POST['id_uss'];
 


mysqli_query($mysqli,"insert into especializacion(id_tipo_especializacion,nombre_especializacion,universidad,fecha_inicio,fecha_fin,descripcion,usuario_reg) values($p_id_tipo_especializacion,'$p_nombre_especializacion','$p_universidad','$p_fecha_inicio','$p_fecha_fin','$destino',$id_uss)");
				//echo 'Se ha registrado con exito';
				//echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';

//mysql_query("insert into especializacion(id_tipo_especializacion,nombre_especializacion,universidad,fecha_inicio,fecha_fin,descripcion,usuario_reg) values($p_id_tipo_especializacion,'$p_nombre_especializacion','$p_universidad','$p_fecha_inicio','$p_fecha_fin','$destino',$id_uss)");
header("Location:  http://localhost/bolsalunes/#dashboard.php");
?>

 
