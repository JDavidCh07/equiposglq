<?php
include('controllers/cpag.php');

?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="nompag"><strong>Nombre:</strong></label>
            <input type="text" name="nompag" id="nompag" class="form-control" value="<?php if ($datOne) echo $datOne[0]['nompag']; ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="mospag"><strong>Mostrar:</strong></label>
            <select name="mospag" id="mospag" class="form-control form-select" required>
                <option value="1" <?php if ($datOne && $datOne[0]['mospag'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['mospag'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="ordpag"><strong>Orden:</strong></label>
            <input type="text" name="ordpag" id="ordpag" class="form-control" value="<?php if ($datOne) echo $datOne[0]['ordpag']; ?>" onkeypress="return solonum(event);" required>
        </div>

        <div class="form-group col-md-4">
            <label for="menpag"><strong>Menú principal:</strong></label>
            <input type="text" name="menpag" id="menpag" class="form-control" value="<?php if ($datOne) echo $datOne[0]['menpag']; ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="arcpag"><strong>Ruta archivo:</strong></label>
            <input type="text" name="arcpag" id="arcpag" class="form-control" value="<?php if ($datOne) echo $datOne[0]['arcpag']; ?>" required></input>
        </div>

        <div class="form-group col-md-4">
            <label for="arcpag"><strong>Icono:</strong></label>
            <input type="text" name="icono" id="icono" class="form-control" value="<?php if ($datOne) echo $datOne[0]['icono']; ?>" required></input>
        </div>

        <div class="form-group col-md-4">
            <label for="idmod"><strong>Módulo:</strong></label>
            <select name="idmod" id="idmod" class="form-control form-select" required>
                <?php foreach ($datAllm as $dtm) { ?>
                    <option value="<?= $dtm['idmod']; ?>" <?php if ($datOne && $dtm['idmod'] == $datOne[0]['idmod']) echo " selected "; ?>>
                        <?= $dtm['idmod'] . " - " . $dtm['nommod']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input type="submit" class="btn btn-primary mybtn" value="Registrar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idpag" value="<?php if ($datOne) echo $datOne[0]['idpag']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Páginas</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <strong> <?= number_format($dta['idpag']) . " - " . $dta['nompag']; ?></strong><br>
                        <small>
                            <i class="<?= $dta['icono']; ?>"></i>
                            <?= $dta['icono']; ?><br>
                            <strong>Archivo: </strong> <?= $dta['arcpag']; ?>
                            <strong>Módulo: </strong> <?= $dta['nommod']; ?>
                        </small>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['mospag'] == 1) { ?>
                            <span style="font-size: 1px; opacity: 0;">+</span>
                            <a href="home.php?pg=<?= $pg; ?>&idpag=<?= $dta['idpag']; ?>&ope=act&mospag=2" title="Activa">
                                <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                            </a>
                        <?php } else { ?>
                            <span style="font-size: 1px; opacity: 0;">--</span>
                            <a href="home.php?pg=<?= $pg; ?>&idpag=<?= $dta['idpag']; ?>&ope=act&mospag=1" title="Desactiva">
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idpag=<?= $dta['idpag']; ?>&ope=edi" title="Editar">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                        </a>
                        <?php
                        $ct = $mpag->getPFxPG($dta['idpag']);
                        $pf = $mpag->getPPxPG($dta['idpag']);
                        $pm = $mpag->getMDxPG($dta['idpag']);
                        if ($ct && $pf && $ct[0]['can'] == 0 && $pf[0]['can'] == 0) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idpag=<?= $dta['idpag']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nompag'] ?>');" title="Eliminar">
                                <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
        <?php }
        }; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Páginas</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
    ocul();
</script>