<?php
    class Masg{

        //------------Asignar-----------
        private $ideqxpr;
        private $idequ;
        private $idperent;
        private $idperrec;
        private $fecent;
        private $observ;
        private $idperentd;
        private $idperrecd;
        private $fecdev;
        private $observd;
        private $numcel;
        private $opecel;
        private $estexp;
        private $rutpdf;
        private $difasg;

        private $firma;

        
        private $serialeq;
        private $ndper;

        //------------Accesorios-----------
        private $idvacc;

        //------------Asignar-----------
        public function getIdeqxpr(){
            return $this->ideqxpr;
        }
        public function getIdequ(){
            return $this->idequ;
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
        public function getObserv(){
            return $this->observ;
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
        public function getObservd(){
            return $this->observd;
        }
        public function getNumcel(){
            return $this->numcel;
        }
        public function getOpecel(){
            return $this->opecel;
        }
        public function getEstexp(){
            return $this->estexp;
        }
        public function getRutpdf(){
            return $this->rutpdf;
        }
        public function getDifasg(){
            return $this->difasg;
        }

        public function getFirma(){
            return $this->firma;
        }

        public function getSerialeq(){
            return $this->serialeq;
        }
        public function getNdper(){
            return $this->ndper;
        }

        //------------Accesorios-----------
        public function getIdvacc(){
            return $this->idvacc;
        }

        //------------Asignar-----------
        public function setIdeqxpr($ideqxpr){
            $this->ideqxpr=$ideqxpr;
        }
        public function setIdequ($idequ){
            $this->idequ=$idequ;
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
        public function setObserv($observ){
            $this->observ=$observ;
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
        public function setObservd($observd){
            $this->observd=$observd;
        }
        public function setNumcel($numcel){
            $this->numcel=$numcel;
        }
        public function setOpecel($opecel){
            $this->opecel=$opecel;
        }
        public function setEstexp($estexp){
            $this->estexp=$estexp;
        }
        public function setRutpdf($rutpdf){
            $this->rutpdf=$rutpdf;
        }
        public function setDifasg($difasg){
            $this->difasg=$difasg;
        }

        public function setFirma($firma){
            $this->firma=$firma;
        }

        public function setSerialeq($serialeq){
            $this->serialeq=$serialeq;
        }
        public function setNdper($ndper){
            $this->ndper = $ndper;
        }

        //------------Accesorios-----------
        public function setIdvacc($idvacc){
            $this->idvacc=$idvacc;
        }

        //------------Asignar-----------
        function getAllAsig($asg){
            $sql = "SELECT a.ideqxpr, a.fecent, a.observ, a.firent, a.fecdev, a.observd, a.firdev, a.numcel, a.opecel, vo.nomval AS operador, a.estexp, a.rutpdf, e.idequ, e.marca, e.modelo, e.serialeq, e.nomred, e.idvtpeq, e.capgb, e.ram, e.procs, e.tipcon, e.pagequ, vt.nomval AS tpe, vc.nomval AS tpc, pe.idper AS idpent, CONCAT (pe.apeper,' ',pe.nomper) AS pent, pe.ndper AS dpent, vpe.nomval AS tdpent, pe.cargo AS cpent, pe.emaper AS epent, pr.idper AS idprec, CONCAT (pr.apeper,' ',pr.nomper) AS prec, pr.ndper AS dprec, vpr.nomval AS tdprec, pr.cargo AS cprec, pr.emaper AS eprec, ped.idper AS idpentd, CONCAT (ped.apeper,' ',ped.nomper) AS pentd, ped.ndper AS dpentd, vped.nomval AS tdpentd, ped.cargo AS cpentd, ped.emaper AS epentd, prd.idper AS idprecd, CONCAT (prd.apeper,' ',prd.nomper) AS precd, prd.ndper AS dprecd, vprd.nomval AS tdprecd, prd.cargo AS cprecd, prd.emaper AS eprecd FROM asignar AS a INNER JOIN equipo AS e ON a.idequ=e.idequ INNER JOIN persona AS pe ON a.idperent=pe.idper INNER JOIN persona AS pr ON a.idperrec=pr.idper LEFT JOIN persona AS ped ON a.idperentd=ped.idper LEFT JOIN persona AS prd ON a.idperrecd=prd.idper INNER JOIN valor AS vpe ON pe.idvtpd=vpe.idval INNER JOIN valor AS vpr ON pr.idvtpd=vpr.idval LEFT JOIN valor AS vped ON ped.idvtpd=vped.idval LEFT JOIN valor AS vprd ON prd.idvtpd=vprd.idval LEFT JOIN valor AS vt ON e.idvtpeq=vt.idval LEFT JOIN valor AS vc ON e.tipcon=vc.idval LEFT JOIN valor AS vo ON a.opecel=vo.idval";
            if($asg==52) $sql .= " WHERE e.pagequ=52";
            else if($asg==54) $sql .= " WHERE e.pagequ=54";
            if($_SESSION['idpef']==3) $sql .= " AND pr.idper=:idper";
            $sql .= " ORDER BY a.estexp, prec";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            if($_SESSION['idpef']==3){
                $idper = $_SESSION['idper'];
                $result->bindParam(":idper",$idper);
            }
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOne(){
            $sql = "SELECT a.ideqxpr, a.fecent, a.observ, a.firent, a.fecdev, a.observd, a.firdev, a.numcel, a.opecel, vo.nomval AS operador, a.estexp, a.rutpdf, e.idequ, e.marca, e.modelo, e.serialeq, e.nomred, e.idvtpeq, e.capgb, e.ram, e.procs, e.tipcon, e.pagequ, vt.nomval AS tpe, vc.nomval AS tpc, pe.idper AS idpent, CONCAT (pe.apeper,' ',pe.nomper) AS pent, pe.ndper AS dpent, vpe.nomval AS tdpent, pe.cargo AS cpent, pe.emaper AS epent, pr.idper AS idprec, CONCAT (pr.apeper,' ',pr.nomper) AS prec, pr.ndper AS dprec, vpr.nomval AS tdprec, pr.cargo AS cprec, pr.emaper AS eprec, ped.idper AS idpentd, CONCAT (ped.apeper,' ',ped.nomper) AS pentd, ped.ndper AS dpentd, vped.nomval AS tdpentd, ped.cargo AS cpentd, ped.emaper AS epentd, prd.idper AS idprecd, CONCAT (prd.apeper,' ',prd.nomper) AS precd, prd.ndper AS dprecd, vprd.nomval AS tdprecd, prd.cargo AS cprecd, prd.emaper AS eprecd FROM asignar AS a INNER JOIN equipo AS e ON a.idequ=e.idequ INNER JOIN persona AS pe ON a.idperent=pe.idper INNER JOIN persona AS pr ON a.idperrec=pr.idper LEFT JOIN persona AS ped ON a.idperentd=ped.idper LEFT JOIN persona AS prd ON a.idperrecd=prd.idper INNER JOIN valor AS vpe ON pe.idvtpd=vpe.idval INNER JOIN valor AS vpr ON pr.idvtpd=vpr.idval LEFT JOIN valor AS vped ON ped.idvtpd=vped.idval LEFT JOIN valor AS vprd ON prd.idvtpd=vprd.idval LEFT JOIN valor AS vt ON e.idvtpeq=vt.idval LEFT JOIN valor AS vc ON e.tipcon=vc.idval LEFT JOIN valor AS vo ON a.opecel=vo.idval WHERE a.ideqxpr=:ideqxpr";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $ideqxpr = $this->getIdeqxpr();
            $result->bindParam(":ideqxpr",$ideqxpr);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function save($asg){
            try{
                $sql = "INSERT INTO asignar (idequ, idperent, idperrec, fecent, observ, estexp, difasg";
                if($asg=="cel") $sql .= ", numcel, opecel"; 
                $sql .= ") VALUES (:idequ, :idperent, :idperrec, :fecent, :observ, :estexp, :difasg";
                if($asg=="cel") $sql .= ", :numcel, :opecel";
                $sql .= ")";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $idperent = $_SESSION['idper'];
                $result->bindParam(":idperent", $idperent);
                $idperrec = $this->getIdperrec();
                $result->bindParam(":idperrec", $idperrec);
                $fecent = $this->getFecent();
                $result->bindParam(":fecent", $fecent);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);
                $estexp = $this->getEstexp();
                $result->bindParam(":estexp", $estexp);
                $difasg = $this->getDifasg();
                $result->bindParam(":difasg", $difasg);
                if($asg=="cel"){
                    $numcel = $this->getNumcel();
                    $result->bindParam(":numcel", $numcel);
                    $opecel = $this->getOpecel();
                    $result->bindParam(":opecel", $opecel);
                }
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function saveFir($fir){
            try{
                $sql = "UPDATE asignar SET";
                if($fir==2) $sql .= " firdev=:firma,";
                if($fir==1) $sql .= " firent=:firma,";
                $sql .= " estexp=:estexp WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr",$ideqxpr);
                $firma = $this->getFirma();
                $result->bindParam(":firma", $firma);
                $estexp = $this->getEstexp();
                $result->bindParam(":estexp", $estexp);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function savePdf(){
            try{
                $sql = "UPDATE asignar SET rutpdf=:rutpdf WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr",$ideqxpr);
                $rutpdf = $this->getRutpdf();
                $result->bindParam(":rutpdf", $rutpdf);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function saveAsgXls(){
            try{
                $sql = "INSERT INTO asignar (idequ, idperent, idperrec, fecent, observ, idperentd, idperrecd, fecdev, observd, numcel, opecel, estexp, difasg) VALUES (:idequ, :idperent, :idperrec, :fecent, :observ, :idperentd, :idperrecd, :fecdev, :observd, :numcel, :opecel, :estexp, :difasg)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $idperent = $this->getIdperent();
                $result->bindParam(":idperent", $idperent);
                $idperrec = $this->getIdperrec();
                $result->bindParam(":idperrec", $idperrec);
                $fecent = $this->getFecent();
                $result->bindParam(":fecent", $fecent);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);
                $idperentd = $this->getIdperentd();
                $result->bindParam(":idperentd", $idperentd);
                $idperrecd = $this->getIdperrecd();
                $result->bindParam(":idperrecd", $idperrecd);
                $fecdev = $this->getFecdev();
                $result->bindParam(":fecdev", $fecdev);
                $observd = $this->getObservd();
                $result->bindParam(":observd", $observd);
                $estexp = $this->getEstexp();
                $result->bindParam(":estexp", $estexp);
                $numcel = $this->getNumcel();
                $result->bindParam(":numcel", $numcel);
                $opecel = $this->getOpecel();
                $result->bindParam(":opecel", $opecel);
                $difasg = $this->getDifasg();
                $result->bindParam(":difasg", $difasg);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function EditAsgXls(){
            try{
                $sql = "UPDATE asignar SET idequ=:idequ, idperent=:idperent, idperrec=:idperrec, fecent=:fecent, observ=:observ, idperentd=:idperentd, idperrecd=:idperrecd, fecdev=:fecdev, observd=:observd, numcel=:numcel, opecel=:opecel, estexp=:estexp WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr",$ideqxpr);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $idperent = $this->getIdperent();
                $result->bindParam(":idperent", $idperent);
                $idperrec = $this->getIdperrec();
                $result->bindParam(":idperrec", $idperrec);
                $fecent = $this->getFecent();
                $result->bindParam(":fecent", $fecent);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);
                $idperentd = $this->getIdperentd();
                $result->bindParam(":idperentd", $idperentd);
                $idperrecd = $this->getIdperrecd();
                $result->bindParam(":idperrecd", $idperrecd);
                $fecdev = $this->getFecdev();
                $result->bindParam(":fecdev", $fecdev);
                $observd = $this->getObservd();
                $result->bindParam(":observd", $observd);
                $estexp = $this->getEstexp();
                $result->bindParam(":estexp", $estexp);
                $numcel = $this->getNumcel();
                $result->bindParam(":numcel", $numcel);
                $opecel = $this->getOpecel();
                $result->bindParam(":opecel", $opecel);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function edit(){
            try{
                $numcel = $this->getNumcel();
                $opecel = $this->getOpecel();
                $sql = "UPDATE asignar SET ";
                if($numcel) $sql .= "numcel=:numcel, "; 
                if($opecel) $sql .= "opecel=:opecel, "; 
                $sql .= "observ=:observ WHERE ideqxpr=:ideqxpr"; 
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr", $ideqxpr);
                if($numcel) $result->bindParam(":numcel", $numcel);
                if($opecel) $result->bindParam(":opecel", $opecel);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function dev(){
            try{
                $sql = "UPDATE asignar SET idperentd=:idperentd, idperrecd=:idperrecd, fecdev=:fecdev, observd=:observd, estexp=:estexp WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr", $ideqxpr);
                $idperentd = $this->getIdperentd();
                $result->bindParam(":idperentd", $idperentd);
                $idperrecd = $this->getIdperrecd();
                $result->bindParam(":idperrecd", $idperrecd);
                $fecdev = $this->getFecdev();
                $result->bindParam(":fecdev", $fecdev);
                $observd = $this->getObservd();
                $result->bindParam(":observd", $observd);
                $estexp = $this->getEstexp();
                $result->bindParam(":estexp", $estexp);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }
    
        function getAcxAs($ideqxpr){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(ideqxpr) AS can FROM accxequi WHERE ideqxpr=:ideqxpr";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':ideqxpr',$ideqxpr);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        //------------Accesorios-----------

        function getAllAxE($ideqxpr)
            {
                $sql = "SELECT ae.idvacc, v.nomval FROM accxequi AS ae INNER JOIN valor AS v ON ae.idvacc=v.idval WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $result->bindParam(":ideqxpr", $ideqxpr);
                $result->execute();
                $res = $result->fetchall(PDO::FETCH_ASSOC);
                return $res;
            }

        function saveAxE()
        {
            try{
                $sql = "INSERT INTO accxequi (ideqxpr, idvacc) VALUES (:ideqxpr, :idvacc)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr", $ideqxpr);
                $idvacc = $this->getIdvacc();
                $result->bindParam(":idvacc", $idvacc);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function delAxE()
        {
            try{
                $sql = "DELETE FROM accxequi WHERE ideqxpr=:ideqxpr";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideqxpr = $this->getIdeqxpr();
                $result->bindParam(":ideqxpr", $ideqxpr);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        //------------Traer valores-----------
        function getAllOpe($iddom){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllAcc($iddom){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllPer($ope){
            $sql = "SELECT DISTINCT idper, nomper, apeper, ndper FROM persona";
            if(!$ope) $sql.= " WHERE actper=1";
            $sql .= " ORDER BY apeper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllEquDis($pg, $ope){
            $sql = "SELECT idequ, marca, modelo, serialeq FROM equipo WHERE pagequ=:pg";
            if(!$ope) $sql .= " AND actequ=1";
            $sql .= " ORDER BY marca, modelo";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":pg", $pg);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOneAsg($difasg)
        {
            $sql = "SELECT ideqxpr FROM asignar WHERE difasg=:difasg";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":difasg", $difasg);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function selectAsg()
        {
            $sql = "SELECT ideqxpr, COUNT(*) AS sum FROM asignar WHERE idequ=:idequ AND idperrec=:idperrec GROUP BY ideqxpr";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idequ = $this->getIdequ();
            $result->bindParam(":idequ", $idequ);
            $idperrec = $this->getIdperrec();
            $result->bindParam(":idperrec", $idperrec);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function selectEqu(){
            $sql = "SELECT idequ, COUNT(*) AS sum FROM equipo WHERE serialeq=:serialeq GROUP BY idequ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $serialeq=$this->getSerialeq();
            $result->bindParam(":serialeq",$serialeq);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function selectUsu(){
            $sql = "SELECT idper, COUNT(*) AS sum FROM persona WHERE ndper=:ndper GROUP BY idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $ndper=$this->getNdper();
            $result->bindParam(":ndper",$ndper);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function CompValOp(){
            $sql = "SELECT idval, COUNT(*) AS sum FROM valor WHERE idval=:opecel GROUP BY idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $opecel = $this->getOpecel();
            $result->bindParam(":opecel", $opecel);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        function CompValAc(){
            $sql = "SELECT idval, COUNT(*) AS sum FROM valor WHERE idval=:idvacc GROUP BY idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idvacc = $this->getIdvacc();
            $result->bindParam(":idvacc", $idvacc);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>