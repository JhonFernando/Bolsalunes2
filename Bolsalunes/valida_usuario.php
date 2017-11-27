 

<?php

require_once 'conexion1.php';


 




 
$p_id_usuario = strtoupper($_REQUEST["p_id_usuario"]);
$p_clave = strtoupper($_REQUEST["p_clave"]);
$p_estado = strtoupper($_REQUEST["dd_estado"]);
$p_intentos_fallidos = strtoupper($_REQUEST["p_nro_intentos"]);
$p_cambio_clave = strtoupper($_REQUEST["dd_cambio"]);

$foto = $_FILES["foto"]["name"];
$ruta = $_FILES["foto"]["tmp_name"];
$p_descripcion = 'usuarios/' . $foto;
copy($ruta, $p_descripcion);
 




mysqli_query($mysqli,"UPDATE usuario
            set clave = '$p_clave',
             ind_estado = '$p_estado',
             nro_intentos_fallidos = $p_intentos_fallidos,
             ind_cambio_clave = '$p_cambio_clave',
             descripcion='$p_descripcion'
         where id_usuario = $p_id_usuario; ");



header("Location:  http://localhost/bolsalunes/#dashboard.php");
?>
