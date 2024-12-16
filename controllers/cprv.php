<?php
require_once 'models/mprv.php';

$mprv = new Mprv();

$idprv = isset($_REQUEST['idprv']) ? $_REQUEST['idprv'] : NULL;
$idvtpd = isset($_POST['idvtpd']) ? $_POST['idvtpd'] : NULL;
$ndprv = isset($_POST['ndprv']) ? $_POST['ndprv'] : NULL;
$nomprv = isset($_POST['nomprv']) ? $_POST['nomprv'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$pg = 57;

$datOne = NULL;

$mprv->setIdprv($idprv);


if ($ope == "save") {
    $mprv->setIdvtpd($idvtpd);
    $mprv->setNdprv($ndprv);
    $mprv->setNomprv($nomprv);
    if (!$idprv) $mprv->save();
    else $mprv->edit();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if ($ope == "edi" && $idprv) $datOne = $mprv->getOne();
if ($ope == "eli" && $idprv){
    $mprv->del();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

$datAll = $mprv->getAll();
$dattpd = $mprv->getAllDom(14);
?>