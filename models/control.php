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
	$res = valdat($usu);
	$res = isset($res) ? $res:NULL;	
	if($res){
		if(verificar($pas, $res[0]['salt'], $res[0]['hashl'])){
			session_start();		
			$_SESSION["idper"] = $res[0]['idper'];
			$_SESSION["nomper"] = $res[0]['nomper'];
			$_SESSION["apeper"] = $res[0]['apeper'];
			$_SESSION["ndper"] = $res[0]['ndper'];
			$_SESSION["emaper"] = $res[0]['emaper'];
			$_SESSION["cargo"] = $res[0]['cargo'];
			$_SESSION["new"] = $res[0]['feccam'];
			$_SESSION["aut"] = "";
			$_SESSION["aut"] = "ht92Ic37=glQiCo@Q2!?";
			echo "<script>window.location.href = '../views/carga.php';</script>";
		}else echo "<script>window.location.href = '../index.php?err=s';</script>";
	}else echo "<script>window.location.href = '../index.php?err=s';</script>";
}

function valdat($usu){
	$res = NULL;
	$sql = "SELECT idper, nomper, apeper, ndper, emaper, cargo, actper, hashl, salt, feccam FROM persona WHERE (emaper=:user OR ndper=:user) AND actper=1";
	$modelo = new conexion();
	$conexion = $modelo->get_conexion();
	$result = $conexion->prepare($sql);
	$result->bindParam(':user',$usu);
	$result->execute();
	$res = $result->fetchall(PDO::FETCH_ASSOC);
	return $res;
}

function verificar($pas, $salt, $hash) {
    $iterations = 10000; // Mismo número de iteraciones utilizado al registrar
    $length = 32; // Mismo tamaño de hash

    $comp = hash_pbkdf2("sha256", $pas, $salt, $iterations, $length);
    // Comparar el hash generado con el almacenado
    return hash_equals($comp, $hash); // Devuelve verdadero si coinciden
}
?>