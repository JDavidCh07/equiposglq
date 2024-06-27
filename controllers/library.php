<?php
// require_once("models/mper.php");

//------------Titulos-----------
function titulo($ico, $tit, $mos, $pg){
	$txt = '';
	$txt .= '<div class="titu">';
		$txt .= '<div class="titaju">';
			$txt .= '<i class="' . $ico . '"></i>';
			$txt .= ' ' . $tit;
			$txt .= '<hr class="hrtitu">';
		$txt .= '</div>';
		if ($mos == 1) {
			$txt .= '<div class="titaju" style="float: right;">';
				$txt .= '<i class="fa-solid fa-circle-plus" id="mas" onclick="ocul(' . $mos . ',1);"></i>';
				$txt .= '<i class="fa-solid fa-circle-minus" id="menos" onclick="ocul(' . $mos . ');"></i>';
			$txt .= '</div>';
		}
	$txt .= '</div>';
	echo $txt;
}

//------------Errores try-catch-----------
function ManejoError($e){
	if (strpos($e->getMessage(), '1451')) {
		echo '<script>err("No se puede eliminar este registro. Por que se encuentra relacionado en otra opción.");</script>';
	} elseif (strpos($e->getMessage(), '1062')) {
		echo '<script>err("Registro duplicado. Intente nuevamente con otro número de identificación ó comuníquese con el administrador del sistema.");</script>';
	} else {
		echo '<script>err("Se generó un error comuníquese con el administrador del sistema.");</script>';
	}
}

