<?php
require_once 'models/mprg.php';

$mprg = new Mprg();

$idprg = isset($_REQUEST['idprg']) ? $_REQUEST['idprg'] : NULL;
$nomprg = isset($_POST['nomprg']) ? $_POST['nomprg'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$pg = 55;

$datOne = NULL;

$mprg->setIdprg($idprg);


if ($ope == "save") {
    $mprg->setNomprg($nomprg);
    if (!$idprg) $mprg->save();
    else $mprg->edit();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if ($ope == "edi" && $idprg) $datOne = $mprg->getOne();

if ($ope == "eli" && $idprg){
    $mprg->del();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

$datAll = $mprg->getAll();
?>