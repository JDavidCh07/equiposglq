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
$cont = 0;
$html = '';
$html .= '
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
    .sep{
        height: 16px;
    }
</style>
<table>
    <tbody>
        <tr>
            <td class="tit" style="width: 100px" colspan="4" rowspan="4"><img style="width: 80%;" src="'.$imagenBase64.'" alt="Logo GALQUI SAS"></td>
            <td class="tit" colspan="6" rowspan="4"><strong>FORMATO REGISTRO DE EQUIPOS Y ELEMENTOS</strong></td>
            <td class="pie" colspan="4"><strong>Código: GAL-RH-FR-26</strong></td>
        </tr>
        <tr>
            <td class="pie" colspan="4"><strong>Versión: 6</strong></td>
        </tr>
        <tr>
            <td class="pie" colspan="4"><strong>Fecha: 13/02/2024</strong></td>
        </tr>
        <tr>
            <td class="pie" colspan="4"><strong>Página: 1 de 1</strong></td>
        </tr>
        <tr>
            <td class="tit" colspan="14"><strong>DATOS DEL TRABAJADOR</strong></td>
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
            <td colspan="11">';
                if($det['eprec']) $html .= $det['eprec'];
                else $html .= 'N/A';
$html .= '
            </td>
        </tr>';
        if($pg==52){
$html .= '
            <tr>
                <td class="tit" colspan="14"><strong>DATOS DEL EQUIPO</strong></td>
            </tr>
            <tr>
                <td colspan="1"><strong>MARCA:</strong></td>
                <td colspan="6">'.$det['marca'].'</td>
                <td colspan="1"><strong>MODELO:</strong></td>
                <td colspan="6">'.$det['modelo'].'</td>
            </tr>
            <tr>
                <td colspan="1"><strong>SERIAL:</strong></td>
                <td colspan="13">'.$det['serialeq'].'</td>
            </tr>
            <tr>
                <td colspan="1"><strong>OFFICE:</strong></td>
                <td colspan="6">'.$prgs[0]['nomval'].$prgs[0]['verprg'].
                '</td>
                <td colspan="1"><strong>WINDOWS:</strong></td>
                <td colspan="6">'.$prgs[1]['nomval'].$prgs[0]['verprg'].
                '</td>
            </tr>
            <tr>
                <td colspan="4"><strong>IDENTIFICACION EQUIPO EN LA RED:</strong></td>
                <td colspan="10">'.$det['nomred'].'</td>
            </tr>
            <tr class="sep">
                <td colspan="14"> </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2"><strong>ACCESORIOS:</strong></td>';
                if ($datAcc && $datAxE) {
                    foreach ($datAcc as $dac) {
                        $marcadorEncontrado = false;
                        $html .= '<td colspan="3"><strong>'.$dac['nomval'].'</strong></td>';
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
        }elseif($pg==52){
$html .= '
            <tr>
                <td class="tit" colspan="14"><strong>DATOS DEL CELULAR</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>MARCA:</strong></td>
                <td colspan="5">'.$det['marca'].'</td>
                <td colspan="2"><strong>IMEI:</strong></td>
                <td colspan="5">'.$det['serialeq'].'</td>
            </tr>
            <tr>
                <td colspan="2"><strong>NUMERO:</strong></td>
                <td colspan="5">';
                    if($det['numcel']!=0) $html .= $det['numcel'];
                    else $html .= 'N/A';
$html .= '
                </td>
                <td colspan="2"><strong>OPERADOR:</strong></td>
                <td colspan="5">'.$det['operador'].'</td>
            </tr>
            <tr class="sep">
                <td colspan="14"> </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2"><strong>ACCESORIOS:</strong></td>';
                if ($datAcc && $datAxE) {
                    foreach ($datAcc as $dac) {
                        $marcadorEncontrado = false;
                        $html .= '<td colspan="2"><strong>'.$dac['nomval'].'</strong></td>';
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
        }
$html .= '
        <tr class="sep">
            <td colspan="14"> </td>
        </tr>        
        <tr>
            <td colspan="4"><strong>FECHA ENTREGA:</strong></td>
            <td colspan="10">'.$det['fecent'].'</td>
        </tr>
        <tr class="sep">
            <td colspan="14"> </td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td colspan="3">'.$det['pent'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cpent'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td colspan="3">'.$det['prec'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cprec'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"><strong>OBSERVACIONES:</strong></td>
            <td colspan="10">'.$det['observ'].'</td>
        </tr>
        <tr class="sep">
            <td colspan="14"> </td>
        </tr>        
        <tr>
            <td colspan="4"><strong>FECHA DEVOLUCION:</strong></td>
            <td colspan="10">'.$det['fecdev'].'</td>
        </tr>
        <tr class="sep">
            <td colspan="14"> </td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td colspan="3">'.$det['pentd'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cpentd'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td colspan="3">'.$det['precd'].'</td>
            <td colspan="1"><strong>CARGO:</strong></td>
            <td colspan="3">'.$det['cprecd'].'</td>
            <td colspan="1"><strong>FIRMA:</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"><strong>OBSERVACIONES:</strong></td>
            <td colspan="10">'.$det['observd'].'</td>
        </tr>
        <tr class="sep">
            <td colspan="14"> </td>
        </tr>
        <tr>
            <td class="pie" colspan="14">
                <p><strong>NOTA:</strong> A partir de la fecha en la que se le haya asignado el (los) equipo (s), tarjetas, accesorios y demás elementos para la correcta ejecución de sus funciones y responsabilidades, usted es responsable por el buen estado y funcionamiento del (los) equipo (s), tarjetas, accesorios y demás elementos suministrados.<br>
                Está prohibido la descarga e instalación de software y aplicativos que puedan perjudicar el equipo y que no sean necesarias para la realización de sus funciones, si es necesario debe comunicarse con el área soporte IT.<br>
                En caso de daño o pérdida es su deber comunicarlo por escrito o por correo al departamento administrativo y a su jefe inmediato, si se comprueba un uso inadecuado, usted asumirá la reposición y/o reparación correspondiente.<br>
                En el momento de retirarse de GALQUI SAS o traslado a otro cargo, deberá devolver el equipo junto con los implementos entregados al departamento administrativo o a su jefe inmediato dejando constancia a través del formato GAL-RH-FR-39.</p>
            </td>
        </tr>
    </tbody>
</table>';

// if($pdf==123456){
//     $dompdf = new Dompdf();
//     $paper_size = array(0,0,612,792);
    
//     $dompdf->loadHtml($html);
//     $dompdf->setPaper($paper_size);
//     $dompdf->setPaper('Letter', 'landscape');
//     $dompdf->render();
//     $dompdf->stream("Factura No._".$idfac.".pdf");
// }else{
    echo $html;
    echo "<script type='text/javascript'>window.print();</script>";
// }
?>