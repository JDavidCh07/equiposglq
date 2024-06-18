<?php
    require_once("models/mequ.php");

    $mequ = new Mequ();

    //------------Equipo-----------
    $idequ = isset($_REQUEST['idequ']) ? $_REQUEST['idequ']:NULL;
    $marca = isset($_POST['marca']) ? $_POST['marca']:NULL;
    $modelo = isset($_POST['modelo']) ? $_POST['modelo']:NULL;
    $serialeq = isset($_POST['serialeq']) ? $_POST['serialeq']:NULL;
    $nomred = isset($_POST['nomred']) ? $_POST['nomred']:NULL;
    $idvtpeq = isset($_POST['idvtpeq']) ? $_POST['idvtpeq']:NULL;
    $capgb = isset($_POST['capgb']) ? $_POST['capgb']:NULL;
    $ram = isset($_POST['ram']) ? $_POST['ram']:NULL;
    $procs = isset($_POST['procs']) ? $_POST['procs']:NULL;
    $fecultman = isset($_POST['fecultman']) ? $_POST['fecultman']:NULL;
    $fecproman = isset($_POST['fecproman']) ? $_POST['fecproman']:NULL;
    $actequ = isset($_REQUEST['actequ']) ? $_REQUEST['actequ']:NULL;
    $tipcon = isset($_POST['tipcon']) ? $_POST['tipcon']:NULL;
    $contrato = isset($_POST['contrato']) ? $_POST['contrato']:NULL;
    $valrcont = isset($_POST['valrcont']) ? $_POST['valrcont']:NULL;
    $pagequ = isset($_POST['pagequ']) ? $_POST['pagequ']:NULL;

    //------------Programa-----------
    $idvprg = isset($_POST['idvprg']) ? $_POST['idvprg']:NULL;
    $verprg = isset($_POST['verprg']) ? $_POST['verprg']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $datOne = NULL;

    $mequ->setIdequ($idequ);

    //------------Equipo-----------
    if($ope=="save"){
        $mequ->setMarca($marca);
        $mequ->setModelo($modelo);
        $mequ->setSerialeq($serialeq);
        $mequ->setNomred($nomred);
        $mequ->setIdvtpeq($idvtpeq);
        $mequ->setCapgb($capgb);
        $mequ->setRam($ram);
        $mequ->setProcs($procs);
        $mequ->setFecultman($fecultman);
        $mequ->setFecproman($fecproman);
        $mequ->setActequ($actequ);
        $mequ->setTipcon($tipcon);
        $mequ->setContrato($contrato);
        $mequ->setValrcont($valrcont);
        if($pg==52) $mequ->setPagequ(52);
        if($pg==54) $mequ->setPagequ(54);
        if(!$idequ) $mequ->save();
        else $mequ->edit();
    }

    if($ope=="act" && $idequ && $actequ){
        $mequ->setActequ($actequ);
        $mequ->editAct();
    }

    if($ope=="edi" && $idequ) $datOne = $mequ->getOne();
    if($ope=="eli" && $idequ) $mequ->del();

    //------------Programa-----------
    if($ope=="savepxe"){
        $i = 0;
        if($idequ) $mequ->delPxE();
        if($idvprg){ foreach ($idvprg as $prg) {
            if($prg && $verprg){
                $mequ->setIdvprg($prg);
                $mequ->setVerprg($verprg[$i]);
                $mequ->savePxE();
                $i++;
            }
        }}
    }
    
    //------------Traer valores-----------
    $datAll = $mequ->getAll($pg);
    $dattpe = $mequ->getAllTpEq(2);
    $dattpc = $mequ->getAllTpCt(4);

    $dom = $mequ->getAllDom(6,7);
?>