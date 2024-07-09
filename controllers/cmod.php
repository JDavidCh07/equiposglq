<?php

    include ('models/mmod.php');
    
    $mmod = new Mmod();

    $idmod = isset($_REQUEST['idmod']) ? $_REQUEST['idmod']:NULL;
    $nommod = isset($_POST['nommod']) ? $_POST['nommod']:NULL;
    $actmod = isset($_REQUEST['actmod']) ? $_REQUEST['actmod']:NULL;
    $idpag = isset($_POST['idpag']) ? $_POST['idpag']:NULL;
    $arcimg = isset($_FILES['arcimg']) ? $_FILES['arcimg']:NULL;
    $imgmod = NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $pg = 1;
    $datOne = NULL;

    if($arcimg AND $arcimg["name"]) $imgmod = opti($arcimg, "mod", "img/mod", $nmfl);
    
    $mmod->setIdmod($idmod);

    if($ope=='save'){
        if($nommod && $idpag){
            $mmod->setNommod($nommod);
            $mmod->setImgmod($imgmod);
            $mmod->setActmod($actmod);
            $mmod->setIdpag($idpag);
            if(!$idmod) $mmod->save();
            else $mmod->edit();
        }else echo '<script>err("Todos los datos son obligatorios.");</script>';
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=='act' && $idmod && $actmod){
        $mmod->setActmod($actmod);
        $mmod->editAct();
    }

    if($ope=='del' && $idmod) $mmod->del();
    if($ope=='edi' && $idmod) $datOne = $mmod->getOne();

    $datAll = $mmod->getAll();
    $datPag = $mmod->getAllPag();
    $datGra = $mmod->getAllGraf();

?>