<?php
require_once ('conexion.php');
$username = isset($_POST['username']) ? $_POST['username']:NULL;
$password = isset($_POST['password']) ? $_POST['password']:NULL;
if($username && $password){
	validar($username, $password);
}else{
	echo "<script>window.location.href = '../index.php';</script>";
}

function validar($usu,$pas){
	$res = valdat($usu,$pas);
	$res = isset($res) ? $res:NULL;	
	if($res){
		session_start();		
		$_SESSION["idper"] = $res[0]['idper'];
		$_SESSION["nomper"] = $res[0]['nomper'];
		$_SESSION["apeper"] = $res[0]['apeper'];
		$_SESSION["ndper"] = $res[0]['ndper'];
		$_SESSION["emaper"] = $res[0]['emaper'];
		$_SESSION["cargo"] = $res[0]['cargo'];
		$_SESSION["idpef"] = NULL;
		$_SESSION["nompef"] = "Prueba";
		$_SESSION["aut"] = "";
		$_SESSION["aut"] = "ht92Ic37=glQiCo@Q2!?";
		echo "<script>window.location.href = '../views/carga.php';</script>";
	}else{
		echo "<script>window.location.href = '../index.php?err=s';</script>";
	}
}

function valdat($usu,$pas){
	$res = NULL;
	$pas = sha1(md5($pas))."sGlaqs2%";	
	$sql = "SELECT idper, nomper, apeper, ndper, emaper, cargo, actper FROM persona WHERE (emaper=:user OR ndper=:user) AND pasper=:pasper AND actper=1";
	$modelo = new conexion();
	$conexion = $modelo->get_conexion();
	$result = $conexion->prepare($sql);
	$result->bindParam(':user',$usu);
	$result->bindParam(':pasper',$pas);
	$result->execute();
	$res = $result->fetchall(PDO::FETCH_ASSOC);
	return $res;
}
?>