<?php
    require_once("models/mper.php");

    $mper = new Mper();

    //------------Persona-----------
    $idper = isset($_REQUEST['idper']) ? $_REQUEST['idper']:NULL;
    $nomper = isset($_POST['nomper']) ? $_POST['nomper']:NULL;
    $apeper = isset($_POST['apeper']) ? $_POST['apeper']:NULL;
    $idvtpd = isset($_POST['idvtpd']) ? $_POST['idvtpd']:NULL;
    $ndper = isset($_POST['ndper']) ? $_POST['ndper']:NULL;
    $emaper = isset($_POST['emaper']) ? strtolower($_POST['emaper']):NULL;
    $cargo = isset($_POST['cargo']) ? $_POST['cargo']:NULL;
    $usured = isset($_POST['usured']) ? $_POST['usured']:NULL;
    $actper = isset($_REQUEST['actper']) ? $_REQUEST['actper']:1;

    $pasper = strtoupper(substr($nomper, 0, 1)).strtolower(substr($apeper, 0, 1)).$ndper."GLQ";
    
    //------------Perfil-----------
    $idpef = isset($_POST['idpef']) ? $_POST['idpef']:3;

    //------------Tarjeta-----------
    $idtaj = isset($_POST['idtaj']) ? $_POST['idtaj']:NULL;
    $numtajpar = isset($_POST['numtajpar']) ? $_POST['numtajpar']:NULL;
    $numtajofi = isset($_POST['numtajofi']) ? $_POST['numtajofi']:NULL;
    $idperent = isset($_POST['idperent']) ? $_POST['idperent']:NULL;
    $idperrec = isset($_POST['idperrec']) ? $_POST['idperrec']:NULL;
    $fecent = isset($_POST['fecent']) ? $_POST['fecent']:NULL;
    $idperentd = isset($_POST['idperentd']) ? $_POST['idperentd']:NULL;
    $idperrecd = isset($_POST['idperrecd']) ? $_POST['idperrecd']:NULL;
    $fecdev = isset($_POST['fecdev']) ? $_POST['fecdev']:NULL;
    $esttaj = isset($_POST['esttaj']) ? $_POST['esttaj']:1;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $datOne=NULL;
    $pg = 53;


    $mper->setIdper($idper);
    $mper->setIdtaj($idtaj);

    //------------Persona-----------
    if($ope=="save"){
        $mper->setNomper($nomper);
        $mper->setApeper($apeper);
        $mper->setEmaper($emaper);
        $mper->setNdper($ndper);
        $mper->setIdvtpd($idvtpd);
        $mper->setCargo($cargo);
        $mper->setUsured($usured);
        $mper->setActper($actper);
        $mper->setPasper($pasper);
        if(!$idper) {
            $mper->save();
            $per = $mper->getOneSPxF($ndper); 
            $mper->savePxFAut($per[0]['idper'],$idpef);
        }
        else{
            $mper->edit();
            if($idper == $_SESSION["idper"]){
                $_SESSION['nomper'] = $nomper;
                $_SESSION['apeper'] = $apeper;
                $_SESSION['emaper'] = $emaper;
                $_SESSION['ndper'] = $ndper;
                $_SESSION['cargo'] = $cargo;
            };
        } 
    }

    if($ope=="act" && $idper && $actper){
        $mper->setActper($actper);
        $mper->editAct();
    }

    if($ope=="eli"&& $idper) $mper->del();
    if($ope=="edi"&& $idper) $datOne=$mper->getOne();

    //------------Perfil-----------
    if($ope=="savepxf"){
        if($idper) $mper->delPxF();
        if($idpef){ foreach ($idpef as $pf) {
            if($pf){
                $mper->setIdpef($pf);
                $mper->savePxF();
            }
        }}
    }

    //------------Tarjeta-----------
    if($ope=="savetxp"){
        $mper->setNumtajpar($numtajpar);
        $mper->setNumtajofi($numtajofi);
        $mper->setIdperent($idperent);
        $mper->setIdperrec($idperrec);
        $mper->setFecent($fecent);
        $mper->setFecdev($fecdev);
        $mper->setEsttaj($esttaj);
        if($fecdev){
            $mper->setIdperentd($idperentd);
            $mper->setIdperrecd($idperrecd);
            $mper->setEsttaj(2);
        }
        if(!$idtaj) $mper->saveTaj();
        else $mper->updTaj();
    }

    //------------Traer valores-----------
    $datAll = $mper->getAll();
    $idmod = $mper->getAllMod();
    $dattpd = $mper->getAllTpd(1);
?>
