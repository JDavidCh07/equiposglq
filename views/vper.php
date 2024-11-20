<?php
require_once('controllers/cper.php');
if($_SESSION['idpef']!=3){ ?>

<div style="text-align: right;">
    <i class="fa fa-solid fa-file-import fa-2x imp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod<?= $pg ?>cargm" title="Importar Personal"></i>
    <?php modalImp("mod", $pg, "Personas", "cargm", "");
    if ($_SESSION['idpef'] == 2) { ?>
        <i class="fa fa-solid fa-file-import fa-2x imp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod<?= $pg ?>cargmt" title="Importar Tarjetas"></i>
        <?php modalImp("mod", $pg, "Tarjetas asignadas", "cargmt", ""); ?>
        <a href="excel/xtaj.php" title="Exportar Tarjetas">
            <i class="fa fa-solid fa-file-export fa-2x ext"></i>
        </a>
    <?php } ?>
</div>
<?php } ?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="nomper"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomper" name="nomper" value="<?php if ($datOne) echo $datOne[0]['nomper']; ?>" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
        </div>
        <div class="form-group col-md-4">
            <label for="apeper"><strong>Apellido:</strong></label>
            <input class="form-control" type="text" id="apeper" name="apeper" value="<?php if ($datOne) echo $datOne[0]['apeper']; ?>" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
        </div>
        <div class="form-group col-md-4">
            <label for="idvsex"><strong>Sexo:</strong></label>
            <select name="idvsex" id="idvsex" class="form-control form-select" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
                <?php foreach ($datsex as $dts) { ?>
                    <option value="<?= $dts['idval']; ?>" <?php if ($datOne && $dts['idval'] == $datOne[0]['idvsex']) echo " selected "; ?>>
                        <?= $dts['nomval']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label><strong>Documento:</strong></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="idvtpd" id="idvtpd" class="form-control form-select" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
                        <?php foreach ($dattpd as $dtt) { ?>
                            <option value="<?= $dtt['idval']; ?>" <?php if ($datOne && $dtt['idval'] == $datOne[0]['idvtpd']) echo " selected "; ?>>
                                <?= $dtt['nomval']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input class="form-control" type="text" id="ndper" name="ndper" value="<?php if ($datOne) echo $datOne[0]['ndper']; ?>" onkeypress="return solonum(event);" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="apeper"><strong>Correo Electrónico:</strong></label>
            <input class="form-control" type="email" id="emaper" name="emaper" value="<?php if ($datOne) echo $datOne[0]['emaper']; ?>" <?php if($_SESSION['idpef']==3) echo " disabled "?>>
        </div>
        <div class="form-group col-md-4">
            <label for="idvdpt"><strong>Departamento:</strong></label>
            <select name="idvdpt" id="idvdpt" class="form-control form-select" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
                <?php foreach ($datdpt as $dtd) { ?>
                    <option value="<?= $dtd['idval']; ?>" <?php if ($datOne && $dtd['idval'] == $datOne[0]['idvdpt']) echo " selected "; ?>>
                        <?= $dtd['nomval']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="cargo"><strong>Cargo:</strong></label>
            <input class="form-control" type="text" id="cargo" name="cargo" value="<?php if ($datOne) echo $datOne[0]['cargo']; ?>" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
        </div>
        <?php if($_SESSION['idpef']!=3){ for($i=0; $i<=1; $i++){ ?>
            <div class="form-group col-md-4 ui-widget">
                <label for="idjef"><strong>Jefe <?php if($i==0) echo "Inmediato"; else echo "Area";?></strong></label>
                <select id="combobox<?php ($i+1)?>" name="idjef[]" class="form-control form-select" <?php if($i==0) echo "required";?>>
                    <option value="0"></option>
                    <?php if ($datPer) { foreach ($datPer as $dpr) { ?>
                            <option value="<?= $dpr['idper']; ?>" <?php if ($datJxP){ foreach ($datJxP AS $dtj) { if($dpr['idper'] == $dtj['idjef'] && $dtj['tipjef'] == ($i+1)) echo " selected "; }}?>>
                                <?= $dpr['nomper']." ".$dpr['apeper']; ?>     
                            </option>
                    <?php }} ?>
                </select>
            </div>
        <?php }} ?>
        <div class="form-group col-md-4">
            <label for="usured"><strong>Red:</strong></label>
            <input class="form-control" type="text" id="usured" name="usured" value="<?php if ($datOne) echo $datOne[0]['usured']; ?>" <?php if($_SESSION['idpef']==3) echo " disabled "?>>
        </div>
        <?php if ($_SESSION['idpef'] != 3) { ?>
            <div class="form-group col-md-4">
                <label for="actper" class="titulo"><strong>Activo:</strong></label>
                <select name="actper" id="actper" class="form-control form-select" required <?php if($_SESSION['idpef']==3) echo " disabled "?>>
                    <option value="1" <?php if ($datOne && $datOne[0]['actper'] == 1) echo " selected "; ?>>Si</option>
                    <option value="2" <?php if ($datOne && $datOne[0]['actper'] == 2) echo " selected "; ?>>No</option>
                </select>
            </div>
        <?php }
        if ($datOne && $_SESSION['idpef'] == 3) { ?>
            <div class="form-group col-md-4">
                <label for="pasper"><strong>Contraseña:</strong></label>
                <input class="form-control" type="password" value="**********" <?php if($_SESSION['idpef']==3) echo " disabled "?>>
                <span class="txtcontra" data-bs-toggle="modal" data-bs-target="#pass<?=$_SESSION['idper']?>">(Cambiar contraseña)</span>                   
            </div>
        <?php } ?>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <?php if($_SESSION['idpef'] != 3){ ?>
                <input class="btn btn-primary" type="submit" value="Registrar">
                <input type="hidden" name="ope" value="save">
            <?php } ?>
            <input type="hidden" name="idper" value="<?php if ($datOne) echo $datOne[0]['idper']; ?>">
        </div>
    </div>
</form>

<?php if($_SESSION['idpef']!=3){ ?>
<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Datos personales</th>
            <?php if ($_SESSION['idpef'] != 3) { ?>
                <th>Estado</th>
            <?php } ?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <BIG><strong><?= $dta['apeper'] . " " . $dta['nomper'] ?><br></strong></BIG>
                                <strong><?= $dta['doc'] . ". " . $dta['ndper'] ?></strong>
                                <small>
                                    <div class="row">
                                        <?php 
                                        $mper->setIdper($dta['idper']);
                                        $jef = $mper->getOneJxP();
                                        $dtj = NULL;
                                        if($jef && $jef[0]['tipjef']==1){
                                            $mper->setIdper($jef[0]['idjef']);
                                            $dtj = $mper->getOne();
                                        } if ($dta['emaper']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>Email: </strong> <?= $dta['emaper']; ?>
                                            </div>
                                        <?php } if ($dta['usured']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>Red: </strong> <?= $dta['usured']; ?>
                                            </div>
                                        <?php } if ($dta['cargo']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>Cargo: </strong> <?= $dta['cargo']; ?>
                                            </div>
                                        <?php } if ($dta['idvdpt']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>Dpto: </strong> <?= $dta['dpt']; ?>
                                            </div>
                                        <?php } if ($dtj) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>Jefe: </strong> <?= explode(' ', $dtj[0]['nomper'])[0] . " " . explode(' ', $dtj[0]['apeper'])[0]; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </small>
                            </div>
                        </div>
                    </td>
                    <?php if ($_SESSION['idpef'] != 3) { ?>
                        <td style="text-align: left;">
                            <?php if ($dta['actper'] == 1) { ?>
                                <span style="font-size: 1px;opacity: 0;">+</span>
                                <a href="home.php?pg=<?= $pg; ?>&idper=<?= $dta['idper']; ?>&actper=2&ope=act" title="Activa">
                                    <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                                </a>
                            <?php } else { ?>
                                <span style="font-size: 1px;">--</span>
                                <a href="home.php?pg=<?= $pg; ?>&idper=<?= $dta['idper']; ?>&actper=1&ope=act" title="Inactiva">
                                    <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                                </a>
                            <?php } ?>
                        </td>
                    <?php } ?>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idper=<?= $dta['idper']; ?>&ope=edi" title="Editar">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                        </a>
                        <?php if ($_SESSION['idpef'] == 2) { 
                            $mper->setIdper($dta['idper']);
                            $i = $mper->getOne();
                            $dga = $mper->getOnePxF();
                            $pef = $mper->getPef();
                            $info = $i[0];
                            modalCmb("mcb", $dta['idper'], $dta['nomper'] . " " . $dta['apeper'], $pef, $dga, $pg);
                            modalCamPass("contra", $info['idper'], $info['nomper'] . " " . $info['apeper']);
                            modalTj("tj",  $dta['idper'], $_SESSION['idper'], $pg);
                            ?>
                            <i class="fa fa-solid fa-id-card-clip fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcb<?= $dta['idper']; ?>" title="Asignar perfil"></i>
                            <i class="fa fa-solid fa-tarp fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tj<?= $dta['idper']; ?>" title="Asignar tarjetas"></i>
                            <i class="fa fa-solid fa-key fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contra<?= $info['idper']; ?>" title="Cambiar Contraseña"></i>
                            <?php
                            $pe = $mper->getExPE($dta['idper']);
                            $pr = $mper->getExPR($dta['idper']);
                            $pf = $mper->getPFxP($dta['idper']);
                            if ($pe && $pr && $pf && $pe[0]['can'] == 0 && $pr[0]['can'] == 0 && $pf[0]['can'] == 0) { ?>
                                <a href="home.php?pg=<?= $pg; ?>&idper=<?= $dta['idper']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomper'] . ' ' . $dta['apeper']; ?>');" title="Eliminar">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                                </a>
                        <?php }
                        } ?>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Datos personales</th>
            <?php if ($pg == 102) { ?>
                <th>Estado</th>
            <?php } ?>
            <th></th>
        </tr>
    </tfoot>
</table>
<?php } ?>
<div class="modal fade" id="pass<?=$_SESSION['idper']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<form action="controllers/colv.php" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Cambiar Contraseña</strong></h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" style="text-align: left;">
                    <div class="contra">
                        <label for="pasper" class="labcon"><small><strong>Nueva contraseña: </strong></small></label>
                        <input class="form-control" style="margin-right: 10px;" type="password" id="pasper<?=$_SESSION['idper']?>" name="pasper" required oninput="comparar(<?=$_SESSION['idper']?>)">
					    <i id="vpass<?=$_SESSION['idper']?>" class="fas fa-eye" onclick="verpass('pasper', 'vpass', <?=$_SESSION['idper']?>)"></i>
                    </div>
                    <div class="contra">
                        <label for="newpasper" class="labcon"><small><strong>Confirmar contraseña: </strong></small></label>
                        <input class="form-control" style="margin-right: 10px;" type="password" id="newpasper<?=$_SESSION['idper']?>" name="newpasper" required oninput="comparar(<?=$_SESSION['idper']?>)">
                        <i id="vpassc<?=$_SESSION['idper']?>" class="fas fa-eye" onclick="verpass('newpasper', 'vpassc', <?=$_SESSION['idper']?>)"></i>
                    </div>
                    <small><small id="error-message<?=$_SESSION['idper']?>" style="color: red; display: none;"></small></small>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="<?=$_SESSION['idper']?>" name="idper">
					<input type="hidden" value="changpass" name="ope">
					<button type="submit" class="btn btn-primary btnmd" id="btncon<?=$_SESSION['idper']?>">Reestablecer</button>
					<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<style>
    .custom-combobox1,
    .custom-combobox2 {
        position: relative;
        display: inline-block;
        width: 100%;
        text-align: left;
    }

    .custom-combobox1-toggle,
    .custom-combobox2-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox1-input,
    .custom-combobox2-input {
        margin: 0;
        padding: 5px 10px;
        width: 100%;
        text-align: left;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }
</style>