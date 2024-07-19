<?php
    include('controllers/casg.php');
    $hoy = date("Y-m-d");
    $mañana = date("Y-m-d", strtotime($hoy . ' +1 day'));
?>

<div class="row">
    <div class="col-8">
        <a href="home.php?pg=51&asg=equ" title="Equipo">
            <i class="fa fa-solid fa-laptop fa-2x iconi"></i>
        </a>
        <a href="home.php?pg=51&asg=cel" title="Celular">
            <i class="fa fa-solid fa-mobile fa-2x iconi"></i>
        </a>
    </div>
    <div class="col-4" style="text-align: right;">
        <i class="fa fa-solid fa-file-import fa-2x imp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mod<?=$pg?><?=($asg=='equ') ? 'cargmea' : 'cargmca'?>" title="Importar"></i>
        <?php modalImp("mod", $pg, ($asg=="equ") ? "Equipos asignados" : "Celulares asignados", ($asg=="equ") ? "cargmea" : "cargmca", $asg)?>
        <a href="excel/xasg.php" title="Exportar">
            <i class="fa fa-solid fa-file-export fa-2x ext"></i>
        </a>
    </div>
</div>

<?php if($asg){ ?>
    <form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
        <div class="row">
            <div <?php if($asg=="equ") echo 'class="form-group col-md-4 ui-widget"'; else if($asg=="cel") echo 'class="form-group col-md-6 ui-widget"';?>>
                <label for="idperrec"><strong>Usuario:</strong></label>
                <select id="combobox1" name="idperrec" class="form-control form-select" <?php if ($datOneA) echo 'disabled'; else echo 'required';?>>
                    <option value="0"></option>
                    <?php if ($datPer) { foreach ($datPer as $dpr) { ?>
                            <option value="<?= $dpr['idper']; ?>" <?php if ($datOneA && $dpr['idper'] == $datOneA[0]['idprec']) echo " selected "; ?>>
                                <?= $dpr['ndper']." - ".$dpr['apeper']." ".$dpr['nomper']; ?>    
                            </option>
                    <?php }} ?>
                </select>
            </div>
            <div <?php if($asg=="equ") echo 'class="form-group col-md-4 ui-widget"'; else if($asg=="cel") echo 'class="form-group col-md-6 ui-widget"';?>>
                <label for="idequ"><strong><?php if($asg=="equ") echo "Equipo"; else if($asg=="cel") echo "Celular";?>:</strong></label>
                <select id="combobox2" name="idequ" class="form-control form-select" <?php if ($datOneA) echo 'disabled'; else echo 'required';?>>
                    <option value="0"></option>
                    <?php if ($datEqu) { foreach ($datEqu as $deq) { ?>
                            <option value="<?= $deq['idequ']; ?>" <?php if ($datOneA && $deq['idequ'] == $datOneA[0]['idequ']) echo " selected "; ?>>
                                <?= $deq['serialeq']." - ".$deq['marca']." ".$deq['modelo']; ?>    
                            </option>
                    <?php }} ?>
                </select>
            </div>
            <?php if($asg=="cel") { ?>
                <div class="form-group col-md-4">
                    <label for="numcel"><strong>Número:</strong></label>
                    <input class="form-control" type="text" id="numcel" name="numcel" value="<?php if ($datOneA) echo $datOneA[0]['numcel']; ?>" onkeypress="return solonum(event);">
                </div>
                <div class="form-group col-md-4">
                    <label for="opecel"><strong>Operador:</strong></label>
                    <select id="opecel" name="opecel" class="form-control form-select" required>
                        <?php if ($datOpe) { foreach ($datOpe as $dop) { ?>
                                <option value="<?= $dop['idval']; ?>" <?php if ($datOneA && $dop['idval'] == $datOneA[0]['opecel']) echo " selected "; ?>>
                                    <?= $dop['nomval']; ?>
                                </option>
                        <?php }} ?>
                    </select>
                </div>
            <?php } ?>
            <option value="0"></option>
            <div class="form-group col-md-4">
                <label for="fecent"><strong>F. Entrega:</strong></label>
                <input class="form-control" type="date" id="fecent" name="fecent" max=<?php echo $hoy;?> <?php if ($datOneA) echo 'value="'.$datOneA[0]['fecent'].'" disabled'; else echo 'value="'.$hoy.'" required';?>>
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
                <textarea class="form-control" type="text" id="observ" name="observ" <?php if ($datOneA) echo 'required';?>><?php if ($datOneA) echo $datOneA[0]['observ']; ?></textarea>
            </div>
            <div class="form-group col-md-12" id="boxbtn">
                <br><br>
                <input class="btn btn-primary" type="submit" value="Registrar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="asg" value="<?php echo $asg?>">
                <input type="hidden" name="ideqxpr" value="<?php if ($datOneA) echo $datOneA[0]['ideqxpr']; ?>">
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
            <?php if ($datAllA) { foreach ($datAllA as $dta) { ?>
                <tr>
                    <td>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <BIG><strong><?= $dta['prec']." - ".$dta['marca']." ".$dta['modelo']; ?></strong></BIG>
                                <small>
                                    <div class="row">
                                        <?php if ($dta['tpe'] && $asg="equ") { ?>
                                            <div class="form-group col-md-6">
                                                <strong>T. Equipo: </strong> <?= $dta['tpe']; ?>
                                            </div>
                                        <?php } if ($dta['serialeq']) { ?>
                                            <div <?php if($asg=="equ"){ echo 'class="form-group col-md-6"'; } else if($asg=="cel") { echo 'class="form-group col-md-12"'; }?>>
                                                <strong><?php if($asg=="equ"){ echo "Serial"; } else { echo "IMEI"; }?>: </strong> <?= $dta['serialeq']; ?>
                                            </div>
                                        <?php } if ($dta['nomred'] && $asg=="equ") { ?>
                                            <div class="form-group col-md-12">
                                                <strong>Red: </strong> <?= $dta['nomred']; ?>
                                            </div>
                                        <?php } if ($dta['fecent']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>F. Entrega: </strong> <?= $dta['fecent']; ?>
                                            </div>
                                        <?php } if ($dta['fecdev']) { ?>
                                            <div class="form-group col-md-6">
                                                <strong>F. Devolución: </strong> <?= $dta['fecdev']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </small>
                            </div>
                            <div class="form-group col-md-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbdet<?= $dta['ideqxpr']; ?>" title="Detalles"></i>
                                <?php
                                    $mequ->setIdequ($dta['idequ']);
                                    $masg->setIdeqxpr($dta['ideqxpr']);
                                    $prgs = $mequ->getOnePxE();
                                    $acc = $masg->getAllAxE($dta['ideqxpr']);
                                    $det = $masg->getOne();
                                    modalInfAsg("mcbdet", $dta['ideqxpr'], $prgs, $acc, $det, $asg);
                                ?>
                                <a href="views/pdfasg.php?ideqxpr=<?=$dta['ideqxpr'];?>" title="Imprimir PDF" target="_blank">
                                    <i class="fa fa-solid fa-file-pdf iconi"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['estexp'] == 1) { ?>
                            <span style="font-size: 1px;opacity: 0;">1</span>
                            <i class="fa fa-solid fa-circle-check fa-2x act" title="Asignado"></i>
                        <?php } else if ($dta['estexp'] == 2) { ?>
                            <span style="font-size: 1px;">2</span>
                            <i class="fa fa-solid fa-circle-xmark fa-2x desact" title="Devuelto"></i>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <?php if ($dta['estexp'] != 2) { ?>
                            <i class="fa fa-solid fa-arrows-turn-to-dots fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbdev<?= $dta['ideqxpr']; ?>" title="Devolver"></i>
                            <?php
                                $masg->setIdeqxpr($dta['ideqxpr']);
                                $acc = $masg->getAllAxE($dta['ideqxpr']);
                                $det = $masg->getOne();
                                modalDev("mcbdev", $dta['ideqxpr'], $acc, $det, $pg, $asg);
                            ?>
                            <a href="home.php?pg=<?= $pg; ?>&ideqxpr=<?= $dta['ideqxpr']; ?>&ope=edi&asg=<?= $asg; ?>" title="Editar">
                                <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Datos asignados</th>
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
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }
</style>