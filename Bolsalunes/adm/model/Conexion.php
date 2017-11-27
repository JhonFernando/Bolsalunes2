<?php

class Conexion {

    var $BaseDatos;
    var $Servidor;
    var $Usuario;
    var $Clave;
    var $Conexion_ID;
    var $Consulta_ID;
    var $Errno = 0;
    var $Error = "";

    function Conexion() {
        $this->BaseDatos = "u925523509_bolsa";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "aaaaaaaa";
//        $this->BaseDatos = "ivpedu_sge";
//        $this->Servidor = "localhost";
//        $this->Usuario = "ivpedu_victor";
//        $this->Clave = "147258";
    }

    function Conexion2() {
        $this->BaseDatos = 'bolsa';
        $this->Servidor = 'localhost';
        $this->Usuario = 'root';
        $this->Clave = 'aaaaaaaa';
//        $this->BaseDatos = "ivpedu_sge";
//        $this->Servidor = "localhost";
//        $this->Usuario = "ivpedu_victor";
//        $this->Clave = "147258";
    }
    
    function conectar() {
        try {
             
            # Tratamos de conectarnos
//            $mysqli = new mysqli("ejemplo.com", "usuario", "contraseña", "basedatos");
            $mysqli = new mysqli($this->Servidor, $this->Usuario, $this->Clave,$this->BaseDatos);
            
//            # Si conexion es falsa
//            if ($this->Conexion_ID == false) {
//                throw new Exception("NO SE PUEDE CONECTAR CON LA BASE DE DATOS!! CONTACTAR CON EL ADMINISTRADOR</p>");
//            }
            # Conectando a la Base de Datos
//            mysql_select_db($this->BaseDatos, $this->Conexion_ID);
        } catch (Exception $e) { # Enviamos el mensaje de error
            # Mostramos mensaje de error
            $error = die("Error!: " . $e->getMessage() . '
        ' . "\n");
            echo $error;
        }
        return $mysqli;
    }

}

?>
