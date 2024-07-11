<?php
    require_once("models/masg.php");
    require_once('models/mequ.php');
    require ('vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;

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

    $arc = isset($_FILES["arc"]["name"]) ? $_FILES["arc"]["name"] : NULL;
    $arc = substr($arc, 0, strpos($arc, ".xls"));

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
            $idperrecd = NULL;
            $idperentd = NULL;
            $masg->setIdperrecd($idperrecd);
            $masg->setIdperentd($idperentd);
    		$serialeq = $sheet->getCell("B" . $row)->getValue();
            $masg->setSerialeq($serialeq); 
            $idq = $masg->selectEqu(); 
            $idequ = $idq[0]['idequ']; 
    		$dpent = $sheet->getCell("C" . $row)->getValue();
            $masg->setNdper($dpent); 
            $idpent = $masg->selectUsu(); 
            $idperent = $idpent[0]['idper']; 
            $dprec = $sheet->getCell("E" . $row)->getValue();
            $masg->setNdper($dprec); 
            $idprec = $masg->selectUsu(); 
            $idperrec = $idprec[0]['idper']; 
    		$fecent = $sheet->getCell("G" . $row)->getValue();
    		$observ = $sheet->getCell("H" . $row)->getValue();
            $fecdev = $sheet->getCell("M" . $row)->getValue();
            if (is_numeric($fecent)) $fecent = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecent)->format('Y-m-d');
            if (is_numeric($fecdev)) $fecdev = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecdev)->format('Y-m-d');
            if($fecdev){
    		    $dpentd = $sheet->getCell("I" . $row)->getValue();
                $masg->setNdper($dpentd); 
                $idpentd = $masg->selectUsu(); 
                $idperentd = $idpentd[0]['idper']; 
                $masg->setIdperentd($idperentd);
    		    $dprecd = $sheet->getCell("K" . $row)->getValue();
                $masg->setNdper($dprecd); 
                $idprecd = $masg->selectUsu(); 
                $idperrecd = $idprecd[0]['idper']; 
                $masg->setIdperrecd($idperrecd);
                $observd = $sheet->getCell("N" . $row)->getValue();
            }
    		$estexp = ($fecdev) ? 2 : 1;
            $masg->setIdequ($idequ);
            $masg->setIdperent($idperent);
            $masg->setIdperrec($idperrec);
            $masg->setFecent($fecent);
            $masg->setFecdev($fecdev);
            $masg->setEstexp($estexp);
            if($idequ && $estexp==2) $mequ->setActequ(1);
            elseif($idequ && $estexp==1) $mequ->setActequ(2);
            $mequ->editAct(); 
    		$existingData = $mper->selectTaj();
            $idtaj = $existingData[0]['idtaj'];
            $mper->setIdtaj($idtaj);
    		if ((!empty($numtajpar) OR !empty($numtajofi)) AND !empty($idperrec)) {
    			if ($existingData[0]['sum'] == 0) $mper->saveTajXls();
    			else $mper->EditTajXls();
    		}
    	}
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
?>