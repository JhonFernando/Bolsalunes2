<!DOCTYPE html>
<html lang="en-us" <?php
@session_start();
$id_persona1 = $_SESSION['id_persona'];
$empleado = $_SESSION['empleado'];
include_once("adm/model/m_persona.php");
$obj_laboratorio = new m_persona();
$lista = $obj_laboratorio->dame_persona5($id_persona1);

echo implode(' ', array_map(function($prop, $value) {
            return $prop . '="' . $value . '"';
        }, array_keys($page_html_prop), $page_html_prop));
?>>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

        <title> <?php echo $page_title != "" ? $page_title . " - " : ""; ?>Bolsa de trabajo </title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/tablita.css">
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-skins.min.css">

        <!-- SmartAdmin RTL Support is under construction-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-rtl.min.css">

        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/your_style.css"> -->

        <?php
        if ($page_css) {
            foreach ($page_css as $css) {
                echo '<link rel="stylesheet" type="text/css" media="screen" href="' . ASSETS_URL . '/css/' . $css . '">';
            }
        }
        ?>


        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/demo.min.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Specifying a Webpage Icon for Web Clip
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
    </head>
    <body class="desktop-detected pace-done smart-style-4">
        <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
                 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
        <?php
        if (!$no_main_header) {
            ?>
            <!-- HEADER -->
            <header id="header">
                <div id="logo-group">

                    <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
                        <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">

                            <?php $descripcion1 = $lista[0]["descripcion"]; ?>
                            <?php echo '<img src="' . $descripcion1 . '" width="38" heigth="38" class="online">'; ?>

                            <i class="fa fa-angle-down"></i>
                        </a> 
                    </span>

                </div>

                <!-- pulled right: nav area -->
                <div class="pull-right">
                    <div id="hide-menu" class="btn-header pull-right">
                        <span> <a href="javascript:void(0);" title="  Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
                    </div>
                    <!-- #MOBILE -->
                    <!-- Top menu profile link : this shows only when top menu is active -->
                    <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                        <li class="">

                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="#ajax/profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> Mi Perfil</a>
                                </li>
                                <li class="divider"></li> 
                                <li>
                                    <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Pantalla Completa</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="login.php" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong> Cerrar Session</strong></a>
                                </li>
                            </ul>
                        </li>
                    </ul> 


                    <!-- logout button -->
                    <div id="logout" class="btn-header transparent pull-right">
                        <?php echo $empleado; ?>
                        <span> <a href="<?php echo APP_URL; ?>/adm/controller/c_logout.php" title="Cerrar Sessión" data-action="userLogout" data-logout-msg="Está seguro de cerrar sessión al Sistema?">
                                <i class="fa fa-sign-out"></i></a> </span>
                    </div>
                    <!-- end logout button -->
                    
                    <!-- fullscreen button -->

                    <!-- end fullscreen button -->
                </div>
                <!-- end pulled right: nav area -->

            </header>
            <!-- END HEADER -->

            <?php
        }
        ?>