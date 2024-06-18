<?php 
    class Mval{
        private $idval;
        private $codval;
        private $iddom;
        private $nomval;
        private $actval;

        public function getIdval(){
            return $this->idval;    
        }
        public function getCodval(){
            return $this->codval;    
        }
        public function getIddom(){
            return $this->iddom;    
        }
        public function getNomval(){
            return $this->nomval;    
        }
        public function getActval(){
            return $this->actval;    
        }

        public function setIdval($idval){
            $this->idval = $idval;    
        }
        public function setCodval($codval){
            $this->codval = $codval;    
        }
        public function setIddom($iddom){
            $this->iddom = $iddom;    
        }
        public function setNomval($nomval){
            $this->nomval = $nomval;    
        }
        public function setActval($actval){
            $this->actval = $actval;    
        }

        function getAll(){
            $sql = "SELECT idval, codval, iddom, nomval, actval FROM valor";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return  $res;
        }

        function getOne(){
            $sql = "SELECT idval, codval, iddom, nomval, actval FROM valor WHERE idval=:idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval",$idval);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return  $res;
        }

        function save(){
            try{
                $sql = "INSERT INTO valor(codval, iddom, nomval, actval) VALUES (:codval, :iddom, :nomval, :actval)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $codval = $this->getCodval();
                $result->bindParam(":codval",$codval);
                $iddom = $this->getIddom();
                $result->bindParam(":iddom",$iddom);
                $nomval = $this->getNomval();
                $result->bindParam(":nomval",$nomval);
                $actval = $this->getActval();
                $result->bindParam(":actval",$actval);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }
        function editAct(){
            try{
                $sql = "UPDATE valor SET actval=:actval WHERE idval=:idval";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idval = $this->getIdval();
                $result->bindParam(":idval",$idval);
                $actval = $this->getActval();
                $result->bindParam(":actval",$actval);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }
        function edit(){
            try{
                $sql = "UPDATE valor SET codval=:codval, iddom=:iddom, nomval=:nomval, actval=:actval WHERE idval=:idval";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idval = $this->getIdval();
                $result->bindParam(":idval",$idval);
                $codval = $this->getCodval();
                $result->bindParam(":codval",$codval);
                $iddom = $this->getIddom();
                $result->bindParam(":iddom",$iddom);
                $nomval = $this->getNomval();
                $result->bindParam(":nomval",$nomval);
                $actval = $this->getActval();
                $result->bindParam(":actval",$actval);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }
        function del(){
            $sql = "DELETE FROM valor WHERE idval=:idval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion-> prepare($sql);
            $idval = $this->getIdval();
            $result->bindParam(":idval",$idval);
            $result->execute();
        }

        function getPxV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idvtpd) AS can FROM persona WHERE idvtpd=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getMxV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idvtpm) AS can FROM mantenimiento WHERE idvtpm=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getTExV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idvtpeq) AS can FROM equipo WHERE idvtpeq=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getTCxV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(tipcon) AS can FROM equipo WHERE idvtpeq=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAExV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idvacc) AS can FROM accxequi WHERE idvacc=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getPExV($idval){
            $res = null;
            $modelo = new conexion();
            $sql = "SELECT COUNT(idvprg) AS can FROM prgxequi WHERE idvprg=:idval";
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idval',$idval);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }

    ?>

