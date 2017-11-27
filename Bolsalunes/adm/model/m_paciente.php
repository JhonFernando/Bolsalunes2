<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_paciente {

    function dame_paciente($id_paciente, $id_sucursal,$p_fecha_inicio,$p_fecha_fin) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_dame_paciente($id_paciente,$id_sucursal,'$p_fecha_inicio','$p_fecha_fin')";
        try {
            $miconexion = new Conexion();
            $miemail = new m_email();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $result = $mysqli->query($sql);
            $registros = array();
            while ($reg = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($registros, $reg);
            }
            $result->free();
            $mysqli->close();
        } catch (Exception $e) {
            $titulo = "ERROR CONEXION CON BASE DATOS";
            $mensaje = "FILE:" . $e->getFile() . "\n";
            $mensaje.= "MENSAJE:" . $e->getMessage() . "\n";
            $miemail->enviar_email_adm($titulo, $mensaje);
        }
        return $registros;
    }
    function sp_dame_provincia_xdepartamento($p_departamento) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_dame_provincia_xdepartamento($p_departamento)";
        try {
            $miconexion = new Conexion();
            $miemail = new m_email();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $result = $mysqli->query($sql);
            $registros = array();
            while ($reg = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($registros, $reg);
            }
            $result->free();
            $mysqli->close();
        } catch (Exception $e) {
            $titulo = "ERROR CONEXION CON BASE DATOS";
            $mensaje = "FILE:" . $e->getFile() . "\n";
            $mensaje.= "MENSAJE:" . $e->getMessage() . "\n";
            $miemail->enviar_email_adm($titulo, $mensaje);
        }
        return $registros;
    }
    
     function sp_dame_distrito_xprovincia($p_provincia) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_dame_distrito_xprovincia($p_provincia)";
        try {
            $miconexion = new Conexion();
            $miemail = new m_email();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $result = $mysqli->query($sql);
            $registros = array();
            while ($reg = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($registros, $reg);
            }
            $result->free();
            $mysqli->close();
        } catch (Exception $e) {
            $titulo = "ERROR CONEXION CON BASE DATOS";
            $mensaje = "FILE:" . $e->getFile() . "\n";
            $mensaje.= "MENSAJE:" . $e->getMessage() . "\n";
            $miemail->enviar_email_adm($titulo, $mensaje);
        }
        return $registros;
    }
    
    
    

    function crud_paciente($p_id_paciente, $p_nombres, $p_ape_paterno, $p_ape_materno, $p_dni, $p_sexo, $p_fecha_nacimiento, 
    $p_telefono, $p_celular,$p_id_estado_civil, $p_id_grado_instruccion, $p_lugar_nacimiento,$p_direccion, $p_id_sucursal, 
    $p_correo, $p_id_distrito, $p_seguro, $p_nro_hijos_vivos, $p_nro_total_dependientes, $p_nro_historia_clinica, 
    $p_usuario_reg, $p_accion)
    {
        setlocale(LC_CTYPE, 'es');
    $sql = "call sp_crud_paciente($p_id_paciente, '$p_nombres', '$p_ape_paterno', '$p_ape_materno', '$p_dni', '$p_sexo',
    '$p_fecha_nacimiento','$p_telefono', '$p_celular',$p_id_estado_civil, $p_id_grado_instruccion, '$p_lugar_nacimiento',
    '$p_direccion', $p_id_sucursal,'$p_correo', $p_id_distrito, '$p_seguro', $p_nro_hijos_vivos, $p_nro_total_dependientes, 
    '$p_nro_historia_clinica',$p_usuario_reg, '$p_accion')";
        try {
            $miconexion = new Conexion();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $mysqli->query($sql);
            $mysqli->close();
        } catch (Exception $e) {
            $titulo = "ERROR CONEXION CON BASE DATOS";
            $mensaje = "FILE:" . $e->getFile() . "\n";
            $mensaje.= "MENSAJE:" . $e->getMessage() . "\n";
            $this->enviar_email_adm($titulo, $mensaje);
        }
        return $mysqli;
    }

}
?>


