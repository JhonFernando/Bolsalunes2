<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_grado_instruccion {

    function lis_grado_instruccion($codigo) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_grado_instruccion($codigo)";
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

    function crud_grado_instruccion($codigo, $nombre,  $estado, $accion) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_grado_instruccion($codigo,'$nombre','$estado','$accion')";
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
