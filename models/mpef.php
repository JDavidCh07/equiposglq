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
        $sql = "SELECT p.idpef, p.nompef, p.idpag, g.nompag, p.idmod, m.nommod FROM perfil AS p LEFT JOIN pagina AS g ON p.idpag=g.idpag INNER JOIN modulo AS m ON p.idmod=m.idmod";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
	    return $res;
    }

    function getOne(){
        $sql = "SELECT p.idpef, p.nompef, p.idpag, p.idmod FROM perfil AS p INNER JOIN pagina AS g ON g.idpag = p.idpag INNER JOIN modulo AS m ON m.idmod = p.idmod WHERE p.idpef=:idpef";
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
            $sql = "INSERT INTO perfil(idmod, nompef, idpag) VALUES (:idmod, :nompef, :idpag)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nompef=$this->getNompef();
            $result->bindParam(":nompef", $nompef);
            $idpag=$this->getIdpag();
            $result->bindParam(":idpag", $idpag);
            $idmod=$this->getIdmod();
            $result->bindParam(":idmod", $idmod);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

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

    function edit(){
        try{
            $sql = "UPDATE perfil SET idpef=:idpef,nompef=:nompef, idmod=:idmod, idpag=:idpag WHERE  idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion(); 
            $result = $conexion->prepare($sql);
            $idpef=$this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $nompef=$this->getNompef();
            $result->bindParam(":nompef", $nompef);
            $idpag=$this->getIdpag();
            $result->bindParam(":idpag", $idpag);
            $idmod=$this->getIdmod();
            $result->bindParam(":idmod", $idmod);
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
        $sql = "SELECT idpag, nompag, icono FROM pagina WHERE idmod=$this->idmod";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getMod(){
        $sql = "SELECT idmod, nommod, imgmod, actmod, idpag FROM modulo";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    
    // function getGraphi(){
    //     try{
    //         $sql = "SELECT f.idpef, f.pefnom, COUNT(p.idper) as cn FROM perfil AS f LEFT JOIN pefxper AS p ON f.idpef=p.idpef GROUP BY f.idpef, f.pefnom ORDER BY COUNT(p.idper) DESC, f.pefnom";
    //         $modelo = new conexion();
    //         $conexion = $modelo->get_conexion();
    //         $result = $conexion->prepare($sql);
    //         $result->execute();
    //         $res = $result->fetchall(PDO::FETCH_ASSOC);
    //     }catch(Exception $e){
    //         ManejoError($e);
    //     }
    //     return $res;
    // }
    // function getALLGraf(){
    //     $sql = "SELECT pf.idpef, pf.pefnom, COUNT(pa.pagid) AS cn FROM perfil AS pf LEFT JOIN pagxpef AS pa ON pf.idpef = pa.idpef GROUP BY pf.idpef, pf.pefnom";
    //     $modelo = new conexion();
    //     $conexion = $modelo->get_conexion();
    //     $result = $conexion->prepare($sql);
    //     $result->execute();
    //     $res = $result->fetchall(PDO::FETCH_ASSOC);
    //     return $res;
    // }

}

?>
