<?php include('controllers/cprm.php');
if ($datOne) {
    $fechai = (new DateTime($datOne[0]['fecini']))->format('Y-m-d\TH:i');
    $fechaf = (new DateTime($datOne[0]['fecfin']))->format('Y-m-d\TH:i');
}
if($_SESSION['idpef']==4){?>
    <form action="home.php?pg=<?= $pg; ?>" method="post">
        <div class="row">
            <div class="form-group col-md-3 col-sm-4">
                <label for="fecinib"><strong>Fecha inicial:</strong></label>
                <input type="date" name="fecini" id="fecinib" value="<?= $fecini; ?>" onchange="this.form.submit(); actMinMax();" class="form-control">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <label for="fecfinb"><strong>Fecha final:</strong></label>
                <input type="date" name="fecfin" id="fecfinb" value="<?= $fecfin; ?>" onchange="this.form.submit()" class="form-control">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <label for="ndper"><strong>Documento:</strong></label>
                <input type="text" name="ndper" id="ndper" value="<?= $ndper; ?>" onkeydown="return enter(event);" onchange="this.form.submit();" onkeypress="return solonum(event);" class="form-control">
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <label for="idvdpt"><strong>Departamento:</strong></label>
                <select name="idvdpt" id="idvdpt" class="form-control form-select" onchange="this.form.submit();" >
                    <option value="0">Seleccione...</option>
                    <?php foreach ($datDpt AS $dtd) { ?>
                        <option value="<?= $dtd['idval']; ?>" <?php if ($dtd['idval'] == $idvdpt) echo " selected "; ?>>
                            <?= $dtd['nomval']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <label for="idvtprm"><strong>T. Permiso:</strong></label>
                <select name="idvtprm" id="idvtprsh" class="form-control form-select" onchange="this.form.submit();" >
                    <option value="0">Seleccione...</option>
                    <?php foreach ($datTprm AS $dtm) { ?>
                        <option value="<?= $dtm['idval']; ?>" <?php if ($dtm['idval'] == $idvtprm) echo " selected "; ?>>
                            <?= $dtm['nomval']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-3 col-sm-4">
                <label for="estprm"><strong>Estado:</strong></label>
                <select name="estprm" id="estprm" class="form-control form-select" onchange="this.form.submit();">
                    <option value="0">Seleccione...</option>
                    <option value="3" <?php if ($estprm && $estprm == 3) echo " selected "; ?>>Aprobados</option>
                    <option value="4" <?php if ($estprm && $estprm == 4) echo " selected "; ?>>Rechazados</option>
                </select>
            </div>
            <input type="hidden" name="ope" value="busc">
            <div class="form-group col-md-3 col-sm-4" id="btnprm">
                <div>
                    <button type="submit" title="Limpiar" value="limp" name="ope" style="border: none;">
                        <i class="fa fa-solid fa-eraser fa-2x desact"></i>
                    </button>
                </div>
                <div>
                    <?php 
                        modalExport($fecini, $fecfin, $ndper, $idvdpt);
                    ?>
                    <i class="fa fa-solid fa-file-export fa-2x act" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#export" title="Exportar"></i>                                
                </div>
                <?php if($datGra){ ?>
                    <div>
                        <i class="fa fa-solid fa-chart-simple fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#grafprm" title="Gráfica"></i>                                
                    </div>
                <?php } ?>
            </div>
        </div>
    </form>
<?php } ?>

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
                <?php if ($datJef) { foreach ($datJef as $dpr) { ?>
                        <option value="<?= $dpr['idper']; ?>" <?php if ($datOne && $dpr['idper'] == $datOne[0]['ijef']) echo " selected "; ?>>
                            <?= $dpr['nomjef']; ?>     
                        </option>
                <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="fecini"><strong>Desde:</strong></label>
            <input class="form-control" type="datetime-local" id="fecini" name="fecini" value="<?php if ($datOne){ if ($fechai) echo $fechai;}; ?>" step="900" required>
            <small id="error-message-fecini" style="color: red; display: none;"></small>
        </div>
        <div class="form-group col-md-4">
            <label for="fecfin"><strong>Hasta:</strong></label>
            <input class="form-control" type="datetime-local" id="fecfin" name="fecfin" value="<?php if ($datOne){ if ($fechaf) echo $fechaf;}?>" step="900" required>
            <small id="error-message-fecfin" style="color: red; display: none;"></small>
        </div>
        <div class="form-group col-md-4">
            <label for="arcspt"><strong>Soporte:</strong></label>
            <input class="form-control" type="file" id="arcspt" name="arcspt" accept=".pdf, image/png,image/jpeg">
            <small id="soporte-requerido" style="color: red; display: none;">Este campo es obligatorio.</small>
        </div>
        <div class="form-group col-md-12">
            <label for="desprm"><strong>Justificación:</strong></label>
            <textarea placeholder="Por favor especifique el motivo de su solicitud" class="form-control" type="text" id="desprm" name="desprm" required oninput="contar()"><?php if ($datOne) echo $datOne[0]['desprm']; ?></textarea>
            <small id="error-message-des" style="color: red; display: none;"></small>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="estprm" value="1">
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
                            <?php if($_SESSION['idpef']==4){ ?>
                                <span style="font-size: 0px;opacity: 0;"><?=$dta['fecsol'];?></span>
                            <?php } ?>
                            <BIG><strong><?php if($_SESSION['idpef']==3) echo $dta['tprm']; else echo $dta['dper']." - ".$dta['aper']." ".$dta['nper']?></strong></BIG>
                            <small>
                                <div class="row">
                                    <?php if($_SESSION['idpef']==4 && $dta['tprm']){?>
                                        <div class="form-group col-md-12">
                                            <strong><?php if($dta['noprm']) echo "N° ".$dta['noprm']." - "; echo $dta['tprm'];?></strong>
                                        </div>
                                    <?php } ?>
                                    <?php if ($dta['fini'] && $dta['hini']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>F. Inicio: </strong> <?= $dta['fini']." - ".$dta['hini']; ?>
                                        </div>
                                    <?php } if ($dta['ffin'] && $dta['hfin']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>F. Fin: </strong> <?= $dta['ffin']." - ".$dta['hfin']; ?>
                                        </div>
                                    <?php } if ($dta['ddif'] OR $dta['hdif']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Tiempo: </strong> 
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
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['idprm'] ?>', 'spt', '<?= basename($dta['sptrut']) ?>')"></i>
                            <?php } elseif($_SESSION['idpef']==4 && $dta['rutpdf'] && file_exists($dta['rutpdf'])) { ?>
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['idprm'] ?>', 'pdf', '<?= basename($dta['rutpdf']) ?>')"></i>
                            <?php } ?>
                        </div>
                    </div>
                </td>
                <td style="text-align: left;">
                    <?php
                    if($dta['idvtprm']==43) $fecha = $hoyh; 
                    else $fecha = $mañanah;
                    if ($dta['estprm'] == 1){
                        if ($fecha<=$dta['fecini']) { ?>
                            <span style="font-size: 1px;opacity: 0;">1</span>
                            <a href="views/pdfprm.php?idprm=<?=$dta['idprm'];?>&estprm=2" title="Enviar solicitud" target="_blank" onclick="setTimeout(() => location.reload(), 1000);">
                                <i class="fa fa-solid fa-paper-plane fa-2x iconi" title="Enviar"></i>
                            </a>
                        <?php } else{?>
                            <span style="font-size: 1px;opacity: 0;">5</span>
                            <i class="fa fa-solid fa-circle-exclamation fa-2x iconi" title="Fuera de Tiempo"></i>
                    <?php }} else if ($dta['estprm'] == 2){
                        if ($fecha<=$dta['fecini']) { ?>
                            <span style="font-size: 1px;">2</span>
                            <i class="fa fa-solid fa-clock fa-2x iconi" title="Enviado/Pendiente"></i>
                        <?php } else {
                            $obs = "Tiempo de espera excedido";
                            $mprm->setIdprm($dta['idprm']);
                            $mprm->setEstprm(4);
                            $mprm->setFecrev($hoy);
                            $mprm->setObsprm($obs);
                            $mprm->editAct();
                        ?>
                            <span style="font-size: 1px;opacity: 0;">5</span>
                            <i class="fa fa-solid fa-circle-exclamation fa-2x iconi" title="Fuera de Tiempo"></i>
                    <?php }} else if ($dta['estprm'] == 3) { ?>
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
            <th>Datos permisos</th>
            <th>Estado</th>
            <?php if($_SESSION['idpef']==3){ ?><th></th><?php } ?>
        </tr>
    </tfoot>
</table>
<?php 
    if($solper){ 
        titulo("fa fa-solid fa-file-circle-check", "Solicitudes", 0, $pg);?>
    <table id="mytable1" class="table table-striped">
        <thead>
            <tr>
                <th>Datos Solicitudes</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solper as $slp) { ?>
                <tr>
                    <td>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <span style="font-size: 0px;opacity: 0;"><?=$slp['fecsol'];?></span>
                                <BIG><strong><?= $slp['dper']." - ".$slp['aper']." ".$slp['nper']?></strong></BIG>
                                <small>
                                    <div class="row">
                                        <?php if ($slp['tprm']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>Motivo: </strong> <?=$slp['tprm'];?>
                                            </div>
                                        <?php } if ($slp['fini'] && $slp['hini']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>F. Inicio: </strong> <?= $slp['fini']." - ".$slp['hini']; ?>
                                            </div>
                                        <?php } if ($slp['ffin'] && $slp['hfin']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>F. Fin: </strong> <?= $slp['ffin']." - ".$slp['hfin']; ?>
                                            </div>
                                        <?php } if ($slp['ddif'] OR $slp['hdif']) { ?>
                                            <div class="form-group col-md-12">
                                                <strong>Tiempo: </strong> 
                                                <?php if($slp['ddif']){ echo $slp['ddif']; if($slp['ddif']==1) echo " día "; else echo " días ";
                                                }else echo $slp['hdif']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </small>
                            </div>
                            <div class="form-group col-md-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbprm<?= $slp['idprm']; ?>" title="Detalles"></i>
                                <?php 
                                    $mprm->setIdprm($slp['idprm']);
                                    $det = $mprm->getOne();
                                    modalInfPrm("mcbprm", $slp['idprm'], $det);
                                if($slp['rutpdf'] && file_exists($slp['rutpdf'])) { ?>
                                    <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $slp['idprm'] ?>', 'pdf', '<?= basename($slp['rutpdf']) ?>')"></i>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($slp['estprm'] == 2){
                            if ($hoyh<=$slp['fecini']) { 
                                $mprm->setIdprm($slp['idprm']);
                                $inf = $mprm->getOne();
                                $pfec = explode(' ', $inf[0]['fini']);
                                $fec = strtoupper($pfec[0].' de '.$pfec[2]);
                                modalRecPrm("mcbrprm", $slp['idprm'], $slp['nper']." ".$slp['aper']." - ".$fec);    
                            ?>
                                <a href="views/pdfprm.php?idprm=<?= $slp['idprm']; ?>&estprm=3&idrev=<?= $_SESSION['idper']; ?>" title="Aprobar" onclick="confirmar('¿Está seguro de aprobar este permiso?\n\n- <?= $slp['tprm'].'-'.$slp['nper'].' '.$slp['aper'] ?>', this.href); return false;">
                                    <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                                </a>
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbrprm<?= $slp['idprm']; ?>" title="Rechazar"></i>
                            <?php }else{ 
                                $obs = "Tiempo de espera excedido";
                                $mprm->setIdprm($slp['idprm']);
                                $mprm->setEstprm(4);
                                $mprm->setFecrev($hoy);
                                $mprm->setObsprm($obs);
                                $mprm->editAct();
                            ?>
                                <span style="font-size: 1px;opacity: 0;">5</span>
                                <i class="fa fa-solid fa-circle-exclamation fa-2x iconi" title="Fuera de Tiempo"></i>
                        <?php }} else if ($slp['estprm'] == 3) { ?>
                            <span style="font-size: 1px;">3</span>
                            <i class="fa fa-solid fa-circle-check fa-2x act" title="Aprobado"></i>
                        <?php } else if ($slp['estprm'] == 4) { ?>
                            <span style="font-size: 1px;">4</span>
                            <i class="fa fa-solid fa-circle-xmark fa-2x desact" title="Rechazado"></i>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Datos solicitudes</th>
                <th>Resultado</th>
            </tr>
        </tfoot>
    </table>
<?php } ?>
<div class="modal fade" id="grafprm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" style="text-align: left;">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <div style="text-align: center;">
                        <button class="btn btn-primary" id="plain">Vertical</button>
                        <button class="btn btn-primary" id="inverted">Horizontal</button>
                        <button class="btn btn-primary" id="polar">Polar</button>
                    </div>
                </figure>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btnmd" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

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
    
    /*----- CSS Información de la gráfica -----*/

    #container {
        height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    .imgmod{
        max-width: 150px;
    }

    @media screen and (max-width: 600px){
        
        .imgmod{
            max-width: 75px;
        }

    }
</style>

<!-- JS Funcionamiento de la gráfica -->
<script type="text/javascript">
    const chart = Highcharts.chart('container', {
        lang: {
            viewFullscreen: "Ver en pantalla completa",
            printChart: "Imprimir",
            downloadPNG: "Descarga imagen PNG",
            downloadJPEG: "Descarga imagen JPEG",
            downloadPDF: "Descarga documento PDF",
            downloadSVG: "Descarga SVG",
            downloadXLS: "Descarga XLS",
            downloadCSV: "Descarga CSV",
            viewData: "Ver tabla de datos",
            exitFullscreen: "Salir de pantalla completa"
        },

        credits: {
            enabled: false
        },

        title: {
            text: 'Cantidad de solicitudes por departamento',
            align: 'left'
        },

        colors: [
            '#C65911',
            '#BF8F00',
            '#548235',
            '#305496',
            '#7030A0'
        ],

        yAxis: {
            title: {
                text: 'PERMISOS',
                style: {
                    fontWeight: 'bold',
                }
            },
            tickInterval: 1
        },

        xAxis: {
            title: {
                text: 'DEPARTAMENTO',
                style: {
                    fontWeight: 'bold',
                }
            },
            categories: [
                <?php if ($datGra) { foreach ($datGra as $dtgn) { ?>
                    '<?= $dtgn['dpto']; ?>',
                <?php }} ?>
            ]
        },

        series: [{
            type: 'column',
            name: 'PERMISOS',
            borderRadius: 5,
            colorByPoint: true,
            data: [<?php if ($datGra) { foreach ($datGra as $dtgc) { ?>
                    <?= $dtgc['cn']; ?>,
                <?php }} ?>
            ],
            showInLegend: false
        }]
    });

    document.getElementById('plain').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },

            yAxis: {
                title: {
                    text: 'PERMISOS',
                    style: {
                        fontWeight: 'bold',
                    }
                },
                tickInterval: 1
            },
            

            xAxis: {
                title: {
                    text: 'DEPARTAMENTO',
                    style: {
                        fontWeight: 'bold',
                    }
                },
            },

        });
    });

    document.getElementById('inverted').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },

            yAxis: {
                title: {
                    text: 'PERMISOS',
                    style: {
                        fontWeight: 'bold',
                    }
                },
                tickInterval: 1
            },

            xAxis: {
                title: {
                    text: 'DEPARTAMENTO',
                    style: {
                        fontWeight: 'bold',
                    }
                },
            },

        });
    });

    document.getElementById('polar').addEventListener('click', () => {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },

            yAxis: {
                title: {
                    text: ''
                },
                tickInterval: 1
            },

            xAxis: {
                title: {
                    text: ''
                },
            },
        });
    });
</script>