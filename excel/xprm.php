<?php
    require_once ("../models/seguridad.php");
    require_once ('../models/conexion.php');
    require_once ('../models/mprm.php');
    require ('../vendor/autoload.php');

    ini_set('memory_limit', '4096M');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Style\Alignment;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
    use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

    $spreadsheet = new Spreadsheet();
    $writer = new Xlsx($spreadsheet);
    $drawing = new Drawing();
    
    date_default_timezone_set('America/Bogota');
    $nmfl = date('d-m-Y H-i-s');

    $mprm = new Mprm();

    $fecini = isset($_REQUEST['fi']) ? $_REQUEST['fi']:NULL;
    $fecfin = isset($_REQUEST['ff']) ? $_REQUEST['ff']:NULL;
    $estprm = isset($_REQUEST['e']) ? $_REQUEST['e']:NULL;
    $ndper = isset($_REQUEST['n']) ? $_REQUEST['n']:NULL;
    $idvdpt = isset($_REQUEST['d']) ? $_REQUEST['d']:NULL;

    $ope = isset($_REQUEST['o']) ? $_REQUEST['o']:NULL;

    if($ope=='busc'){
        $mprm->setNdper($ndper);
        $mprm->setFecini($fecini);
        $mprm->setFecfin($fecfin);
        $mprm->setIdvdpt($idvdpt);
        $mprm->setEstprm($estprm);
        $datAll = $mprm->getAll("bus");
    } else $datAll = $mprm->getAll($_SESSION['idpef']);

    // Crear o seleccionar la hoja
    $sheet = $spreadsheet->getActiveSheet();
   
    // Agregar titulo hoja
    $nm = "PERMISOS";
    $sheet->setTitle($nm);
    
    // Agregar titulo
    $sheet->setCellValue('B1', 'PERMISOS');
    $merge = 'B1:AA1';
    $sheet->mergeCells($merge);
    $style = $sheet->getStyle('B1');
    $style->getFont()->setBold(true)->setSize(15);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF92D050');
    
    // Agregar encabezados
    $sheet->setCellValue('B2', 'FECHA');
    $sheet->mergeCells('B2:D2');
    $sheet->setCellValue('B3', 'DIA');
    $sheet->setCellValue('C3', 'MES');
    $sheet->setCellValue('D3', 'AÑO');
    $sheet->setCellValue('E2', 'NUMERO DE DOCUMENTO');
    $sheet->mergeCells('E2:E3');
    $sheet->setCellValue('F2', 'NOMBRE DEL TRABAJADOR');
    $sheet->mergeCells('F2:F3');
    $sheet->setCellValue('G2', 'SEXO');
    $sheet->mergeCells('G2:G3');
    $sheet->setCellValue('H2', 'CARGO');
    $sheet->mergeCells('H2:H3');
    $sheet->setCellValue('I2', 'DEPARTAMENTO');
    $sheet->mergeCells('I2:I3');
    $sheet->setCellValue('J2', 'ORIGEN DEL EVENTO');
    $sheet->mergeCells('J2:J3');
    $sheet->setCellValue('K2', 'PELIGRO');
    $sheet->mergeCells('K2:K3');
    $sheet->setCellValue('L2', 'CODIGO DIAGNOSTICO / RIESGO');
    $sheet->mergeCells('L2:L3');
    $sheet->setCellValue('M2', 'TIEMPO SEGÚN CAUSA AUSENTISMO');
    $sheet->mergeCells('M2:Z2');
    $sheet->setCellValue('AA2', 'HORAS');
    $sheet->mergeCells('AA2:AA3');
    $style = $sheet->getStyle('B2:Z3');
    $style->getFont()->setBold(true)->setSize(9);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF92D050');
    
    // Agregar titulos
    $titulo = ['EG', 'CM', 'AT', 'ATT', 'AC', 'EL', 'LM', 'LP', 'DP', 'CD', 'SANC', 'JE', 'LL', 'OTROS'];
    $sheet->fromArray([$titulo], NULL, 'M3');
    $style = $sheet->getStyle('M3:Z3');
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFEBF1DE');
    $style = $sheet->getStyle('AA2');
    $style->getFont()->getColor()->setARGB('FFFFFFFF'); 
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF4F6228');
    
    //información
    $datos = [];
    if ($datAll) {
        foreach ($datAll as $dat) {
            $filaDatos = [date("d", strtotime($dat['fecini'])), date("m", strtotime($dat['fecini'])), date("Y", strtotime($dat['fecini'])), $dat['dper'], $dat['aper']." ".$dat['nper'], substr($dat['sper'], 0, 1), $dat['cper'], strtoupper($dat['dpt']), strtoupper($dat['tprm']), "NO APLICA", "N/A", ""];

            if($dat['idvtprm']==41) $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 1);
            else $filaDatos = array_merge($filaDatos, ["", "", "", "", "", "", ""]);
            if($dat['idvtprm']==42) $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 1);
            else $filaDatos[] = "";
            if($dat['idvtprm']==43) $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 1);
            else $filaDatos = array_merge($filaDatos, ["", ""]);
            if($dat['idvtprm']==44) $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 1);
            else $filaDatos = array_merge($filaDatos, ["", ""]);
            if($dat['idvtprm']==48) $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 1);
            else $filaDatos[] = "";

            $filaDatos[] = tot($dat['hdif'], $dat['ddif'], 2);

            // Agregar la fila completa al array $datos
            $datos[] = $filaDatos;
        }
    }

    // Agregar datos dinámicos
    $fila = 4; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
    foreach ($datos as $dato) {
        $sheet->fromArray($dato, NULL, 'B' . $fila);
        $fila++;
    }

    // Definir estilo de borde
    $styleArray = [
        'borders' => [
            'allBorders' => [                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ];

    // Definir estilo de alineación
    $alignmentStyleC = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    $alignmentStyleL = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    $alignmentStyleR = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];

    // Aplicar estilo de borde y alineación a todo el rango de datos
    $range = 'B1:AA' . ($fila - 1); // Rango que cubre todos los datos
    $sheet->getStyle($range)->applyFromArray($styleArray);
    $sheet->getStyle($range)->applyFromArray($alignmentStyleC);
    $sheet->getStyle('E4:E' . ($fila - 1))->applyFromArray($alignmentStyleR);
    $sheet->getStyle('F4:F' . ($fila - 1))->applyFromArray($alignmentStyleL);
    $sheet->getStyle('H4:L' . ($fila - 1))->applyFromArray($alignmentStyleL);
    // $sheet->getStyle('M4:Z' . ($fila - 1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);

    // Ajustar la altura de las filas y el ancho de las columnas
    foreach (range('B', 'Z') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);
    $sheet->getColumnDimension('AA')->setAutoSize(true);
    foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);

    // Agregar imagen
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../img/logoynombre.png'); // Ruta a tu imagen
    $drawing->setHeight(40); // Altura de la imagen
    $drawing->setCoordinates('B1'); // Celda donde se ubicará la imagen
    $drawing->setWorksheet($sheet);
    
    $spreadsheet->setActiveSheetIndex(0);

    $filename = "PERMISOS GALQUI ";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
    header('Cache-Control: max-age=0');

    // Crear el archivo Excel y enviarlo al navegador
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

    function tot($time, $days, $num) {
        $minxdia = 0;
        $totmindia = (8*60) + 30;
        list($h, $m, $s) = explode(':', $time);
        $totminreg = ($h * 60) + $m + ($s / 60);

        if($num==1){
            $minxdia = $days * $totmindia;
            $tot = ($totminreg + $minxdia)/$totmindia;
        }else if($num==2){
            $minxdia = $days * $totmindia;
            $tot = ($totminreg + $minxdia)/60;
        }
        return number_format($tot, 2, ",", "");
    }
?>