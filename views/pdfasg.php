<?php
echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/masg.php');
require_once ('../models/mequ.php');
require_once ('../controllers/sendemail.php');
include("../models/datos.php");

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
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

if($ideqxpr){
    $masg->setIdeqxpr($ideqxpr);
    $datDet = $masg->getOne();
    $det = $datDet[0];
    $pg = $datDet[0]['pagequ'];
    if($pg==52){
        $datAcc = $masg->getAllAcc(3);
        $mequ->setIdequ($datDet[0]["idequ"]);
        $prgs = $mequ->getOnePxE();
        $n = 'AE_';
        $asg = "equ";
    }
    elseif($pg==54){
        $datAcc = $masg->getAllAcc(5);
        $n = 'AC_';
        $asg = "cel";
    }
    $datAxE = $masg->getAllAxE($datDet[0]["ideqxpr"]);
}


if($det['firent']){
    $fent = "../".$det['firent'];
    $fentb64 = "data:image/png;base64,".base64_encode(file_get_contents($fent));
}if($det['firdev']){
    $fdev = "../".$det['firdev'];
    $fdevb64 = "data:image/png;base64,".base64_encode(file_get_contents($fdev));
}

$cont = 0;
$html = '';
$html .= '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GALQUI SAS</title>
    <link rel="icon" href="../img/logo.png">
    <style>
        table, tbody, tr, td{
            border-collapse: collapse;
            border: 1px solid #000;
            padding: 1px 3px;
            font-size: 12px;
        }
        table, .tit, .pie{
            border: 3px solid #000;
        }
        .tit{
            text-align: center;
        }
        .fond{
            background-color: #D9D9D9;
        }
        .sep{
            height: 16px;
        }
        .sec{
            font-size: 15px
        }
        .obs{
            height: 32px;   
        }
        .obs tx{
            vertical-align: top;           
        }
    </style>
