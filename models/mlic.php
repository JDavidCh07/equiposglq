<?php
class Mlic
{
    //------------Licencia-----------
    
    private $idlic;
    private $nomlic;
    private $idvtlic;
    private $feccom;
    private $fecven;
    private $costo;
    private $clvlic;
    private $actlic;
    private $idprv;
    private $idprg;

    //------------Licencia-----------

    public function getIdlic(){
        return $this->idlic;
    }
    public function getNomlic(){
        return $this->nomlic;
    }
    public function getIdvtlic(){
        return $this->idvtlic;
    }
    public function getFeccom(){
        return $this->feccom;
    }
    public function getFecven(){
        return $this->fecven;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getClvlic(){
        return $this->clvlic;
    }
    public function getActlic(){
        return $this->actlic;
    }
    public function getIdprv(){
        return $this->idprv;
    }
    public function getIdprg(){
        return $this->idprg;
    }

    
    //------------Licencia-----------

    public function setIdlic($idlic){
        $this->idlic = $idlic;
    }
    public function setNomlic($nomlic){
        $this->nomlic = $nomlic;
    }
    public function setIdvtlic($idvtlic){
        $this->idvtlic = $idvtlic;
    }
    public function setFeccom($feccom){
        $this->feccom = $feccom;
    }
    public function setFecven($fecven){
        $this->fecven = $fecven;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function setClvlic($clvlic){
        $this->clvlic = $clvlic;
    }
    public function setActlic($actlic){
        $this->actlic = $actlic;
    }
    public function setIdprv($idprv){
        $this->idprv = $idprv;
    }
    public function setIdprg($idprg){
        $this->idprg = $idprg;
    }

    //------------Licencia-----------

    function getAll(){
        $sql = "SELECT l.idlic, l.nomlic, l.idvtlic, vt.nomval AS nomtip, l.feccom, l.fecven, l.costo, l.clvlic, l.actlic, l.idprv, pr.nomprv AS nomprv, l.idprg, pg.nomprg AS nomprg, lp.idper, lp.fecent, p.nomper, p.apeper FROM licencia AS l INNER JOIN valor AS vt ON l.idvtlic=vt.idval INNER JOIN proveedor AS pr ON l.idprv=pr.idprv INNER JOIN programa AS pg ON l.idprg=pg.idprg LEFT JOIN licxper AS lp ON l.idlic=lp.idlic LEFT JOIN persona AS p ON lp.idper=p.idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
    function getOne(){
        $sql = "SELECT l.idlic, l.nomlic, l.idvtlic, vt.nomval AS nomtip, l.feccom, l.fecven, l.costo, l.clvlic, l.actlic, l.idprv, pr.nomprv AS nomprv, l.idprg, pg.nomprg AS nomprg, lp.idper, lp.fecent, p.nomper, p.apeper FROM licencia AS l INNER JOIN valor AS vt ON l.idvtlic=vt.idval INNER JOIN proveedor AS pr ON l.idprv=pr.idprv INNER JOIN programa AS pg ON l.idprg=pg.idprg LEFT JOIN licxper AS lp ON l.idlic=lp.idlic LEFT JOIN persona AS p ON lp.idper=p.idper WHERE l.idlic=:idlic";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idlic = $this->getIdlic();
        $result->bindParam(":idlic", $idlic);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save(){
        try {
            $sql = "INSERT INTO licencia (nomlic, idvtlic, feccom, fecven, costo, clvlic, actlic, idprv, idprg) VALUES (:nomlic, :idvtlic, :feccom, :fecven, :costo, :clvlic, :actlic, :idprv, :idprg)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomlic = $this->getNomlic();
            $result->bindParam(":nomlic", $nomlic);
            $idvtlic = $this->getIdvtlic();
            $result->bindParam(":idvtlic", $idvtlic);
            $feccom = $this->getFeccom();
            $result->bindParam(":feccom", $feccom);
            $fecven = $this->getFecven();
            $result->bindParam(":fecven", $fecven);
            $costo = $this->getCosto();
            $result->bindParam(":costo", $costo);
            $clvlic = $this->getClvlic();
            $result->bindParam(":clvlic", $clvlic);
            $actlic = $this->getActlic();
            $result->bindParam(":actlic", $actlic);
            $idprv = $this->getIdprv();
            $result->bindParam(":idprv", $idprv);
            $idprg = $this->getIdprg();
            $result->bindParam(":idprg", $idprg);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function editAct(){
        try{
            $sql = "UPDATE licencia SET actlic=:actlic WHERE idlic=:idlic";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idlic = $this->getIdlic();
            $result->bindParam(":idlic", $idlic);
            $actlic = $this->getActlic();
            $result->bindParam(":actlic", $actlic);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }


    function edit(){
        $sql = "UPDATE licencia SET nomlic=:nomlic, idvtlic=:idvtlic, feccom=:feccom, fecven=:fecven, costo=:costo, clvlic=:clvlic, idprv=:idprv, idprg=:idprg WHERE idlic=:idlic";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idlic = $this->getIdlic();
        $result->bindParam(":idlic", $idlic);
        $nomlic = $this->getNomlic();
        $result->bindParam(":nomlic", $nomlic);
        $idvtlic = $this->getIdvtlic();
        $result->bindParam(":idvtlic", $idvtlic);
        $feccom = $this->getFeccom();
        $result->bindParam(":feccom", $feccom);
        $fecven = $this->getFecven();
        $result->bindParam(":fecven", $fecven);
        $costo = $this->getCosto();
        $result->bindParam(":costo", $costo);
        $clvlic = $this->getClvlic();
        $result->bindParam(":clvlic", $clvlic);
        $idprv = $this->getIdprv();
        $result->bindParam(":idprv", $idprv);
        $idprg = $this->getIdprg();
        $result->bindParam(":idprg", $idprg);
        $result->execute();
    }

    function del(){
        try {
            $sql = "DELETE FROM licencia WHERE idlic=:idlic";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idlic = $this->getIdlic();
            $result->bindParam(":idlic", $idlic);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    //------------Traer valores-----------

    function getAllPrv(){
        $sql = "SELECT p.idprv, p.nomprv FROM proveedor AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval ORDER BY nomprv";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getAllPrg(){
        $sql = "SELECT idprg, nomprg FROM programa ORDER BY nomprg";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getAllPer(){
        $sql = "SELECT idper, nomper, apeper FROM persona WHERE actper=1 ORDER BY apeper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getAllDom($iddom){
        $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":iddom", $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getLxP($idlic){
        $sql ="SELECT COUNT(idlic) AS can FROM licxper WHERE idlic=:idlic";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idlic", $idlic);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

}
?>