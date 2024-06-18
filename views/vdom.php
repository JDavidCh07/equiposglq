<?php
include('controllers/cdom.php');
?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomdom"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomdom" name="nomdom" value="<?php if ($datOne)
                echo $datOne[0]['nomdom']; ?>" required>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="iddom" value="<?php if ($datOne) echo $datOne[0]['iddom']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Dominio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <?= $dta['iddom']; ?> - <?= $dta['nomdom']; ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&iddom=<?= $dta['iddom']; ?>&ope=edi">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"  title="Editar"></i>
                        </a>
                        <?php 
                            $ct = $mdom->getVxD($dta['iddom']);
                            if ($ct && $ct[0]['can']==0) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&iddom=<?= $dta['iddom']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomdom']; ?>');">
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
            <th>Dominio</th>
            <th></th>
        </tr>
    </tfoot>
</table>
