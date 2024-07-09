<?php
    require_once("models/masg.php");
    require_once('models/mequ.php');

    $masg = new Masg();
    $mequ = new Mequ();

    //------------Asignar-----------
    $ideqxpr = isset($_REQUEST['ideqxpr']) ? $_REQUEST['ideqxpr']:NULL;
    $idequ = isset($_POST['idequ']) ? $_POST['idequ']:NULL;
    $idperent = isset($_POST['idperent']) ? $_POST['idperent']:NULL;
    $idperrec = isset($_POST['idperrec']) ? $_POST['idperrec']:NULL;
    $fecent = isset($_POST['fecent']) ? $_POST['fecent']:NULL;
    $observ = isset($_POST['observ']) ? $_POST['observ']:NULL;
    $idperentd = isset($_POST['idperentd']) ? $_POST['idperentd']:NULL;
    $idperrecd = isset($_POST['idperrecd']) ? $_POST['idperrecd']:$_SESSION['idper'];
    $fecdev = isset($_POST['fecdev']) ? $_POST['fecdev']:NULL;
    $observd = isset($_POST['observd']) ? $_POST['observd']:NULL;
    $numcel = isset($_POST['numcel']) ? $_POST['numcel']:NULL;
    $opecel = isset($_POST['opecel']) ? $_POST['opecel']:NULL;
    $estexp = isset($_REQUEST['estexp']) ? $_REQUEST['estexp']:1;
    $difasg = $nmfl;
    
    //------------Accesorios-----------
    $idvacc = isset($_POST['idvacc']) ? $_POST['idvacc']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $asg = isset($_REQUEST['asg']) ? $_REQUEST['asg']:"equ";
    
    $datOneA = NULL;
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
        $masg->setEstexp($estexp);    
        $masg->setDifasg($difasg);    
        if(!$ideqxpr){
            $masg->save($asg);
            $id = $masg->getOneAsg($difasg);
            $ideqxpr = $id[0]['ideqxpr'];
            $mequ->setIdequ($idequ);
            $mequ->setActequ(2);
            $mequ->editAct();
        }
        else $masg->edit();
        if($ideqxpr) $masg->delAxE();
        if($idvacc && $ideqxpr){ foreach($idvacc AS $ida){
            $masg->setIdeqxpr($ideqxpr);
            $masg->setIdvacc($ida);
            $masg->saveAxE();
        }}
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="dev" && $ideqxpr && $idequ){
        $masg->setIdperentd($idperentd);
        $masg->setIdperrecd($idperrecd);
        $masg->setFecdev($fecdev);
        $masg->setObservd($observd);
        $masg->setEstexp($estexp);
        $masg->dev();
        $mequ->setIdequ($idequ);
        $mequ->setActequ(1);
        $mequ->editAct();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="edi" && $ideqxpr) {
        $datOneA = $masg->getOne();
        $datAxE = $masg->getAllAxE($ideqxpr);
    }
    
    //------------Traer valores-----------

    $datOpe = $masg->getAllOpe(9);
    $datPer = $masg->getAllPer();
    
    if($asg=="equ"){
        $datAllA = $masg->getAllAsig(52);
        $datEqu = $masg->getAllEquDis(52);
        $datAcc = $masg->getAllAcc(3);
    }else if($asg=="cel"){
        $datAllA = $masg->getAllAsig(54);
        $datEqu = $masg->getAllEquDis(54);
        $datAcc = $masg->getAllAcc(5);
    }
?>