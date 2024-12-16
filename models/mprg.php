<?php
class Mprg
{
    private $idprg;
    private $nomprg;

    public function getIdprg(){
        return $this->idprg;
    }
    public function getNomprg(){
        return $this->nomprg;
    }

    public function setIdprg($idprg){
        $this->idprg = $idprg;
    }
    public function setNomprg($nomprg){
        $this->nomprg = $nomprg;
    }


    function getAll(){
        $sql = "SELECT idprg, nomprg FROM programa";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $sql = "SELECT idprg, nomprg FROM programa WHERE idprg=:idprg";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idprg = $this->getIdprg();
        $result->bindParam(":idprg", $idprg);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save(){
        try {
            $sql = "INSERT INTO programa (nomprg) VALUES (:nomprg)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomprg = $this->getNomprg();
            $result->bindParam(":nomprg", $nomprg);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function edit(){
        $sql = "UPDATE programa SET nomprg=:nomprg WHERE idprg=:idprg";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idprg = $this->getIdprg();
        $result->bindParam(":idprg", $idprg);
        $nomprg = $this->getNomprg();
        $result->bindParam(":nomprg", $nomprg);
        $result->execute();
    }

    function del(){
        try {
            $sql = "DELETE FROM programa WHERE idprg=:idprg";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprg = $this->getIdprg();
            $result->bindParam(":idprg", $idprg);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function getLxP($idprg){
        $sql ="SELECT COUNT(idprg) AS can FROM licencia WHERE idprg=:idprg";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idprg",$idprg);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

}
?>