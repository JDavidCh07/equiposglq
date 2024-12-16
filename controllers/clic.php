<?php
require_once 'models/mlic.php';

$mlic = new Mlic();

$idlic = isset($_REQUEST['idlic']) ? $_REQUEST['idlic'] : NULL;
$nomlic = isset($_POST['nomlic']) ? $_POST['nomlic'] : NULL;
$idvtlic = isset($_POST['idvtlic']) ? $_POST['idvtlic'] : NULL;
$feccom = isset($_POST['feccom']) ? $_POST['feccom']:NULL;
$fecven = isset($_POST['fecven']) ? $_POST['fecven']:NULL;
$costo = isset($_POST['costo']) ? $_POST['costo'] : NULL;
$clvlic = isset($_POST['clvlic']) ? $_POST['clvlic'] : NULL;
$actlic = isset($_REQUEST['actlic']) ? $_REQUEST['actlic'] : 1;
$idprv = isset($_POST['idprv']) ? $_POST['idprv'] : NULL;
$idprg = isset($_POST['idprg']) ? $_POST['idprg'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$pg = 56;

$datOne = NULL;

$mlic->setIdlic($idlic);

if ($ope == "save") {
    $mlic->setNomlic($nomlic);
    $mlic->setIdvtlic($idvtlic);
    $mlic->setFeccom($feccom);
    $mlic->setFecven($fecven);
    $mlic->setCosto($costo);
    $mlic->setClvlic($clvlic);
    $mlic->setActlic($actlic);
    $mlic->setIdprv($idprv);
    $mlic->setIdprg($idprg);
    if (!$idlic) $mlic->save();
    else{
        $mlic->edit();
    }
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if($ope=="act" && $idlic && $actlic){
    $mlic->setActlic($actlic);
    $mlic->editAct();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if ($ope == "edi" && $idlic) $datOne = $mlic->getOne();
if ($ope == "eli" && $idlic){
    $mlic->del();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

$datAll = $mlic->getAll();
$datPrv = $mlic->getAllPrv();
$datPrg = $mlic->getAllPrg();
$datPer = $mlic->getAllPer();
$datTpl = $mlic->getAllDom(6);
?>