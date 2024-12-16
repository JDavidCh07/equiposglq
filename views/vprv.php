<?php
include('controllers/cprv.php');
?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label><strong>Documento:</strong></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="idvtpd" id="idvtpd" class="form-control form-select" required>
                        <?php foreach ($dattpd as $dtt) { ?>
                            <option value="<?= $dtt['idval']; ?>" <?php if ($datOne && $dtt['idval'] == $datOne[0]['idvtpd']) echo " selected "; ?>>
                                <?= $dtt['nomval']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input class="form-control" type="text" id="ndprv" name="ndprv" value="<?php if ($datOne) echo $datOne[0]['ndprv']; ?>" onkeypress="return solonum(event);" required>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="nomprv"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomprv" name="nomprv" value="<?php if ($datOne)
                echo $datOne[0]['nomprv']; ?>" required>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idprv" value="<?php if ($datOne) echo $datOne[0]['idprv']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Proveedor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <big><strong>
                            <?= $dta['nomprv']; ?>
                        </strong></big><br>
                        <?= $dta['tdoc']." ".$dta['ndprv']; ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idprv=<?= $dta['idprv']; ?>&ope=edi">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"  title="Editar"></i>
                        </a>
                        <?php 
                            $ct = $mprv->getPxL($dta['idprv']);
                            if ($ct && $ct[0]['can']==0) { ?>
                            <a href="home.php?pg=<?= $pg; ?>&idprv=<?= $dta['idprv']; ?>&ope=eli" onclick="return eliminar('<?= $dta['nomprv']; ?>');">
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
            <th>Proveedor</th>
            <th></th>
        </tr>
    </tfoot>
</table>
