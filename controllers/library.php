<?php

//------------Titulos-----------
function titulo($ico, $tit, $mos, $pg){
	if($_SESSION['idpef']==3 && $pg==51) $tit = "Asignaciones";
	if($_SESSION['idpef']==3 && $pg==53) $tit = "Datos Personales";
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
				$txt .= '<i class="fa-solid fa-circle-minus" id="menos" onclick="ocul(' . $mos . ',0);"></i>';
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
function modalChk($nm, $id, $tit, $mods, $dps, $pg){
	$mpef = new Mpef();
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #000;font-weight: bold !important;"><strong>Páginas - ' . $tit . '</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
						if ($mods) { foreach ($mods as $md) {
							$mpef->setIdmod($md['idmod']);
							$pgmd = $mpef->getPagMod();
							$txt .= '<div class="form-group col-sm-12" style="text-align: left !important;"><strong>'.$md['nommod'].':</strong></div>';
							if($pgmd){ foreach($pgmd AS $pm){
								$txt .= '<div class="form-group col-sm-6" style="text-align: left !important;">';
			                    	$txt .= '<input type="checkbox" name="idpag[]" value="'.$pm['idpag'].'"';
									if ($dps){ foreach($dps as $dp){ if($pm['idpag'] == $dp['idpag']) $txt .= ' checked ';}}
									$txt .= '> '.$pm['nompag'].' ';
									$txt .= '<i class="' . $pm['icono'] . '" style="color: #073663;"></i>';
								$txt .= '</div>';
							}}
						}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savepxp" name="ope">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idpef">';
						$txt .= '<input type="submit" class="btn btn-primary btnmd" value="Guardar">';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</form>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vpmod, perfil-----------
function modalPef($info) {
    $txt = '';
	$txt .= '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="" aria-hidden="true">';
		$txt .= '<div class="modal-dialog modal-dialog-centered">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #000;font-weight: bold !important;"><strong>'.$info[0]['nommod'].'</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form action="pmod.php" method="POST" id="perfilForm">';
					$txt .= '<div class="modal-body">';
						$txt .= '<label for="idpef">Ingresar con perfil de:</label>';
						$txt .= '<select name="idpef" id="idpef" class="form form-select" onchange="document.getElementById(\'perfilForm\').submit();">';
							$txt .= '<option value="0">Seleccione un perfil...</option>';
							if ($info) { foreach ($info as $i) $txt .= '<option value="'.$i['idpef'].'">'.$i['nompef'].'</option>';}
						$txt .= '</select>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="dircc" name="ope">';
						$txt .= '<input type="hidden" value="'.$info[0]['idmod'].'" name="idmod">';
					$txt .= '</div>';
				$txt .= '</form>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vpef, pefxmod-----------
function modalPxM($nm, $id, $tit, $mods, $pfxmd, $pg){
	$mpef = new Mpef();
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #000;font-weight: bold !important;"><strong>Páginas iniciales - ' . $tit . '</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
						if ($mods) { foreach ($mods as $md) {
								$mpef->setIdmod($md['idmod']);
								$pgmd = $mpef->getPagMod();
								$txt .= '<div class="form-group col-sm-6" style="text-align: left !important;">';
									$txt .= $md['nommod'].":";
									$txt .= '<select name="idpag[]" id="idpag" class="form form-select">';
										$txt .= '<option value="0">Sin acceso...</option>';
									if ($pgmd){ foreach($pgmd as $pm){
										$txt .= '<option value="'.$pm['idpag'].'"';
										if ($pfxmd){ foreach($pfxmd as $fm){ if($pm['idpag'] == $fm['idpag']) $txt .= ' selected ';}}
										$txt .= '>'.$pm['nompag'].'</option>';
									}}
									$txt .= '</select>';
								$txt .= '</div>';
								$txt .= '<input type="hidden" value="'.$md['idmod'].'" name="idmod[]">';
							}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savepxm" name="ope">';
						$txt .= '<input type="hidden" value="'.$id.'" name="idpef">';
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
function modalCmb($nm, $id, $tit, $pef, $dga, $pg){
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="text-align: left;"><strong>PERFILES - ' . $tit . '</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
							if ($pef) { foreach ($pef as $pf) {
								$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
									$txt .= '<input type="checkbox" name="idpef[]" value="'.$pf['idpef'].'"';
									if ($dga){ foreach($dga as $dg){ if($pf['idpef'] == $dg['idpef']) $txt .= ' checked ';}}
									$txt .= '> '.$pf['nompef'].' ';
								$txt .= '</div>';
							}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savepxf" name="ope">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idper">';
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
							if($prgs){ foreach($prgs AS $pr) $txt .= '<tr><td><strong>'.$pr['nomdom'].': </strong></td><td class="infpc">'.$pr['nomval'].' '.$pr['verprg'].'</td></tr>';}
							$txt .= '<tr><td style="display: flex;"><strong>Procesador: </strong></td><td class="infpc">'.$info[0]["procs"].'</td></tr>';
							$txt .= '<tr><td><strong>RAM: </strong></td><td class="infpc">'.$info[0]["ram"].' GB</td></tr>';
							$txt .= '<tr><td><strong>Almacenamiento: </strong></td><td class="infpc">';
							if($info[0]["capgb"]>=1000){
								$frmt = $info[0]["capgb"]/1000;
								$txt .= number_format($frmt,1,".",",").' TB</td></tr>';
							}
							else $txt .= $info[0]["capgb"].' GB</td></tr>';
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

//------------Modal vasg, firma-----------
function modalFir($nm, $id, $det, $pg, $asg) {
    $prs = NULL;
    $est = NULL;
    $txt = '';
    $txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        $txt .= '<div class="modal-dialog">';
            $txt .= '<form id="signature-form' . $id . '" action="home.php?pg=' . $pg . '&asg=' . $asg . '" method="POST">';
                $txt .= '<div class="modal-content">';
                    $txt .= '<div class="modal-header">';
                        $txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>';
                        if (!$det[0]['firent']) {
                            $txt .= $det[0]['prec'];
                            $estfir = 1;
                            $prs = "asg";
                        } elseif ($det[0]['firent']) {
                            $txt .= $det[0]['pentd'];
                            $estfir = 2;
                            $prs = "dev";
                        }
                        $txt .= '</strong></h1>';
                        $txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    $txt .= '</div>';
                    $txt .= '<div class="modal-body" style="text-align: left;">';
                        $txt .= '<div class="fir" style="text-align: center;">';
                            $txt .= '<canvas id="signature-pad' . $id . '"></canvas>';
                        $txt .= '</div>';
                        $txt .= '<div style="text-align: left;">';
                            $txt .= '<small><small><br>*Al firmar, acepto la entrega del equipo anteriormente detallado. Me comprometo a su correcto uso y a seguir las políticas de la empresa en cuanto al mantenimiento y cuidado del mismo. Reconozco que soy responsable de este equipo hasta que sea devuelto en condiciones satisfactorias.</small></small>';
                        $txt .= '</div>';
                    $txt .= '</div>';
                    $txt .= '<div class="modal-footer">';
                        $txt .= '<input type="hidden" name="ideqxpr" value="' . $det[0]['ideqxpr'] . '">';
                        $txt .= '<input type="hidden" name="nomfir" value="' . (($det[0]['firent']) ? $det[0]['pentd'] : $det[0]['prec']) . '">';
                        $txt .= '<input type="hidden" name="estexp" value="' . (($det[0]['firent']) ? 2 : 1) . '">';
                        $txt .= '<input type="hidden" name="prs" value="' . $prs . '">';
                        $txt .= '<input type="hidden" name="estfir" value="' . $estfir . '">';
                        $txt .= '<input type="hidden" name="ope" value="firmar">';
                        $txt .= '<input type="hidden" name="firma" id="firma-input' . $id . '">';
                        $txt .= '<button type="button" id="save-button' . $id . '" class="btn btn-primary btnmd">Guardar</button>';
                        $txt .= '<button type="button" id="clear-button' . $id . '" class="btn btn-primary btnmd">Limpiar</button>';
                        $txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
                    $txt .= '</div>';
                $txt .= '</div>';
            $txt .= '</form>';
        $txt .= '</div>';
    $txt .= '</div>';
    $txt .= '<style>
                .fir {
                    border: 1px solid #4F4F4F;
                    border-radius: 3px;
                    width: 100%;
                    height: 200px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                #signature-pad' . $id . ' {
                    border-bottom: 1px solid #000;
                    width: 80%;
                    height: 170px;
                }
            </style>';
    $txt .= '<script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#' . $nm . $id . '").on("shown.bs.modal", function () {
                const canvas = document.getElementById("signature-pad' . $id . '");
                const context = canvas.getContext("2d");
				context.lineWidth = 2;
                const signatureInput = document.getElementById("firma-input' . $id . '");
                const clearButton = document.getElementById("clear-button' . $id . '");
                const saveButton = document.getElementById("save-button' . $id . '");
                let drawing = false;

                const getMousePos = (canvas, evt) => {
                    const rect = canvas.getBoundingClientRect();
                    return {
                        x: (evt.clientX - rect.left) * (canvas.width / rect.width),
                        y: (evt.clientY - rect.top) * (canvas.height / rect.height)
                    };
                };

                const getTouchPos = (canvas, evt) => {
                    const rect = canvas.getBoundingClientRect();
                    return {
                        x: (evt.touches[0].clientX - rect.left) * (canvas.width / rect.width),
                        y: (evt.touches[0].clientY - rect.top) * (canvas.height / rect.height)
                    };
                };

                const draw = (pos) => {
                    if (drawing) {
                        context.lineTo(pos.x, pos.y);
                        context.stroke();
                    }
                };

                const startDrawing = (pos) => {
                    drawing = true;
                    context.beginPath();
                    context.moveTo(pos.x, pos.y);
                };

                const stopDrawing = () => {
                    drawing = false;
                    context.closePath();
                };

                canvas.addEventListener("mousedown", function(e) {
                    startDrawing(getMousePos(canvas, e));
                });

                canvas.addEventListener("mousemove", function(e) {
                    if (drawing) {
                        draw(getMousePos(canvas, e));
                    }
                });

                canvas.addEventListener("mouseup", stopDrawing);
                document.addEventListener("mouseup", stopDrawing);

                canvas.addEventListener("touchstart", function(e) {
                    e.preventDefault();
                    startDrawing(getTouchPos(canvas, e));
                });

                canvas.addEventListener("touchmove", function(e) {
                    e.preventDefault();
                    draw(getTouchPos(canvas, e));
                });

                canvas.addEventListener("touchend", stopDrawing);
                canvas.addEventListener("touchcancel", stopDrawing);

                clearButton.addEventListener("click", function(event) {
                    event.preventDefault();
                    context.clearRect(0, 0, canvas.width, canvas.height);
                });

                saveButton.addEventListener("click", function(event) {
                    if (context.getImageData(0, 0, canvas.width, canvas.height).data.every(pixel => pixel === 0)) {
                        alert("Por favor, dibuja tu firma.");
                        event.preventDefault();
                    } else {
                        const dataURL = canvas.toDataURL("image/png");
                        signatureInput.value = dataURL;
                        document.getElementById("signature-form' . $id . '").submit();
                    }
                });

                $("#' . $nm . $id . '").on("hidden.bs.modal", function () {
                    context.clearRect(0, 0, canvas.width, canvas.height);
                });
            });
        });
    </script>';
    echo $txt;
}
//------------Modal vasg, devolucion-----------
function modalDev($nm, $id, $acc, $det, $pg, $asg){
	$hoy = date("Y-m-d");
	$txt = '';
	$txt .= '<div class="modal fade" id="'.$nm.$id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg='.$pg.'&asg='.$asg.'" method="POST">';
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
								if($det[0]['idvtpeq']!=8) $txt .= strtoupper($det[0]['tpe']).' '.$det[0]['marca'].' '.$det[0]['modelo'];
								else $txt .= $det[0]['marca'].' '.strtoupper($det[0]['tpe']).' '.$det[0]['modelo'];
							$txt .= '</div>';
							if($acc){
								$txt .= '<strong><br>Accesorios:</strong><hr>';
								foreach($acc AS $ac) $txt .= '<div class="form-group col-md-6">- '.$ac['nomval'].'</div>';
							}
							$txt .= '<strong><br>Devolución:</strong><hr>';
							$txt .= '<div class="form-group col-md-6">';
								$txt .= '<label for="fecdev" class="titulo"><strong>Devolución: </strong></label>';
								$txt .= '<input class="form-control" max='.$hoy.' type="date" id="fecdev" name="fecdev" value="'.$hoy.'" required>';
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
						$txt .= '<input type="hidden" value="'.$det[0]['idequ'].'" name="idequ">';
						$txt .= '<input type="hidden" value="dev" name="ope">';
						$txt .= '<input type="hidden" value="3" name="estexp">';
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
							if($prgs){ foreach($prgs AS $pr) $txt .= '<div class="form-group col-md-6"><strong>'.$pr['nomdom'].': </strong>'.$pr['nomval'].' '.$pr['verprg'].'</div>';
						}}
						if($asg=="cel"){
							$txt .= '<big><strong>Plan</strong></big><hr>';
							$txt .= '<div class="form-group col-md-6"><strong>Número: </strong>'.(($det[0]["numcel"]!=0) ? $det[0]["numcel"] : 'N/A').'</div>';
							$txt .= '<div class="form-group col-md-6"><strong>Operador: </strong>'.$det[0]["operador"].'</div>';
						}
						if($acc){
							$txt .= '<big><br><strong>Accesorios</strong></big><hr>';
							foreach($acc AS $ac) $txt .= '<div class="form-group col-md-6">- '.$ac['nomval'].'</div>';}
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
									$txt .= 'onkeypress="return solonum(event);">';
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
								$txt .= '<label for="fecent" class="titulo"><strong>Entrega</strong></label>';
								$txt .= '<input class="form-control" max='.$hoy.' type="date" id="fecent" name="fecent"';
									if ($dtj && $dtj[0]['fecent']) $txt .= ' value="'.$dtj[0]['fecent'].'" disabled';
									else $txt .= ' value="'.$hoy.'" required';
								$txt .= '>';
							$txt .= '</div> ';
							$txt .= '<div class="form-group col-md-6" style="text-align: left;">';
								$txt .= '<label for="fecdev" class="titulo"><strong>Devolución</strong></label>';
								$txt .= '<input class="form-control" max='.$hoy.' type="date" id="fecdev" name="fecdev"'.((!$dtj) ? ' disabled' : '').'>';
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
											if($dta['numtajofi']) $txt .= "<div class='form-group col-md-12'><strong>B. </strong>".$dta['numtajofi']."</div>";
                    					$txt .= "</small></small></td>";
										$txt .= "<td><small><small>".(($dta['fecdev']) ? $dta['fecdev'] : "")."</small></small></td>";
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

//------------Modal importar, vper/vasg/vequ-----------
function modalImp($nm, $pg, $tit, $ope, $asg){
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $pg . $ope.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg='.$pg.(($pg==51) ? '&asg='.$asg : '');
			$txt .= '" method="POST" enctype="multipart/form-data">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Carga Masiva - '.$tit.'</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body" style="text-align: left;">';
						$txt .= '<label for="arc" style="margin-bottom: 10px"><strong>Cargar archivo Excel:</strong></label>';
						$txt .= '<input class="form-control" type="file" id="arc" name="arc" accept=".xls,.xlsx" required>';
						$txt .= '<small><small><br>*Por favor, asegúrese de subir únicamente archivos con extensión .xls o .xlsx. Estos formatos son específicos de archivos de Excel y son necesarios para garantizar la correcta lectura y procesamiento de los datos.</small></small>';
						if($pg==53) $txt .= '<small><small><br>*Si el archivo contiene muchos registros, el procesamiento puede tardar un poco más de lo habitual. Agradecemos su paciencia.</small></small>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="'.$ope.'" name="ope">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vprm, info permiso-----------
function modalInfPrm($nm, $id, $det){		
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Permiso - '.$det[0]['tprm'].'</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>';
				$txt .= '</div>';
				$txt .= '<div class="modal-body" style="margin: 0px 25px;">';
					$txt .= '<div class="row">';
						$txt .= '<div class="form-group col-md-4"><strong>Solicitado a: </strong></div>';
						$txt .= '<div class="form-group col-md-8">'.$det[0]["njef"].' '.$det[0]["ajef"].'</div>';
						$txt .= '<div class="form-group col-md-4"><strong>Solicitado por: </strong></div>';
						$txt .= '<div class="form-group col-md-8">'.$det[0]["nper"].' '.$det[0]["aper"].'</div>';
						$txt .= '<big><br><strong>Fechas:</strong></big><hr>';
						$txt .= '<div class="form-group col-sm-2"><strong>Desde: </strong></div>';
						$txt .= '<div class="form-group col-sm-10">'.$det[0]["fini"].' - '.$det[0]["hini"].'</div>';
						$txt .= '<div class="form-group col-sm-2"><strong>Hasta: </strong></div>';
						$txt .= '<div class="form-group col-sm-10">'.$det[0]["ffin"].' - '.$det[0]["hfin"].'</div>';
						$txt .= '<div class="form-group col-sm-2"><strong>Tiempo: </strong></div>';
						$txt .= '<div class="form-group col-sm-4">Días: '.$det[0]["ddif"].'</div>';
						$txt .= '<div class="form-group col-sm-6">Horas: '.$det[0]["hdif"].'</div>';
						if($det[0]["desprm"]) $txt .= '<big><br><strong>Descripción:</strong></big><hr><div class="form-group col-md-12">'.$det[0]["desprm"].'</div>';
						if($det[0]["obsprm"]) $txt .= '<big><br><strong>Observaciones:</strong></big><hr><div class="form-group col-md-12">'.$det[0]["obsprm"].'</div>';
						if($det[0]["estprm"] != 1){
							$txt .= '<big><br><strong>Resultado:</strong></big><hr>';
							if($det[0]["estprm"] != 2){
								$txt .= '<div class="form-group col-md-4"><strong>'.(($det[0]["estprm"] == 3) ? 'Aprobado' : 'Rechazado').' por: </strong></div>';
								$txt .= '<div class="form-group col-md-8">'.$det[0]["nrev"].' '.$det[0]["arev"].'</div>';
							}
							$txt .= '<div class="form-group col-md-4"><strong>Solicitud: </strong></div>';
							$txt .= '<div class="form-group col-md-8">'.$det[0]["fsol"].'</div>';
							if($det[0]["estprm"] != 2){
								$txt .= '<div class="form-group col-md-4"><strong>Revisión: </strong></div>';
								$txt .= '<div class="form-group col-md-8">'.$det[0]["frev"].'</div>';
							}
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

//------------Modal vprm, rechazar permiso-----------
function modalRecPrm($nm, $id, $tit){		
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="views/pdfprm.php" method="POST" target="_blank" onsubmit="setTimeout(() => location.reload(), 1000);">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>'.$tit.'</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body" style="text-align: left;">';
						$txt .= '<label for="arc" style="margin-bottom: 10px"><strong>Motivo rechazo:</strong></label>';
						$txt .= '<textarea class="form-control" type="text" id="obsprm" name="obsprm" required></textarea>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="'.$id.'" name="idprm">';
						$txt .= '<input type="hidden" value="'.$_SESSION['idper'].'" name="idrev">';
						$txt .= '<input type="hidden" value="4" name="estprm">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vprm, excel-----------
function modalExport($fi, $ff, $n, $d) {
    $txt = '';
	$txt .= '<div class="modal fade" id="export" tabindex="-1" aria-labelledby="" aria-hidden="true">';
		$txt .= '<div class="modal-dialog modal-dialog-centered">';
			$txt .= '<div class="modal-content">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #000;font-weight: bold !important;"><strong>Exportar excel</strong></h1>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<div class="modal-body">';
					$txt .= '<div>';
                	    $txt .= '<li><a style="color: #000" href="excel/xprm.php?exl=aus&'.(($d) ? "d=".$d."&" : "").(($fi) ? "fi=".$fi."&" : "").(($n) ? "n=".$n."&" : "").(($ff) ? "ff=".$ff : "").'"><big>Ausentismos</big></a></li>';
                	    $txt .= '<li><a style="color: #000" href="excel/xprm.php?exl=prm"><big>Permisos</big></a></li>';
                	$txt .= '</div>';
				$txt .= '</div>';
				$txt .= '<div class="modal-footer">';
				$txt .= '</div>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vper, Cambiar contraseña-----------
function modalCamPass($nm, $id, $tit){	
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="controllers/colv.php" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Cambiar Contraseña'.(($id==$_SESSION['idper']) ? "" : "/".$tit ).'</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body" style="text-align: left;">';
                        $txt .= '<div class="contra">';
                            $txt .= '<label for="pasper" class="labcon"><small><strong>Nueva contraseña: </strong></small></label>';
                            $txt .= '<input class="form-control" type="password" id="pasper'.$id.'" name="pasper" required oninput="comparar('.$id.')">';
                        $txt .= '</div>';
                        $txt .= '<div class="contra">';
                            $txt .= '<label for="newpasper" class="labcon"><small><strong>Confirmar contraseña: </strong></small></label>';
                            $txt .= '<input class="form-control" type="password" id="newpasper'.$id.'" name="newpasper" required oninput="comparar('.$id.')">';
                        $txt .= '</div>';
                        $txt .= '<small><small id="error-message'.$id.'" style="color: red; display: none;"></small></small>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="'.$id.'" name="idper">';
						$txt .= '<input type="hidden" value="changpass" name="ope">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd" id="btncon'.$id.'">Reestablecer</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//------------Modal vlic, llave-----------
function modalLlave($nm, $id, $tit, $cant, $llaves, $pg){
	$txt = '';
	$txt .= '<div class="modal fade" id="' . $nm . $id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<form action="home.php?pg=' . $pg . '" method="POST">';
				$txt .= '<div class="modal-content">';
					$txt .= '<div class="modal-header">';
						$txt .= '<h1 class="modal-title fs-5" id="exampleModalLabel" style="text-align: left;"><strong>LLAVES - ' . $tit . '</strong></h1>';
						$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$txt .= '</div>';
					$txt .= '<div class="modal-body">';
						$txt .= '<div class="row">';
						if ($cant) { for($i=1; $i<=$cant; $i++){
							$txt .= '<div class="form-group col-sm-6" style="text-align: left;">';
								$txt .= '<label><strong>Llave '.$i.':</strong></label>';
								$txt .= '<input class="form-control" type="text" id="llave" name="llave[]" value="';
								if ($llaves && count($llaves)>=$i) $txt .= $llaves[($i-1)]['llave'];
								$txt .= '" required>';
							$txt .= '</div>';
						}}
						$txt .= '</div>';
					$txt .= '</div>';
					$txt .= '<div class="modal-footer">';
						$txt .= '<input type="hidden" value="savelxl" name="ope">';
						$txt .= '<input type="hidden" value="' . $id . '" name="idlic">';
						$txt .= '<button type="submit" class="btn btn-primary btnmd">Guardar</button>';
						$txt .= '<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>';
					$txt .= '</div>';
				$txt .= '</div>';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
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

//------------Formatear fecha-----------
function formatfec($fec){
	$fecha = date('d/m/Y', strtotime($fec));
	return $fecha;
}

//------------Encriptar-----------
function encripta($password) {
    // Generar una sal aleatoria
	$salt = bin2hex(random_bytes(16));
    $iterations = 10000;
    $length = 32; 
	
    // Derivar el hash de la contraseña
    $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, $length);
	
    $pass = [
        'salt' => $salt,
        'hash' => $hash,
    ];
    return $pass; // Devuelve el usuario (en un caso real, guarda en la base de datos)
}