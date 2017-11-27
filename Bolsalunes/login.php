<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_body_prop = array("id" => "extr-page", "class" => "animated fadeInDown");

?>

<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">

		<!-- #FAVICONS -->
			<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">


	</head>
	
		<header id="header">

			<div id="logo-group">
				<h2 class="text-center"> Bolsa de Trabajo</h2>
			</div>
			<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Necesitas una cuenta?</span> <a href="http://localhost/Firma_Abogados/index.html" class="btn btn-warning">Regresar</a> </span>

		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h2 class="txt-color-red login-header-big">Firma de Abogados</h2>
						<div class="hero">

							<div class="pull-left login-desc-box-l">
								<h4 class="paragraph-header text-justify">Esta es la primera forma de busqueda de trabajo virtual y automatizada, y estará al alcance de sus manos, ya que se podra ejecutar en cualquier plataforma.</h4>
							</div>
							
							<img src="img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">

						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">Sobre Nosotros</h5>
								<p class="text-justify">
									Somos un grupo que busca incursionar en una nueva de busqueda de trabajo mas automatizada, para facilitarle al trabajo tanto a los abogados como las empresas que los contratan.
								</p>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h5 class="about-heading">Trabajar con nosotros es asi de facil</h5>
								<p class="text-justify">
									Lo unico que deben hacer para ser parte de esta nueva forma de trabajo, es registrarse una vez se encuentren habilitados y las empresas podran encontrarlos rapidamente, de acuerdo a sus competencias.
								</p>
							</div>
						</div>

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							 <form action="adm/controller/c_login.php" method="post" id="login-form" class="smart-form client-form">
								<header>
									Iniciar Sesión
								</header>
							<fieldset> 
                            <section>
                                <label class="label">Usuario:</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="txtusuario" name="p_usuario">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Por favor, ingrese su usuario</b></label>
                            </section>

                            <section>
                                <label class="label">Clave:</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" id="txtpass" name="p_clave">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Por favor, ingrese su clave</b> </label>
                            </section> 
                        </fieldset>
								<footer>
									<button type="submit" id="btniniciosesion" class="btn btn-success">
										Iniciar Sesión
									</button>
								</footer>
							</form>

						</div>
                                            
                                            
                                            
                                            
                                            
                                            
						<a class="text-center" href=" "> -venta -</a>
					</div>
				</div>
			</div>

		</div>

</html>

<?php
//include required scripts
include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
    runAllForms();

    $(function () {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules: {
                p_usuario: {
                    required: true 
                },
                p_clave: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
            // Messages for form validation
            messages: {
                p_usuario: {
                    required: 'Por favor, ingrese su usuario'  
                },
                p_clave: {
                    required: 'Por favor, ingrese su clave'
                }
            },
            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
    });
</script>

<?php
//include footer
include("inc/google-analytics.php");
?>