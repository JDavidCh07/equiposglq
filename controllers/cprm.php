<?php

    include ('models/mprm.php');
    require ('vendor/autoload.php');
    
    $mprm = new Mprm();
    $pdf = new TCPDF();

    $idprm = isset($_REQUEST['idprm']) ? $_REQUEST['idprm']:NULL;
    $fecini = isset($_POST['fecini']) ? $_POST['fecini']:NULL;
    $fecfin = isset($_POST['fecfin']) ? $_POST['fecfin']:NULL;
    $idjef = isset($_POST['idjef']) ? $_POST['idjef']:NULL;
    $idvtprm = isset($_POST['idvtprm']) ? $_POST['idvtprm']:NULL;
    $desprm = isset($_POST['desprm']) ? $_POST['desprm']:NULL;
    $obsprm = isset($_POST['obsprm']) ? $_POST['obsprm']:NULL;
    $estprm = isset($_POST['estprm']) ? $_POST['estprm']:NULL;
    $arcspt = isset($_FILES['arcspt']) ? $_FILES['arcspt']:NULL;
    $idvubi = isset($_POST['idvubi']) ? $_POST['idvubi']:NULL;
    $idper = $_SESSION['idper'];
    $sptrut = NULL;
    $arc = NULL;
    $ext = NULL;

    $ndper = isset($_POST['ndper']) ? $_POST['ndper']:NULL;
    $idvdpt = isset($_POST['idvdpt']) ? $_POST['idvdpt']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $pg = 101;
    $datOne = NULL;

    $nomprm = $mprm->getAllDom($idvtprm);
    $fecnom = date("Y-m-d", strtotime($fecini));

    if($arcspt AND $arcspt["name"] AND $nomprm AND $fecnom){
        
        $ext = strtolower(pathinfo($arcspt["name"], PATHINFO_EXTENSION));
        $rut = "arc/permisos/".$_SESSION['apeper']." ".$_SESSION['nomper']."_".$_SESSION['ndper']."/soportes/";
        $nom = "sop_".$nomprm[0]['nomval'].$fecnom.".pdf";
        $sptrut = $rut.$nom;

        if (!file_exists($rut)) mkdir($rut, 0755, true);
        
        //-------Si es imagen la convierte--------
        if($ext == 'png' || $ext == 'jpeg' || $ext == 'jpg'){
            $pdf->AddPage();
            $pdf->Image($arcspt['tmp_name'], 10, 10, 0, 0, '', '', '', false, 300, '', false, false, 0, false, false, false);
            $imgpdf = $pdf->Output('', 'S');
            file_put_contents($sptrut, $imgpdf); 
        } else if($ext == 'pdf') move_uploaded_file($arcspt['tmp_name'], $sptrut);        
    }

    $mprm->setIdprm($idprm);

    if($ope=='save'){
        $mprm->setFecini($fecini);
        $mprm->setFecfin($fecfin);
        $mprm->setIdjef($idjef);
        $mprm->setIdvtprm($idvtprm);
        $mprm->setSptrut($sptrut);
        $mprm->setDesprm($desprm);
        $mprm->setObsprm($obsprm);
        $mprm->setEstprm($estprm);
        $mprm->setIdper($idper);
        $mprm->setIdvubi($idvubi);
        if(!$idprm) $mprm->save();
        else $mprm->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=='edi' && $idprm) $datOne = $mprm->getOne();
    if($ope=='del' && $idprm){
        $mprm->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=='busc'){
        $mprm->setNdper($ndper);
        $mprm->setFecini($fecini);
        $mprm->setFecfin($fecfin);
        $mprm->setIdvdpt($idvdpt);
        $mprm->setEstprm($estprm);
        $datAll = $mprm->getAll("bus");
    } else if($_SESSION['idpef']==3) $datAll = $mprm->getAll("prop");
    else if($_SESSION['idpef']==4) $datAll = $mprm->getAll("rrhhf");

    if($ope=='limp') echo "<script>window.location='home.php?pg=".$pg."';</script>";

    $datTprm = $mprm->getAllDom(10);
    $datUbi = $mprm->getAllDom(11);
    $datDpt = $mprm->getAllDom(12);
    $datJef = $mprm->getAllPer();
    
    if($_SESSION['idpef']==4) $solper = $mprm->getAll("rrhhp");
    else $solper = $mprm->getAll($_SESSION['idper']);
?>