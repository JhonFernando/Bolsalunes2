 <?php

@session_start();
include_once("../model/m_curriculum.php");
include_once("../model/m_usuario.php");
$obj = new m_persona();
$obj_usuario = new m_usuario();
$p_accion = $_REQUEST["p_accion"];
$usuario_reg = $_SESSION['usuario'];

if ($p_accion == 'I') {

    $p_id_estudio = $_REQUEST["p_id_estudio"];
    //aca deberia el ususario reg
    
    $p_institucion = strtoupper($_REQUEST["p_institucion"]);
    $p_fecha_inicio = strtoupper($_REQUEST["p_fecha_inicio"]);
    $p_fecha_fin = strtoupper($_REQUEST["p_fecha_fin"]);
    $p_tipoestudios = strtoupper($_REQUEST["p_tipoestudios"]);
    $p_descripcion = strtoupper($_REQUEST["p_descripcion"]);
     
      
     
    $res = $obj->crud_persona(0,$usuario_reg, $institucion, $p_fecha_inicio, $p_fecha_fin, $p_tipoestudios, $p_descripcion,  $p_accion);
    echo 'OK';
}

if ($p_accion == 'A') {
    $p_id_estdio = $_REQUEST["p_id_estudio"];
    
    
    $p_institucion = strtoupper($_REQUEST["p_institucion"]);
    $p_fecha_inicio = strtoupper($_REQUEST["p_fecha_inicio"]);
    $p_fecha_fin = strtoupper($_REQUEST["p_fecha_fin"]);
    $p_tipoestudios = strtoupper($_REQUEST["p_tipoestudios"]);
    $p_descripcion = strtoupper($_REQUEST["p_descripcion"]);
       
    $res = $obj->crud_persona($p_id_estudio,$usuario_reg, $institucion, $p_fecha_inicio, $p_fecha_fin, $p_tipoestudios, $p_descripcion,  $p_accion);
    echo 'OK';
}

if ($p_accion == 'E') {
  $p_id_estdio = $_REQUEST["p_id_estudio"];
    
    
    $p_institucion = strtoupper($_REQUEST["p_institucion"]);
    $p_fecha_inicio = strtoupper($_REQUEST["p_fecha_inicio"]);
    $p_fecha_fin = strtoupper($_REQUEST["p_fecha_fin"]);
    $p_tipoestudios = strtoupper($_REQUEST["p_tipoestudios"]);
    $p_descripcion = strtoupper($_REQUEST["p_descripcion"]);

    $res = $obj->crud_persona($p_id_estudio,$usuario_reg, $institucion, $p_fecha_inicio, $p_fecha_fin, $p_tipoestudios, $p_descripcion,  $p_accion);
    echo 'OK';//puedeser que 
}

if ($p_accion == 'B') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $resp = $obj->dame_persona($p_id_estudio);
    
    if ($resp != null) {
        echo $resp[0]["id_estudio"] . "," . $resp[0]["usuario_reg"] . "," . $resp[0]["institucion"] . "," . $resp[0]["fecha_inicio"] . "," . $resp[0]["fecha_fin"]. "," . $resp[0]["tipoestudios"] . ",". $resp[0]["descripcion"]  ;
    } else {
        echo $resp;
    }
}

 
 

?>
