<?php
    require_once ("models/seguridad.php");
    require_once ('models/conexion.php');
    require_once ('models/masg.php');
    require_once ('models/mprm.php');

    $mprm = new Mprm();

    $id = isset($_REQUEST['id']) ? $_REQUEST['id']:NULL;
    $arc = isset($_REQUEST['arc']) ? $_REQUEST['arc']:NULL;

    $mprm->setIdprm($id);
    if($arc){
        $dt = $mprm->getPdf($arc);
        $rut = $dt[0]['rut'];
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($rut) . '"');

        readfile($rut);
    }
?>  