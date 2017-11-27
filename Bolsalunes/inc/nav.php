<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<?php
@session_start();
if (!empty($_SESSION['id_persona'])) {
    $id_persona = $_SESSION['id_persona'];
    $id_persona1 = $_SESSION['id_persona'];
    $empleado = $_SESSION['empleado'];

    include_once("adm/model/m_modulo.php");
    include_once("adm/model/m_persona.php");
    $obj_modulo = new m_modulo();
    $obj_laboratorio = new m_persona();
    $lista_modulos = $obj_modulo->dame_modulos_xidpersona($id_persona);
    $lista = $obj_laboratorio->dame_persona5($id_persona1);
    ?>
    <aside id="left-panel"> 
        <!-- User info -->
        <div class="login-info">
            <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
                <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                     
                    <?php $descripcion1 = $lista[0]["descripcion"]; ?>
                    <?php echo '<img src="' . $descripcion1 . '" width="200" heigth="200" class="online">'; ?>
                    <span>
                       <?php echo $empleado;?>
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a> 
            </span>
        </div> 
        <nav> 
            <nav>       
                <ul>
                    <li class="">
                        <a href="#" title="Menu Principal">
                            <i class="fa fa-lg fa-fw fa-home"></i>
                            <span class="menu-item-parent">Menu Principal </span>
                        </a>
                    </li>

                    <?php
                    for ($i = 0; $i < count($lista_modulos); $i++) {
                        ?>   

                        <li><a href="#" title="Graphs">
                                <i class="<?php echo($lista_modulos[$i]['icono']); ?>"></i>
                                <span class="menu-item-parent"><?php echo($lista_modulos[$i]['modulo']); ?></span>
                            </a>
                            
                            <ul>
                                
                                 <?php
                                            $lista_paginas = $obj_modulo->dame_paginas_xidmodulo($id_persona, $lista_modulos[$i]['id_modulo']);
                                            for ($j = 0; $j < count($lista_paginas); $j++) {
                                                $id_pagina = $lista_paginas[$j]['id_pagina'];
                                                $url = $lista_paginas[$j]['url'];
                                                $pagina = $lista_paginas[$j]['pagina'];
                                                ?>
                                <li><a onClick="verurl('<?php echo $url; ?>', <?php echo $id_pagina; ?>);" href="#" title="Flot Chart"><?php echo $pagina; ?></a></li>
                                 <?php }
                                            ?>
                            </ul>
                        </li>
                    <?php }
                    ?>  
                </ul> 
            </nav> 
        </nav>
        <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span> 
    </aside>
    <!-- END NAVIGATION -->
    <?php
} else {
    ?>
    <script language="JavaScript" type="text/javascript">
        alert('Su session a expirado, por favor Ingrese Nuevamente');
        location.href = 'login.php';
    </script>
    <?php
}
?>