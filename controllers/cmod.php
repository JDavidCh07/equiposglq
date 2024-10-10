<?php

    include ('models/mmod.php');
    
    $mmod = new Mmod();

    $idmod = isset($_REQUEST['idmod']) ? $_REQUEST['idmod']:NULL;
    $nommod = isset($_POST['nommod']) ? $_POST['nommod']:NULL;
    $actmod = isset($_REQUEST['actmod']) ? $_REQUEST['actmod']:NULL;
    $arcimg = isset($_FILES['arcimg']) ? $_FILES['arcimg']:NULL;
    $imgmod = NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $pg = 1;
    $datOne = NULL;

    if($arcimg AND $arcimg["name"]) $imgmod = opti($arcimg, "mod", "img/mod", $nmfl); 
    $mmod->setIdmod($idmod);

    if($ope=='save'){
        $mmod->setNommod($nommod);
        $mmod->setImgmod($imgmod);
        $mmod->setActmod($actmod);
        if(!$idmod) $mmod->save();
        else $mmod->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    if($ope=='act' && $idmod && $actmod){
        $mmod->setActmod($actmod);
        $mmod->editAct();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    if($ope=='del' && $idmod){
        $mmod->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=='edi' && $idmod) $datOne = $mmod->getOne();

    $datAll = $mmod->getAll();

?>