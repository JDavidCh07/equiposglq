<?php
    require_once("models/masg.php");

    $masg = new Masg();

    //------------Asignar-----------
    $ideqxpr = isset($_POST['ideqxpr']) ? $_POST['ideqxpr']:NULL;
    $idequ = isset($_POST['idequ']) ? $_POST['idequ']:NULL;
    $idperent = isset($_POST['idperent']) ? $_POST['idperent']:NULL;
    $idperrec = isset($_POST['idperrec']) ? $_POST['idperrec']:NULL;
    $fecent = isset($_POST['fecent']) ? $_POST['fecent']:NULL;
    $observ = isset($_POST['observ']) ? $_POST['observ']:NULL;
    $idperentd = isset($_POST['idperentd']) ? $_POST['idperentd']:NULL;
    $idperrecd = isset($_POST['idperrecd']) ? $_POST['idperrecd']:NULL;
    $fecdev = date('Y-m-d H:i:s');
    $observd = isset($_POST['observd']) ? $_POST['observd']:NULL;
    $numcel = isset($_POST['numcel']) ? $_POST['numcel']:NULL;
    $opecel = isset($_POST['opecel']) ? $_POST['opecel']:NULL;
    $estexp = isset($_POST['estexp']) ? $_POST['estexp']:NULL;
    $difasg = $nmfl;
    
    //------------Accesorios-----------
    $idvacc = isset($_POST['idvacc']) ? $_POST['idvacc']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $asg = isset($_REQUEST['asg']) ? $_REQUEST['asg']:NULL;
    
    $datOne = NULL;
    $datAxE = NULL;
    $pg = 51;

    $masg->setIdeqxpr($ideqxpr);

    //------------Asignar-----------
    if($ope=="save"){
        $masg->setIdequ($idequ);
        $masg->setIdperent($idperent);
        $masg->setIdperrec($idperrec);
        $masg->setFecent($fecent);
        $masg->setObserv($observ);
        $masg->setNumcel($numcel);
        $masg->setOpecel($opecel);
        $masg->setEstexp(1);    
        $masg->setDifasg($difasg);    
        if(!$ideqxpr){
            $masg->save($asg);
            $id = $masg->getOneAsg($difasg);
            $ideqxpr = $id[0]['ideqxpr'];
        }
        else $masg->edit();
        if($ideqxpr) $masg->delAxE();
        if($idvacc && $ideqxpr){ foreach($idvacc AS $ida){
            $masg->setIdeqxpr($ideqxpr);
            $masg->setIdvacc($ida);
            $masg->saveAxE();
        }}
    }

    if($ope=="dev" && $ideqxpr){
        $masg->setIdperentd($idperentd);
        $masg->setIdperrecd($idperrecd);
        $masg->setFecdev($fecdev);
        $masg->setObservd($observd);
        $masg->setEstexp(2);
        $masg->dev();
    }

    if($ope=="edi" && $ideqxpr) {
        $datOne = $masg->getOne();
        $datAxE = $masg->getAllAxE();
    }
    

    // //------------Programa-----------
    // if($ope=="savepxe"){
    //     $i = 0;
    //     if($idequ) $masg->delPxE();
    //     if($idvprg){ foreach ($idvprg as $prg) {
    //         if($prg && $verprg){
    //             $masg->setIdvprg($prg);
    //             $masg->setVerprg($verprg[$i]);
    //             $masg->savePxE();
    //             $i++;
    //         }
    //     }}
    // }
    
    //------------Traer valores-----------

    $datAll = NULL;
    $datOpe = $masg->getAllOpe(9);
    $datPer = $masg->getAllPer(9);
    
    if($asg=="equ"){
        $datEqu = $masg->getAllEquDis(52);
        $datAcc = $masg->getAllAcc(3);
    }else if($asg=="cel"){
        $datAcc = $masg->getAllAcc(5);
        $datEqu = $masg->getAllEquDis(54);
    }
?>