<?php
class Mpef {
    //atributos
    private $idpef;
    private $nompef;
    private $idmod;
    private $idpag;

    function getIdpef(){return $this->idpef;}
    function getNompef(){return $this->nompef;}    
    // Metodos SET guardar el dato
    function getIdmod(){return $this->idmod;}    
    function getIdpag(){return $this->idpag;}    

    //--------------------set-------------------------------
    function setIdpef($idpef){$this->idpef = $idpef;}
    function setNompef($nompef){$this->nompef = $nompef;}
    function setIdmod($idmod){$this->idmod = $idmod;}
    function setIdpag($idpag){$this->idpag = $idpag;}

    function getAll(){
        $sql = "SELECT p.idpef, p.nompef FROM perfil AS p";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
	    return $res;
    }

    function getOne(){
        $sql = "SELECT p.idpef, p.nompef FROM perfil AS p WHERE p.idpef=:idpef";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idpef=$this->getIdpef();
        $result->bindParam(":idpef", $idpef);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
	    return $res;
    }


    function save(){
        try{
            $sql = "INSERT INTO perfil(nompef) VALUES (:nompef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nompef=$this->getNompef();
            $result->bindParam(":nompef", $nompef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function edit(){
        try{
            $sql = "UPDATE perfil SET nompef=:nompef WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion(); 
            $result = $conexion->prepare($sql);
            $idpef=$this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $nompef=$this->getNompef();
            $result->bindParam(":nompef", $nompef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function del(){
        try{
        $sql = "DELETE FROM perfil WHERE idpef=:idpef";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idpef=$this->getIdpef();
        $result->bindParam(":idpef", $idpef);
        $result->execute();
        }catch(Exception $e){
            ManejoError($e);
        }
    }

    //---------Pagxpef------------
    function savePxP(){
        try {
            $sql = "INSERT INTO pagxpef (idpag, idpef)VALUES (:idpag, :idpef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(":idpag", $idpag);
            $idpef = $this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delPXP(){
        try {
            $sql = "DELETE FROM pagxpef WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef(); 
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delPag($idmod){
        try {
            $sql = "DELETE pp FROM pagxpef AS pp INNER JOIN pagina AS p ON pp.idpag=p.idpag WHERE idpef=:idpef AND p.idmod NOT IN ($idmod)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef(); 
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function selPxP(){
        $res = NULL;
        $sql = "SELECT idpag FROM pagxpef WHERE idpef=:idpef";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idpef = $this->getIdpef();
        $result->bindParam(":idpef", $idpef);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    //---------Pefxmod------------
    function savePxM(){
        try {
            $sql = "INSERT INTO pefxmod (idmod, idpef, idpag) VALUES (:idmod, :idpef, :idpag)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod", $idmod);
            $idpef = $this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $idpag = $this->getIdpag();
            $result->bindParam(":idpag", $idpag);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delPxM(){
        try {
            $sql = "DELETE FROM pefxmod WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef(); 
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function getPxM(){
        $sql = "SELECT pm.idmod, pm.idpag, m.idmod, m.nommod FROM pefxmod AS pm INNER JOIN modulo AS m ON pm.idmod=m.idmod WHERE pm.idpef=:idpef";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idpef = $this->getIdpef();
        $result->bindParam(":idpef", $idpef);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    //---------Traer valores------------
    function getPag(){
        $sql = "SELECT idpag, nompag, icono FROM pagina";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
	    return $res;
    }

    function getPagMod(){
        $sql = "SELECT idpag, nompag, icono FROM pagina WHERE mospag=1 AND idmod=:idmod";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idmod = $this->getIdmod();
        $result->bindParam(":idmod", $idmod);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getMod(){
        $sql = "SELECT idmod, nommod, imgmod, actmod FROM modulo";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
}

?>
