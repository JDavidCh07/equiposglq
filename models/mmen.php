<?php
class Mmen{
//Atributos	
	private $idpag;
	private $idper;
	private $idmod;
// Metodos GET devuelven el dato
	function getIdpag(){
		return $this->idpag;
	}
	function getIdper(){
		return $this->idper;
	}
	function getIdmod(){
		return $this->idmod;
	}
// Metodos SET guardar el dato
	function setIdper($idper){
		$this->idper = $idper;
	}
	function setIdpag($idpag){
		$this->idpag = $idpag;
	}
	function setIdmod($idmod){
		$this->idmod = $idmod;
	}
	
	function getMen(){
		$sql = "SELECT p.idpag, p.nompag, p.arcpag, p.icono FROM pagina AS p INNER JOIN pagxpef AS f ON p.idpag=f.idpag WHERE p.mospag=1 AND f.idpef=:idpef AND p.idmod=:idmod ORDER BY p.ordpag;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idpef = $_SESSION['idpef'];
		$result->bindParam(':idpef', $idpef);
		$idmod = $_SESSION['idmod'];
		$result->bindParam(':idmod', $idmod);
		$result->execute();
		$res = $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

	public function getVal(){
		$sql = "SELECT p.idpag, p.nompag, p.arcpag, p.icono, p.mospag FROM pagina AS p INNER JOIN pagxpef AS f ON p.idpag=f.idpag WHERE p.idpag=:idpag AND f.idpef=:idpef";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idpag = $this->getIdpag();
		$result->bindParam(':idpag',$idpag);
		$idpef = $_SESSION['idpef'];
		$result->bindParam(':idpef', $idpef);
		$result->execute();
		$res = $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>