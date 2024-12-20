<?php
include('controllers/cprg.php');
?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomprg"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomprg" name="nomprg" value="<?php if ($datOne) echo $datOne[0]['nomprg']; ?>" required>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idprg" value="<?php if ($datOne) echo $datOne[0]['idprg']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Programa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <?= $dta['nomprg']; ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idprg=<?= $dta['idprg']; ?>&ope=edi">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"  title="Editar"></i>
                        </a>
                        <?php 
                            $ct = $mprg->getLxP($dta['idprg']);
                            if ($ct && $ct[0]['can']==0) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idprg=<?= $dta['idprg']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomprg']; ?>');">
                                <i class="fa fa-solid fa-trash-can fa-2x iconi" title="Eliminar"></i>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Programa</th>
            <th></th>
        </tr>
    </tfoot>
</table>
