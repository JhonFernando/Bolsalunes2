<?php
@session_start();
include_once("../model/m_paciente.php");
include_once("../model/m_usuario.php");
$obj = new m_paciente();
$obj_usuario = new m_usuario();
$p_accion = $_REQUEST["p_accion"];
$id_sucursal = $_SESSION['id_sucursal'];
$id_persona = $_SESSION['id_persona'];

if ($p_accion == 'I') {
 
    $p_id_paciente = $_REQUEST["p_id_paciente"];
    $p_nombres = strtoupper($_REQUEST["p_nombre"]);
    $p_ape_paterno = strtoupper($_REQUEST["p_ape_paterno"]);
    $p_ape_materno = strtoupper($_REQUEST["p_ape_materno"]);
    $p_dni = strtoupper($_REQUEST["p_dni"]);
    $p_sexo = strtoupper($_REQUEST["p_sexo"]); 
    $p_fecha_nacimiento = $_REQUEST["p_fecha_nacimiento"];
    $p_telefono = strtoupper($_REQUEST["p_telefono"]);
    $p_celular = strtoupper($_REQUEST["p_celular"]);
    $p_id_estado_civil = strtoupper($_REQUEST["p_civil"]);
    $p_id_grado_instruccion = strtoupper($_REQUEST["p_instruccion"]); 
    $p_lugar_nacimiento = strtoupper($_REQUEST["p_nacimiento"]);
    $p_direccion = strtoupper($_REQUEST["p_direccion"]);
    
    $p_correo = strtoupper($_REQUEST["p_correo"]);
    $p_id_distrito = strtoupper($_REQUEST["p_distrito"]);
    $p_seguro = "k";
    $p_nro_hijos_vivos = 0;
    $p_nro_total_dependientes = 0;
    
    $res = $obj->crud_paciente(0, $p_nombres, $p_ape_paterno, $p_ape_materno, $p_dni, $p_sexo, $p_fecha_nacimiento, 
    $p_telefono, $p_celular,$p_id_estado_civil, $p_id_grado_instruccion, $p_lugar_nacimiento,$p_direccion, $id_sucursal, 
    $p_correo, $p_id_distrito, $p_seguro, $p_nro_hijos_vivos, $p_nro_total_dependientes, 0,$id_persona, $p_accion);
    echo 'OK';
}

if ($p_accion == 'A') {
    $p_id_paciente = $_REQUEST["p_id_paciente"];
    $p_nombres = strtoupper($_REQUEST["p_nombre"]);
    $p_ape_paterno = strtoupper($_REQUEST["p_ape_paterno"]);
    $p_ape_materno = strtoupper($_REQUEST["p_ape_materno"]);
    $p_dni = strtoupper($_REQUEST["p_dni"]);
    $p_sexo = strtoupper($_REQUEST["p_sexo"]); 
    $p_fecha_nacimiento = $_REQUEST["p_fecha_nacimiento"];
    $p_telefono = strtoupper($_REQUEST["p_telefono"]);
    $p_celular = strtoupper($_REQUEST["p_celular"]);
    $p_id_estado_civil = strtoupper($_REQUEST["p_civil"]);
    $p_id_grado_instruccion = strtoupper($_REQUEST["p_instruccion"]); 
    $p_lugar_nacimiento = strtoupper($_REQUEST["p_nacimiento"]);
    $p_direccion = strtoupper($_REQUEST["p_direccion"]);
    
    $p_correo = strtoupper($_REQUEST["p_correo"]);
    $p_id_distrito = strtoupper($_REQUEST["p_distrito"]);
    
    $p_seguro = "k";
    $p_nro_hijos_vivos = 0;
    $p_nro_total_dependientes = 0;

   $res = $obj->crud_paciente($p_id_paciente, $p_nombres, $p_ape_paterno, $p_ape_materno, $p_dni, $p_sexo, $p_fecha_nacimiento, 
    $p_telefono, $p_celular,$p_id_estado_civil, $p_id_grado_instruccion, $p_lugar_nacimiento,$p_direccion, $id_sucursal, 
    $p_correo, $p_id_distrito, $p_seguro, $p_nro_hijos_vivos, $p_nro_total_dependientes, 0,$id_persona, $p_accion);
   echo 'OK';
}

