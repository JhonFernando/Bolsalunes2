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
include("inc/header.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header"> 
    <div id="logo-group">
        <span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SmartAdmin"> </span> 
    </div> 
</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <div class="col-xs-2">
            </div>
            <div class="col-xs-8">
                <div class="well no-padding">
                    <form action="adm/controller/c_login.php" method="post" id="login-form" class="smart-form client-form">
                        <header>
                            Ingresar al Sistema
                        </header> 
                        <fieldset> 
                            <section>
                                <label class="label">Usuario:</label>
                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                    <input type="text" name="p_usuario">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Por favor, ingrese su usuario</b></label>
                            </section>

                            <section>
                                <label class="label">Clave:</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="p_clave">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Por favor, ingrese su clave</b> </label>
                            </section> 
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </footer>
                    </form> 
                </div> 
                <h5 class="text-center"> - ClinPanorte v1.0 -</h5> 
            </div>
            <div class="col-xs-2">
            </div>
        </div>
    </div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

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