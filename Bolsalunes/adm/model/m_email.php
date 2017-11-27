<?php

include_once("Conexion.php");

class m_email {

    //METODO PARA ENVIAR CORREO AL ADMINISTRADOR DEL SISTEMA
    function enviar_email_adm($titulo, $mensaje) {
        $destino = 'jouverthc@gmail.com';
        $enviador = 'From: jcustodiot@upao.edu.pe' . "\r\n"; //La direccion de correo desde donde supuestamente se envió
        $enviador .= 'Cc: jouverthc@gmail.com' . "\r\n";
        $enviador .= 'X-Mailer: PHP/' . phpversion();  //información sobre el sistema de envio de correos, en este caso la version de PHP
        mail($para, $titulo, $mensaje, $enviador);
    }

}

?>
