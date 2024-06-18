<?php include('controllers/cpef.php'); ?>

<form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row" style="margin-bottom: 50px">
        <div class="form-group col-md-6">
            <label for="nompef"><strong>Nombre:</strong></label>
            <input type="text" name="nompef" id="nompef" class="form-control" required value="<?php if ($datOne) echo $datOne[0]['nompef']; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="idpag"><strong>Pagina Inicial:</strong></label>
            <select name="idpag" id="idpag" class="form-select">
                <?php if ($datpag) { foreach ($datpag  as $dt) { ?>
                    <option value="<?= $dt['idpag']; ?>" <?php if ($datOne && $datOne[0]['idpag'] == $dt['idpag']) echo " selected "; ?>>
                        <?= $dt['nompag']; ?>
                    </option>
                <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="idmod"><strong>Módulo:</strong></label>
            <select name="idmod" id="idmod" class="form-select">
                <?php if ($datmod) { foreach ($datmod as $dt) { ?>
                    <option value="<?= $dt['idmod']; ?>" <?php if ($datOne && $datOne[0]['idmod'] == $dt['idmod']) echo " selected "; ?>>
                            <?= $dt['nommod']; ?>
                    </option>
                <?php }} ?>
            </select><br>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br>
            <input type="submit" class="mt-0 btn btn-primary" value="Registrar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idpef" value="<?php if ($datOne) echo $datOne[0]['idpef']; ?>">
        </div>
    </div>
</form>
<table id="mytable" class="table table-striped table-bordered" style="width:100%">
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
                    <a href="#" title="Ver Páginas" data-bs-toggle="modal" data-bs-target="#mchk<?= $d['idpef']; ?>" title="Asignar páginas">
                        <i class="fa fa-solid fa-circle-exclamation fa-2x iconi"></i>
                    </a>
                    <?php
                        $mpef->setIdmod($d['idmod']);
                        $dtm = $mpef->getPagMod();
                        $mpef->setIdpef($d['idpef']);
                        $dps = $mpef->selPxP();
                        $dms = arrstr($dps);
                        modalChk("mchk", $d['idpef'], $d['nompef'], $dtm, $pg, $dms); ?>
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