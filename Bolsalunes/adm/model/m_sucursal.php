<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_sucursal {
 
    function dame_sucursal_xempresa($p_id_sucursal,$p_id_empresa) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_dame_sucursal_xempresa($p_id_sucursal,$p_id_empresa)";
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
