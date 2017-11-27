 <?php

@session_start();
include_once("../model/m_persona.php");
include_once("../model/m_usuario.php");
$obj = new m_persona();
$obj_usuario = new m_usuario();
$p_accion = $_REQUEST["p_accion"];
//dudas hacerca del usuario registrador
$usuario_reg = $_SESSION['usuario'];

if ($p_accion == 'I') {

    $p_id_persona = $_REQUEST["p_id_persona"];
    $p_nombres = strtoupper($_REQUEST["p_nombres"]);
    $p_ape_paterno = strtoupper($_REQUEST["p_ape_paterno"]);
    $p_ape_materno = strtoupper($_REQUEST["p_ape_materno"]);
    $p_dni = strtoupper($_REQUEST["p_dni"]);
    $p_sexo = strtoupper($_REQUEST["p_sexo"]);
    $p_sucursal = strtoupper($_REQUEST["p_sucursal"]);
    $p_fecha_nacimiento = $_REQUEST["p_fecha_nacimiento"];
    $p_celular = strtoupper($_REQUEST["p_celular"]);
    $p_telefono = strtoupper($_REQUEST["p_telefono"]);
    $p_correo = strtoupper($_REQUEST["p_correo"]);
    $p_direccion = strtoupper($_REQUEST["p_direccion"]);
    
    $cmp = strtoupper($_REQUEST["cmp"]);
    $externo = strtoupper($_REQUEST["externo"]);
     
     
     
    $res = $obj->crud_persona(0, $p_ape_paterno, $p_ape_materno, $p_nombres, $p_dni, $p_sexo, $p_sucursal, 
            $p_fecha_nacimiento, $p_celular, $p_telefono, $p_correo, $p_direccion, $cmp, 
            $externo, $p_accion);
    echo 'OK';
}

if ($p_accion == 'A') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $p_nombres = strtoupper($_REQUEST["p_nombres"]);
    $p_ape_paterno = strtoupper($_REQUEST["p_ape_paterno"]);
    $p_ape_materno = strtoupper($_REQUEST["p_ape_materno"]);
    $p_dni = strtoupper($_REQUEST["p_dni"]);
    $p_sexo = strtoupper($_REQUEST["p_sexo"]);
    $p_sucursal = strtoupper($_REQUEST["p_sucursal"]);
    $p_fecha_nacimiento = $_REQUEST["p_fecha_nacimiento"];
    $p_celular = strtoupper($_REQUEST["p_celular"]);
    $p_telefono = strtoupper($_REQUEST["p_telefono"]);
    $p_correo = strtoupper($_REQUEST["p_correo"]);
    $p_direccion = strtoupper($_REQUEST["p_direccion"]);
    $cmp = strtoupper($_REQUEST["cmp"]);
    $externo = strtoupper($_REQUEST["externo"]);
       
    $res = $obj->crud_persona($p_id_persona, $p_ape_paterno, $p_ape_materno, $p_nombres, $p_dni, $p_sexo, $p_sucursal, $p_fecha_nacimiento, $p_celular, $p_telefono, $p_correo, $p_direccion, $cmp, $externo, $p_accion);
    echo 'OK';
}

if ($p_accion == 'E') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $p_nombres = strtoupper($_REQUEST["p_nombres"]);
    $p_ape_paterno = strtoupper($_REQUEST["p_ape_paterno"]);
    $p_ape_materno = strtoupper($_REQUEST["p_ape_materno"]);
    $p_dni = strtoupper($_REQUEST["p_dni"]);
    $p_sexo = strtoupper($_REQUEST["p_sexo"]);
    $p_sucursal = 0;
    $p_fecha_nacimiento = $_REQUEST["p_fecha_nacimiento"];
    $p_celular = strtoupper($_REQUEST["p_celular"]);
    $p_telefono = strtoupper($_REQUEST["p_telefono"]);
    $p_correo = strtoupper($_REQUEST["p_correo"]);
    $p_direccion = strtoupper($_REQUEST["p_direccion"]);
    $cmp = strtoupper($_REQUEST["cmp"]);
    $externo = strtoupper($_REQUEST["externo"]);

    $res = $obj->crud_persona($p_id_persona,$p_ape_paterno, $p_ape_materno, $p_nombres, $p_dni, $p_sexo,$p_sucursal, $p_fecha_nacimiento, $p_celular, $p_telefono, $p_correo, $p_direccion, $p_accion);
    echo 'OK';
}
 

if ($p_accion == 'B') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $resp = $obj->dame_persona11($p_id_persona);
    
    if ($resp != null) {
        echo $resp[0]["id_persona"] . "," . $resp[0]["ape_paterno"] . "," . $resp[0]["ape_materno"] . "," . $resp[0]["nombres"] . "," . $resp[0]["dni"]. "," . $resp[0]["sexo"] . ",". $resp[0]["sucursal"] . "," . $resp[0]["fecha_nacimiento"] . "," . $resp[0]["celular"] . "," . $resp[0]["telefono"] . "," . $resp[0]["correo"] . "," . $resp[0]["direccion"]. "," . $resp[0]["cmp"]. "," . $resp[0]["externo"];
    } else {
        echo $resp;
    }
}

if ($p_accion == 'B_U') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $resp = $obj_usuario->dame_usuario_xpersona($p_id_persona);
    
    if ($resp != null) {
        echo $resp[0]["id_usuario"] . ";" . $resp[0]["id_persona"] . ";" . $resp[0]["persona"] . ";" . $resp[0]["usuario"] . ";" . $resp[0]["clave"]. ";" . $resp[0]["estado"] . ";". $resp[0]["intentos_fallidos"] . ";" . $resp[0]["cambio_clave"];
    } else {
        echo $resp;
    }
}

if ($p_accion == 'A_U') {
    $p_id_persona = $_REQUEST["p_id_persona"];
    $p_id_usuario = strtoupper($_REQUEST["p_id_usuario"]);
    $p_clave = strtoupper($_REQUEST["p_clave"]);
    $p_estado = strtoupper($_REQUEST["p_estado"]);
    $p_nro_intentos = strtoupper($_REQUEST["p_nro_intentos"]);
    $p_cambio = strtoupper($_REQUEST["p_cambio"]); 
     
    
    $res = $obj_usuario->crud_usuario($p_id_usuario, $p_id_persona,$p_clave, $p_estado, $p_nro_intentos,$p_cambio,$p_accion);
    echo 'OK';
}

?>
