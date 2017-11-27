<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_estudio {

    function sp_dame_estudio($codigo) {
        setlocale(LC_CTYPE, 'es');
        $id_persona = $_SESSION['id_persona'];
            $sql = "call sp_dame_estudio($codigo,$id_persona)";
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
 function sp_dame_estudio1($p_codigo) {
        setlocale(LC_CTYPE, 'es');
         
            $sql = "call sp_dame_estudio1($p_codigo)";
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
    function sp_crud_estudio($id_estudio,$id_tipo_estudio, $institucion,  $fecha_inicio,$fecha_fin,$descripcion,$usuario_reg, $accion) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_estudio($id_estudio,$id_tipo_estudio,'$institucion','$fecha_inicio','$fecha_fin','$descripcion',$usuario_reg,'$accion')";
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
