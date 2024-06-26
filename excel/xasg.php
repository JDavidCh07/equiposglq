<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/masg.php');
require_once ('../models/mequ.php');

$masg = new Masg();
$mequ = new Mequ();

$asg = isset($_REQUEST['asg']) ? $_REQUEST['asg']:NULL;


if($asg=="equ"){
    $datAllA = $masg->getAllAsig(52);
    $datAcc = $masg->getAllAcc(3);
}else if($asg=="cel"){
    $datAllA = $masg->getAllAsig(54);
    $datAcc = $masg->getAllAcc(5);
}

$msj = '';
$msj .= '<table>';
    $msj .= '<thead>';
        $msj .= '<tr>';
            $msj .= '<th colspan="4">DATOS DEL TRABAJADOR</th>';
            $msj .= '<th colspan="'; 
                if($asg=="equ") $msj .= '7';
                else $msj .= '5';
            $msj .= '">DATOS DEL EQUIPO</th>';
            $msj .= '<th colspan="'; 
                if($asg=="equ") $msj .= '5';
                else $msj .= '7';
            $msj .= '">ACCESORIOS</th>';
            $msj .= '<th colspan="6">ENTREGA</th>';
            $msj .= '<th colspan="6">DEVOLUCION</th>';
        $msj .= '</tr>';
    $msj .= '</thead>';
    $msj .= '<tbody>';
        $msj .= '<tr>';
            $msj .= '<td>CEDULA</td>';
            $msj .= '<td>NOMBRE</td>';
            $msj .= '<td>CARGO</td>';
            $msj .= '<td>CORREO</td>';
                if($asg=="equ") $msj .= '<td>TIPO</td>';
            $msj .= '<td>MARCA</td>';
            $msj .= '<td>MODELO</td>';
            $msj .= '<td>';
                if($asg=="equ") $msj .= 'SERIAL';
                else $msj .= 'SERIAL';
            $msj .= '</td>';
            if($asg=="equ"){
                $msj .= '<td>RED</td>';
                $msj .= '<td>OFFICE</td>';
                $msj .= '<td>WINDOWS</td>';
            } else if($asg=="cel"){
                $msj .= '<td>NUMERO</td>';
                $msj .= '<td>OPERADOR</td>';
            } if($datAcc){ foreach($datAcc AS $dtac){
                $msj .= '<td>'.$dtac["nomval"].'</td>';
            }}
            $msj .= '<td>FECHA ENTREGA</td>';
            $msj .= '<td>NOMBRE ENTREGA</td>';
            $msj .= '<td>CARGO</td>';
            $msj .= '<td>NOMBRE RECIBE</td>';
            $msj .= '<td>CARGO</td>';
            $msj .= '<td>OBSERVACIONES</td>';
            $msj .= '<td>FECHA DEVOLUCION</td>';
            $msj .= '<td>NOMBRE ENTREGA</td>';
            $msj .= '<td>CARGO</td>';
            $msj .= '<td>NOMBRE RECIBE</td>';
            $msj .= '<td>CARGO</td>';
            $msj .= '<td>OBSERVACIONES</td>';
        $msj .= '</tr>';
        if($datAllA){ foreach($datAllA as $dta){
            $msj .= '<tr>';
                $msj .= '<td>'.$dta["dprec"].'</td>';
                $msj .= '<td>'.$dta["prec"].'</td>';
                $msj .= '<td>'.$dta["cprec"].'</td>';
                $msj .= '<td>'.$dta["eprec"].'</td>';
                if($asg=="equ") $msj .= '<td>'.$dta["tpe"].'</td>';
                $msj .= '<td>'.$dta["marca"].'</td>';
                $msj .= '<td>'.$dta["modelo"].'</td>';
                $msj .= '<td>'.$dta["serialeq"].'</td>';
                if($asg=="equ"){
                    $msj .= '<td>'.$dta["nomred"].'</td>';
                    $mequ->setIdequ($dta["idequ"]);
                    $prgs = $mequ->getOnePxE();
                    if($prgs){ foreach($prgs AS $pr){
                        $msj .= '<td>'.$pr['nomdom'].' '.$pr['nomval'].' '.$pr['verprg'].'</td>';
                    }}
                } else if($asg=="cel"){
                    $msj .= '<td>'.$dta["numcel"].'</td>';
                    $msj .= '<td>'.$dta["operador"].'</td>';
                } 
                $datAxE = $masg->getAllAxE($dta["ideqxpr"]);
                if($datAcc){ foreach($datAcc as $dac){
                    if ($datAxE){ foreach($datAxE as $dae){ 
                        if($dac['idval'] == $dae['idvacc']) $msj .= '<td>X</td>';
                }}}}
                $msj .= '<td>'.$dta["fecent"].'</td>';
                $msj .= '<td>'.$dta["pent"].'</td>';
                $msj .= '<td>'.$dta["cpent"].'</td>';
                $msj .= '<td>'.$dta["prec"].'</td>';
                $msj .= '<td>'.$dta["cprec"].'</td>';
                $msj .= '<td>'.$dta["observ"].'</td>';
                $msj .= '<td>'.$dta["fecdev"].'</td>';
                $msj .= '<td>'.$dta["pentd"].'</td>';
                $msj .= '<td>'.$dta["cpentd"].'</td>';
                $msj .= '<td>'.$dta["precd"].'</td>';
                $msj .= '<td>'.$dta["cprecd"].'</td>';
                $msj .= '<td>'.$dta["observd"].'</td>';
            $msj .= '</tr>';
        }}
    $msj .= '</tbody>';
$msj .= '</table>';

var_dump($msj);
?>