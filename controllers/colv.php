<?php
    require_once ("../models/seguridad.php");
    require_once ('../models/conexion.php');
    require_once("../models/mper.php");
    require_once("library.php");
    require ('../vendor/autoload.php');
    date_default_timezone_set('America/Bogota');

    $mper = new Mper();
    $idper = isset($_POST['idper']) ? $_POST['idper']:NULL;
    $pass = isset($_POST['newpasper']) ? $_POST['newpasper']:NULL;
    $feccam = date('Y-m-d H:i:s');
    
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    
    $pasper = encripta($pass);
    $hash = $pasper['hash'];
    $salt = $pasper['salt'];
    
    $mper->setIdper($idper);
    if($ope=="changpass"){
        $mper->setHash($hash);
        $mper->setSalt($salt);
        $mper->setFeccam($feccam);
        $mper->updpass();
        echo "<script>alert('Cambio de contraseña exitoso!');</script>";
        if($idper==$_SESSION['idper']){
            echo "<script>window.location='../';</script>";
            session_destroy();
		    exit();
        } else echo "<script>window.location='../home.php?pg=53';</script>";
    }

?>