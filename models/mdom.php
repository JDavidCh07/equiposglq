<?php
class Mdom
{
    public $iddom;
    public $nomdom;

    function getIddom(){
        return $this->iddom;
    }
    function getNomdom(){
        return $this->nomdom;
    }

    function setIddom($iddom){
        $this->iddom = $iddom;
    }
    function setNomdom($nomdom){
        $this->nomdom = $nomdom;
    }


    function getAll(){
        $sql = "SELECT iddom, nomdom FROM dominio";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql = "SELECT iddom, nomdom FROM dominio WHERE iddom=:iddom";
        $result = $conexion->prepare($sql);
        $iddom = $this->getIddom();
        $result->bindParam(":iddom", $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save(){
        try {
            $sql = "INSERT INTO dominio (nomdom) VALUES (:nomdom)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomdom = $this->getNomdom();
            $result->bindParam(":nomdom", $nomdom);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function edit(){
        $sql = "UPDATE dominio SET nomdom=:nomdom WHERE iddom=:iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $iddom = $this->getIddom();
        $result->bindParam(":iddom", $iddom);
        $nomdom = $this->getNomdom();
        $result->bindParam(":nomdom", $nomdom);
        $result->execute();
    }

    function del(){
        try {
            $sql = "DELETE FROM dominio WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $iddom = $this->getIddom();
            $result->bindParam(":iddom", $iddom);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function getVxD($iddom){
        $sql ="SELECT COUNT(iddom) AS can FROM valor WHERE iddom=:iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":iddom",$iddom);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

}
?>