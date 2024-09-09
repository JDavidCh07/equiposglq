<?php include('controllers/cpef.php'); ?>

<form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nompef"><strong>Nombre:</strong></label>
            <input type="text" name="nompef" id="nompef" class="form-control" required value="<?php if ($datOne) echo $datOne[0]['nompef']; ?>">
        </div>
        <div class="form-group col-md-12"><br></div>
        <div class="form-group col-md-12" id="boxbtn">
            <input type="submit" class="mt-0 btn btn-primary" value="Registrar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idpef" value="<?php if ($datOne) echo $datOne[0]['idpef']; ?>">
        </div>
    </div>
</form>
<table id="mytable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Perfil</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($dat) { foreach ($dat as $d) { ?>
            <tr>
                <td>
                    <strong><?= $d['idpef'] . " - " . $d['nompef']; ?></strong>
                </td>
                <td style="text-align: right;">
                    <?php
                        $mpef->setIdpef($d['idpef']);
                        $mods = $mpef->getMod();
                        $pfxmd = $mpef->getPxM();
                        $dps = $mpef->selPxP();
                        modalPxM("mdlpxm", $d['idpef'], $d['nompef'], $mods, $pfxmd, $pg); 
                        modalChk("mchk", $d['idpef'], $d['nompef'], $pfxmd, $dps, $pg); 
                        if($pfxmd){ ?>
                    <a href="#" title="Ver Páginas" data-bs-toggle="modal" data-bs-target="#mchk<?= $d['idpef']; ?>" title="Asignar páginas">
                        <i class="fa fa-solid fa-circle-exclamation fa-2x iconi"></i>
                    </a>
                    <?php } ?>
                    <a href="#" title="Ver Módulos" data-bs-toggle="modal" data-bs-target="#mdlpxm<?= $d['idpef']; ?>" title="Asignar módulos">
                        <i class="fa fa-solid fa-cubes fa-2x iconi"></i>
                    </a>
                    <a href="home.php?pg=<?= $pg; ?>&idpef=<?= $d['idpef']; ?>&ope=edi" title="Editar">
                        <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                    </a>
                </td>
            </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Perfil</th>
            <th></th>
        </tr>
    </tfoot>
</table>