if ($p_accion == 'E') {
    $p_id_paciente = $_REQUEST["p_id_paciente"];
    $p_nombres = "OK";
    $p_ape_paterno = "OK";
    $p_ape_materno = "OK";
    $p_dni = "OK";
    $p_sexo = "O"; 
    $p_fecha_nacimiento = "OK";
    $p_celular = "OK";
    $p_telefono = "OK";
    $p_lugar_nacimiento = "OK";
    $p_direccion = "OK";
    $p_id_estado_civil = 0;
    $p_id_grado_instruccion = 0;
    $p_correo = "OK";
    $p_id_distrito = 0;
    $p_seguro = "OK";
    $p_nro_hijos_vivos = 0;
    $p_nro_total_dependientes =0;
     
    $res = $obj->crud_paciente($p_id_paciente, $p_nombres, $p_ape_paterno, $p_ape_materno, $p_dni, $p_sexo, $p_fecha_nacimiento, 
    $p_telefono, $p_celular,$p_id_estado_civil, $p_id_grado_instruccion, $p_lugar_nacimiento,$p_direccion, $id_sucursal, 
    $p_correo, $p_id_distrito, $p_seguro, $p_nro_hijos_vivos, $p_nro_total_dependientes, 0,$id_persona, $p_accion);
    echo 'OK';
}

if ($p_accion == 'B') {
    $p_id_paciente = $_REQUEST["p_id_paciente"];
    $resp = $obj->dame_paciente($p_id_paciente,$id_sucursal,"01/01/2015","01/01/2015");
    
    if ($resp != null) {
        echo $resp[0]["id_paciente"] . ";" . 
             $resp[0]["ape_paterno"] . ";" . 
             $resp[0]["ape_materno"] . ";" . 
             $resp[0]["nombres"] . ";" . 
             $resp[0]["dni"]. ";" . 
             $resp[0]["sexo"] . ";" . 
             $resp[0]["fecha_nacimiento"] . ";" . 
             $resp[0]["celular"] . ";" . 
             $resp[0]["telefono"] . ";" . 
             $resp[0]["lugar_nacimiento"] . ";" . 
             $resp[0]["direccion"]. ";" . 
             $resp[0]["id_estado_civil"]. ";" . 
             $resp[0]["id_grado_instruccion"]. ";" . 
             $resp[0]["correo"]. ";" . 
             $resp[0]["id_distrito"]. ";" . 
             $resp[0]["id_provincia"]. ";" . 
             $resp[0]["id_departamento"];  
    } else {
        echo $resp;
    }
}

if ($p_accion == 'B_U') {
    $p_id_persona = $_REQUEST["p_id_paciente"];
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

if ($p_accion == 'carga_provincia') {
    $p_departamento = $_REQUEST["p_departamento"]; 
    $lista = $obj->sp_dame_provincia_xdepartamento($p_departamento);
        $cadena = "";
        $cadena = $cadena . "0" . "," . "Seleccione" . "*";
        $j = 0;
        for($i=0;$i<count($lista);$i++){
            
            if($j == count($lista) - 1){
                $cadena = $cadena . $lista[$i]["id_provincia"] . "," . $lista[$i]["nombre"];
            }
            else
            {
                $cadena = $cadena . $lista[$i]["id_provincia"] . "," . $lista[$i]["nombre"]. "*";
            }
            
            $j = $j +1;
        }
        echo $cadena;
}

if ($p_accion == 'carga_distrito') {
    $p_provincia = $_REQUEST["p_provincia"]; 
    $lista = $obj->sp_dame_distrito_xprovincia($p_provincia);
        $cadena = "";
        $cadena = $cadena . "0" . "," . "Seleccione" . "*";
        $j = 0;
        for($i=0;$i<count($lista);$i++){
            
            if($j == count($lista) - 1){
                $cadena = $cadena . $lista[$i]["id_distrito"] . "," . $lista[$i]["nombre"];
            }
            else
            {
                $cadena = $cadena . $lista[$i]["id_distrito"] . "," . $lista[$i]["nombre"]. "*";
            }
            
            $j = $j +1;
        }
        echo $cadena;
}


 
?>
