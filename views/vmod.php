<?php
include('controllers/cmod.php');
?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nommod"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nommod" name="nommod" value="<?php if ($datOne) echo $datOne[0]['nommod']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="arcimg"><strong>Imagen:</strong></label>
            <input class="form-control" type="file" id="arcimg" name="arcimg" accept="image/png,image/jpeg,image/gif" <?php if(!$datOne) echo "required";?>>
        </div>
        <div class="form-group col-md-6">
            <label for="actmod" class="titulo"><strong>Activo:</strong></label>
            <select name="actmod" id="actmod" class="form-control form-select" required>
                <option value="1" <?php if ($datOne && $datOne[0]['actmod'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['actmod'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="idpag"><strong>Página:</strong></label>
            <select name="idpag" id="idpag" class="form-control form-select" required>
                <?php foreach ($datPag as $dtp) { ?>
                    <option value="<?= $dtp['idpag']; ?>" <?php if ($datOne && $dtp['idpag'] == $datOne[0]['idpag']) echo " selected "; ?>>
                        <?= $dtp['idpag'] . " - " . $dtp['nompag']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idmod" value="<?php if ($datOne) echo $datOne[0]['idmod']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Logo</th>
            <th>Módulo</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td style="width: 170px;">
                        <?php if (file_exists($dta['imgmod'])) { ?>
                            <img class="imgmod" src="<?= $dta['imgmod'] ?>" alt="Logo módulo <?= $dta['nommod'] ?>">
					    <?php }else{ ?>
					    	<img class="imgmod" src="img/logo.png" alt="Logo módulo <?= $dta['nommod']; ?>"/>
					    <?php } ?>
                    </td>
                    <td>
                        <BIG><?= $dta['idmod']." - ".$dta['nommod']; ?></BIG>
                        <small><br>
                            <?php if ($dta['idpag']) { ?>
                                <strong>Página:</strong> <?= $dta['idpag']." - ".$dta['nompag']; ?>
                            <?php } ?>
                        </small>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['actmod'] == 1) { ?>
                            <span style="font-size: 1px;opacity: 0;">+</span>
                            <a href="home.php?pg=<?= $pg; ?>&idmod=<?= $dta['idmod']; ?>&actmod=2&ope=act" title="Activo">
                                <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                            </a>
                        <?php } else { ?>
                            <span style="font-size: 1px;">--</span>
                            <a href="home.php?pg=<?= $pg; ?>&idmod=<?= $dta['idmod']; ?>&actmod=1&ope=act" title="Inactivo">
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="home.php?pg=<?= $pg; ?>&idmod=<?= $dta['idmod']; ?>&ope=edi" title="Editar">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                        </a>
                        <?php 
                            $ct = $mmod->getMxP($dta['idmod']);
                            if($ct && $ct[0]['can']==0){ ?> 
                                <a href="home.php?pg=<?= $pg; ?>&idmod=<?= $dta['idmod']; ?>&ope=del" onclick="return eliminar('<?= $dta['nommod']; ?>');" title="Eliminar">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                                </a>
                        <?php } ?>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Logo</th>
            <th>Módulo</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </tfoot>
</table>

<style>
    .imgmod{
        max-width: 150px;
    }

    @media screen and (max-width: 600px){
        
        .imgmod{
            max-width: 75px;
        }

    }
</style>
