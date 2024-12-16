<?php
include('controllers/clic.php');
?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-3">
            <label><strong>Proveedor:</strong></label>
            <select name="idprv" id="idprv" class="form-control form-select" required>
                <?php foreach ($datPrv as $dpv) { ?>
                    <option value="<?= $dpv['idprv']; ?>" <?php if ($datOne && $dpv['idprv'] == $datOne[0]['idprv']) echo " selected "; ?>>
                        <?= $dpv['nomprv']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label><strong>Programa:</strong></label>
            <select name="idprg" id="idprg" class="form-control form-select" required>
                <?php foreach ($datPrg as $dpg) { ?>
                    <option value="<?= $dpg['idprg']; ?>" <?php if ($datOne && $dpg['idprg'] == $datOne[0]['idprg']) echo " selected "; ?>>
                        <?= $dpg['nomprg']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="nomlic"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomlic" name="nomlic" value="<?php if ($datOne) echo $datOne[0]['nomlic']; ?>" required>
        </div>
        <div class="form-group col-md-3">
            <label><strong>Tipo:</strong></label>
            <select name="idvtlic" id="idvtlic" class="form-control form-select" required>
                <?php foreach ($datTpl as $dtl) { ?>
                    <option value="<?= $dtl['idval']; ?>" <?php if ($datOne && $dtl['idval'] == $datOne[0]['idvtlic']) echo " selected "; ?>>
                        <?= $dtl['nomval']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="feccom"><strong>Compra:</strong></label>
            <input class="form-control" type="date" id="feccom" name="feccom" max=<?php echo $hoy;?> <?php if ($datOne) echo 'value="'.$datOne[0]['feccom'].'"'; else echo 'value="'.$hoy.'"';?>>
        </div>
        <div class="form-group col-md-3">
            <label for="fecven"><strong>Vencimiento:</strong></label>
            <input class="form-control" type="date" id="fecven" name="fecven" min=<?php echo $mañana;?> value="<?php if ($datOne) echo $datOne[0]['fecven']; else echo $mañana; ?>" required>
        </div>
        <div class="form-group col-md-3">
            <label for="costo"><strong>Costo:</strong></label>
            <input class="form-control" type="text" id="costo" name="costo" value="<?php if ($datOne) echo $datOne[0]['costo']; ?>" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-3">
            <label for="clvlic"><strong>Llave:</strong></label>
            <input class="form-control" type="text" id="clvlic" name="clvlic" value="<?php if ($datOne) echo $datOne[0]['clvlic']; ?>">
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idlic" value="<?php if ($datOne) echo $datOne[0]['idlic']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Licencia</th>
            <th>Estado</th>
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
                                <big><strong>
                                    <?= $dta['nomprg']." ".$dta['nomlic']." (".$dta['nomtip'].")"; ?>
                                </strong></big>
                            </div>
                            <?php if ($dta['feccom']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Compra: </strong> <?= formatfec($dta['feccom']); ?>
                                </div>
                            <?php } if ($dta['fecven']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Vencimiento: </strong> <?= formatfec($dta['fecven']); ?>
                                </div>
                            <?php } if ($dta['idprv']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Proveedor: </strong> <?= $dta['nomprv']; ?>
                                </div>
                            <?php } if ($dta['costo']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Costo: </strong>$ <?= number_format($dta['costo'], 0, ',', '.'); ?>
                                </div>
                            <?php } if ($dta['clvlic']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Llave: </strong> <?= $dta['clvlic']; ?>
                                </div>
                            <?php } if ($dta['idper']) { ?>
                                <div class="form-group col-md-6">
                                    <strong>Usuario: </strong> <?= explode(" ", $dta['nomper'])[0]." ".explode(" ", $dta['apeper'])[0]; ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <strong>Asignada: </strong> <?= formatfec($dta['fecent']); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['actlic'] == 1) { ?>
                            <span style="font-size: 1px;opacity: 0;">1</span>
                            <a href="home.php?pg=<?= $pg; ?>&idlic=<?= $dta['idlic']; ?>&actlic=3&ope=act" title="Disponible">
                                <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                            </a>
                        <?php } else if ($dta['actlic'] == 2) { ?>
                            <span style="font-size: 1px;opacity: 0;">2</span>
                            <i class="fa fa-solid fa-circle-user fa-2x iconi" style="color: #c76e00;" title="Asignada"></i>
                        <?php } else { ?>
                            <span style="font-size: 1px;">3</span>
                            <a href="home.php?pg=<?= $pg; ?>&idlic=<?= $dta['idlic']; ?>&actlic=1&ope=act" title="Inactiva">
                                <i class="fa fa-solid fa-circle-user fa-2x desact"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <?php if ($dta['actlic'] == 1) { 
                            $mlic->setIdlic($dta['idlic']);
                            $i = $mlic->getOne();
                            $info = $i[0];
                            modalLic("lic", $dta['idlic'],  $dta['nomprg']." ".$dta['nomlic'], $info, $datPer, $pg); ?>
                            <i class="fa fa-solid fa-user fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lic<?= $dta['idlic']; ?>" title="Asignar"></i>
                        <?php } ?>
                        <a href="home.php?pg=<?= $pg; ?>&idlic=<?= $dta['idlic']; ?>&ope=edi">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"  title="Editar"></i>
                        </a>
                        <?php
                            $cp = $mlic->getLxP($dta['idlic']);
                            if ($cp && $cp[0]['can']==0) { ?>
                                <a href="home.php?pg=<?= $pg; ?>&idlic=<?= $dta['idlic']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomprv'].' '.$dta['nomlic']; ?>');">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi" title="Eliminar"></i>
                                </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Licencia</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </tfoot>
</table>
