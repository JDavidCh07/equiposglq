<?php
    class Mmod{

        private $idmod;
        private $nommod;
        private $imgmod;
        private $actmod;
        private $idpag;

        public function getIdmod(){
            return $this->idmod;
        }
        public function getNommod(){
            return $this->nommod;
        }
        public function getImgmod(){
            return $this->imgmod;
        }
        public function getActmod(){
            return $this->actmod;
        }
        public function getIdpag(){
            return $this->idpag;
        }

        public function setIdmod($idmod){
            $this->idmod=$idmod;
        }
        public function setNommod($nommod){
            $this->nommod=$nommod;
        }
        public function setImgmod($imgmod){
            $this->imgmod=$imgmod;
        }
        public function setActmod($actmod){
            $this->actmod=$actmod;
        }
        public function setIdpag($idpag){
            $this->idpag=$idpag;
        }

        function getAll(){
            $sql = "SELECT m.idmod, m.nommod, m.imgmod, m.actmod, m.idpag, p.nompag FROM modulo AS m LEFT JOIN pagina AS p ON m.idpag=p.idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllAct(){
            $sql = "SELECT m.idmod, m.nommod, m.imgmod, m.actmod, m.idpag FROM modulo AS m WHERE m.actmod=1;";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        
        function getOnePfPr(){
            $sql = "SELECT m.idmod, m.nommod, p.idpef, p.nompef, p.idpag FROM modulo AS m LEFT JOIN perfil AS p ON m.idmod=p.idmod RIGHT JOIN perxpef AS f ON p.idpef=f.idpef WHERE f.idper=:idper;";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $_SESSION["idper"];
            $result->bindParam(":idper",$idper);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOnePfPrMd(){
            $sql = "SELECT m.idmod, m.nommod, p.idpef, p.nompef, p.idpag FROM modulo AS m LEFT JOIN perfil AS p ON m.idmod=p.idmod RIGHT JOIN perxpef AS f ON p.idpef=f.idpef WHERE f.idper=:idper AND m.idmod=:idmod;";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $_SESSION["idper"];
            $result->bindParam(":idper",$idper);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        
        function getAllPag(){
            $sql = "SELECT idpag, nompag FROM pagina";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllGraf(){
            $sql = "SELECT m.nommod, COUNT(f.idmod) AS cn FROM modulo AS m LEFT JOIN perfil AS f ON m.idmod=f.idmod GROUP BY f.idmod, m.nommod ORDER BY COUNT(f.idmod) DESC, m.nommod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getNomP(){
            $sql ="SELECT m.idmod ,p.nompef FROM modulo AS m INNER JOIN perfil AS p ON m.idmod=p.idmod";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOne(){
            $sql = "SELECT idmod, nommod, imgmod, actmod, idpag FROM modulo WHERE idmod=:idmod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function save(){
            try{
                $sql = "INSERT INTO modulo(nommod, ";
                    if($this->getImgmod()) $sql .= "imgmod,";
                $sql .= " actmod, idpag) VALUES (:nommod, ";
                    if($this->getImgmod()) $sql .= ":imgmod,";
                $sql .= " :actmod, :idpag)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $nommod = $this->getNommod();
                $result->bindParam(":nommod",$nommod);
                if($this->getImgmod()){
                    $imgmod = $this->getImgmod();
                    $result->bindParam(":imgmod",$imgmod);
                }
                $actmod = $this->getActmod();
                $result->bindParam(":actmod",$actmod);
                $idpag = $this->getIdpag();
                $result->bindParam(":idpag",$idpag);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function edit(){
            try{
                $sql = "UPDATE modulo SET nommod=:nommod, ";
                    if($this->getImgmod()) $sql .= "imgmod=:imgmod,";
                $sql .= " actmod=:actmod, idpag=:idpag WHERE idmod=:idmod";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idmod = $this->getIdmod();
                $result->bindParam(":idmod",$idmod);
                $nommod = $this->getNommod();
                $result->bindParam(":nommod",$nommod);
                if($this->getImgmod()){
                    $imgmod = $this->getImgmod();
                    $result->bindParam(":imgmod",$imgmod);
                }
                $actmod = $this->getActmod();
                $result->bindParam(":actmod",$actmod);
                $idpag = $this->getIdpag();
                $result->bindParam(":idpag",$idpag);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }
        
        function editAct(){
            $sql = "UPDATE modulo SET actmod=:actmod WHERE idmod=:idmod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $actmod = $this->getActmod();
            $result->bindParam(":actmod",$actmod);
            $result->execute();
        }

        function del(){
            try{
                $sql = "DELETE FROM modulo WHERE idmod=:idmod";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idmod = $this->getIdmod();
                $result->bindParam(":idmod",$idmod);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }
        
        function getMxP($idmod){
            $sql ="SELECT COUNT(idpef) AS can FROM perfil WHERE idmod=:idmod";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idmod",$idmod);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }

?>