//------------Modal vpef, pagxpef-----------
function modalChk($nm, $id, $tit, $mt, $pg, $dms){
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="" style="color: #000;font-weight: bold !important;"><strong>Páginas - ' . $tit . '</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
					$txt .= '<div class="modal-body">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idpef">';
						$txt .= '<div class="row">';
							if ($mt) { foreach ($mt as $tm) {
									$txt .= '<div class="form-group col-md-6" style="text-align: left !important;">';
										$pos = strpos($dms, $tm['idpag']);
										$txt .= '<input type="checkbox" name="chk[]" value="' . $tm['idpag'] . '"';
										if ($pos > -1) $txt .= " checked ";
										$txt .= '> ';
										$txt .= $tm['nompag'] . " ";
										$txt .= '<i class="' . $tm['icono'] . '" style="color: #000;"></i>';
									$txt .= '</div>';
							}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savepxp" name="ope">';
						$txt .= '<input type="submit" class="btn btn-primary btnmd" value="Guardar">';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</form>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vper, pefxper-----------
function modalCmb($nm, $id, $tit, $idmod, $pg, $dms){
	$mper = new Mper();
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Perfiles - ' . $tit . '</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idper">';
						$txt .= '<div class="row">';
							if ($idmod) { foreach ($idmod as $dt) {
								$dtpg = $mper->getOnePef($dt['idmod']);
								$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
									$txt .= '<label for="idpef" class="titulo"><strong>' . $dt['nommod'] . ':</strong></label>';
									$txt .= '<input type="hidden" name="idmod[]" value="' . $dt['idmod'] . '">';
									$txt .= '<select name="idpef[]" id="idpef" class="form form-select">';
										$txt .= '<option value="0">Sin perfil</option>';
											if ($dtpg){ foreach ($dtpg as $td) {
												$pos = strpos($dms, $td['idpef']);
												$txt .= '<option value="' . $td['idpef'] . '"';
												if ($pos > -1) $txt .= " selected ";
												$txt .= '>' . $td['nompef'] . '</option>';
											}}
									$txt .= '</select>';
								$txt .= '</div>';
							}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savepxf" name="ope">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vequ, info equipos-----------
function modalDet($nm, $id, $prgs, $info){
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>'.$info[0]['marca'].' '.$info[0]['modelo'].' - '.$info[0]['serialeq'].'</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
				$txt .= '</div>';
				$txt .= '<div class="modal-body" style="margin: 0px 25px;">';
					$txt .= '<div class="row">';
						$txt .= '<table>';
							if($prgs){ foreach($prgs AS $pr){
								$txt .= '<tr><td><strong>'.$pr['nomdom'].': </strong></td><td class="infpc">'.$pr['nomval'].' '.$pr['verprg'].'</td></tr>';
							}}
							$txt .= '<tr><td><strong>Procesador: </strong></td><td class="infpc">'.$info[0]["procs"].'</td></tr>';
							$txt .= '<tr><td><strong>RAM: </strong></td><td class="infpc">'.$info[0]["ram"].' GB</td></tr>';
							$txt .= '<tr><td><strong>Almacenamiento: </strong></td><td class="infpc">';
							if($info[0]["capgb"]>1000){
								$frmt = $info[0]["capgb"]/1000;
								$txt .= number_format($frmt,1,".",",").' TB</td></tr>';
							}
							else $txt .= $info[0]["capgb"].' GB</td></tr>';
							if ($info[0]["tipcon"] && $info[0]["tipcon"]==11){
								if ($info[0]["contrato"]) $txt .= '<tr><td><strong>Contrato: </strong></td><td class="infpc">'.$info[0]["contrato"].' GB</td></tr>';
								if ($info[0]["valrcont"]) $txt .= '<tr><td><strong>Valor contrato: </strong></td><td class="infpc">$'.$info[0]["valrcont"].'</td></tr>';
							}
						$txt .= '</table>';
					$txt .= '</div>';
				$txt .= '</div>';
				$txt .= '<div class="modal-footer">';
					$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vasg, devolucion-----------
function modalDev($nm, $id, $acc, $det, $pg){
	$hoy = date("Y-m-d");
	$pasmañ = date("Y-m-d", strtotime($hoy . ' +3 day'));
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Datos Asignación</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body" style="margin: 0px 25px; text-align: left;">';
						$txt .= '<div class="row">';
							$txt .= '<strong>Entrega:</strong><hr>';
							$txt .= '<div class="form-group col-md-4"><strong>Persona:</strong></div>';
							$txt .= '<div class="form-group col-md-8">'.$det[0]['prec'].' - '.$det[0]['cprec'].'</div>';
							$txt .= '<div class="form-group col-md-4"><strong>Equipo:</strong></div>';
							$txt .= '<div class="form-group col-md-8">';
								if($det[0]['idvtpeq']!=8) $txt .= $det[0]['tpe'].' '.$det[0]['marca'].' '.$det[0]['modelo'];
								else $txt .= $det[0]['marca'].' '.$det[0]['tpe'].' '.$det[0]['modelo'];
							$txt .= '</div>';
							if($acc){
								$txt .= '<strong><br>Accesorios:</strong><hr>';
								foreach($acc AS $ac){
									$txt .= '<div class="form-group col-md-6">- '.$ac['nomval'].'</div>';
								}}
							$txt .= '<strong><br>Devolución:</strong><hr>';
							$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
								$txt .= '<div class="form-group col-md-6">';
									$txt .= '<label for="fecdev" class="titulo"><strong>F. Devolución: </strong></label>';
									$txt .= '<input class="form-control" max='.$pasmañ.' type="date" id="fecdev" name="fecdev" value="'.$hoy.'" required>';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-12">';
									$txt .= '<label for="observd" class="titulo"><strong>Observaciones: </strong></label>';
									$txt .= '<textarea class="form-control" type="text" id="observd" name="observd" required></textarea>';
								$txt .= '</div>';
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<br><div class="modal-footer">';
						$txt .= '<input type="hidden" value="'.$det[0]['idprec'].'" name="idperentd">';
						$txt .= '<input type="hidden" value="'.$det[0]['ideqxpr'].'" name="ideqxpr">';
						$txt .= '<input type="hidden" value="dev" name="ope">';
						$txt .= '<input type="hidden" value="2" name="estexp">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';	
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vasg, info asignacion-----------
function modalInfAsg($nm, $id, $prgs, $acc, $det, $asg){		
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>'.$det[0]['prec']." - ".$det[0]['marca'].' '.$det[0]['modelo'].'</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
				$txt .= '</div>';
				$txt .= '<div class="modal-body" style="margin: 0px 25px;">';
					$txt .= '<div class="row">';
						if($asg=="equ"){
							$txt .= '<big><strong>Programas</strong></big><hr>';
							if($prgs){ foreach($prgs AS $pr)
								$txt .= '<div class="form-group col-md-6"><strong>'.$pr['nomdom'].': </strong>'.$pr['nomval'].' '.$pr['verprg'].'</div>';
						}}
						if($asg=="cel"){
							$txt .= '<big><strong>Plan</strong></big><hr>';
							$txt .= '<div class="form-group col-md-6"><strong>Número: </strong>'.$det[0]["numcel"].'</div>';
							$txt .= '<div class="form-group col-md-6"><strong>Operador: </strong>'.$det[0]["operador"].'</div>';
						}
						if($acc){
							$txt .= '<big><br><strong>Accesorios</strong></big><hr>';
							foreach($acc AS $ac){
								$txt .= '<div class="form-group col-md-6">- '.$ac['nomval'].'</div>';
						}}
						$txt .= '<big><br><strong>Asignación</strong></big><hr>';
						$txt .= '<div class="form-group col-md-4"><strong>Entrega: </strong></div>';
						$txt .= '<div class="form-group col-md-8">'.$det[0]["pent"].' - '.$det[0]["cpent"].'</div>';
						$txt .= '<div class="form-group col-md-4"><strong>Recibe: </strong></div>';
						$txt .= '<div class="form-group col-md-8">'.$det[0]["prec"].' - '.$det[0]["cprec"].'</div>';
						if($det[0]["observ"]) $txt .= '<div class="form-group col-md-12"><br><strong>Observación: </strong><br>'.$det[0]["observ"].'</div>';
						if($det[0]["pentd"] && $det[0]["precd"]){
							$txt .= '<big><br><strong>Devolución</strong></big><hr>';
							$txt .= '<div class="form-group col-md-4"><strong>Entrega: </strong></div>';
							$txt .= '<div class="form-group col-md-8">'.$det[0]["pentd"].' - '.$det[0]["cpentd"].'</div>';
							$txt .= '<div class="form-group col-md-4"><strong>Recibe: </strong></div>';
							$txt .= '<div class="form-group col-md-8">'.$det[0]["precd"].' - '.$det[0]["cprecd"].'</div>';
							if($det[0]["observd"]) $txt .= '<div class="form-group col-md-12"><br><strong>Observación: </strong><br>'.$det[0]["observd"].'</div>';
						}
					$txt .= '</div>';
				$txt .= '</div>';
				$txt .= '<br><div class="modal-footer">';
					$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vequ, prgxequi-----------
function modalPxE($nm, $id, $tit, $dom, $pg, $dms, $dga){
	$mequ = new Mequ();
	$i = 0;
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>'.$tit.'</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
							if ($dom) { foreach ($dom as $dom) {
								$dtpg = $mequ->getOnePrg($dom['iddom']);
								$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
									$txt .= '<label for="idvprg" class="titulo"><strong>' . $dom['nomdom'] . ':</strong></label>';
									$txt .= '<input type="hidden" name="idequ" value="' . $id . '">';
									$txt .= '<select name="idvprg[]" id="idvprg" class="form form-select">';
										$txt .= '<option value="0">Sin licencia</option>';
											if ($dtpg){ foreach ($dtpg as $td) {
												$pos = strpos($dms, $td['idval']);
												$txt .= '<option value="' . $td['idval'] . '"';
												if ($pos > -1) $txt .= " selected ";
												$txt .= '>' . $td['nomval'] . '</option>';
											}}
									$txt .= '</select>';
								$txt .= '</div>';
								$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
									$txt .= '<label for="verprg" class="titulo"><strong>Versión:</strong></label>';
									$txt .= '<input class="form-control" type="text" id="verprg" name="verprg[]" ';
										if ($dga){ 
											$txt .= 'value="' . $dga[$i]['verprg'] . '"';
											$i++;
										}
									$txt .= 'onkeypress="return solonum(event);" required>';
								$txt .= '</div> ';
							}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idper">';
						$txt .= '<input type="hidden" value="savepxe" name="ope">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vper, tajxper-----------
function modalTj($nm, $id, $perent, $pg){
	$mper = new Mper();
	$dtj = NULL;
	$dtj = $mper->getOneTaj($id);
	$datj = $mper->getAllTajPer($id);
	$hoy = date("Y-m-d");
	$pasmañ = date("Y-m-d", strtotime($hoy . ' +3 day'));
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Asignar tarjetas</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
							$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
								$txt .= '<label for="numtajpar" class="titulo"><strong>N° T. Parque:</strong></label>';
								$txt .= '<input class="form-control" type="text" id="numtajpar" name="numtajpar"';
								if ($dtj && $dtj[0]['numtajpar']) $txt .= ' value="'.$dtj[0]['numtajpar'].'" disabled';
								$txt .= '>';
							$txt .= '</div> ';
							$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
								$txt .= '<label for="numtajofi" class="titulo"><strong>N° T. Bodega:</strong></label>';
								$txt .= '<input class="form-control" type="text" id="numtajofi" name="numtajofi"';
									if ($dtj && $dtj[0]['numtajofi']) $txt .= ' value="'.$dtj[0]['numtajofi'].'" disabled';
								$txt .= '>';
							$txt .= '</div> ';
							$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
								$txt .= '<label for="fecent" class="titulo"><strong>F. Entrega</strong></label>';
								$txt .= '<input class="form-control" max='.$pasmañ.' type="date" id="fecent" name="fecent"';
									if ($dtj && $dtj[0]['fecent']) $txt .= ' value="'.$dtj[0]['fecent'].'" disabled';
									else $txt .= ' value="'.$hoy.'" required';
								$txt .= '>';
							$txt .= '</div> ';
							$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
								$txt .= '<label for="fecdev" class="titulo"><strong>F. Devolución</strong></label>';
								$txt .= '<input class="form-control" max='.$pasmañ.' type="date" id="fecdev" name="fecdev"';
									if(!$dtj) $txt .= ' disabled';
								$txt .= '>';
							$txt .= '</div>';
						$txt .= '</div><br>';
						if ($datj){
							$txt .= '<table id="mytable" class="table table-striped" style="width:100%; text-align: left">';	
								$txt .= "<thead>";
									$txt .= "<tr>";
										$txt .= "<th><small><small>Número</small></small></th>";
										$txt .= "<th><small><small>Devolución</small></small></th>";
									$txt .= "<tr>";
								$txt .= "<thead>";
								$txt .= "<tbody>";
								foreach ($datj as $dta) { 
									$txt .= "<tr>";
                    					$txt .= "<td><small><small>";
											if($dta['numtajpar']) $txt .= "<div class='form-group col-md-12'><strong>P. </strong>".$dta['numtajpar']."</div>";
											if($dta['numtajofi'])$txt .= "<div class='form-group col-md-12'><strong>B. </strong>".$dta['numtajofi']."</div>";
                    					$txt .= "</small></small></td>";
										$txt .= "<td><small><small>";
											if($dta['fecdev'])$txt .= $dta['fecdev'];
                    					$txt .= "</small></small></td>";
									$txt .= "</tr>";
								}
								$txt .= "</tbody>";
							$txt .= "</table>";
						}
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
					$txt .= '<input type="hidden" value="savetxp" name="ope">';
						if (!$dtj){
							$txt .= '<input type="hidden" value="'.$perent.'" name="idperent">';
							$txt .= '<input type="hidden" value="'.$id.'" name="idperrec">';
						}else{
							$txt .= '<input type="hidden" value="'.$id.'" name="idperentd">';
							$txt .= '<input type="hidden" value="'.$perent.'" name="idperrecd">';
							$txt .= '<input type="hidden" value="'.$dtj[0]['idtaj'].'" name="idtaj">';
						}
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Array-string vpef, pagxpef-----------
function arrstr($dt){
	$txt = "";
	if ($dt) {
		foreach ($dt as $d) {
			$txt .= $d['idpag'] . ",";
		}
	}
	return $txt;
}

//------------Array-string vequ, prgxequi-----------
function arrstrprg($dt){
	$txt = "";
	if ($dt) {
		foreach ($dt as $d) {
			$txt .= $d['prg'] . ",";
		}
	}
	return $txt;
}
