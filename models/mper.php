<?php
class Mper{   
    //------------Persona-----------
    private $idper;
    private $nomper;
    private $apeper;
    private $idvtpd;
    private $ndper;
    private $emaper;
    private $pasper;
    private $idvdpt;
    private $cargo;
    private $usured;
    private $actper;

    //------------Perfil-----------
    private $idpef;

    //------------Tarjeta-----------
    private $idtaj;
    private $numtajpar;
    private $numtajofi;
    private $idperent;
    private $idperrec;
    private $fecent;
    private $idperentd;
    private $idperrecd;
    private $fecdev;
    private $esttaj;



    //------------Persona-----------
    public function getIdper(){
        return $this->idper;
    }
    public function getNomper(){
        return $this->nomper;
    }
    public function getApeper(){
        return $this->apeper;
    }
    public function getIdvtpd(){
        return $this->idvtpd;
    }
    public function getNdper(){
        return $this->ndper;
    }
    public function getEmaper(){
        return $this->emaper;
    }
    public function getPasper(){
        return $this->pasper;
    }
    public function getIdvdpt(){
        return $this->idvdpt;
    }
    public function getCargo(){
        return $this->cargo;
    }
    public function getUsured(){
        return $this->usured;
    }
    public function getActper(){
        return $this->actper;
    }

    //------------Perfil-----------
    public function getIdpef(){
        return $this->idpef;
    }

    //------------Tarjeta-----------
    public function getIdtaj(){
        return $this->idtaj;
    }
    public function getNumtajpar(){
        return $this->numtajpar;
    }
    public function getNumtajofi(){
        return $this->numtajofi;
    }
    public function getIdperent(){
        return $this->idperent;
    }
    public function getIdperrec(){
        return $this->idperrec;
    }
    public function getFecent(){
        return $this->fecent;
    }
    public function getIdperentd(){
        return $this->idperentd;
    }
    public function getIdperrecd(){
        return $this->idperrecd;
    }
    public function getFecdev(){
        return $this->fecdev;
    }
    public function getEsttaj(){
        return $this->esttaj;
    }

