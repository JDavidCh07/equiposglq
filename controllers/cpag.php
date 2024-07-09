<?php 
include ('models/mpag.php');
 $mpag = new Mpag();


$idpag = isset($_REQUEST['idpag']) ? $_REQUEST['idpag']:NULL;
$icono = isset($_POST['icono']) ? $_POST['icono']:NULL;
$nompag = isset($_POST['nompag']) ? $_POST['nompag']:NULL;
$arcpag = isset($_REQUEST['arcpag']) ? $_REQUEST['arcpag']:NULL;
$ordpag = isset($_POST['ordpag']) ? $_POST['ordpag']:NULL;
$menpag = isset($_POST['menpag']) ? $_POST['menpag']:NULL;
$mospag = isset($_REQUEST['mospag']) ? $_REQUEST['mospag']:NULL;
$idmod = isset($_REQUEST['idmod']) ? $_REQUEST['idmod']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mpag->setIdpag($idpag);
if($ope=="save"){
	$mpag->setIcono($icono);
	$mpag->setNompag($nompag);
	$mpag->setArcpag($arcpag);
	$mpag->setOrdpag($ordpag);
    $mpag->setMenpag($menpag);
	$mpag->setMospag($mospag);
	$mpag->setIdmod($idmod);
    if(!$idpag) $mpag->save();
	else $mpag->edit();
	echo "<script>window.location='home.php?pg=".$pg."';</script>";
}


if($ope=="act" && $idpag && $mospag){
	$mpag->setMospag($mospag);
	$mpag->editAct();
}

if($ope=="eli" && $idpag)$mpag->del();
if($ope=="edi" && $idpag)$datOne = $mpag->getOne();

$datAll = $mpag->getAll();
$datAllm = $mpag->getAllM();


?>