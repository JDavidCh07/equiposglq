<?php
    require_once("models/mper.php");
    require ('vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;

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

    $arc = isset($_FILES["arc"]["name"]) ? $_FILES["arc"]["name"] : NULL;
    $arc = substr($arc, 0, strpos($arc, ".xls"));

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

    //------------Importar-----------
    if ($ope=="cargm" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc", "");
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
    		$nomper = $sheet->getCell("B" . $row)->getValue();
    		$apeper = $sheet->getCell("C" . $row)->getValue();
            $idvtpd = $sheet->getCell("D" . $row)->getValue();
    		$ndper = $sheet->getCell("E" . $row)->getValue();
    		$emaper = $sheet->getCell("F" . $row)->getValue();
    		$cargo = $sheet->getCell("G" . $row)->getValue();
    		$usured = $sheet->getCell("H" . $row)->getValue();
    		$actper = $sheet->getCell("I" . $row)->getValue();
    		$pasper = NULL;
            $mper->setNomper($nomper);
            $mper->setApeper($apeper);
            $mper->setIdvtpd($idvtpd);
            $mper->setNdper($ndper);
            $mper->setEmaper($emaper);
            $mper->setCargo($cargo);
            $mper->setUsured($usured);
            $mper->setActper($actper);
            $mper->setPasper($pasper);
    		$existingData = $mper->selectUsu();
    		if (!empty($ndper)) {
    			if ($existingData[0]['sum'] == 0) {
    				// Datos ya existen, por lo tanto, actualiza en lugar de guardar
    				$mper->save();
    			}else {
    				$mper->edit();
    			}
    		}
    	}
    }

?>