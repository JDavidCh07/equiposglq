<?php include('controllers/cprm.php');?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="idvubi"><strong>Lugar:</strong></label>
            <select name="idvubi" id="idvubi" class="form-control form-select" required>
            <?php if($datUbi){ foreach($datUbi AS $dtu){ ?>
                <option value="<?=$dtu['idval']?>" <?php if($datOne && $datOne[0]['idvubi']==$dtu['idval']) echo " selected "?>><?=$dtu['nomval']?></option>
            <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="idvtprm"><strong>Permiso por:</strong></label>
            <select name="idvtprm" id="idvtprm" class="form-control form-select" required onchange="validarPermiso()">
            <?php if($datTprm){ foreach($datTprm AS $dtp){ ?>
                <option value="<?=$dtp['idval']?>" <?php if($datOne && $datOne[0]['idvtprm']==$dtp['idval']) echo " selected "?>><?=$dtp['nomval']?></option>
            <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-4 ui-widget">
            <label for="idjef"><strong>Enviar a:</strong></label>
            <select id="combobox1" name="idjef" class="form-control form-select" required>
                <option value="0"></option>
                <?php if ($datPer) { foreach ($datPer as $dpr) { ?>
                        <option value="<?= $dpr['idper']; ?>" <?php if ($datOne && $dpr['idper'] == $datOne[0]['ijef']) echo " selected "; ?>>
                            <?= $dpr['nomjef']; ?>     
                        </option>
                <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="fecini"><strong>Desde:</strong></label>
            <input class="form-control" type="datetime-local" id="fecini" name="fecini" <?php if ($datOne) echo 'value="'.$datOne[0]['fecini'].'"';?> step="1800" required onchange="validarHora(this); actualizarMinMax()">
            <small id="error-message-fecini" style="color: red; display: none;">La hora debe estar entre las 7:00 AM y las 6:00 PM.</small>
        </div>
        <div class="form-group col-md-4">
            <label for="fecfin"><strong>Hasta:</strong></label>
            <input class="form-control" type="datetime-local" id="fecfin" name="fecfin" <?php if ($datOne) echo 'value="'.$datOne[0]['fecfin'].'"';?> step="1800" required onchange="validarHora(this)">
            <small id="error-message-fecfin" style="color: red; display: none;">La hora debe estar entre las 7:00 AM y las 6:00 PM.</small>
        </div>
        <div class="form-group col-md-4">
            <label for="arcspt"><strong>Soporte:</strong></label>
            <input class="form-control" type="file" id="arcspt" name="arcspt" accept=".pdf">
            <small id="soporte-requerido" style="color: red; display: none;">Este campo es obligatorio.</small>
        </div>
        <div class="form-group col-md-12">
            <label for="desprm"><strong>Descripción:</strong></label>
            <textarea class="form-control" type="text" id="desprm" name="desprm" required><?php if ($datOne) echo $datOne[0]['desprm']; ?></textarea>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idprm" value="<?php if ($datOne) echo $datOne[0]['idprm']; ?>">
        </div>
    </div>
</form>
<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Datos permisos</th>
            <th>Estado</th>
            <?php if($_SESSION['idpef']==3){ ?><th></th><?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll as $dta) { ?>
            <tr>
                <td>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <BIG><strong><?php if($_SESSION['idpef']==3) echo $dta['tprm']; else echo $dta['dper']." - ".$dta['aper']." ".$dta['nper']?></strong></BIG>
                            <?php if($_SESSION['idpef']!=3){?>
                                <div class="form-group col-md-12">
                                    <strong><?="N° ".$dta['noprm']." - ".$dta['tprm'];?></strong>
                                </div>
                            <?php } ?>
                            <small>
                                <div class="row">
                                    <?php if ($dta['fini'] && $dta['hini']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>F. de Inicio: </strong> <?= $dta['fini']." - ".$dta['hini']; ?>
                                        </div>
                                    <?php } if ($dta['ffin'] && $dta['hfin']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>F. de Fin: </strong> <?= $dta['ffin']." - ".$dta['hfin']; ?>
                                        </div>
                                    <?php } if ($dta['ddif'] OR $dta['hdif']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>T. de Tiempo: </strong> 
                                            <?php if($dta['ddif']){ echo $dta['ddif']; if($dta['ddif']==1) echo " día "; else echo " días ";
                                            }else echo $dta['hdif']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbprm<?= $dta['idprm']; ?>" title="Detalles"></i>
                            <?php 
                                $mprm->setIdprm($dta['idprm']);
                                $det = $mprm->getOne();
                                modalInfPrm("mcbprm", $dta['idprm'], $det);
                            if($_SESSION['idpef']==3 && $dta['sptrut'] && file_exists($dta['sptrut'])) { ?>
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['sptrut'] ?>')"></i>
                            <?php } elseif($_SESSION['idpef']==4 && $dta['rutpdf'] && file_exists($dta['rutpdf'])) { ?>
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['rutpdf'] ?>')"></i>
                            <?php } ?>
                        </div>
                    </div>
                </td>
                <td style="text-align: left;">
                    <?php if ($dta['estprm'] == 1){
                        $fecini = date("Y-m-d", strtotime($dta['fecini'])); 
                        if($dta['idvtprm']==43) $fecha = $hoy; 
                        else $fecha = $pasadom; 
                        if ($fecha<=$fecini) { ?>
                            <span style="font-size: 1px;opacity: 0;">1</span>
                            <a href="views/pdfprm.php?idprm=<?=$dta['idprm'];?>&estprm=2" title="Enviar solicitud" target="_blank" onclick="setTimeout(() => location.reload(), 1000);">
                                <i class="fa fa-solid fa-paper-plane fa-2x iconi" title="Enviar"></i>
                            </a>
                        <?php }else{ ?>
                            <span style="font-size: 1px;opacity: 0;">5</span>
                            <i class="fa fa-solid fa-circle-exclamation fa-2x iconi" title="Fuera de Tiempo"></i>
                    <?php }} else if ($dta['estprm'] == 2) { ?>
                        <span style="font-size: 1px;">2</span>
                        <i class="fa fa-solid fa-clock fa-2x iconi" title="Enviado/Pendiente"></i>
                    <?php } else if ($dta['estprm'] == 3) { ?>
                        <span style="font-size: 1px;">3</span>
                        <i class="fa fa-solid fa-circle-check fa-2x act" title="Aprobado"></i>
                    <?php } else if ($dta['estprm'] == 4) { ?>
                        <span style="font-size: 1px;">4</span>
                        <i class="fa fa-solid fa-circle-xmark fa-2x desact" title="Rechazado"></i>
                    <?php } ?>
                </td>
                <?php if($_SESSION['idpef']==3){ ?>
                    <td style="text-align: right;">
                        <?php if ($dta['estprm'] == 1) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idprm=<?= $dta['idprm']; ?>&ope=edi" title="Editar">
                                <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                            </a>
                            <a href="home.php?pg=<?= $pg; ?>&idprm=<?= $dta['idprm']; ?>&ope=del" onclick="return eliminar('<?= $dta['tprm'] ?>');" title="Eliminar">
                                <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                            </a>
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Datos asignados</th>
            <th>Estado</th>
            <?php if($_SESSION['idpef']==3){ ?><th></th><?php } ?>
        </tr>
    </tfoot>
</table>

<?php if($solper){ ?>
    <table id="mytable" class="table table-striped">
        <thead>
            <tr>
                <th>Datos Solicitudes</th>
                <th>Estado</th>
                <?php if($_SESSION['idpef']==3){ ?><th></th><?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) { foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <BIG><strong><?php if($_SESSION['idpef']==3) echo $dta['tprm']; else echo $dta['dper']." - ".$dta['aper']." ".$dta['nper']?></strong></BIG>
                                <?php if($_SESSION['idpef']!=3){?>
                                    <div class="form-group col-md-12">
                                        <strong><?="N° ".$dta['noprm']." - ".$dta['tprm'];?></strong>
                                    </div>
                                <?php } ?>
                                <small>
                                    <div class="row">
                                        <?php if ($dta['fini'] && $dta['hini']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>F. de Inicio: </strong> <?= $dta['fini']." - ".$dta['hini']; ?>
                                            </div>
                                        <?php } if ($dta['ffin'] && $dta['hfin']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>F. de Fin: </strong> <?= $dta['ffin']." - ".$dta['hfin']; ?>
                                            </div>
                                        <?php } if ($dta['ddif'] OR $dta['hdif']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>T. de Tiempo: </strong> 
                                                <?php if($dta['ddif']){ echo $dta['ddif']; if($dta['ddif']==1) echo " día "; else echo " días ";
                                                }else echo $dta['hdif']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </small>
                            </div>
                            <div class="form-group col-md-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbprm<?= $dta['idprm']; ?>" title="Detalles"></i>
                                <?php 
                                    $mprm->setIdprm($dta['idprm']);
                                    $det = $mprm->getOne();
                                    modalInfPrm("mcbprm", $dta['idprm'], $det);
                                if($_SESSION['idpef']==3 && $dta['sptrut'] && file_exists($dta['sptrut'])) { ?>
                                    <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['sptrut'] ?>')"></i>
                                <?php } elseif($_SESSION['idpef']==4 && $dta['rutpdf'] && file_exists($dta['rutpdf'])) { ?>
                                    <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['rutpdf'] ?>')"></i>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['estprm'] == 1){
                            $fecini = date("Y-m-d", strtotime($dta['fecini'])); 
                            if($dta['idvtprm']==43) $fecha = $hoy; 
                            else $fecha = $pasadom; 
                            if ($fecha<=$fecini) { ?>
                                <span style="font-size: 1px;opacity: 0;">1</span>
                                <a href="views/pdfprm.php?idprm=<?=$dta['idprm'];?>&estprm=2" title="Enviar solicitud" target="_blank" onclick="setTimeout(() => location.reload(), 1000);">
                                    <i class="fa fa-solid fa-paper-plane fa-2x iconi" title="Enviar"></i>
                                </a>
                            <?php }else{ ?>
                                <span style="font-size: 1px;opacity: 0;">5</span>
                                <i class="fa fa-solid fa-circle-exclamation fa-2x iconi" title="Fuera de Tiempo"></i>
                        <?php }} else if ($dta['estprm'] == 2) { ?>
                            <span style="font-size: 1px;">2</span>
                            <i class="fa fa-solid fa-clock fa-2x iconi" title="Enviado/Pendiente"></i>
                        <?php } else if ($dta['estprm'] == 3) { ?>
                            <span style="font-size: 1px;">3</span>
                            <i class="fa fa-solid fa-circle-check fa-2x act" title="Aprobado"></i>
                        <?php } else if ($dta['estprm'] == 4) { ?>
                            <span style="font-size: 1px;">4</span>
                            <i class="fa fa-solid fa-circle-xmark fa-2x desact" title="Rechazado"></i>
                        <?php } ?>
                    </td>
                    <?php if($_SESSION['idpef']==3){ ?>
                        <td style="text-align: right;">
                            <?php if ($dta['estprm'] == 1) { ?>
                                <a href="home.php?pg=<?= $pg; ?>&idprm=<?= $dta['idprm']; ?>&ope=edi" title="Editar">
                                    <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                                </a>
                                <a href="home.php?pg=<?= $pg; ?>&idprm=<?= $dta['idprm']; ?>&ope=eli" onclick="return eliminar('<?= $dta['tprm'] ?>');" title="Eliminar">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                                </a>
                            <?php } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Datos asignados</th>
                <th>Estado</th>
                <?php if($_SESSION['idpef']==3){ ?><th></th><?php } ?>
            </tr>
        </tfoot>
    </table>
<?php } ?>
<style>
    .custom-combobox1 {
        position: relative;
        display: inline-block;
        width: 100%;
        text-align: left;
    }

    .custom-combobox1-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox1-input{
        margin: 0;
        padding: 5px 10px;
        width: 100%;
        text-align: left;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }
</style>