<?php
echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mprm.php');
require_once ('../sendemail.php');
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

$mprm = new Mprm();

$idprm = isset($_REQUEST['idprm']) ? $_REQUEST['idprm']:NULL;
$estprm = isset($_REQUEST['estprm']) ? $_REQUEST['estprm']:NULL;
$numprm = array_reverse($mprm->getAll());
if ($numprm){
    foreach($numprm AS $np){
        if($np['noprm']){
            $noprm = ($np['noprm']) + 1;
            break;
        }else $noprm = 1; 
}}else $noprm = 1;

$logo = "../img/logoynombre.png";
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

if($idprm){
    $mprm->setIdprm($idprm);
    $mprm->setNoprm($noprm);
    $mprm->setEstprm($estprm);
    $mprm->setFecsol($hoy);
    // $mprm->editAct();
    $datDet = $mprm->getOne();
    $det = $datDet[0];
    $datTprm = $mprm->getAllDom(10);
}

$anctbla = 750;
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
            <td class="td" colspan="1"><strong>Fecha: 13/09/2024</strong></td>
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
            <td class="td datper fond2 tit" style="width: 5%">';
            if($dtp['idval']==$det['idvtprm']) $html .= 'X</td>';
            else $html .= '</td>';
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
<span><br></span>
<table>
    <tbody>
        <tr>
            <td class="datper" style="width: 30%"><strong>APROBADA POR JEFE INMEDIATO :</strong></td>
            <td class="datper" style="width: 8%">SI : </td> 
            <td class="datper tit" style="width: 7%">'; 
            if($det['estprm']==3) $html .= 'X';
            $html .= '</td>
            <td class="datper" style="width: 8%">NO : </td>
            <td class="datper tit" style="width: 7%">'; 
            if($det['estprm']==4) $html .= 'X';
            $html .= '</td>
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

if($idprm){
    $fold = 'arc/permisos/'.$det['aper'].' '.$det['nper'].'_'.$det['dper'].'/';
    $name = $det['tprm']."_".date("Y-m-d", strtotime($det['fecini'])).".pdf";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();
    $pdfgen = $dompdf->output();
    //-------Unir pdf generado y soporte--------
    if("../".$det['sptrut'] && file_exists("../".$det['sptrut'])){
        //-------Cargar pdf generado--------
        $pCountGen = $fpdi->setSourceFile(StreamReader::createByString($pdfgen));
        for ($pageNo = 1; $pageNo <= $pCountGen; $pageNo++) {
            $tplIdx = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($tplIdx);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplIdx);
        }
        
        //-------Cargar pdf soporte--------
        $sptrut = "../".$det['sptrut'];
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

    //-------Datos destinatario--------
    $perd = $det['ajef']." ".$det['njef']; 
    $maild = $det['ejef'];
    $partes = explode(" ", $perd);
    $aped = ucfirst(strtolower($partes[0]));
    $nomd = ucfirst(strtolower($partes[count($partes) > 2 ? 2 : 1]));
    $nomperd = $nomd." ".$aped;
    
    //-------Datos correo--------
    $pprm = $det['aper']." ".$det['nper']; 
    $partesp = explode(" ", $pprm);
    $apep = ucfirst(strtolower($partesp[0]));
    $nomp = ucfirst(strtolower($partesp[count($partesp) > 2 ? 2 : 1]));
    
    // $template="../tempmail.html";
    // $txt_mess = "";
    // $txt_mess = "Adjunto a este correo se encuentra el acta de ";
    // if($det['fecent'] && !$det['fecdev']) $txt_mess .= "entrega";
    // elseif($det['fecent'] && $det['fecdev']) $txt_mess .= "devolución"; 
    // $txt_mess .= " firmada del equipo asignado.<br><br>
    // Le solicitamos revisar el documento adjunto y conservar una copia para sus registros. Si tiene alguna pregunta o necesita asistencia adicional, no dude en ponerse en contacto con nuestro departamento de soporte.<br><br>
    // Agradecemos su colaboración y compromiso con el correcto uso y mantenimiento del equipo.<br><br>
    // Atentamente,<br><br>";
	// $mail_asun = "Confirmación ";
    // if($det['fecent'] && !$det['fecdev']) $mail_asun .= "Entrega";
    // elseif($det['fecent'] && $det['fecdev']) $mail_asun .= "Devolución"; 
    // $mail_asun .= " de Equipo";
    // $fir_mail = '<strong>'.$nomperm.'</strong><br>'.$cargom.' | '.$mail.'<br>Cra 1 Nº 4 - 02 Bdg 2 Parque Industrial K2<br>Chía - Cund<br>www.galqui.com';
    // sendemail($ema, $psem, $maild, $nomperd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template);
}
?>