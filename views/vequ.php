<?php
require_once('controllers/cequ.php');
?>

<div style="text-align: right;">
    <i class="fa fa-solid fa-file-import fa-2x imp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod<?=$pg?><?=($pg==52) ? 'cargme' : 'cargmc'?>" title="Importar"></i>
    <?php modalImp("mod", $pg, ($pg==52)? "Equipos" : "Celulares", ($pg==52)? "cargme" : "cargmc", "") ?>
    
    <a href="excel/xequ.php" title="Exportar">
        <i class="fa fa-solid fa-file-export fa-2x ext"></i>
    </a>
</div>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="marca"><strong>Marca:</strong></label>
            <input class="form-control" type="text" id="marca" name="marca" value="<?php if ($datOne) echo $datOne[0]['marca']; ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="modelo"><strong>Modelo:</strong></label>
            <input class="form-control" type="text" id="modelo" name="modelo" value="<?php if ($datOne) echo $datOne[0]['modelo']; ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="serialeq"><strong><?php if($pg==52){ echo "Serial"; } else { echo "IMEI"; }?>:</strong></label>
            <input class="form-control" type="text" id="serialeq" name="serialeq" value="<?php if ($datOne) echo $datOne[0]['serialeq']; ?>" <?php if($pg==54) echo " onkeypress='return solonum(event);' "; ?> required>
        </div>
        <?php if($pg==52){ ?>
            <div class="form-group col-md-4">
                <label for="nomred"><strong>Nombre en Red:</strong></label>
                <input class="form-control" type="text" id="nomred" name="nomred" value="<?php if ($datOne) echo $datOne[0]['nomred']; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="idvtpeq"><strong>T. Equipo:</strong></label>
                <select name="idvtpeq" id="idvtpeq" class="form-control form-select" required>
                    <?php foreach ($dattpe as $dte) { ?>
                        <option value="<?= $dte['idval']; ?>" <?php if ($datOne && $dte['idval'] == $datOne[0]['idvtpeq']) echo " selected "; ?>>
                            <?= $dte['nomval']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
        <div class="form-group col-md-4">
            <label for="capgb"><strong>Almacenamiento(GB):</strong></label>
            <input class="form-control" type="text" id="capgb" name="capgb" value="<?php if ($datOne) echo $datOne[0]['capgb']; ?>" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-4">
            <label for="ram"><strong>RAM:</strong></label>
            <input class="form-control" type="text" id="ram" name="ram" value="<?php if ($datOne) echo $datOne[0]['ram']; ?>" onkeypress="return solonum(event);" required>
        </div>
        <?php if($pg==52){ ?>
            <div class="form-group col-md-4">
                <label for="procs"><strong>Procesador:</strong></label>
                <input class="form-control" type="text" id="procs" name="procs" value="<?php if ($datOne) echo $datOne[0]['procs']; ?>" required>
            </div>
        <?php } ?>
        <div class="form-group col-md-4">
            <label for="actequ" class="titulo"><strong>Activo:</strong></label>
            <select name="actequ" id="actequ" class="form-control form-select" required>
                <option value="1" <?php if ($datOne && $datOne[0]['actequ'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['actequ'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
        <?php if($pg==52){ ?>
            <div class="form-group col-md-4">
                <label for="tipcon"><strong>Estado:</strong></label>
                <select name="tipcon" id="tipcon" class="form-control form-select" required>
                    <?php foreach ($dattpc as $dtc) { ?>
                        <option value="<?= $dtc['idval']; ?>" <?php if ($datOne && $dtc['idval'] == $datOne[0]['tipcon']) echo " selected "; ?>>
                            <?= $dtc['nomval']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="pg" value="<?=$pg;?>">
            <input type="hidden" name="idequ" value="<?php if ($datOne) echo $datOne[0]['idequ']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Datos <?php if($pg==52){ echo "equipo"; } else { echo "celular"; }?></th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll as $dta) { ?>
            <tr>
                <td>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <BIG><strong><?= $dta['marca']." ".$dta['modelo']; ?></strong></BIG>
                            <small>
                                <div class="row">
                                    <?php if ($dta['serialeq']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong><?php if($pg==52){ echo "Serial"; } else { echo "IMEI"; }?>: </strong> <?= $dta['serialeq']; ?>
                                        </div>
                                    <?php } if ($dta['nomred'] && $pg==52) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Red: </strong> <?= $dta['nomred']; ?>
                                        </div>
                                    <?php } if ($dta['idvtpeq'] && $pg==52) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Tipo: </strong> <?= $dta['tpe']; ?>
                                        </div>
                                    <?php } if ($dta['tipcon'] && $pg==52) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Estado: </strong> <?= $dta['tpc']; ?> 
                                        </div>
                                    <?php } if ($dta['ram'] && $pg==54) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>RAM: </strong> <?= $dta['ram']; echo " GB"?>
                                        </div>
                                    <?php } if ($dta['capgb'] && $pg==54) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Almacenamiento: </strong> <?= $dta['capgb']; echo " GB"?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </small>
                        </div>
                        <?php if($pg==52){ ?>
                            <div class="form-group col-md-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbinf<?= $dta['idequ']; ?>" title="Detalles"></i>
                                <?php
                                    $mequ->setIdequ($dta['idequ']);
                                    $prgs = $mequ->getOnePxE();
                                    $info = $mequ->getOne();
                                    modalDet("mcbinf", $dta['idequ'], $prgs, $info);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <td style="text-align: left;">
                    <?php if ($dta['actequ'] == 1) { ?>
                        <span style="font-size: 1px;opacity: 0;">1</span>
                        <a href="home.php?pg=<?= $pg; ?>&idequ=<?= $dta['idequ']; ?>&actequ=3&ope=act" title="Activo">
                            <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                        </a>
                    <?php } else if ($dta['actequ'] == 2) { ?>
                        <span style="font-size: 1px;opacity: 0;">2</span>
                        <i class="fa fa-solid fa-circle-user fa-2x iconi" style="color: #c76e00;" title="Asignado"></i>
                    <?php } else { ?>
                        <span style="font-size: 1px;">3</span>
                        <a href="home.php?pg=<?= $pg; ?>&idequ=<?= $dta['idequ']; ?>&actequ=1&ope=act" title="Inactivo">
                            <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                        </a>
                    <?php } ?>
                </td>
                <td style="text-align: right;">
                    <?php if($pg==52){ ?>
                        <i class="fa fa-solid fa-key fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbpxe<?= $dta['idequ']; ?>" title="Licencias"></i>
                        <?php 
                            $mequ->setIdequ($dta['idequ']);
                            $dga = $mequ->getOnePxE();
                            $dm = arrstrprg($dga);
                            modalPxE("mcbpxe", $dta['idequ'], $dta['marca'].' '.$dta['modelo'].' - '.$dta['serialeq'], $dom, $pg, $dm, $dga);
                    } ?>
                    <a href="home.php?pg=<?= $pg; ?>&idequ=<?= $dta['idequ']; ?>&ope=edi" title="Editar">
                        <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                    </a>
                    <?php
                        $ee = $mequ->getEqxEp($dta['idequ']);
                        $pe = $mequ->getEqprxEq($dta['idequ']);
                        if ($ee && $pe && $ee[0]['can'] == 0 && $pe[0]['can'] == 0) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idequ=<?= $dta['idequ']; ?>&ope=eli" onclick="return eliminar('<?= $dta['marca'].' '.$dta['modelo']; ?>');" title="Eliminar">
                                <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                            </a>
                    <?php } ?>
                </td>
            </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Datos <?php if($pg==52){ echo "equipo"; } else { echo "celular"; }?></th>
            <th>Estado</th>
            <th></th>
        </tr>
    </tfoot>
</table>