<?php
ob_start();
include_once("adm/model/m_persona.php");
include_once("adm/model/m_habilidades.php");
include_once("adm/model/m_especializacion.php");
include_once("adm/model/m_experiencia.php");
include_once("adm/model/m_estudio.php");
$obj_laboratorio = new m_persona();
$obj_habilidades = new m_habilidades();
$obj_especializacion = new m_especializacion();
$obj_experiencia = new m_experiencia();
$obj_estudio = new m_estudio();
$p_codigo = $_REQUEST["id_persona"];
;

$lista = $obj_laboratorio->dame_persona1($p_codigo);
$lista1 = $obj_habilidades->sp_dame_habilidades1($p_codigo);
$lista2 = $obj_estudio->sp_dame_estudio1($p_codigo);
$lista3 = $obj_especializacion->sp_dame_especializacion1($p_codigo);
$lista4 = $obj_experiencia->sp_dame_experiencia1($p_codigo)
?>
<!doctype html> 
<html> 
    <head>
        <style>
            @page { margin: 15px 15px; }
            #header { position: fixed; left: 0px; top: -60px; right: 50px; height: 35px;}
            #footer { position: fixed; left: 0px; bottom: 50px; right: 50px; height: 60px;}
            #footer .page:after { content: counter(page, upper-num);}
            #body {
                font-family: "Times New Roman", serif;
                text-align: center;
                margin: 10mm 12mm 8mm 12mm; 
            }

            #ficha {
                font-family: "Times New Roman", serif;
                text-align: center;
                margin: 9mm 5mm 5mm 9mm; 
            }      
            p{ 
                font-size: 13pt; 
                line-height: 1.5em;
                margin: 4mm 12mm 4mm 12mm; 
            }
            td { 
                font-family: "Times New Roman", serif;
                font-size: 11pt; 
                line-height: 1.2em;
            }
        </style>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
        <link rel="stylesheet" type="text/css" href="http://www.example.com/style.css">
    </head> 
    <body>



        <h2 id="body"><b>CURRICULUM VITAE</b></h2>

        <table width="90%" border='0' cellspacing='0' cellpadding='2' align='center'>

            <tr>
                <td colspan="4" style="background-color: #C7C7C7;" ><b> </b>  </td
                <td colspan="8"  ><b><h4>CARACTERISTICAS PERSONALES:</h4></b>  </td>
            </tr>
            <tr>
                <td colspan="4" style="background-color: #C7C7C7;" align='center'> 

                    <?php $descripcion1 = $lista[0]["descripcion"]; ?>
                    <?php echo '<img src="' . $descripcion1 . '" width="100" heigth="100"><br>'; ?>
                </td>
                <td colspan="8"  > 

                    <?php
                    for ($i = 0; $i < count($lista1); $i++) {

                        $cod_habilidades = $lista1[$i]["id_habilidades"];
                        $nombre = $lista1[$i]["nombre"];
                        ?>    
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -  <?php echo $nombre; ?><br> 
                    <?php } ?> 
                </td>
            </tr>

            <tr>
                <td colspan="4" style="background-color: #C7C7C7;" align='center'>


                    <?php echo $lista[0]["abogado"]; ?>
                    <br><?php echo $lista[0]["nombres"]; ?>
                    <br>Edad:&nbsp; <?php echo $lista[0]["edad"]; ?>&nbsp;años 
                </td>
                <td colspan="8"> <b><h4>ESTUDIOS REALIZADOS:</h4></b>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="background-color: #C7C7C7;" align='center'>

                    Fecha de Nacimiento:<br>
                    <?php echo $lista[0]["fecha_nacimiento"]; ?>
                    <br>DNI:&nbsp;<?php echo $lista[0]["dni"]; ?>
                </td>
                <td colspan="8">
                    <table border="0">

                        <?php
                        for ($a = 0; $a < count($lista2); $a++) {
                            $id_tipo_psicologia = $lista2[$a]["id_estudio"];
                            $nombre1 = $lista2[$a]["tiponombre"];
                            $nombre = $lista2[$a]["institucion"];
                            ?>
                            <tr>
                                <td colspan="6" style="border-color: lightgray;"><b><?php echo $nombre1; ?> :&nbsp;
                                    </b><?php echo $nombre; ?></td>
                            </tr>



                        <?php } ?>

                    </table>

                </td>
            </tr>

            <tr>
                <td colspan="4" rowspan="2" style="background-color: #C7C7C7;" align='center'>
                    Estado Civil: &nbsp;<br>
                    <br>
                    Dirección:&nbsp;<?php echo $lista[0]["direccion"]; ?><br><br>
                    Celular:&nbsp;<?php echo $lista[0]["celular"]; ?><br><br>
                    &nbsp;<?php echo $lista[0]["correo"]; ?>



                </td>
                <td colspan="8"> <b><h4>ESPECIALIDAD:</h4></b>
                </td>
            </tr>
            <tr>

                <td colspan="8"> 
                    <table border="0">

                        <?php
                        for ($b = 0; $b < count($lista3); $b++) {
                            $id_especializacion = $lista3[$b]["id_especializacion"];
                            $nombre1 = $lista3[$b]["nombre_especializacion"];
                            ?>
                            <tr>
                                <td colspan="6" style="border-color: lightgray;"> -&nbsp; <?php echo $nombre1; ?></td>
                            </tr>



                        <?php } ?>

                    </table>

                </td>
            </tr>
        </table>
        <div style="page-break-after:always;" class="col-md-12"></div>
        <table width="90%" border='0' cellspacing='0' cellpadding='2' align='center'>
            <tr>

                <td colspan="12" style="background-color: #C7C7C7;"> <b><h4>EXPERIENCIAS LABORALES:</h4></b>    </td>
            </tr>
            <tr>

                <td colspan="12"  >   

                    <?php
                    for ($d = 0; $d < count($lista4); $d++) {

                        $cod_experiencia = $lista4[$i]["id_experiencia"];
                        $empresa = $lista4[$d]["empresa"];
                        $puesto = $lista4[$d]["puesto"];
                        $trabajo_realizado = $lista4[$d]["trabajo_realizado"];
                        $fecha_inicio = $lista4[$d]["fecha_inicio"];
                        $fecha_fin = $lista4[$d]["fecha_fin"];
                        ?>    
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Empresa: &nbsp;&nbsp;</b> <?php echo $empresa; ?><br> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Puesto: &nbsp;&nbsp;</b> <?php echo $puesto; ?><br> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Empresa:&nbsp;&nbsp;</b>  <?php echo $empresa; ?><br> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Fecha Inicio:&nbsp;&nbsp;</b>  <?php echo $fecha_inicio; ?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Fecha Fin: &nbsp;&nbsp;</b> <?php echo $fecha_fin; ?><br> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Trabajos Realizados:&nbsp;&nbsp;</b>  <?php echo $trabajo_realizado; ?><br><br><br>

                    <?php } ?> 
                </td>
            </tr>
        </table>

            
        <table width="90%" border='0' cellspacing='0' cellpadding='2' align='center'>

            <tr>
                <td colspan="12" align='center'  style="background-color: #C7C7C7;">
                     <B>CERTIFICADOS ADJUNTOS </B> 
                </td>
            </tr>
            <tr>
                <td colspan="12" align='center'  >  
                    <?php
                    for ($g = 0; $g < count($lista2); $g++) {
                        $empresa22 = $lista2[$g]["institucion"];
                        $descripcion22 = $lista2[$g]["descripcion"];
                        ?>
                        <b> ESTUDIOS BASICOS: &nbsp;&nbsp;</b> <?php echo $empresa22; ?><br>                            
                        <?php echo '<img src="' . $descripcion22 . '" width="380" heigth="380"><br>'; ?>

                    <?php } ?>                    
                </td>
            </tr> 
            <tr>
                <td colspan="12" align='center'  >  
                    <?php
                    for ($f = 0; $f < count($lista3); $f++) {
                        $empresa33 = $lista3[$f]["nombre_especializacion"];
                        $descripcion33 = $lista3[$f]["descripcion"];
                        ?>
                        <b> ESPECIALIDAD: &nbsp;&nbsp;</b> <?php echo $empresa33; ?><br>                            
                        <?php echo '<img src="' . $descripcion33 . '" width="400" heigth="400"><br>'; ?>

                    <?php } ?>                    
                </td>
            </tr> 

            <tr>
                <td colspan="12" align='center'  >  
                    <?php
                    for ($e = 0; $e < count($lista4); $e++) {
                        $empresa11 = $lista4[$e]["empresa"];
                        $descripcion11 = $lista2[$e]["descripcion"];
                        ?>
                        <b> EMPRESA: &nbsp;&nbsp;</b> <?php echo $empresa11; ?><br>                            
                        <?php echo '<img src="' . $descripcion11 . '" width="400" heigth="400"><br>'; ?>

                    <?php } ?>                    
                </td>
            </tr> 

        </table>

    </body> 
</html>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper("A4", "portrail");

$dompdf->render();
$pdf = $dompdf->output();

$filename = 'Bolsaempleo.pdf';
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>