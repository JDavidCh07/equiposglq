<?php
require_once ('models/mval.php');
include('models/mdom.php');

$mval = new Mval();
$mdom = new Mdom();

$idval = isset($_REQUEST['idval']) ? $_REQUEST['idval']:NULL;
$codval = isset($_POST['codval']) ? $_POST['codval']:NULL;
$iddom = isset($_REQUEST['iddom']) ? $_REQUEST['iddom']:NULL;

$nomval = isset($_POST['nomval']) ? $_POST['nomval']:NULL;
$actval = isset($_REQUEST['actval']) ? $_REQUEST['actval']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;
$pg=7;

$mval->setIdval($idval);

if($ope=="save"){
    $mval->setCodval($codval);
    $mval->setIddom($iddom);
    $mval->setNomval($nomval);
    $mval->setActval($actval);
    if(!$idval) $mval->save();
    else $mval->edit();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if($ope=="act" && $idval && $actval){
    $mval->setActval($actval);
    $mval->editAct();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if($ope=="edi" && $idval) $datOne = $mval->getOne();
if($ope=="eli" && $idval){
    $mval->del();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

$datALL = $mval-> getALL();
$datDom = $mdom-> getALL();

$obtOne= $mval->getOne();
?>
