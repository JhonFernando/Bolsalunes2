<?php

@session_start();
include_once("../model/m_usuario.php");
$obj_usuario = new m_usuario();

$p_usuario = $_REQUEST['p_usuario'];
$p_clave = $_REQUEST['p_clave'];

$datos_usuario = $obj_usuario->valida_login($p_usuario, $p_clave);

if ($datos_usuario) {

    $_SESSION['id_persona'] = $datos_usuario[0]['id_persona'];
    $_SESSION['empleado'] = $datos_usuario[0]['empleado'];
    $_SESSION['usuario'] = $datos_usuario[0]['usuario'];
    $_SESSION['id_sucursal'] = $datos_usuario[0]['id_sucursal'];
    $_SESSION['id_empresa'] = $datos_usuario[0]['id_empresa'];

    $ind_estado = $datos_usuario[0]['ind_estado'];
//    $nro_intentos_fallidos = $datos_usuario[0]['nro_intentos_fallidos'];
    $ind_cambio_clave = $datos_usuario[0]['ind_cambio_clave'];

    if ($ind_estado == 'A') {
        if ($ind_cambio_clave == 'N') {
            ?>
            <script language="JavaScript" type="text/javascript">
                //location.href = '../../#ajax/dashboard.php';
                location.href = '../../#dashboard.php';
            </script>
            <?php

        } else {
            ?>
            <script language="JavaScript" type="text/javascript">
                //location.href = '../../#ajax/dashboard.php';
                location.href = '../../dashboard.php';
            </script>
            <?php

        }
    } else {
        $_SESSION["mensaje"] = "Su usuario esta bloqueado, favor de contactarse con el administrador del Sistema!!";
        ?>
        <script language="JavaScript" type="text/javascript">
            location.href = '../../login.php';
        </script>
        <?php
    }
} else {
    $_SESSION["mensaje"] = "Usuario o clave incorrecta!!";
    ?>
    <script language="JavaScript" type="text/javascript">
        alert("Usuario o clave incorrecta");
        location.href = '../../login.php';
    </script>
    <?php

}
?>  