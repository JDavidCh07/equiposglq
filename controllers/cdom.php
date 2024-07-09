<?php
require_once 'models/conexion.php';
require_once 'models/mdom.php';

$mdom = new Mdom();

$iddom = isset($_REQUEST['iddom']) ? $_REQUEST['iddom'] : NULL;
$nomdom = isset($_POST['nomdom']) ? $_POST['nomdom'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$pg = 6;

$datOne = NULL;

$mdom->setIddom($iddom);


if ($ope == "save") {
    $mdom->setNomdom($nomdom);
    if (!$nomdom) $mdom->save();
    else $mdom->save();
    echo "<script>window.location='home.php?pg=".$pg."';</script>";
}

if ($ope == "edi" && $iddom) $datOne = $mdom->getOne();
if ($ope == "eli" && $iddom) $mdom->del();

$datAll = $mdom->getAll();
?>