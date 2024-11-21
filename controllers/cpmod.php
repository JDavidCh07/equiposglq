<?php
require_once 'models/mmod.php';

$mmod = new Mmod();

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$idper = isset($_SESSION["idper"]) ? $_SESSION["idper"]:NULL;

if($ope=="dircc"){
    $idmod = isset($_POST['idmod']) ? $_POST['idmod']:NULL;
    $idpef = isset($_POST['idpef']) ? $_POST['idpef']:NULL;
}elseif($ope=="cg"){
    $idmod = 1;
    $idpef = 3;  
}

$mosmdl = false;
$datPfPrMd = NULL;

if ($ope && $idper && $idmod) {
    $mmod->setIdmod($idmod);
	$mmod->setIdpef($idpef);
    $datPfPrMd = $mmod->getOnePfPrMd();
    if (count($datPfPrMd) > 1) $mosmdl = true;
	elseif ($datPfPrMd) {
        $_SESSION["idpef"] = $datPfPrMd[0]['idpef'];
        $_SESSION["nompef"] = $datPfPrMd[0]['nompef'];
        $_SESSION["idmod"] = $idmod;
        echo '<script>window.location=\'home.php?pg='.$datPfPrMd[0]['idpag'].'\';</script>';
    }
}

$datAll = $mmod->getAllAct();
$datPfPr = $mmod->getOnePfPr();
?>