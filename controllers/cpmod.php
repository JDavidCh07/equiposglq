<?php
require_once 'models/mmod.php';

$mmod = new Mmod();

$idmod = isset($_POST['idmod']) ? $_POST['idmod']:NULL;
$idper = isset($_SESSION["idper"]) ? $_SESSION["idper"]:NULL;
$idpef = isset($_POST['idpef']) ? $_POST['idpef']:NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

$mosmdl = false;
$datPfPrMd = NULL;

if ($ope == "dircc" && $idper && $idmod) {
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