<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC. */



/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
<?php
include("inc/ribbon.php");
?>

    <!-- MAIN CONTENT -->
    <div id="content">

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- FOOTER -->
<?php
include("inc/footer.php");
?>
<!-- END FOOTER -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
//include required scripts
include("inc/scripts.php");
//include footer
include("inc/google-analytics.php");
?>

<!--PARAMETROS GENERALES DEL SISTEMA-->       
<input id="hd-er-parametrosGET" type="hidden" />
<div id="div_oculto" style="display: none;"></div>
<div id="erp_dialogo" style="display: none;">Ventana Inicial</div>
<div id="erp_dialogo1" style="display: none;"></div>
<div id="erp_dialogo2" style="display: none;"></div>
<div id="respuesta" ></div>
