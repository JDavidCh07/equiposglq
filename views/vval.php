<?php
include('controllers/cval.php');
?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="codval"><strong>Código:</strong></label>
            <input type="text" name="codval" id="codval" class="form-control" value="<?php if ($datOne) echo $datOne[0]['codval']; ?>" <?php if ($datOne) echo $datOne[0]['codval']; ?> onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-6">
            <label for="nomval"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomval" name="nomval" value="<?php if ($datOne) echo $datOne[0]['nomval']; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="iddom" class="titulo"><strong>Dominio:</strong></label>
            <select name="iddom" id="iddom" class="form form-select">
                <?php if ($datDom) {
                    foreach ($datDom as $ddo) { ?>
                        <option value="<?= $ddo['iddom']; ?>" <?php if ($datOne && $ddo['iddom'] == $datOne[0]['iddom']) echo "selected"; ?>>
                            <?= $ddo['iddom']." - ". $ddo['nomdom']; ?>
                        </option>
                <?php }
                } ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="actval"><strong>Activo:</strong></label>
            <select name="actval" id="actval" class="form-control form-select">
                <option value="1" <?php if ($datOne && $datOne[0]['actval'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['actval'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
    </div>
    <div class="form-group col-md-12" id="boxbtn">
        <br><br>
        <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
        <input type="hidden" name="ope" value="save">
        <input type="hidden" name="idval" value="<?php if ($datOne) echo $datOne[0]['idval']; ?>">
    </div>
    </div>
</form>

<table id="mytable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Datos</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datALL) {
            foreach ($datALL as $dta) { ?>
                <tr>
                    <td>
                        <strong> <?= number_format($dta['codval']) . " - " . $dta['nomval']; ?></strong>
                        <br><small><strong>Dominio:</strong> <?= $dta['iddom']; ?>
                        /
                        <?php
                        if ($datDom) {
                            foreach ($datDom as $dtd) {
                                if ($dtd['iddom'] == $dta['iddom']) {
                                    echo $dtd['nomdom'];
                                }
                            }
                        }
                        ?>
                        </small>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['actval'] == 1) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idval=<?= $dta['idval']; ?>&ope=act&actval=2" title="Activo">
                                <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                            </a>
                        <?php } else { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idval=<?= $dta['idval']; ?>&ope=act&actval=1" title="Desactivo">
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idval=<?= $dta['idval']; ?>&ope=edi" title="Editar">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                        </a>
                        <?php 
                            $cp = $mval->getPxV($dta['idval']);
                            $cte = $mval->getTExV($dta['idval']);
                            $ctc = $mval->getTCxV($dta['idval']);
                            $cae = $mval->getAExV($dta['idval']);
                            $cpe = $mval->getPExV($dta['idval']);
                            if($cp && $cte && $ctc && $cae && $cpe && $cp[0]['can']==0 && $cte[0]['can']==0 && $ctc[0]['can']==0 && $cae[0]['can']==0 && $cpe[0]['can']==0){ ?> 
                                <a href="home.php?pg=<?= $pg; ?>&idval=<?= $dta['idval']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomval']; ?>');" title="Eliminar">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                                </a>
                        <?php } ?>
                    </td>
                </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Valor</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </tfoot>
</table>