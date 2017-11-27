<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_modulo {

    function dame_modulos_xidpersona($id_persona) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_modulos_xidpersona($id_persona)";
        try {
            $miconexion = new Conexion();
            $miemail = new m_email();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $result = $mysqli->query($sql);
            //Creamos un array que almacenara los datos de la sentencia
            $registros = array();
            //Recorremos el resultado de la consulta y lo almacenamos en el array
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
    
    function dame_paginas_xidmodulo($id_persona, $id_modulo) {
        //setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_paginas_xidmodulo($id_persona,$id_modulo)";
        try {
            $miconexion = new Conexion();
            $miemail = new m_email();
            $mysqli = $miconexion->conectar();
            $mysqli->set_charset("utf8");
            $result = $mysqli->query($sql);
            $registros = array();
            //Recorremos el resultado de la consulta y lo almacenamos en el array
            while ($reg = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($registros, $reg);
            }
            //Liberamos recursos
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

     function lis_modulo($codigo) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_modulo($codigo)";
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
            //Liberamos recursos
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
     
    function sp_crud_modulo($p_id_modulo, $p_nombre, $p_abreviatura, $p_estado,$p_orden,$p_icono,$p_usuario, $p_accion) {
        //setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_modulo($p_id_modulo, '$p_nombre', '$p_abreviatura', '$p_estado',$p_orden,'$p_icono',$p_usuario, '$p_accion')";
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
    
      function lis_modulo_pagina() {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_modulo_pagina()";
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
            //Liberamos recursos
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

}

?>
