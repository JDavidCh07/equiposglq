<?php
    require_once("models/mequ.php");
    require ('vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;

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
    $actequ = isset($_REQUEST['actequ']) ? $_REQUEST['actequ']:NULL;
    $tipcon = isset($_POST['tipcon']) ? $_POST['tipcon']:NULL;
    $pagequ = isset($_POST['pagequ']) ? $_POST['pagequ']:NULL;

    //------------Programa-----------
    $idvprg = isset($_POST['idvprg']) ? $_POST['idvprg']:NULL;
    $verprg = isset($_POST['verprg']) ? $_POST['verprg']:NULL;

    $arc = isset($_FILES["arc"]["name"]) ? $_FILES["arc"]["name"] : NULL;
    $arc = substr($arc, 0, strpos($arc, ".xls"));

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $pg = isset($_REQUEST['pg']) ? $_REQUEST['pg']:NULL;
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
        $mequ->setActequ($actequ);
        $mequ->setTipcon($tipcon);
        if($pg==52) $mequ->setPagequ(52);
        if($pg==54) $mequ->setPagequ(54);
        if(!$idequ) $mequ->save();
        else $mequ->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="act" && $idequ && $actequ){
        $mequ->setActequ($actequ);
        $mequ->editAct();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="edi" && $idequ) $datOne = $mequ->getOne();
    if($ope=="eli" && $idequ){
        $mequ->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

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
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    //------------Traer valores-----------
    $datAll = $mequ->getAll($pg);
    $dattpe = $mequ->getAllTpEq(2);
    $dattpc = $mequ->getAllTpCt(4);

    $dom = $mequ->getAllDom(6,7);

    //------------Importar-----------
    if ($ope=="cargme" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
            $idvprg = [];
            $verprg = [];
    		$marca = $sheet->getCell("B" . $row)->getValue();
    		$modelo = $sheet->getCell("C" . $row)->getValue();
            $serialeq = $sheet->getCell("D" . $row)->getValue();
    		$nomred = $sheet->getCell("E" . $row)->getValue();
    		$idvtpeq = $sheet->getCell("F" . $row)->getValue();
            $mequ->setIdvtpeq($idvtpeq); 
            $idvtpeq = $mequ->CompValTq(); 
            $idvtpeq = $idvtpeq[0]['idval'];
    		$capgb = $sheet->getCell("G" . $row)->getValue();
    		$ram = $sheet->getCell("H" . $row)->getValue();
    		$procs = $sheet->getCell("I" . $row)->getValue();
    		$actequ = $sheet->getCell("J" . $row)->getValue();
    		$tipcon = $sheet->getCell("K" . $row)->getValue();
            $mequ->setTipcon($tipcon); 
            $tipcon = $mequ->CompValTc(); 
            $tipcon = $tipcon[0]['idval'];
    		$pagequ = $sheet->getCell("L" . $row)->getValue();
            if($pagequ==52){
    		    $idvprg[0] = $sheet->getCell("M" . $row)->getValue();
                $mequ->setIdvprg($idvprg[0]); 
                $idvprg[0] = $mequ->CompValPrg(); 
                $idvprg[0] = $idvprg[0][0]['idval'];
    		    $verprg[] = $sheet->getCell("N" . $row)->getValue();
    		    $idvprg[1] = $sheet->getCell("O" . $row)->getValue();
                $mequ->setIdvprg($idvprg[1]); 
                $idvprg[1] = $mequ->CompValPrg(); 
                $idvprg[1] = $idvprg[1][0]['idval'];
    		    $verprg[] = $sheet->getCell("P" . $row)->getValue();
            }
    		$mequ->setMarca($marca);
            $mequ->setModelo($modelo);
            $mequ->setSerialeq($serialeq);
            $mequ->setNomred($nomred);
            $mequ->setIdvtpeq($idvtpeq);
            $mequ->setCapgb($capgb);
            $mequ->setRam($ram);
            $mequ->setProcs($procs);
            $mequ->setActequ($actequ);
            $mequ->setTipcon($tipcon);
            $mequ->setPagequ($pagequ);
    		$existingData = $mequ->selectEqu();
    		if($idvtpeq && $tipcon){
                if (!empty($serialeq)) {
    			    if ($existingData[0]['sum'] == 0) {
    			    	// Datos ya existen, por lo tanto, actualiza en lugar de guardar
    			    	$mequ->save();
                        $existingData = $mequ->selectEqu();
                        $idequ = $existingData[0]['idequ'];
                        $mequ->setIdequ($idequ);
    			    }else {
                        $idequ = $existingData[0]['idequ'];
                        $mequ->setIdequ($idequ);
    			    	$mequ->edit();
                        $mequ->delPxE();
    			    }
                    if($idvprg && $pagequ==52){ foreach ($idvprg as $index=>$prg) {
                        if($prg && $verprg){
                            $mequ->setIdvprg($prg);
                            $mequ->setVerprg($verprg[$index]);
                            $mequ->savePxE();
                        }
                    }}}
            }else{
                $reg = $row;
                $row = $highestRow+5;
            }
        }
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 7000);</script>";
    }
    if ($ope=="cargmc" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
    		$marca = $sheet->getCell("B" . $row)->getValue();
    		$modelo = $sheet->getCell("C" . $row)->getValue();
            $serialeq = $sheet->getCell("D" . $row)->getValue();
    		$capgb = $sheet->getCell("E" . $row)->getValue();
    		$ram = $sheet->getCell("F" . $row)->getValue();
    		$actequ = $sheet->getCell("G" . $row)->getValue();
    		$tipcon = $sheet->getCell("H" . $row)->getValue();
            $mequ->setTipcon($tipcon); 
            $tipcon = $mequ->CompValTc(); 
            $tipcon = $tipcon[0]['idval'];
    		$pagequ = $sheet->getCell("I" . $row)->getValue();
    		$mequ->setMarca($marca);
            $mequ->setModelo($modelo);
            $mequ->setSerialeq($serialeq);
            $mequ->setNomred($nomred);
            $mequ->setIdvtpeq($idvtpeq);
            $mequ->setCapgb($capgb);
            $mequ->setRam($ram);
            $mequ->setProcs($procs);
            $mequ->setActequ($actequ);
            $mequ->setTipcon($tipcon);
            $mequ->setPagequ($pagequ);
    		$existingData = $mequ->selectEqu();
            $idequ = $existingData[0]['idequ'];
            $mequ->setIdequ($idequ);
    		if($tipcon){
                if (!empty($serialeq)) {
    			    if ($existingData[0]['sum'] == 0) $mequ->save();
    			    else $mequ->edit();
                }
            }else{
                $reg = $row;
                $row = $highestRow+5;
            }
        }
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 7000);</script>";
    }
?>