<?php 
    include ('models/mpef.php');

    $mpef = new Mpef();

    $idpef = isset($_REQUEST['idpef']) ? $_REQUEST['idpef']:NULL;
    $nompef = isset($_POST['nompef']) ? $_POST['nompef']:NULL;
    $idpag = isset($_POST['idpag']) ? $_POST['idpag']:NULL;
    $idmod = isset($_POST['idmod']) ? $_POST['idmod']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $pg=4;

    $mpef->setIdpef($idpef);
    if($ope=="savepxp"){ 
        if($idpef) $mpef->delPXP();
        if($idpag){ foreach($idpag AS $ip){
            $mpef->setIdpag($ip);
            $mpef->savePxP();
        }}
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="savepxm"){
        if($idpef) $mpef->delPxM();
        if($idpag){ 
            $i = 0;
            foreach($idpag AS $idp){ if($idp!="0"){
                $mpef->setIdpag($idp);
                $mpef->setIdmod($idmod[$i]);
                $mpef->savePxM();
                $mpef->savePxP();
            }
            $i++;
        }}
        $idmod = $mpef->getPxM();
        if($idmod){ foreach($idmod AS $id) $idm[] = $id['idmod'];
        $mod = implode(',', $idm);
        $mpef->delPag($mod);
        }else $mpef->delPXP();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    //guardar 
    if($ope=="save"){
        $mpef->setNompef($nompef);
        if(!$idpef) $mpef->save();
        else $mpef->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    $datOne = NULL;

    if($ope=="edi" && $idpef) $datOne = $mpef->getOne();
    
//mostrar todos los datos
    $dat = $mpef->getAll();
    $datpag = $mpef->getPag();
    $datmod = $mpef->getMod();

?>