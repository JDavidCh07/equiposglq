<?php
    require_once("models/mper.php");
    include("models/datos.php");
    require ('vendor/autoload.php');
    require ('controllers/sendemail.php');
    
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $mper = new Mper();

    //------------Persona-----------
    $idper = isset($_REQUEST['idper']) ? $_REQUEST['idper']:NULL;
    $nomper = isset($_POST['nomper']) ? strtoupper($_POST['nomper']):NULL;
    $apeper = isset($_POST['apeper']) ? strtoupper($_POST['apeper']):NULL;
    $idvsex = isset($_POST['idvsex']) ? $_POST['idvsex']:NULL;
    $idvtpd = isset($_POST['idvtpd']) ? $_POST['idvtpd']:NULL;
    $ndper = isset($_POST['ndper']) ? $_POST['ndper']:NULL;
    $emaper = isset($_POST['emaper']) ? strtolower($_POST['emaper']):NULL;
    $idvdpt = isset($_POST['idvdpt']) ? $_POST['idvdpt']:NULL;
    $cargo = isset($_POST['cargo']) ? strtoupper($_POST['cargo']):NULL;
    $usured = isset($_POST['usured']) ? strtolower($_POST['usured']):NULL;
    $actper = isset($_REQUEST['actper']) ? $_REQUEST['actper']:1;
    
    //------------Contraseña-----------
    $pass = strtoupper(substr($nomper, 0, 1)).strtolower(substr($apeper, 0, 1)).$ndper."GLQ";
    $pasper = encripta($pass);
    $hash = $pasper['hash'];
    $salt = $pasper['salt'];

    //------------Perfil-----------
    $idjef = isset($_POST['idjef']) ? $_POST['idjef']:NULL;
    
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
    $datJxP=NULL;
    $pg = 53;
    $intentos = 5;
    
    //------------Correo-----------
    $nombre = nombre($apeper." ".$nomper);
    $template = "views/mail.html";
    $mail_asun = "¡Bienvenido a nuestra app!";
    $txt_mess = "Es un placer darle la bienvenida a nuestra nueva aplicación, diseñada para que pueda solicitar y gestionar sus permisos laborales, como ausentismo o trabajo desde casa. A continuación, le proporcionamos sus credenciales de acceso:<br><br>
    <li><strong>Usuario: </strong>".$ndper.(($emaper) ? " / ".$emaper : "")."</li>
    <li><strong>Contraseña: </strong>".$pass."</li><br>
    <mark><strong>Importante:</strong></mark><br><br>
    Para garantizar la seguridad de su cuenta, se le solicita el cambio de contraseña la primera vez que inicie sesión.<br><br>
    Para acceder a la aplicación, ingrese en el siguiente enlace: <a href='".$url."'>App Galqui</a><br><br>
    Si tiene alguna pregunta o requiere asistencia, no dude en ponerse en contacto con nosotros.<br><br>
    Agradecemos su confianza y esperamos que disfrute de la nueva experiencia.<br><br>";
    $fir_mail = '<strong>'.$nom.'</strong><br>Cra 1 Nº 4 - 02 Bdg 2 Parque Industrial K2<br>Chía - Cund<br>www.galqui.com';

    $mper->setIdper($idper);
    $mper->setIdtaj($idtaj);
    
    //------------Persona-----------
    if($ope=="save"){
        $mper->setNomper($nomper);
        $mper->setApeper($apeper);
        $mper->setIdvtpd($idvtpd);
        $mper->setNdper($ndper);
        $mper->setEmaper($emaper);
        $mper->setIdvdpt($idvdpt);
        $mper->setIdvsex($idvsex);
        $mper->setCargo($cargo);
        $mper->setUsured($usured);
        $mper->setActper($actper);
        $mper->setIdjef($idjef);
        $mper->setHash($hash);
        $mper->setSalt($salt);
        if(!$idper) {
            $mper->save();
            $per = $mper->getOneSPxF($ndper); 
            $mper->savePxFAut($per[0]['idper'], $idpef);
            $mper->setIdper($per[0]['idper']);
            if($emaper){ 
                $c = 0;
                $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                while ($exito==2 && $c<$intentos){
                    $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                    sleep(5);
                    $c++;
                }
                if($exito==2) echo '<script>err("Ooops... No se pudo enviar el correo.");</script>';
        }}else{
            $mper->edit();
            if($idper == $_SESSION["idper"]){
                $_SESSION['nomper'] = $nomper;
                $_SESSION['apeper'] = $apeper;
                $_SESSION['emaper'] = $emaper;
                $_SESSION['ndper'] = $ndper;
                $_SESSION['cargo'] = $cargo;
            }
        }
        if($idper) $mper->delJxP();
        if($idjef){ foreach ($idjef as $i=>$jf) {
            if($jf){
                $mper->setIdjef($jf);
                $mper->saveJxP($i+1);
            }
        }}           
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 5000);</script>";
    }

    if($ope=="act" && $idper && $actper){
        $mper->setActper($actper);
        $mper->editAct();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="edi"&& $idper){
        $datOne=$mper->getOne();
        $datJxP=$mper->getOneJxP();
    }

    if($_SESSION['idpef']==3){
        $mper->setIdper($_SESSION['idper']);
        $datOne=$mper->getOne();
        $datJxP=$mper->getOneJxP();
        $est = 1;
    }

    if($ope=="eli"&& $idper){
        $mper->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    //------------Perfil-----------
    if($ope=="savepxf"){
        if($idper) $mper->delPxF();
        if($idpef){ foreach ($idpef as $pf) {
            if($pf){
                $mper->setIdpef($pf);
                $mper->savePxF();
            }
        }}
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
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
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    //------------Traer valores-----------
    $datAll = $mper->getAll();
    $datPer = $mper->getPer();
    $dattpd = $mper->getAllDom(1);
    $datdpt = $mper->getAllDom(12);
    $datsex = $mper->getAllDom(13);

    //------------Importar empleados-----------
    if ($ope=="cargm" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
            $pf = 0;
            $idpefA = [];
            $idjefi = NULL;
            $idjefa = NULL;
            $idper = NULL;
    		$nomper = $sheet->getCell("B" . $row)->getValue();
    		$apeper = $sheet->getCell("C" . $row)->getValue();
            $idvsex = $sheet->getCell("D" . $row)->getValue(); 
            $idvsex = $mper->CompVal($idvsex); 
            $idvsex = $idvsex[0]['idval'];
            $idvtpd = $sheet->getCell("E" . $row)->getValue(); 
            $idvtpd = $mper->CompVal($idvtpd); 
            $idvtpd = $idvtpd[0]['idval'];
    		$ndper = $sheet->getCell("F" . $row)->getValue();
    		$emaper = $sheet->getCell("G" . $row)->getValue();
    		$idvdpt = $sheet->getCell("H" . $row)->getValue();
            $idvdpt = $mper->CompVal($idvdpt); 
            $idvdpt = $idvdpt[0]['idval'];
    		$cargo = $sheet->getCell("I" . $row)->getValue();
    		$usured = $sheet->getCell("J" . $row)->getValue();
    		$actper = $sheet->getCell("K" . $row)->getValue();
    		$idpef = $sheet->getCell("L" . $row)->getValue();
            $idpef = str_replace(' ', '', $idpef);
            $idpefA = explode("-", $idpef);
            foreach($idpefA AS $pa){
                $mper->setIdpef($pa); 
                $pef = $mper->CompPef();
                $pef = $pef[0]['idpef'];
                if($pef) $pf++;
            }
    		$ndjefi = $sheet->getCell("M" . $row)->getValue();
            $mper->setNdper($ndjefi); 
            $idjefia = $mper->selectUsu(); 
            if($idjefia) $idjefi = $idjefia[0]['idper'];
            $ndjefa = $sheet->getCell("O" . $row)->getValue();
            $mper->setNdper($ndjefa); 
            $idjefaa = $mper->selectUsu(); 
            if($idjefaa) $idjefa = $idjefaa[0]['idper'];
            $pass = strtoupper(substr($nomper, 0, 1)).strtolower(substr($apeper, 0, 1)).$ndper."GLQ";
            $pasper = encripta($pass);
            $hash = $pasper['hash'];
            $salt = $pasper['salt'];
            $nombre = nombre($apeper." ".$nomper);
            $txt_mess = "Es un placer darle la bienvenida a nuestra nueva aplicación, diseñada para que pueda solicitar y gestionar sus permisos laborales, como ausentismo o trabajo desde casa. A continuación, le proporcionamos sus credenciales de acceso:<br><br>
            <li><strong>Usuario: </strong>".$ndper.(($emaper) ? " / ".$emaper : "")."</li>
            <li><strong>Contraseña: </strong>".$pass."</li><br>
            <mark><strong>Importante:</strong></mark><br><br>
            Para garantizar la seguridad de su cuenta, se le solicita el cambio de contraseña la primera vez que inicie sesión.<br><br>
            Para acceder a la aplicación, ingrese en el siguiente enlace: <a href='".$url."'>App Galqui</a><br><br>
            Si tiene alguna pregunta o requiere asistencia, no dude en ponerse en contacto con nosotros.<br><br>
            Agradecemos su confianza y esperamos que disfrute de la nueva experiencia.<br><br>";
    		$mper->setNomper($nomper);
            $mper->setApeper($apeper);
            $mper->setIdvtpd($idvtpd);
            $mper->setNdper($ndper);
            $mper->setEmaper($emaper);
            $mper->setIdvsex($idvsex);
            $mper->setIdvdpt($idvdpt);
            $mper->setCargo($cargo);
            $mper->setUsured($usured);
            $mper->setActper($actper);
            $mper->setIdpef($idpef);
            $mper->setHash($hash);
            $mper->setSalt($salt);
    		$existingData = $mper->selectUsu();
            if($existingData){
                $idper = $existingData[0]['idper'];
                $mper->setIdper($idper);
    		} if($idvsex && $idvdpt && $idvtpd && count($idpefA)==$pf && (!$ndjefi OR ($ndjefi && $idjefi)) && (!$ndjefa OR ($ndjefa && $idjefa))) {
    		    if (!empty($ndper)) {
    		    	if (!$idper) {
    		    		$mper->save();
                        $per = $mper->getOneSPxF($ndper);
                        $mper->setIdper($per[0]['idper']);
                        if($emaper){
                            $c = 0;
                            $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                            while ($exito==2 && $c<$intentos){
                                $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                                sleep(5);
                                $c++;
                        }}
    		    	}else {
    		    		$mper->edit();
                        $mper->delPxF();
                        $mper->delJxP();
    		    	} if($idjefi){
                        $mper->setIdjef($idjefi);
                        $mper->saveJxP(1);
                    } if($idjefa){
                        $mper->setIdjef($idjefa);
                        $mper->saveJxP(2);
                    } if($idpefA){ foreach ($idpefA as $pf) {
                        if($pf){
                            $mper->setIdpef($pf);
                            $mper->savePxF();
                        }
                    }} 
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

    //------------Importar tarjetas-----------
    if ($ope=="cargmt" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
    	$inputFileType = IOFactory::identify($dat);
    	$objReader = IOFactory::createReader($inputFileType);
    	$objPHPExcel = $objReader->load($dat);
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	for ($row = 3; $row <= $highestRow; $row++) {
    		// obtengo el valor de la celda
            $comp = 2;
            $idperrecd = NULL;
            $idperentd = NULL;
            $mper->setIdperrecd($idperrecd);
            $mper->setIdperentd($idperentd);
    		$numtajpar = $sheet->getCell("B" . $row)->getValue();
    		$numtajofi = $sheet->getCell("C" . $row)->getValue();
    		$dpent = $sheet->getCell("D" . $row)->getValue();
            $mper->setNdper($dpent); 
            $idpent = $mper->selectUsu(); 
            $idperent = $idpent[0]['idper']; 
            $dprec = $sheet->getCell("F" . $row)->getValue();
            $mper->setNdper($dprec); 
            $idprec = $mper->selectUsu(); 
            $idperrec = $idprec[0]['idper']; 
    		$fecent = $sheet->getCell("H" . $row)->getValue();
            $fecdev = $sheet->getCell("M" . $row)->getValue();
            if (is_numeric($fecent)) $fecent = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecent)->format('Y-m-d');
            if (is_numeric($fecdev)) $fecdev = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecdev)->format('Y-m-d');
            if($fecdev){
    		    $dpentd = $sheet->getCell("I" . $row)->getValue();
                $mper->setNdper($dpentd); 
                $idpentd = $mper->selectUsu(); 
                $idperentd = $idpentd[0]['idper']; 
                $mper->setIdperentd($idperentd);
    		    $dprecd = $sheet->getCell("K" . $row)->getValue();
                $mper->setNdper($dprecd); 
                $idprecd = $mper->selectUsu(); 
                $idperrecd = $idprecd[0]['idper']; 
                $mper->setIdperrecd($idperrecd);
                if($idperent && $idperrec && $idperentd && $idperrecd) $comp = 1;
            }elseif(!$fecdev){
                if($idperent && $idperrec) $comp = 1;
            }
    		$esttaj = ($fecdev) ? 2 : 1;
            $mper->setNumtajpar($numtajpar);
            $mper->setNumtajofi($numtajofi);
            $mper->setIdperent($idperent);
            $mper->setIdperrec($idperrec);
            $mper->setFecent($fecent);
            $mper->setFecdev($fecdev);
            $mper->setEsttaj($esttaj);
    		$existingData = $mper->selectTaj();
            $idtaj = $existingData[0]['idtaj'];
            $mper->setIdtaj($idtaj);
    		if($comp==1 && (!empty($numtajpar) OR !empty($numtajofi))) {
    			if ($existingData[0]['sum'] == 0) $mper->saveTajXls();
    			else $mper->EditTajXls();
    		}else{
                $reg = $row;
                $row = $highestRow+5;
            }
    	}
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 7000);</script>";
    }

    function nombre($nombre){
        $partesp = explode(" ", $nombre);
        $apefor = ucfirst(strtolower($partesp[0]));
        $nomfor = ucfirst(strtolower($partesp[count($partesp) > 2 ? 2 : 1]));
        return $nomfor." ".$apefor;
    }
?>