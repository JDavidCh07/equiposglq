<?php
require_once ('models/mmen.php');

$mmen = new Mmen();
$dat = $mmen->getMen();

function validar($idpag){
	$mmen = new Mmen();
	$mmen->setIdpag($idpag);
	$dat = $mmen->getVal();
	return $dat;
}
?>