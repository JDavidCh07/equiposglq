<?php
echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mprm.php');
require_once ('../controllers/sendemail.php');
include("../models/datos.php");

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

$dompdf = new Dompdf();
$fpdi = new Fpdi();

 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');
$hoy = date("Y-m-d");
$sptrut = NULL;

$mprm = new Mprm();


$idprm = isset($_REQUEST['idprm']) ? $_REQUEST['idprm']:NULL;
$estprm = isset($_REQUEST['estprm']) ? $_REQUEST['estprm']:NULL;
$obsprm = isset($_POST['obsprm']) ? $_POST['obsprm']:NULL;
$idrev = isset($_REQUEST['idrev']) ? $_REQUEST['idrev']:NULL;
$numprm = array_reverse($mprm->getAll(3));

if ($numprm){
    foreach($numprm AS $np){
        if($np['noprm']){
            $noprm = ($np['noprm']) + 1;
            break;
        }else $noprm = 1; 
}}else $noprm = 1;

$logo = "../img/logoynombre.png";
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

$mprm->setIdprm($idprm);
$comest = $mprm->getOne();

if($idprm && ($comest[0]['estprm']!=3 || $comest[0]['estprm']!=4)){
    $mprm->setNoprm($noprm);
    $mprm->setEstprm($estprm);
    $mprm->setObsprm($obsprm);
    $mprm->setFecsol($hoy);
    $mprm->setIdrev($idrev);
    $mprm->setFecrev($hoy);
    $mprm->editAct();
    $datDet = $mprm->getOne();
    $det = $datDet[0];
    $datTprm = $mprm->getAllDom(10);

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
            table{
                width: 100%;
            }
            table, .td{
                border-collapse: collapse;
                border: 1px solid #000;
                padding: 1px 3px;
                font-size: 12px;
            }
            .datper{
                padding: 8px;
            }
            .tit{
                text-align: center;
            }
            .fond1{
                background-color: #A6C9EC;
            }
            .fond2{
                background-color: #DAE9F8;
            }
        </style>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <td class="tit td" style="width: 100px" colspan="2" rowspan="4"><img style="width: 80%;" src="'.$logob64.'" alt="Logo GALQUI SAS"></td>
                <td class="tit td" colspan="2" rowspan="4"><strong>SOLICITUD DE PERMISOS</strong></td>
                <td class="td" colspan="1"><strong>Código: GAL-RH-FR-16</strong></td>
            </tr>
            <tr>
                <td class="td" colspan="1"><strong>Versión: 5</strong></td>
            </tr>
            <tr>
                <td class="td" colspan="1"><strong>Fecha: 17/10/2024</strong></td>
            </tr>
            <tr>
                <td class="td" colspan="1"><strong>Página: 1 de 1</strong></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="datper" style="width: 60%">CIUDAD : '.strtoupper($det['ubi']).'</td>
                <td class="datper" style="width: 40%">FECHA SOLICITUD : '.strtoupper($det['fsol']).'</td>
            </tr>
            <tr>
                <td class="datper" style="width: 60%">NOMBRE SOLICITANTE : '.$det['nper'].' '.$det['aper'].'</td>
                <td class="datper" style="width: 40%">NÚMERO DE CÉDULA : '.$det['dper'].'</td>
            </tr>
            <tr>
                <td class="datper" style="width: 60%">CARGO : '.$det['cper'].'</td>
                <td class="datper" style="width: 40%">DEPTO : '.strtoupper($det['dpt']).'</td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <thead>
            <th class="tit datper fond1" colspan="5" style="width: 100%"><strong>FECHA DEL PERMISO</strong></th>
        </thead>
        <tbody>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>DESDE : </strong></td>
                <td class="datper" style="width: 21%">HORA : '.date("H:i", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 21%">DÍA : '.date("d", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 21%">MES : '.date("m", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 22%">AÑO : '.date("Y", strtotime($det['fecini'])).'</td>
            </tr>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>HASTA : </strong></td>
                <td class="datper" style="width: 21%">HORA : '.date("H:i", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 21%">DÍA : '.date("d", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 21%">MES : '.date("m", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 22%">AÑO : '.date("Y", strtotime($det['fecfin'])).'</td>
            </tr>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>TOTAL : </strong></td>
                <td class="datper" style="width: 21%">DÍAS : '.$det['ddif'].'</td>
                <td class="datper" style="width: 21%">HORAS : '.$det['hdif'].'</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <thead>
            <th class="tit datper fond1" colspan="4" style="width: 100%"><strong>TIPO DE PERMISO</strong></th>
        </thead>
        <tbody>
            <tr>';
            if($datTprm){ foreach($datTprm AS $i=>$dtp){
            $html .= '<td class="td datper" style="width: 45%">'.strtoupper($dtp['nomval']).'</td>
                <td class="td datper fond2 tit" style="width: 5%">'.(($dtp['idval']==$det['idvtprm']) ? 'X' : '').'</td>';
                if($i%2==1 && $dtp['idval']!=48) $html .= '</tr><tr>';
            }}
    $html .= '
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="td datper">DESCRIPCIÓN DEL PERMISO :<br><br>'.$det['desprm'].'</td>
            </tr>
            <tr>
                <td class="td datper">OBSERVACIONES :<br><br>'.$det['obsprm'].'</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td class="datper" style="width: 30%"><strong>APROBADA POR JEFE INMEDIATO :</strong></td>
                <td class="datper" style="width: 8%">SI : </td> 
                <td class="datper tit" style="width: 7%">'.(($det['estprm']==3) ? 'X' : '').'</td>
                <td class="datper" style="width: 8%">NO : </td>
                <td class="datper tit" style="width: 7%">'.(($det['estprm']==4) ? 'X' : '').'</td>
                <td style="width: 40%"></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="datper td"><span style="color: blue"><b>NOTA:</b></span> <b>1.</b> Es obligatorio adjuntar soportes que respalden el permiso solicitado, cuando aplique. <b>2.</b> Para solicitud de permisos de tres (03) o más días se negociara con el Jefe inmediato y el Depto. Recursos Humanos, el disfrute de vacaciones, si se cree conveniente. <b>3.</b> Si el solicitante <b>NO</b> presenta el formato previamente, ni los soportes (en caso de aplicar) al inicio del permiso, podrá incurrir en faltas contempladas en el Reglamento Interno de Trabajo Capitulo XIV Procedimientos para comprobación de fallas y formas de aplicación de las sanciones disciplinaria. <b>4 </b>El día descanso de la ley 1857 de 2017 tiene como objeto fortalecer el desarrollo integral de la familia. <b>5.</b> Para mayor claridad consultar el Reglamento Interno de Trabajo Capitulo VII Permisos. <b>6.</b> Se deja constancia que el Reglamento Interno de Trabajo se encuentra publicado en el aplicativo Kiosko en la sección de Comunicados, y está al alcance de todos los colaboradores.</td>
            </tr>
        </tbody>
    </table>
    </body>
    </html>';

    $fold = 'arc/permisos/'.$det['aper'].' '.$det['nper'].'_'.$det['dper'].'/';
    $name = $det['tprm']."_".date("Y-m-d", strtotime($det['fecini'])).".pdf";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();
    $pdfgen = $dompdf->output();

    if($det['sptrut']) $sptrut = "../".$det['sptrut'];
    //-------Unir pdf generado y soporte--------
    if($sptrut && file_exists($sptrut)){
        //-------Cargar pdf generado--------
        $pCountGen = $fpdi->setSourceFile(StreamReader::createByString($pdfgen));
        for ($pageNo = 1; $pageNo <= $pCountGen; $pageNo++) {
            $tplIdx = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($tplIdx);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplIdx);
        }
        
        //-------Cargar pdf soporte--------
        $pCountSpt = $fpdi->setSourceFile($sptrut);
        for ($pageNo = 1; $pageNo <= $pCountSpt; $pageNo++) {
            $tplIdx = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($tplIdx);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplIdx);
        }
        $output = $fpdi->Output('S');
    }else $output = $pdfgen;

    //-------Guardar pdf--------
    if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    $file_path = '../'.$fold.$name;
    file_put_contents($file_path, $output);
    $mprm->setRutpdf($fold.$name);
    $mprm->savePdf();

    //-------Datos jefe--------
    $perd = $det['ajef']." ".$det['njef']; 
    $maild = $det['ejef'];
    $partes = explode(" ", $perd);
    $aped = ucfirst(strtolower($partes[0]));
    $nomd = ucfirst(strtolower($partes[count($partes) > 2 ? 2 : 1]));
    $nompd = $nomd." ".$aped;

    //-------Datos aprueba--------
    $pera = $det['arev']." ".$det['nrev']; 
    $maila = $det['erev'];
    $partesa = explode(" ", $pera);
    $apea = ucfirst(strtolower($partesa[0]));
    $noma = ucfirst(strtolower($partesa[count($partesa) > 2 ? 2 : 1]));
    $nompa = $noma." ".$apea;
    
    //-------Datos colaborador--------
    $pprm = $det['aper']." ".$det['nper']; 
    $mailp = $det['eper'];
    $partesp = explode(" ", $pprm);
    $apep = ucfirst(strtolower($partesp[0]));
    $nomp = ucfirst(strtolower($partesp[count($partesp) > 2 ? 2 : 1]));
    $nompp = $nomp." ".$apep;
    
    $pfec = explode(' ', $det['fini']);
    $fec = $pfec[0].' de '.$pfec[2];

    $fir_mail = '<strong>'.$nom.'</strong><br>Cra 1 Nº 4 - 02 Bdg 2 Parque Industrial K2<br>Chía - Cund<br>www.galqui.com';

    if($estprm==2){
        $template="../views/mailprm.html";
        
        //-------Datos correo jefe--------
        $mail_asun = "Solicitud Permiso ".$nompp." - ".$fec;
        $link = $url."views/pdfprm.php?idprm=".$idprm."&estprm=3&idrev=".$det['ijef'];
        $txt_mess = "";
        $txt_mess = "Te informamos que ".$nompp." está solicitando un permiso para el ".$fec.(($det['tprm']!=48) ? " por motivos de ".$det['tprm'] : "").".<br><br>
        Adjunto a este correo se encuentra el formato debidamente diligenciado.<br><br>
        Para aceptarlo, da clic en el siguiente botón o ingresa a la aplicación, donde también podrás rechazarlo.";
        
        sendemail($ema, $psem, $nom, $maild, $nompd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, $link);
    } elseif($estprm==3){
        $template="../views/mail.html";

        //-------Datos correo RRHH y DirAdm--------
        $mail_asun = "Aprobación Permiso ".$nompp." - ".$fec;
        $txt_mess = "";
        $txt_mess = "Informamos que ".$nompa." ha aprobado el permiso de ".$nompp." para el día ".$fec." de ".$det['hini']." a ".$det['hfin']."<br><br>
        Adjunto a este correo se encuentra el formato diligenciado con la aprobación.<br><br>.";

        sendemail($ema, $psem, $nom, $rrhh, $nomrh, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "");
        sendemail($ema, $psem, $nom, $diradm, $nomadm, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "");

        //-------Datos correo colaborador--------
        $mail_asun = "Aprobación Permiso - ".$fec;
        $txt_mess = "";
        $txt_mess = "Te informamos que el permiso solicitado para el día ".$fec." ha sido aprobado por ".$nompa."<br><br>
        Adjunto a este correo se encuentra el formato con la aprobación.<br><br>.";

        sendemail($ema, $psem, $nom, $mailp, $nompp, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "");
}}
?>