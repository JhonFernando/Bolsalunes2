 <?php

include_once("Conexion.php"); 
include_once("m_email.php");

class m_persona {
     
    function dame_persona($p_codigo) {
        setlocale(LC_CTYPE, 'es');
        $id_persona = $_SESSION['id_persona'];
        $sql = "CALL sp_dame_persona($p_codigo,$id_persona)";
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
  
    function crud_persona($p_id_estudio,$usuario_reg,$p_institucion, $p_fecha_inicio, $p_fecha_fin,$p_tipoestudios,$p_descripcion, 
            $p_accion) {
        setlocale(LC_CTYPE, 'es');
         $id_persona = $_SESSION['id_persona'];
        
        $sql = "call sp_crud_estudios($p_id_estudio,'$id_persona','$p_institucion','$p_fecha_inicio','$p_fecha_fin','$p_tipoestudios',
               '$p_descripcion',  '$p_accion')";
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
   function dame_persona5($id_persona) {
        setlocale(LC_CTYPE, 'es');
        $sql = "CALL sp_dame_persona5($id_persona)";
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
}
?>


