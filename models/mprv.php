<?php
class Mprv
{
    private $idprv;
    private $idvtpd;
    private $ndprv;
    private $nomprv;

    public function getIdprv(){
        return $this->idprv;
    }
    public function getIdvtpd(){
        return $this->idvtpd;
    }
    public function getNdprv(){
        return $this->ndprv;
    }
    public function getNomprv(){
        return $this->nomprv;
    }

    public function setIdprv($idprv){
        $this->idprv = $idprv;
    }
    public function setIdvtpd($idvtpd){
        $this->idvtpd = $idvtpd;
    }
    public function setNdprv($ndprv){
        $this->ndprv = $ndprv;
    }
    public function setNomprv($nomprv){
        $this->nomprv = $nomprv;
    }


    function getAll(){
        $sql = "SELECT p.idprv, p.idvtpd, vt.nomval AS tdoc, p.ndprv, p.nomprv FROM proveedor AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $sql = "SELECT p.idprv, p.idvtpd, vt.nomval AS tdoc, p.ndprv, p.nomprv FROM proveedor AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval WHERE p.idprv=:idprv";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idprv = $this->getIdprv();
        $result->bindParam(":idprv", $idprv);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save(){
        try {
            $sql = "INSERT INTO proveedor (idvtpd, ndprv, nomprv) VALUES (:idvtpd, :ndprv, :nomprv)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idvtpd = $this->getIdvtpd();
            $result->bindParam(":idvtpd", $idvtpd);
            $ndprv = $this->getNdprv();
            $result->bindParam(":ndprv", $ndprv);
            $nomprv = $this->getNomprv();
            $result->bindParam(":nomprv", $nomprv);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function edit(){
        $sql = "UPDATE proveedor SET idvtpd=:idvtpd, ndprv=:ndprv, nomprv=:nomprv WHERE idprv=:idprv";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idprv = $this->getIdprv();
        $result->bindParam(":idprv", $idprv);
        $idvtpd = $this->getIdvtpd();
        $result->bindParam(":idvtpd", $idvtpd);
        $ndprv = $this->getNdprv();
        $result->bindParam(":ndprv", $ndprv);
        $nomprv = $this->getNomprv();
        $result->bindParam(":nomprv", $nomprv);
        $result->execute();
    }

    function del(){
        try {
            $sql = "DELETE FROM proveedor WHERE idprv=:idprv";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprv = $this->getIdprv();
            $result->bindParam(":idprv", $idprv);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function getAllDom($iddom)
    {
        $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":iddom", $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getPxL($idprv){
        $sql ="SELECT COUNT(idprv) AS can FROM licencia WHERE idprv=:idprv";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idprv",$idprv);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

}
?>