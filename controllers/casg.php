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
    $estexp = isset($_REQUEST['estexp']) ? $_REQUEST['estexp']:3;
    
    $nomfir = isset($_POST['nomfir']) ? $_POST['nomfir']:NULL;
    $prs = isset($_POST['prs']) ? $_POST['prs']:NULL;
    $estfir = isset($_POST['estfir']) ? $_POST['estfir']:NULL;
    $urlfir = isset($_POST['firma']) ? $_POST['firma']:NULL;
    $firma = NULL;

    
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
        $masg->setDifasg($nmfl);    
        if(!$ideqxpr){
            $masg->save($asg);
            $id = $masg->getOneAsg($nmfl);
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
        echo "<script>window.location='home.php?pg=".$pg."&asg=".$asg."';</script>";
    }
    
    if ($urlfir) {
        // Separar los datos base64 del encabezado
        list($type, $data) = explode(';', $urlfir);
        list(, $data) = explode(',', $data);

        // Decodificar los datos base64
        $data = base64_decode($data);

        // Determinar la extensión del archivo basado en el tipo MIME
        $ext = '';
        if (strpos($type, 'image/png') !== false) $ext = 'png';
        elseif (strpos($type, 'image/jpeg') !== false) $ext = 'jpeg';
        else die('Tipo de archivo no soportado');

        // Definir la ruta donde se guardará la imagen

        $fold = 'img/fir/' . $nomfir;
        $nom = "fir_" . $prs . "_" . $nomarc . ".png"; // Guardar como PNG
        $firma = $fold.'/'.$nom;

        if (!file_exists($fold)) mkdir($fold, 0755, true);
        file_put_contents($firma, $data);
    }

    if($ope=="firmar" && $firma){
        $masg->setFirma($firma);
        $masg->setEstexp($estexp);
        $masg->saveFir($estfir);
        echo "<script>window.location='home.php?pg=".$pg."&asg=".$asg."';</script>";
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
        echo "<script>window.location='home.php?pg=".$pg."&asg=".$asg."';</script>";
    }

    if($ope=="edi" && $ideqxpr) {
        $datOneA = $masg->getOne();
        $datAxE = $masg->getAllAxE($ideqxpr);
    }
    
    //------------Traer valores-----------

    $datOpe = $masg->getAllOpe(9);
    $datPer = $masg->getAllPer($ope);
    
    if($asg=="equ"){
        $datAllA = $masg->getAllAsig(52);
        $datEqu = $masg->getAllEquDis(52, $ope);
        $datAcc = $masg->getAllAcc(3);
    }else if($asg=="cel"){
        $datAllA = $masg->getAllAsig(54);
        $datEqu = $masg->getAllEquDis(54, $ope);
        $datAcc = $masg->getAllAcc(5);
    }

    //------------Importar equipos asignados-----------
    if ($ope=="cargmea" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
            $acc = 0;
            $comp = 2;
            $idvacc = [];
            $idperrecd = NULL;
            $idperentd = NULL;
            $masg->setIdperrecd($idperrecd);
            $masg->setIdperentd($idperentd);
    		$serialeq = $sheet->getCell("B" . $row)->getValue();
            $masg->setSerialeq($serialeq); 
            $idq = $masg->selectEqu(); 
            $idequ = $idq[0]['idequ'];
            foreach (range('C', 'H') AS $columnID){
                $id = $sheet->getCell($columnID . $row)->getValue();
                if($id) $idvacc[] = $id;
            }
            foreach ($idvacc AS $idv){
                $masg->setIdvacc($idv); 
                $idv = $masg->CompValAc();
                $idv = $idv[0]['idval'];
                if($idv) $acc++;
            }
    		$dpent = $sheet->getCell("I" . $row)->getValue();
            $masg->setNdper($dpent); 
            $idpent = $masg->selectUsu(); 
            $idperent = $idpent[0]['idper']; 
            $dprec = $sheet->getCell("K" . $row)->getValue();
            $masg->setNdper($dprec); 
            $idprec = $masg->selectUsu(); 
            $idperrec = $idprec[0]['idper'];
    		$observ = $sheet->getCell("M" . $row)->getValue();
    		$fecent = $sheet->getCell("N" . $row)->getValue();
            $fecdev = $sheet->getCell("T" . $row)->getValue();
            if (is_numeric($fecent)) $fecent = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecent)->format('Y-m-d');
            if (is_numeric($fecdev)) $fecdev = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecdev)->format('Y-m-d');
            if($fecdev){
    		    $dpentd = $sheet->getCell("O" . $row)->getValue();
                $masg->setNdper($dpentd); 
                $idpentd = $masg->selectUsu(); 
                $idperentd = $idpentd[0]['idper']; 
                $masg->setIdperentd($idperentd);
    		    $dprecd = $sheet->getCell("Q" . $row)->getValue();
                $masg->setNdper($dprecd); 
                $idprecd = $masg->selectUsu(); 
                $idperrecd = $idprecd[0]['idper']; 
                $masg->setIdperrecd($idperrecd);
                $observd = $sheet->getCell("S" . $row)->getValue();
                if(count($idvacc)==$acc && $idequ && $idperent && $idperrec && $idperentd && $idperrecd) $comp = 1;
            }elseif(!$fecdev){
                if(count($idvacc)==$acc && $idequ && $idperent && $idperrec) $comp = 1;
            }
    		$estexp = ($fecdev) ? 2 : 1;
            $difasg = $nmfl;
            $masg->setIdequ($idequ);
            $masg->setIdperent($idperent);
            $masg->setIdperrec($idperrec);
            $masg->setFecent($fecent);
            $masg->setFecdev($fecdev);
            $masg->setEstexp($estexp);
            $masg->setDifasg($difasg);
            $mequ->setIdequ($idequ);
            if($idequ && $estexp==2) $mequ->setActequ(1);
            elseif($idequ && $estexp==1) $mequ->setActequ(2);
            $mequ->editAct(); 
    		$existingData = $masg->selectAsg();
            $ideqxpr = $existingData[0]['ideqxpr'];
            $masg->setIdeqxpr($ideqxpr);
    		if ($comp==1 && !empty($idequ)) {
                if ($existingData[0]['sum'] == 0){
                    $masg->saveAsgXls();
                    $id = $masg->selectAsg();
                    $ideqxpr = $id[0]['ideqxpr'];
                    $masg->setIdeqxpr($ideqxpr);
                } else $masg->EditAsgXls();
                if($ideqxpr) $masg->delAxE();
                if($idvacc && $ideqxpr){ 
                    foreach($idvacc AS $ida){
                        $masg->setIdvacc($ida);
                        $masg->saveAxE();
                }}
            }else{
                $reg = $row;
                $row = $highestRow+5;
            }
            $nmfl++;
        }
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."&asg=".$asg."';}, 7000);</script>";
    }

    //------------Importar celulares asignados-----------
    if ($ope=="cargmca" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
            $acc = 0;
            $comp = 2;
            $idvacc = [];
            $idperrecd = NULL;
            $idperentd = NULL;
            $masg->setIdperrecd($idperrecd);
            $masg->setIdperentd($idperentd);
    		$serialeq = $sheet->getCell("B" . $row)->getValue();
            $masg->setSerialeq($serialeq); 
            $idq = $masg->selectEqu(); 
            $idequ = $idq[0]['idequ'];
    		$numcel = $sheet->getCell("C" . $row)->getValue();
    		$opecel = $sheet->getCell("D" . $row)->getValue();
            $masg->setOpecel($opecel); 
            $idop = $masg->CompValOp(); 
            $opecel = $idop[0]['idval'];
            foreach (range('E', 'K') AS $columnID){
                $id = $sheet->getCell($columnID . $row)->getValue();
                if($id) $idvacc[] = $id;
            }
            foreach ($idvacc AS $idv){
                $masg->setIdvacc($idv); 
                $idv = $masg->CompValAc();
                $idv = $idv[0]['idval'];
                if($idv) $acc++;
            }
    		$dpent = $sheet->getCell("L" . $row)->getValue();
            $masg->setNdper($dpent); 
            $idpent = $masg->selectUsu(); 
            $idperent = $idpent[0]['idper']; 
            $dprec = $sheet->getCell("N" . $row)->getValue();
            $masg->setNdper($dprec); 
            $idprec = $masg->selectUsu(); 
            $idperrec = $idprec[0]['idper'];
    		$observ = $sheet->getCell("P" . $row)->getValue();
    		$fecent = $sheet->getCell("Q" . $row)->getValue();
            $fecdev = $sheet->getCell("W" . $row)->getValue();
            if (is_numeric($fecent)) $fecent = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecent)->format('Y-m-d');
            if (is_numeric($fecdev)) $fecdev = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecdev)->format('Y-m-d');
            if($fecdev){
    		    $dpentd = $sheet->getCell("R" . $row)->getValue();
                $masg->setNdper($dpentd); 
                $idpentd = $masg->selectUsu(); 
                $idperentd = $idpentd[0]['idper']; 
                $masg->setIdperentd($idperentd);
    		    $dprecd = $sheet->getCell("T" . $row)->getValue();
                $masg->setNdper($dprecd); 
                $idprecd = $masg->selectUsu(); 
                $idperrecd = $idprecd[0]['idper']; 
                $masg->setIdperrecd($idperrecd);
                $observd = $sheet->getCell("V" . $row)->getValue();
                if(count($idvacc)==$acc && $opecel && $idequ && $idperent && $idperrec && $idperentd && $idperrecd) $comp = 1;
            }elseif(!$fecdev){
                if(count($idvacc)==$acc && $opecel && $idequ && $idperent && $idperrec) $comp = 1;
            }
    		$estexp = ($fecdev) ? 2 : 1;
            $difasg = $nmfl;
            $masg->setIdequ($idequ);
            $masg->setIdperent($idperent);
            $masg->setIdperrec($idperrec);
            $masg->setFecent($fecent);
            $masg->setFecdev($fecdev);
            $masg->setNumcel($numcel);
            $masg->setOpecel($opecel);
            $masg->setEstexp($estexp);
            $masg->setDifasg($difasg);
            $mequ->setIdequ($idequ);
            if($idequ && $estexp==2) $mequ->setActequ(1);
            elseif($idequ && $estexp==1) $mequ->setActequ(2);
            $mequ->editAct(); 
    		$existingData = $masg->selectAsg();
            $ideqxpr = $existingData[0]['ideqxpr'];
            $masg->setIdeqxpr($ideqxpr);
    		if ($comp==1 && !empty($idequ)) {
                if ($existingData[0]['sum'] == 0){
                    $masg->saveAsgXls();
                    $id = $masg->selectAsg();
                    $ideqxpr = $id[0]['ideqxpr'];
                    $masg->setIdeqxpr($ideqxpr);
                } else $masg->EditAsgXls();
                if($ideqxpr) $masg->delAxE();
                if($idvacc && $ideqxpr){ 
                    foreach($idvacc AS $ida){
                        $masg->setIdvacc($ida);
                        $masg->saveAxE();
                }}
            }else{
                $reg = $row;
                $row = $highestRow+5;
            }
            $nmfl++;
        }
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."&asg=".$asg."';}, 7000);</script>";
    }
?>