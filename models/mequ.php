<?php
    class Mequ{

        //------------Equipo-----------
        private $idequ;
        private $marca;
        private $modelo;
        private $serialeq;
        private $nomred;
        private $idvtpeq;
        private $capgb;
        private $ram;
        private $procs;
        private $actequ;
        private $tipcon;
        private $contrato;
        private $valrcont;
        private $pagequ;

        //------------Programa-----------
        private $idvprg;
        private $verprg;

        //------------Equipo-----------
        public function getIdequ(){
            return $this->idequ;
        }
        public function getMarca(){
            return $this->marca;
        }
        public function getModelo(){
            return $this->modelo;
        }
        public function getSerialeq(){
            return $this->serialeq;
        }
        public function getNomred(){
            return $this->nomred;
        }
        public function getIdvtpeq(){
            return $this->idvtpeq;
        }
        public function getCapgb(){
            return $this->capgb;
        }
        public function getRam(){
            return $this->ram;
        }
        public function getProcs(){
            return $this->procs;
        }
        public function getActequ(){
            return $this->actequ;
        }
        public function getTipcon(){
            return $this->tipcon;
        }
        public function getContrato(){
            return $this->contrato;
        }
        public function getValrcont(){
            return $this->valrcont;
        }
        public function getPagequ(){
            return $this->pagequ;
        }

        //------------Programa-----------
        public function getIdvprg(){
            return $this->idvprg;
        }
        public function getVerprg(){
            return $this->verprg;
        }
        
        //------------Equipo-----------
        public function setIdequ($idequ){
            $this->idequ=$idequ;
        }
        public function setMarca($marca){
            $this->marca=$marca;
        }
        public function setModelo($modelo){
            $this->modelo=$modelo;
        }
        public function setSerialeq($serialeq){
            $this->serialeq=$serialeq;
        }
        public function setNomred($nomred){
            $this->nomred=$nomred;
        }
        public function setIdvtpeq($idvtpeq){
            $this->idvtpeq=$idvtpeq;
        }
        public function setCapgb($capgb){
            $this->capgb=$capgb;
        }
        public function setRam($ram){
            $this->ram=$ram;
        }
        public function setProcs($procs){
            $this->procs=$procs;
        }
        public function setActequ($actequ){
            $this->actequ=$actequ;
        }
        public function setTipcon($tipcon){
            $this->tipcon=$tipcon;
        }
        public function setContrato($contrato){
            $this->contrato=$contrato;
        }
        public function setValrcont($valrcont){
            $this->valrcont=$valrcont;
        }
        public function setPagequ($pagequ){
            $this->pagequ=$pagequ;
        }

        //------------Programa-----------
        public function setIdvprg($idvprg){
            $this->idvprg=$idvprg;
        }
        public function setVerprg($verprg){
            $this->verprg=$verprg;
        }

        // ------------Equipo-----------
        function getAll($pg){
            $sql = "SELECT e.idequ, e.marca, e.modelo, e.serialeq, e.nomred, e.idvtpeq, e.capgb, e.ram, e.procs, e.actequ, e.tipcon, e.contrato, e.valrcont, vt.nomval AS tpe, vc.nomval AS tpc FROM equipo AS e LEFT JOIN valor AS vt ON e.idvtpeq=vt.idval LEFT JOIN valor AS vc ON e.tipcon=vc.idval";
            if($pg==52) $sql .= " WHERE pagequ=52";
            if($pg==54) $sql .= " WHERE pagequ=54";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOne(){
            $sql = "SELECT e.idequ, e.marca, e.modelo, e.serialeq, e.nomred, e.idvtpeq, e.capgb, e.ram, e.procs, e.actequ, e.tipcon, e.contrato, e.valrcont, vt.nomval AS tpe, vc.nomval AS tpc FROM equipo AS e LEFT JOIN valor AS vt ON e.idvtpeq=vt.idval LEFT JOIN valor AS vc ON e.tipcon=vc.idval WHERE e.idequ=:idequ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idequ = $this->getIdequ();
            $result->bindParam(":idequ",$idequ);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function save(){
            try {
                $sql = "INSERT INTO equipo (marca, modelo, serialeq, nomred, idvtpeq, capgb, ram, procs, actequ, tipcon, contrato, valrcont, pagequ) VALUES (:marca, :modelo, :serialeq, :nomred, :idvtpeq, :capgb, :ram, :procs, :actequ, :tipcon, :contrato, :valrcont, :pagequ)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $marca = $this->getMarca();
                $result->bindParam(":marca", $marca);
                $modelo = $this->getModelo();
                $result->bindParam(":modelo", $modelo);
                $serialeq = $this->getSerialeq();
                $result->bindParam(":serialeq", $serialeq);
                $nomred = $this->getNomred();
                $result->bindParam(":nomred", $nomred);
                $idvtpeq = $this->getIdvtpeq();
                $result->bindParam(":idvtpeq", $idvtpeq);
                $cap = $this->getCapgb();
                $result->bindParam(":capgb", $cap);
                $ram = $this->getRam();
                $result->bindParam(":ram", $ram);
                $procs = $this->getProcs();
                $result->bindParam(":procs", $procs);
                $actequ = $this->getActequ();
                $result->bindParam(":actequ", $actequ);
                $tipcon = $this->getTipcon();
                $result->bindParam(":tipcon", $tipcon);
                $contrato = $this->getContrato();
                $result->bindParam(":contrato", $contrato);
                $valrcont = $this->getValrcont();
                $result->bindParam(":valrcont", $valrcont);
                $pagequ = $this->getPagequ();
                $result->bindParam(":pagequ", $pagequ);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function editAct(){
            try{
                $sql = "UPDATE equipo SET actequ=:actequ WHERE idequ=:idequ";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ",$idequ);
                $actequ = $this->getActequ();
                $result->bindParam(":actequ",$actequ);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function edit(){
            try {
                $sql = "UPDATE equipo SET marca=:marca, modelo=:modelo, serialeq=:serialeq, nomred=:nomred, idvtpeq=:idvtpeq, capgb=:capgb, ram=:ram, procs=:procs, actequ=:actequ, tipcon=:tipcon, contrato=:contrato, valrcont=:valrcont WHERE idequ=:idequ";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ",$idequ);
                $marca = $this->getMarca();
                $result->bindParam(":marca", $marca);
                $modelo = $this->getModelo();
                $result->bindParam(":modelo", $modelo);
                $serialeq = $this->getSerialeq();
                $result->bindParam(":serialeq", $serialeq);
                $nomred = $this->getNomred();
                $result->bindParam(":nomred", $nomred);
                $idvtpeq = $this->getIdvtpeq();
                $result->bindParam(":idvtpeq", $idvtpeq);
                $cap = $this->getCapgb();
                $result->bindParam(":capgb", $cap);
                $ram = $this->getRam();
                $result->bindParam(":ram", $ram);
                $procs = $this->getProcs();
                $result->bindParam(":procs", $procs);
                $actequ = $this->getActequ();
                $result->bindParam(":actequ", $actequ);
                $tipcon = $this->getTipcon();
                $result->bindParam(":tipcon", $tipcon);
                $contrato = $this->getContrato();
                $result->bindParam(":contrato", $contrato);
                $valrcont = $this->getValrcont();
                $result->bindParam(":valrcont", $valrcont);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function del(){
            try {
                $sql = "DELETE FROM equipo WHERE idequ=:idequ";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function getEqxEp($idequ){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idequ) AS can FROM prgxequi WHERE idequ=:idequ";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idequ',$idequ);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getEqprxEq($idequ){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idequ) AS can FROM asignar WHERE idequ=:idequ";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idequ',$idequ);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        //------------Programa-----------
        function getOnePxE()
        {
            $sql = "SELECT p.idvprg AS prg, p.verprg, v.nomval, d.nomdom FROM prgxequi AS p INNER JOIN valor AS v ON idvprg=v.idval INNER JOIN dominio AS d ON v.iddom=d.iddom WHERE idequ=:idequ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idequ = $this->getIdEqu();
            $result->bindParam(":idequ", $idequ);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOnePrg($iddom)
        {
            $sql = "SELECT v.idval, v.nomval, v.iddom, d.nomdom FROM valor AS v INNER JOIN dominio AS d ON v.iddom=d.iddom WHERE v.iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function savePxE()
        {
            try{
                $sql = "INSERT INTO prgxequi (idequ, idvprg, verprg) VALUES (:idequ, :idvprg, :verprg)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $idvprg = $this->getIdvprg();
                $result->bindParam(":idvprg", $idvprg);
                $verprg = $this->getVerprg();
                $result->bindParam(":verprg", $verprg);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function delPxE()
        {
            try{
                $sql = "DELETE FROM prgxequi WHERE idequ=:idequ";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idequ = $this->getIdequ();
                $result->bindParam(":idequ", $idequ);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        //------------Traer valores-----------
        function getAllTpEq($iddom){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllTpCt($iddom){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllDom($iddomo, $iddomw)
        {
            $sql = "SELECT iddom, nomdom FROM dominio WHERE iddom=:iddomo OR iddom=:iddomw";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddomo", $iddomo);
            $result->bindParam(":iddomw", $iddomw);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>