    //------------Persona-----------
    public function setIdper($idper){
        $this->idper = $idper;
    }
    public function setNomper($nomper){
        $this->nomper = $nomper;
    }
    public function setApeper($apeper){
        $this->apeper = $apeper;
    }
    public function setIdvtpd($idvtpd){
        $this->idvtpd = $idvtpd;
    }
    public function setNdper($ndper){
        $this->ndper = $ndper;
    }
    public function setEmaper($emaper){
        $this->emaper = $emaper;
    }
    public function setPasper($pasper){
        $this->pasper = $pasper;
    }
    public function setIdvdpt($idvdpt){
        $this->idvdpt = $idvdpt;
    }
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }
    public function setUsured($usured){
        $this->usured = $usured;
    }
    public function setActper($actper){
        $this->actper = $actper;
    }

    //------------Perfil-----------
    public function setIdpef($idpef){
        $this->idpef = $idpef;
    }

    //------------Tarjeta-----------
    public function setIdtaj($idtaj){
        $this->idtaj=$idtaj;
    }
    public function setNumtajpar($numtajpar){
        $this->numtajpar=$numtajpar;
    }
    public function setNumtajofi($numtajofi){
        $this->numtajofi=$numtajofi;
    }
    public function setIdperent($idperent){
        $this->idperent=$idperent;
    }
    public function setIdperrec($idperrec){
        $this->idperrec=$idperrec;
    }
    public function setFecent($fecent){
        $this->fecent=$fecent;
    }
    public function setIdperentd($idperentd){
        $this->idperentd=$idperentd;
    }
    public function setIdperrecd($idperrecd){
        $this->idperrecd=$idperrecd;
    }
    public function setFecdev($fecdev){
        $this->fecdev=$fecdev;
    }
    public function setEsttaj($esttaj){
        $this->esttaj=$esttaj;
    }

    //------------Persona-----------
    function getAll()
    {
        $sql = "SELECT p.idper, p.nomper, p.apeper, p.idvtpd, p.ndper, p.emaper, p.pasper, p.idvdpt, p.cargo, p.usured, p.actper, pf.idpef, vt.nomval AS doc, vd.nomval AS dpt FROM persona AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval INNER JOIN valor AS vd ON p.idvdpt=vd.idval LEFT JOIN perxpef AS pf ON p.idper=pf.idper";
        if($_SESSION['idpef']==3) $sql .= " WHERE p.idper=:idper ";
        $sql .= " GROUP BY p.idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        if($_SESSION['idpef']==3){
            $idper = $_SESSION['idper'];
            $result->bindParam(":idper", $idper);
        }
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOne()
    {
        $sql = "SELECT p.idper, p.nomper, p.apeper, p.idvtpd, p.ndper, p.emaper, p.pasper, p.idvdpt, p.cargo, p.usured, p.actper, pf.idpef, vt.nomval AS doc, vd.nomval AS dpt FROM persona AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval INNER JOIN valor AS vd ON p.idvdpt=vd.idval LEFT JOIN perxpef AS pf ON p.idper=pf.idper WHERE p.idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save()
    {
        try {
            $sql = "INSERT INTO persona(nomper, apeper, idvtpd, ndper, emaper, idvdpt, cargo, usured, actper";
            if ($this->getPasper()) $sql .= ", pasper";
            $sql .= ") VALUES (:nomper, :apeper, :idvtpd, :ndper, :emaper, :idvdpt, :cargo, :usured, :actper";
            if ($this->getPasper()) $sql .= ", :pasper";
            $sql .= ")";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomper = $this->getNomper();
            $result->bindParam(":nomper", $nomper);
            $apeper = $this->getApeper();
            $result->bindParam(":apeper", $apeper);
            $idvtpd = $this->getIdvtpd();
            $result->bindParam(":idvtpd", $idvtpd);
            $ndper = $this->getNdper();
            $result->bindParam(":ndper", $ndper);
            $emaper = $this->getEmaper();
            $result->bindParam(":emaper", $emaper);
            $idvdpt = $this->getIdvdpt();
            $result->bindParam(":idvdpt", $idvdpt);
            $cargo = $this->getCargo();
            $result->bindParam(":cargo", $cargo);
            $usured = $this->getUsured();
            $result->bindParam(":usured", $usured);
            $actper = $this->getActper();
            $result->bindParam(":actper", $actper);
            if ($this->getPasper()) {
                $pasper = $this->getPasper();
                $pasper = sha1(md5($pasper)) . "sGlaqs2%";
                $result->bindParam(":pasper", $pasper);
            }
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function editAct()
    {
        try{
            $sql = "UPDATE persona SET actper=:actper WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $actper = $this->getActper();
            $result->bindParam(":actper", $actper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function edit(){
        try{
            $sql = "UPDATE persona SET nomper=:nomper, apeper=:apeper, idvtpd=:idvtpd, ndper=:ndper, emaper=:emaper, idvdpt=:idvdpt, cargo=:cargo, usured=:usured, actper=:actper";
            if ($this->getPasper()) $sql .= ", pasper=:pasper";
            $sql .= " WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $nomper = $this->getNomper();
            $result->bindParam(":nomper", $nomper);
            $apeper = $this->getApeper();
            $result->bindParam(":apeper", $apeper);
            $idvtpd = $this->getIdvtpd();
            $result->bindParam(":idvtpd", $idvtpd);
            $ndper = $this->getNdper();
            $result->bindParam(":ndper", $ndper);
            $emaper = $this->getEmaper();
            $result->bindParam(":emaper", $emaper);
            $idvdpt = $this->getIdvdpt();
            $result->bindParam(":idvdpt", $idvdpt);
            $cargo = $this->getCargo();
            $result->bindParam(":cargo", $cargo);
            $usured = $this->getUsured();
            $result->bindParam(":usured", $usured);
            $actper = $this->getActper();
            $result->bindParam(":actper", $actper);
            if ($this->getPasper()) {
                $pasper = $this->getPasper();
                $pasper = sha1(md5($pasper)) . "sGlaqs2%";
                $result->bindParam(":pasper", $pasper);
            }
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function del()
    {
        try {
            $sql = "DELETE FROM persona WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function getExPE($idper){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idperent) AS can FROM asignar WHERE idperent=:idper";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idper',$idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    function getExPR($idper){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idperrec) AS can FROM asignar WHERE idperrec=:idper";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idper',$idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    function getPFxP($idper){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idper) AS can FROM perxpef WHERE idper=:idper";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idper',$idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    //------------Perfil-----------
    
    function getOnePxF()
    {
        $sql = "SELECT idpef FROM perxpef WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOneSPxF($ndper)
    {
        $sql = "SELECT p.idper, p.nomper, p.apeper, p.idvtpd, p.ndper, p.emaper, p.pasper, p.cargo, p.usured, p.actper, pf.idpef, vt.nomval AS doc, vd.nomval AS dpt FROM persona AS p INNER JOIN valor AS vt ON p.idvtpd=vt.idval INNER JOIN valor AS vd ON p.idvdpt=vd.idval LEFT JOIN perxpef AS pf ON p.idper=pf.idper WHERE p.ndper=:ndper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":ndper", $ndper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOnePef()
    {
        $sql = "SELECT idpef, nompef FROM perfil";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function savePxF()
    {
        try{
            $sql = "INSERT INTO perxpef (idper, idpef) VALUES (:idper,:idpef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $idpef = $this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function savePxFAut($idper,$idpef)
    {
        try{
            $sql = "INSERT INTO perxpef (idper, idpef) VALUES (:idper,:idpef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idper", $idper);
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delPxF()
    {
        try{
            $sql = "DELETE FROM perxpef WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    //------------Tarjeta-----------

    function getAllTaj()
    {
        $sql = "SELECT t.idtaj, t.numtajpar, t.numtajofi, t.fecent, t.fecdev, t.esttaj, pe.idper AS idpent, CONCAT (pe.apeper,' ',pe.nomper) AS pent, pe.ndper AS dpent, vpe.nomval AS tdpent, pe.cargo AS cpent, pr.idper AS idprec, CONCAT (pr.apeper,' ',pr.nomper) AS prec, pr.ndper AS dprec, vpr.nomval AS tdprec, pr.cargo AS cprec, pr.emaper AS eprec, ped.idper AS idpentd, CONCAT (ped.apeper,' ',ped.nomper) AS pentd, ped.ndper AS dpentd, vped.nomval AS tdpentd, ped.cargo AS cpentd, prd.idper AS idprecd, CONCAT (prd.apeper,' ',prd.nomper) AS precd, prd.ndper AS dprecd, vprd.nomval AS tdprecd, prd.cargo AS cprecd FROM tarjeta AS t INNER JOIN persona AS pe ON t.idperent=pe.idper INNER JOIN persona AS pr ON t.idperrec=pr.idper LEFT JOIN persona AS ped ON t.idperentd=ped.idper LEFT JOIN persona AS prd ON t.idperrecd=prd.idper INNER JOIN valor AS vpe ON pe.idvtpd=vpe.idval INNER JOIN valor AS vpr ON pr.idvtpd=vpr.idval LEFT JOIN valor AS vped ON ped.idvtpd=vped.idval LEFT JOIN valor AS vprd ON prd.idvtpd=vprd.idval WHERE t.esttaj=1 ORDER BY prec";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getAllTajPer($id)
    {
        $sql = "SELECT idtaj, numtajpar, numtajofi, idperent, idperrec, fecent, idperentd, idperrecd, fecdev, esttaj FROM tarjeta WHERE idperrec=:id AND esttaj=2 ORDER BY fecdev DESC";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOneTaj($id)
    {
        $sql = "SELECT idtaj, numtajpar, numtajofi, idperent, idperrec, fecent, idperentd, idperrecd, fecdev, esttaj FROM tarjeta WHERE idperrec=:id AND esttaj=1 ORDER BY fecent DESC";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":id", $id);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function saveTaj()
    {
        try{
            $numtajpar = $this->getNumtajpar();
            $numtajofi = $this->getNumtajofi();
            $sql = "INSERT INTO tarjeta (";
            if($numtajpar) $sql .= "numtajpar, ";
            if($numtajofi) $sql .= "numtajofi, ";
            $sql .= "idperent, idperrec, fecent, esttaj) VALUES (";
            if($numtajpar) $sql .= ":numtajpar,";
            if($numtajofi) $sql .= ":numtajofi,";
            $sql .= ":idperent, :idperrec, :fecent, :esttaj)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            if($numtajpar) $result->bindParam(":numtajpar", $numtajpar);
            if($numtajofi) $result->bindParam(":numtajofi", $numtajofi);
            $idperent = $this->getIdperent();
            $result->bindParam(":idperent", $idperent);
            $idperrec = $this->getIdperrec();
            $result->bindParam(":idperrec", $idperrec);
            $fecent = $this->getFecent();
            $result->bindParam(":fecent", $fecent);
            $esttaj = $this->getEsttaj();
            $result->bindParam(":esttaj", $esttaj);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function saveTajXls()
    {
        try{
            $sql = "INSERT INTO tarjeta (numtajpar, numtajofi, idperent, idperrec, fecent, idperentd, idperrecd, fecdev, esttaj) VALUES (:numtajpar, :numtajofi, :idperent, :idperrec, :fecent, :idperentd, :idperrecd, :fecdev, :esttaj)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $numtajpar = $this->getNumtajpar();
            $result->bindParam(":numtajpar", $numtajpar);
            $numtajofi = $this->getNumtajofi();
            $result->bindParam(":numtajofi", $numtajofi);
            $idperent = $this->getIdperent();
            $result->bindParam(":idperent", $idperent);
            $idperrec = $this->getIdperrec();
            $result->bindParam(":idperrec", $idperrec);
            $fecent = $this->getFecent();
            $result->bindParam(":fecent", $fecent);
            $idperentd = $this->getIdperentd();
            $result->bindParam(":idperentd", $idperentd);
            $idperrecd = $this->getIdperrecd();
            $result->bindParam(":idperrecd", $idperrecd);
            $fecdev = $this->getFecdev();
            $result->bindParam(":fecdev", $fecdev);
            $esttaj = $this->getEsttaj();
            $result->bindParam(":esttaj", $esttaj);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function EditTajXls()
    {
        try{
            $sql = "UPDATE tarjeta SET numtajpar=:numtajpar, numtajofi=:numtajofi, idperent=:idperent, idperrec=:idperrec, fecent=:fecent, idperentd=:idperentd, idperrecd=:idperrecd, fecdev=:fecdev, esttaj=:esttaj WHERE idtaj=:idtaj";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idtaj = $this->getIdtaj();
            $result->bindParam(":idtaj", $idtaj);
            $numtajpar = $this->getNumtajpar();
            $result->bindParam(":numtajpar", $numtajpar);
            $numtajofi = $this->getNumtajofi();
            $result->bindParam(":numtajofi", $numtajofi);
            $idperent = $this->getIdperent();
            $result->bindParam(":idperent", $idperent);
            $idperrec = $this->getIdperrec();
            $result->bindParam(":idperrec", $idperrec);
            $fecent = $this->getFecent();
            $result->bindParam(":fecent", $fecent);
            $esttaj = $this->getEsttaj();
            $idperentd = $this->getIdperentd();
            $result->bindParam(":idperentd", $idperentd);
            $idperrecd = $this->getIdperrecd();
            $result->bindParam(":idperrecd", $idperrecd);
            $fecdev = $this->getFecdev();
            $result->bindParam(":fecdev", $fecdev);
            $esttaj = $this->getEsttaj();
            $result->bindParam(":esttaj", $esttaj);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function updTaj()
    {
        try{
            $numtajpar = $this->getNumtajpar();
            $numtajofi = $this->getNumtajofi();
            $sql = "UPDATE tarjeta SET ";
            if($numtajpar) $sql .= "numtajpar=:numtajpar, ";
            if($numtajofi) $sql .= "numtajofi=:numtajofi, ";
            $sql .= "idperentd=:idperentd, idperrecd=:idperrecd, fecdev=:fecdev, esttaj=:esttaj WHERE idtaj=:idtaj";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idtaj = $this->getIdtaj();
            $result->bindParam(":idtaj", $idtaj);
            if($numtajpar) $result->bindParam(":numtajpar", $numtajpar);
            if($numtajofi) $result->bindParam(":numtajofi", $numtajofi);
            $idperentd = $this->getIdperentd();
            $result->bindParam(":idperentd", $idperentd);
            $idperrecd = $this->getIdperrecd();
            $result->bindParam(":idperrecd", $idperrecd);
            $fecdev = $this->getFecdev();
            $result->bindParam(":fecdev", $fecdev);
            $esttaj = $this->getEsttaj();
            $result->bindParam(":esttaj", $esttaj);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    //------------Traer valores-----------

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

    function getPef()
    {
        $sql = "SELECT idpef, nompef FROM perfil";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function selectUsu(){
		$sql = "SELECT idper, COUNT(*) AS sum FROM persona WHERE ndper=:ndper";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$ndper=$this->getNdper();
		$result->bindParam(":ndper",$ndper);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

    function selectTaj(){
		$sql = "SELECT idtaj, idperrec, COUNT(*) AS sum FROM tarjeta WHERE (numtajofi=:numtajofi OR numtajpar=:numtajpar) AND idperrec=:idperrec";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$numtajofi=$this->getNumtajofi();
		$result->bindParam(":numtajofi",$numtajofi);
        $numtajpar=$this->getNumtajpar();
		$result->bindParam(":numtajpar",$numtajpar);
        $idperrec = $this->getIdperrec();
        $result->bindParam(":idperrec", $idperrec);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

    function CompPef(){
		$sql = "SELECT idpef, COUNT(*) AS sum FROM perfil WHERE idpef=:idpef";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
        $idpef = $this->getIdpef();
        $result->bindParam(":idpef", $idpef);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

    function CompVal($id){
		$sql = "SELECT idval, COUNT(*) AS sum FROM valor WHERE idval=:id";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
        $result->bindParam(":id", $id);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
}
