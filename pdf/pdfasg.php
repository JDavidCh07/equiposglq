<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/masg.php');
require_once ('../models/mequ.php');

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');

$masg = new Masg();
$mequ = new Mequ();

$ideqxpr = isset($_REQUEST['ideqxpr']) ? $_REQUEST['ideqxpr']:NULL;

$logo = "../img/logoynombre.png";
$imagenBase64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

if($ideqxpr){
    $masg->setIdeqxpr($ideqxpr);
    $datDet = $masg->getOne();
    $det = $datDet[0];
    $pg = $datDet[0]['pagequ'];
    if($pg==52){
        $datAcc = $masg->getAllAcc(3);
        $mequ->setIdequ($datDet[0]["idequ"]);
        $prgs = $mequ->getOnePxE();
    }
    elseif($pg==54) $datAcc = $masg->getAllAcc(5);
    $datAxE = $masg->getAllAxE($datDet[0]["ideqxpr"]);
}

$anctbla = 750;
$html = '';

?>
<table>
    <tbody>
        <tr>
            <td colspan="3" rowspan="3"><img src="'.$imagenBase64.'" alt="Logo GALQUI SAS"></td>
            <td colspan="6" rowspan="3"><strong>FORMATO REGISTRO DE EQUIPOS Y ELEMENTOS</strong></td>
            <td colspan="4"><strong>Código: GAL-RH-FR-26</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>Versión: 6</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>Fecha: 13/02/2024</strong></td>
        </tr>
        <tr>
            <td colspan="14"><strong>DATOS DEL TRABAJADOR</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>NOMBRE</strong></td>
        </tr>
        <tr>
            <td colspan="10">'.$det['prec'].'</td>
        </tr>
        <tr>
            <td colspan="4"><strong>CEDULA</strong></td>
        </tr>
        <tr>
            <td colspan="10">'.$det['dprec'].'</td>
        </tr>
        <tr>
            <td colspan="4"><strong>CARGO</strong></td>
        </tr>
        <tr>
            <td colspan="10">'.$det['cprec'].'</td>
        </tr>
        <tr>
            <td colspan="4"><strong>CORREO CORPORATIVO</strong></td>
        </tr>
        <tr>
            <td colspan="10">'.$det['eprec'].'</td>
        </tr>

    </tbody>
</table>