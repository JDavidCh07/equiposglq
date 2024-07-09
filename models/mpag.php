<?php

class Mpag
{

    private $idpag;
    private $icono;
    private $nompag;
    private $arcpag;
    private $ordpag;
    private $menpag;
    private $mospag;
    private $idmod;
  
    //-------------------------------GET---------------------------//
    public function getIdpag(){
        return $this->idpag;
    }
    public function getIcono(){
        return $this->icono;
    }
    public function getNompag(){
        return $this->nompag;
    }
    public function getArcpag(){
        return $this->arcpag;
    }
  
    public function getOrdpag(){
        return $this->ordpag;
    }

    public function getMenpag(){
        return $this->menpag;
    }
    public function getMospag(){
        return $this->mospag;
    }
    public function getIdmod(){
        return $this->idmod;
    }
 
 //-------------------------------FIN-GET---------------------------//

    //-------------------------------SET---------------------------//
    public function setIdpag($idpag){
        $this->idpag = $idpag;
    }
    public function setIcono($icono){
        $this->icono = $icono;
    }
    public function setNompag($nompag){
        $this->nompag = $nompag;
    }
    public function setArcpag($arcpag){
        $this->arcpag = $arcpag;
    }
  
    public function setOrdpag($ordpag){
        $this->ordpag = $ordpag;
    }

    public function setMenpag($menpag){
        $this->menpag = $menpag;
    }
    public function setMospag($mospag){
        $this->mospag = $mospag;
    }
    public function setIdmod($idmod){
        $this->idmod = $idmod;
    }
   
 //-------------------------------FIN-SET---------------------------//


 //a--------------------------------CRUD------------------------------//
    function getAll(){
    try{
        $sql = "SELECT p.idpag, p.icono, p.nompag, p.arcpag, p.ordpag, p.menpag, p.mospag, p.idmod, m.nommod FROM pagina AS p INNER JOIN modulo AS m ON p.idmod=m.idmod";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
    }catch(Exception $e){
        ManejoError($e);
    }
    return $res;
}

function getAllM(){
    $sql = "SELECT idmod, nommod, imgmod, actmod, idpag FROM modulo";
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->execute();
    $res = $result->fetchall(PDO::FETCH_ASSOC);
    return $res;
}

    function getOne(){
        try{
            $sql = "SELECT p.idpag, p.icono, p.nompag, p.arcpag, p.ordpag, p.menpag, p.mospag, p.idmod, m.nommod FROM pagina AS p INNER JOIN modulo AS m ON p.idmod=m.idmod WHERE p.idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result-> bindParam(":idpag",$idpag);
            $result-> execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            ManejoError($e);
        }
    }

    function getMDxPG($idpag){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idpag) AS can FROM modulo WHERE idpag=:idpag";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idpag',$idpag);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    function getPFxPG($idpag){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idpef) AS can FROM perfil WHERE idpag=:idpag";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idpag',$idpag);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    function getPPxPG($idpag){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idpag) AS can FROM pagxpef WHERE idpag=:idpag";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idpag',$idpag);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
    function save(){
        try{
            $sql = "INSERT INTO pagina(icono, nompag,arcpag, ordpag, menpag, mospag, idmod) VALUES(:icono, :nompag,:arcpag, :ordpag,:menpag, :mospag, :idmod)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $icono = $this->getIcono();
            $result->bindParam(":icono",$icono);
            $nompag = $this->getNompag();
            $result->bindParam(":nompag",$nompag);                    
            $arcpag = $this->getArcpag();
            $result->bindParam(":arcpag",$arcpag);
            $ordpag = $this->getOrdpag();
            $result->bindParam(":ordpag",$ordpag);
            $menpag = $this->getMenpag();
            $result->bindParam(":menpag",$menpag);
            $mospag = $this->getMospag();
            $result->bindParam(":mospag",$mospag);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }

    function edit()
    {
        try{
            $sql = "UPDATE pagina SET idpag=:idpag, icono=:icono, nompag=:nompag, arcpag=:arcpag, ordpag=:ordpag, menpag=:menpag, mospag=:mospag,idmod=:idmod WHERE idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(":idpag",$idpag);
            $icono = $this->getIcono();
            $result->bindParam(":icono",$icono);
            $nompag = $this->getNompag();
            $result->bindParam(":nompag",$nompag);        
            $arcpag = $this->getArcpag();
            $result->bindParam(":arcpag",$arcpag);
            $ordpag = $this->getOrdpag();
            $result->bindParam(":ordpag",$ordpag);
            $menpag = $this->getMenpag();
            $result->bindParam(":menpag",$menpag);
            $mospag = $this->getMospag();
            $result->bindParam(":mospag",$mospag);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }

    function editAct(){
        try{
            $sql = "UPDATE pagina SET mospag = :mospag WHERE idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(":idpag",$idpag);
            $mospag = $this->getMospag();
            $result->bindParam(":mospag",$mospag);
            $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }

    function del()
    {
        try{
            $sql = "DELETE FROM pagina WHERE idpag = :idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag(); 
            $result->bindParam(":idpag", $idpag);
            $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
    }
}