</head>
<body>
<table>
    <tbody>
        <tr>
            <td class="tit fond" style="width: 100px" colspan="4" rowspan="4"><img style="width: 80%;" src="'.$logob64.'" alt="Logo GALQUI SAS"></td>
            <td class="tit fond" colspan="6" rowspan="4"><strong>FORMATO REGISTRO DE EQUIPOS Y ELEMENTOS</strong></td>
            <td class="pie fond" colspan="4"><strong>Código: GAL-RH-FR-26</strong></td>
        </tr>
        <tr>
            <td class="pie fond" colspan="4"><strong>Versión: 6</strong></td>
        </tr>
        <tr>
            <td class="pie fond" colspan="4"><strong>Fecha: 13/02/2024</strong></td>
        </tr>
        <tr>
            <td class="pie fond" colspan="4"><strong>Página: 1 de 1</strong></td>
        </tr>
        <tr>
            <td class="tit sec fond" colspan="14"><strong>DATOS DEL TRABAJADOR</strong></td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE:</strong></td>
            <td colspan="11">'.$det['prec'].'</td>
        </tr>
        <tr>
            <td colspan="3"><strong>CEDULA:</strong></td>
            <td colspan="11">'.$det['dprec'].'</td>
        </tr>
        <tr>
            <td colspan="3"><strong>CARGO:</strong></td>
            <td colspan="11">'.$det['cprec'].'</td>
        </tr>
        <tr>
            <td colspan="3"><strong>CORREO CORPORATIVO:</strong></td>
            <td colspan="11">'.(($det['eprec']) ? $det['eprec'] : 'N/A').'</td>
        </tr>';
        if($pg==52){
$html .= '
            <tr>
                <td class="tit sec fond" colspan="14"><strong>DATOS DEL EQUIPO</strong></td>
            </tr>
            <tr>
                <td colspan="1"><strong>MARCA:</strong></td>
                <td colspan="5">'.$det['marca'].'</td>
                <td colspan="1"><strong>MODELO:</strong></td>
                <td colspan="7">'.$det['modelo'].'</td>
            </tr>
            <tr>
                <td colspan="1"><strong>SERIAL:</strong></td>
                <td colspan="13">'.$det['serialeq'].'</td>
            </tr>
            <tr>
                <td colspan="1"><strong>OFFICE:</strong></td>
                <td colspan="5">'.$prgs[0]['nomval'].' '.$prgs[0]['verprg'].'</td>
                <td colspan="1"><strong>WINDOWS:</strong></td>
                <td colspan="7">'.$prgs[1]['nomval'].' '.$prgs[1]['verprg'].
                '</td>
            </tr>
            <tr>
                <td colspan="6"><strong>IDENTIFICACION EQUIPO EN LA RED:</strong></td>
                <td colspan="8">'.$det['nomred'].'</td>
            </tr>
            <tr>
                <td class="sep" colspan="14"> </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2"><strong>ACCESORIOS:</strong></td>';
                if ($datAcc && $datAxE) {
                    foreach ($datAcc as $dac) {
                        $marcadorEncontrado = false;
                        $html .= '<td colspan="3"><strong>'.strtoupper($dac['nomval']).'</strong></td>';
                        foreach ($datAxE as $dae) {
                            if ($dac['idval'] == $dae['idvacc']) {
                                $html .= '<td colspan="1">X</td>';
                                $marcadorEncontrado = true;
                                break;
                            }
                        }
                        if (!$marcadorEncontrado) $html .= '<td colspan="1"></td>';
                        $cont++;
                        if($cont==3) $html .= '</tr><tr>';
                    }
                }
$html .= '
                <td colspan="4"></td>
            </tr>';
        }elseif($pg==54){
$html .= '
            <tr>
                <td class="tit sec fond" colspan="14"><strong>DATOS DEL CELULAR</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>MARCA:</strong></td>
                <td colspan="5">'.$det['marca'].'</td>
                <td colspan="2"><strong>IMEI:</strong></td>
                <td colspan="5">'.$det['serialeq'].'</td>
            </tr>
            <tr>
                <td colspan="2"><strong>NUMERO:</strong></td>
                <td colspan="5">'.(($det['numcel']!=0) ? $det['numcel'] : 'N/A').'</td>
                <td colspan="2"><strong>OPERADOR:</strong></td>
                <td colspan="5">'.$det['operador'].'</td>
            </tr>
            <tr>
                <td class="sep" colspan="14"> </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2"><strong>ACCESORIOS:</strong></td>';
                if ($datAcc) {
                    foreach ($datAcc as $dac) {
                        $marcadorEncontrado = false;
                        $html .= '<td colspan="2"><strong>'.strtoupper($dac['nomval']).'</strong></td>';
                        if ($datAxE) {
                            foreach ($datAxE as $dae) {
                                if ($dac['idval'] == $dae['idvacc']) {
                                    $html .= '<td colspan="1" style="text-align: center">X</td>';
                                    $marcadorEncontrado = true;
                                    break;
                                }
                            }
                        }
                        if ($marcadorEncontrado==false) $html .= '<td colspan="1"></td>';
                        $cont++;
                        if($cont==4) $html .= '</tr><tr>';
                    }
                }
$html .= '
                <td colspan="3"></td>
            </tr>';
        }
$html .= '
        <tr>
            <td class="sep" colspan="14"> </td>
        </tr>        
        <tr>
            <td colspan="4"><strong>FECHA ENTREGA:</strong></td>
            <td colspan="10">'.$det['fecent'].'</td>
        </tr>
        <tr>
            <td class="sep" colspan="14"> </td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td colspan="3">'.$det['pent'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cpent'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3">'.(function($name) { return explode(" ", $name)[0]; })($_SESSION["nomper"]) . " " . (function($surname) { return explode(" ", $surname)[0]; })($_SESSION["apeper"]).'</td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td colspan="3">'.$det['prec'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cprec'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3">';
            if ($det['firent']) $html .= '<img style="height: 30px;" src="'.$fentb64.'">';
$html .= '
            </td>
        </tr>
        <tr>
            <td class="obs" colspan="3"><strong>OBSERVACIONES:</strong></td>
            <td class="obs tx" colspan="11">'.$det['observ'].'</td>
        </tr>
        <tr>
            <td class="sep" colspan="14"> </td>
        </tr>        
        <tr>
            <td colspan="4"><strong>FECHA DEVOLUCION:</strong></td>
            <td colspan="10">'.$det['fecdev'].'</td>
        </tr>
        <tr>
            <td class="sep" colspan="14"> </td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td colspan="3">'.$det['pentd'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cpentd'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3">';
            if ($det['firdev']) $html .= '<img style="height: 30px;" src="'.$fdevb64.'">';
$html .= '
            </td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td colspan="3">'.$det['precd'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cprecd'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3">';
            if ($det['firdev']) $html .= (function($name) { return explode(" ", $name)[0]; })($_SESSION["nomper"]) . " " . (function($surname) { return explode(" ", $surname)[0]; })($_SESSION["apeper"]);
