<?php
    include('controllers/casg.php');
    $hoy = date("Y-m-d");
    $mañana = date("Y-m-d", strtotime($hoy . ' +1 day'));
?>

<a href="home.php?pg=51&asg=equ" title="Equipo">
    <i class="fa fa-solid fa-laptop fa-2x iconi"></i>
</a>
<a href="home.php?pg=51&asg=cel" title="Celular">
    <i class="fa fa-solid fa-mobile fa-2x iconi"></i>
</a>

<?php if($asg){ ?>
    <form action="home.php?pg=<?= $pg; ?>" method="POST">
        <div class="row">
            <div <?php if($asg=="equ") echo 'class="form-group col-md-4 ui-widget"'; else if($asg=="cel") echo 'class="form-group col-md-6 ui-widget"';?>>
                <label for="idperrec"><strong>Usuario:</strong></label>
                <select id="combobox1" name="idperrec" class="form-control form-select" required>
                    <option value="0"></option>
                    <?php if ($datPer) { foreach ($datPer as $dpr) { ?>
                            <option value='<?= $dpr['idper']; ?>' <?php if ($datOne && $dpr == $datOne[0]['idper']) echo " selected "; ?>>
                                <?= $dpr['ndper']." - ".$dpr['apeper']." ".$dpr['nomper']; ?>    
                            </option>
                    <?php }} ?>
                </select>
            </div>
            <div <?php if($asg=="equ"){ echo 'class="form-group col-md-4 ui-widget"'; } else if($asg=="cel") { echo 'class="form-group col-md-6 ui-widget"'; }?>>
                <label for="idequ"><strong><?php if($asg=="equ") echo "Equipo"; else if($asg=="cel") echo "Celular";?>:</strong></label>
                <select id="combobox2" name="idequ" class="form-control form-select" required>
                    <option value="0"></option>
                    <?php if ($datEqu) { foreach ($datEqu as $deq) { ?>
                            <option value="<?= $deq['idequ']; ?>" <?php if ($datOne && $deq['idequ'] == $datOne[0]['idcli']) echo " selected "; ?>>
                                <?= $deq['serialeq']." - ".$deq['marca']." ".$deq['modelo']; ?>
                            </option>
                    <?php }} ?>
                </select>
            </div>
            <?php if($asg=="cel") { ?>
                <div class="form-group col-md-4">
                    <label for="numcel"><strong>Número:</strong></label>
                    <input class="form-control" type="text" id="numcel" name="numcel" value="<?php if ($datOne) echo $datOne[0]['numcel']; ?>" onkeypress="return solonum(event);">
                </div>
                <div class="form-group col-md-4">
                    <label for="opecel"><strong>Operador:</strong></label>
                    <select id="opecel" name="opecel" class="form-control form-select" required>
                        <?php if ($datOpe) { foreach ($datOpe as $dop) { ?>
                                <option value="<?= $dop['idval']; ?>" <?php if ($datOne && $dop['idval'] == $datOne[0]['opecel']) echo " selected "; ?>>
                                    <?= $dop['nomval']; ?>
                                </option>
                        <?php }} ?>
                    </select>
                </div>
            <?php } ?>
            <div class="form-group col-md-4">
                <label for="fecent"><strong>F. Entrega:</strong></label>
                <input class="form-control" type="date" id="fecent" name="fecent" max=<?php echo $hoy;?> <?php if ($datOne) echo 'value="'.$datOne[0]['fecent'].'" disabled'; else echo 'value="'.$hoy.'" required';?>>
            </div>
            <div class="form-group col-md-12"><br></div>
            <?php if($datAcc){ foreach($datAcc as $dac){?>
                <div <?php if($asg=="equ"){ echo 'class="form-group col-md-4"'; } else if($asg=="cel") { echo 'class="form-group col-md-4"'; }?> style="text-align: left !important;">
                    <input type="checkbox" name="idvacc[]" value="<?= $dac['idval'] ?>" <?php if ($datAxE){ foreach($datAxE as $dae){ if($dac['idval'] == $dae['idvacc']) echo " checked ";}} ?>>
                    <label for="idvacc"><strong><?= $dac['nomval'];?></strong></label>
				</div>
            <?php }} ?>
            <div class="form-group col-md-12">
                <br>
                <label for="observ"><strong>Observaciones entrega:</strong></label>
                <textarea class="form-control" type="text" id="observ" name="observ" <?php if ($datOne) echo 'value="'.$datOne[0]['observ'].'" required';?>></textarea>
            </div>
            <!-- <div class="form-group col-md-4">
                <label for="fecdev"><strong>F. Devolución:</strong></label>
                <input class="form-control" type="date" id="fecdev" name="fecdev" max=<?php echo $hoy;?> value="<?php if ($datOne) echo $datOne[0]['fecdev']; ?>" required>
            </div>
            <div class="form-group col-md-12">
                <label for="observd"><strong>Observaciones devolución:</strong></label>
                <textarea class="form-control" type="text" id="observd" name="observd" value="<?php if ($datOne) echo $datOne[0]['observd']; ?>" required></textarea>
            </div> -->
            <div class="form-group col-md-12" id="boxbtn">
                <br><br>
                <input class="btn btn-primary" type="submit" value="Registrar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="asg" value="<?php echo $asg?>">
                <input type="hidden" name="ideqxpr" value="<?php if ($datOne) echo $datOne[0]['ideqxpr']; ?>">
            </div>
        </div>
    </form>
    <table id="mytable" class="table table-striped">
        <thead>
            <tr>
                <th>Datos asignados</th>
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
                                        modalDet("mcbinf", $dta['idequ'], $dta['marca'].' '.$dta['modelo'].' - '.$dta['serialeq'], $dta['capgb'], $dta['ram'], $dta['procs'], $dta['fecultman'], $dta['fecproman'], $dta['tipcon'], $dta['contrato'], $dta['valrcont'], $prgs);
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
                            <i class="fa fa-solid fa-circle-user fa-2x iconi" title="Asignado"></i>
                        <?php } else { ?>
                            <span style="font-size: 1px;">3</span>
                            <a href="home.php?pg=<?= $pg; ?>&idequ=<?= $dta['idequ']; ?>&actequ=1&ope=act" title="Inactivo">
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <?php if ($dta['actequ'] != 2) { ?>
                            <span style="font-size: 1px;opacity: 0;">2</span>
                            <a href="home.php?pg=51" title="Asignar">
                                <i class="fa fa-solid fa-arrows-turn-to-dots fa-2x iconi"></i>
                            </a>
                        <?php } ?>
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
                            $me = $mequ->getMnxEq($dta['idequ']);
                            $ae = $mequ->getAcxEq($dta['idequ']);
                            $pe = $mequ->getEqprxEq($dta['idequ']);
                            if ($ee && $me && $ae && $pe && $ee[0]['can'] == 0 && $me[0]['can'] == 0 && $ae[0]['can'] == 0 && $pe[0]['can'] == 0) { ?>
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
<?php } ?>
<style>
    .custom-combobox1,
    .custom-combobox2-input {
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
        border-radius: 2px;
    }
</style>