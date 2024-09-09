<?php
    class Mmod{

        private $idmod;
        private $nommod;
        private $imgmod;
        private $actmod;

        private $idpef;

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

        public function getIdpef(){
            return $this->idpef;
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

        public function setIdpef($idpef){
             $this->idpef=$idpef;
        }

        function getAll(){
            $sql = "SELECT m.idmod, m.nommod, m.imgmod, m.actmod FROM modulo AS m";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllAct(){
            $sql = "SELECT m.idmod, m.nommod, m.imgmod, m.actmod FROM modulo AS m WHERE m.actmod=1;";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        
        function getOnePfPr(){
            $sql = "SELECT m.idmod, m.nommod, p.idpef, p.nompef, pm.idpag FROM modulo AS m LEFT JOIN pefxmod AS pm ON m.idmod=pm.idmod LEFT JOIN perfil AS p ON pm.idpef=p.idpef RIGHT JOIN perxpef AS f ON p.idpef=f.idpef WHERE f.idper=:idper";
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
            $idpef = $this->getIdpef();
            $sql = "SELECT m.idmod, m.nommod, pm.idpef, p.nompef, pm.idpag FROM modulo AS m LEFT JOIN pefxmod AS pm ON m.idmod=pm.idmod LEFT JOIN perfil AS p ON pm.idpef=p.idpef RIGHT JOIN perxpef AS f ON p.idpef=f.idpef WHERE f.idper=:idper AND m.idmod=:idmod";
            if($idpef) $sql .= " AND pm.idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $_SESSION["idper"];
            $result->bindParam(":idper",$idper);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            if($idpef) $result->bindParam(":idpef",$idpef);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getPag(){
            $sql ="SELECT pp.idpag FROM pagxpef AS pp INNER JOIN pagina AS p ON pp.idpag=p.idpag INNER JOIN perfil AS f ON pp.idpef=f.idpef INNER JOIN modulo AS m ON p.idmod=m.idmod WHERE p.idmod=:idmod AND pp.idpef=:idpef ORDER BY pp.idpag;";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idmod = $this->getIdmod();
            $result->bindParam(":idmod",$idmod);
            $idpef = $this->getIdpef();
            $result->bindParam(":idpef",$idpef);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        
        function getOne(){
            $sql = "SELECT idmod, nommod, imgmod, actmod FROM modulo WHERE idmod=:idmod";
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
                $sql .= " actmod) VALUES (:nommod, ";
                    if($this->getImgmod()) $sql .= ":imgmod,";
                $sql .= " :actmod)";
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
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function edit(){
            try{
                $sql = "UPDATE modulo SET nommod=:nommod, ";
                    if($this->getImgmod()) $sql .= "imgmod=:imgmod,";
                $sql .= " actmod=:actmod WHERE idmod=:idmod";
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
            $sql ="SELECT COUNT(idpef) AS can FROM pefxmod WHERE idmod=:idmod";
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