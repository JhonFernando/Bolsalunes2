<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_formulario_rol {

     function dame_privilegios_xidpagina($id_persona,$id_pagina) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_privilegios_xidpagina($id_persona,$id_pagina)";
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
    
    
      function lis_formulario_xrol($id_rol) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_formulario_xrol($id_rol)";
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
    
     function lis_formulario_xrol2($id_rol) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_formulario_xrol2($id_rol)";
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
    
    function upd_formulario_rol($id_rol, $id_formulario, $accion) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_upd_formulario_rol($id_rol,$id_formulario,'$accion')";
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
        return $rs;
    }
    
     function crud_formulario_rol_individual($id_rol, $id_pagina, $accion) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_crud_formulario_rol_individual($id_rol,$id_pagina,'$accion')";
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
        return $rs;
    }
   
    
}

?>


