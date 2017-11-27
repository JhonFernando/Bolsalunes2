<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_empresa {

    function dame_empresa($p_codigo) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_empresa($p_codigo)";
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

    function sp_dame_empresa_cliente($p_codigo) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_empresa_cliente($p_codigo)";
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

    function sp_crud_empresa_cliente($p_id_empresa_cliente, $p_ruc, $p_razon_social, $p_actividad_economica, $p_lugar_trabajo, $p_id_distrito, $p_usuario, $p_accion) {

        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_empresa_cliente($p_id_empresa_cliente, '$p_ruc', '$p_razon_social', '$p_actividad_economica', 
     '$p_lugar_trabajo',$p_id_distrito,$p_usuario,'$p_accion')";
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

    function sp_dame_contrata($id_empresa) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_contrata($id_empresa)";
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

    function sp_crud_contrata($id_contrata, $ruc, $nombre, $id_empresa, $usuario_reg, $p_accion) {

        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_contrata($id_contrata,
                                        '$ruc',
                                        '$nombre',
                                        $id_empresa,
                                        '$usuario_reg',
                                        '$p_accion')";
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
     function sp_dame_medicos_empresa($id_empresa) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_medicos_empresa($id_empresa)";
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
   
    function sp_crud_empresa_medico($p_id_empresa_medico, $p_id_empresa, $p_id_medico, $usuario_reg, $p_accion) {

        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_empresa_medico($p_id_empresa_medico,
                                            $p_id_empresa,
                                            $p_id_medico, 
                                            '$usuario_reg',
                                            '$p_accion')";
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