$html .= '
            </td>
        </tr>
        <tr>
            <td class="obs" colspan="3"><strong>OBSERVACIONES:</strong></td>
            <td class="obs tx" colspan="11">'.$det['observd'].'</td>
        </tr>
        <tr>
            <td class="sep" colspan="14"> </td>
        </tr>
        <tr>
            <td class="pie" colspan="14">
                <p><strong>NOTA: </strong>A partir de la fecha en la que se le haya asignado el (los) equipo (s), tarjetas, accesorios y demás elementos para la correcta ejecución de sus funciones y responsabilidades, usted es responsable por el buen estado y funcionamiento del (los) equipo (s), tarjetas, accesorios y demás elementos suministrados.<br>
                Está prohibido la descarga e instalación de software y aplicativos que puedan perjudicar el equipo y que no sean necesarias para la realización de sus funciones, si es necesario debe comunicarse con el área soporte IT.<br>
                En caso de daño o pérdida es su deber comunicarlo por escrito o por correo al departamento administrativo y a su jefe inmediato, si se comprueba un uso inadecuado, usted asumirá la reposición y/o reparación correspondiente.<br>
                En el momento de retirarse de GALQUI SAS o traslado a otro cargo, deberá devolver el equipo junto con los implementos entregados al departamento administrativo o a su jefe inmediato dejando constancia a través del formato GAL-RH-FR-39.</p>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>';

if($ideqxpr){
    $fold = 'arc/actas/'.$det['prec'].'_'.$det['dprec'].'/';
    $name = $n.$det['serialeq']."_".$det['prec'].".pdf";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();
    if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    $file_path = '../'.$fold.$name;
    $masg->setRutpdf($fold.$name);
    $masg->savePdf();
    file_put_contents($file_path, $dompdf->output());

    //-------Datos destinatario--------
    if($det['fecent'] && !$det['fecdev']){
        $perd = $det['prec'];
        $maild = $det['eprec'];
    }elseif($det['fecent'] && $det['fecdev']){
        $perd = $det['prec']; 
        $maild = $det['epentd'];
    }
    $partes = explode(" ", $perd);
    $aped = ucfirst(strtolower($partes[0]));
    $nomd = ucfirst(strtolower($partes[count($partes) > 2 ? 2 : 1]));
    $nomperd = $nomd." ".$aped;
    
    //-------Datos remitente--------
    if($det['fecent'] && !$det['fecdev']){
        $perm = $det['pent'];
        $mail = $det['epent'];
        $car = $det['cpent'];
    }elseif($det['fecent'] && $det['fecdev']){
        $perm = $det['precd']; 
        $mail = $det['eprecd'];
        $car = $det['cprecd'];
    }
    $partesm = explode(" ", $perm);
    $ape1 = ucfirst(strtolower($partesm[0]));
    $ini_ape2 = isset($partesm[1]) ? ucfirst($partesm[1][0]) . '.' : '';
    $nom1 = isset($partesm[2]) ? ucfirst(strtolower($partesm[2])) : '';
    $ini_nom2 = isset($partesm[3]) ? ucfirst($partesm[3][0]) . '.' : '';
    $nomperm = trim("$nom1 $ini_nom2 $ape1 $ini_ape2");
    $cargom = ucfirst(strtolower($car));

    $template="../views/mail.html";
    $mail_asun = "Confirmación ".(($det['fecent'] && !$det['fecdev']) ? "Entrega" : "Devolución")." de Equipo";
    $txt_mess = "";
    $txt_mess = "Adjunto a este correo se encuentra el acta de ".(($det['fecent'] && !$det['fecdev']) ? "entrega" : "devolución")." firmada del equipo asignado.<br><br>
    Le solicitamos revisar el documento adjunto y conservar una copia para sus registros. Si tiene alguna pregunta o necesita asistencia adicional, no dude en ponerse en contacto con nuestro departamento de soporte.<br><br>
    Agradecemos su colaboración y compromiso con el correcto uso y mantenimiento del equipo.<br><br>
    Atentamente,<br><br>";
    $fir_mail = '<strong>'.$nomperm.'</strong><br>'.$cargom.' | '.$mail.'<br>Cra 1 Nº 4 - 02 Bdg 2 Parque Industrial K2<br>Chía - Cund<br>www.galqui.com';
    sendemail($ema, $psem, $nom, $maild, $nomperd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "asg", "");
}

?>