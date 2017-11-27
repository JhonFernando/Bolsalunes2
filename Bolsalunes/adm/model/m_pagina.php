<?php

include_once("Conexion.php");
include_once("m_email.php");

class m_pagina {

    function lis_pagina($codigo) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_lis_pagina($codigo)";
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
    
     function crud_pagina($id_pagina,$id_modulo, $nombre, $url, $estado, $accion) {
        setlocale(LC_CTYPE, 'es');
        $sql = "call sp_crud_pagina($id_pagina,$id_modulo,'$nombre','$url','$estado','$accion')";
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
