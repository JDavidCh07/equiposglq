<?php
require_once 'models/mmod.php';

$mmod = new Mmod();

$idmod = isset($_POST['idmod']) ? $_POST['idmod']:NULL;
$idper = isset($_SESSION["idper"]) ? $_SESSION["idper"]:NULL;
// $nompef = isset($_POST['nompef']) ? $_POST['nompef']:NULL;
// $idpef = isset($_POST['idpef']) ? $_POST['idpef']:NULL;
// $pg = isset($_POST['pg']) ? $_POST['pg']:NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

if($ope=="dircc" AND $idper AND $idmod){
	$mmod->setIdmod($idmod);
	$datPfPrMd = $mmod->getOnePfPrMd();
	if($datPfPrMd){
		$_SESSION["idpef"] = $datPfPrMd[0]['idpef'];
		$_SESSION["nompef"] = $datPfPrMd[0]['nompef'];
		echo '<script>window.location=\'home.php?pg='.$datPfPrMd[0]['idpag'].'\';</script>';
	}
}

$datAll = $mmod->getAllAct();
$datPfPr = $mmod->getOnePfPr();

?>