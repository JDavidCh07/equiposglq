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

    $datAll = $mprm->getAll("rrhhx");

    // Crear o seleccionar la hoja
    $sheet = $spreadsheet->getActiveSheet();
   
    // Agregar titulo hoja
    $nm = "PERMISOS";
    $sheet->setTitle($nm);
    
    // Agregar titulo
    $sheet->setCellValue('B1', 'PERMISOS');
    $merge = 'B1:J1';
    $sheet->mergeCells($merge);
    $style = $sheet->getStyle('B1');
    $style->getFont()->setBold(true)->setSize(15);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF92D050');
    
    // Agregar encabezados
    $sheet->setCellValue('B2', 'FECHA INICIO');
    $sheet->setCellValue('C2', 'FECHA FIN');
    $sheet->setCellValue('D2', 'NUMERO DE DOCUMENTO');
    $sheet->setCellValue('E2', 'NOMBRE DEL TRABAJADOR');
    $sheet->setCellValue('F2', 'CARGO');
    $sheet->setCellValue('G2', 'DEPARTAMENTO');
    $sheet->setCellValue('H2', 'ORIGEN DEL EVENTO');
    $sheet->setCellValue('I2', 'TIEMPO EN HORAS');
    $sheet->setCellValue('J2', 'ESTADO');
    $style = $sheet->getStyle('B2:J2');
    $style->getFont()->setBold(true)->setSize(9);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF92D050');
    
    //información
    $datos = [];
    if ($datAll) {
        foreach ($datAll as $dat) {
            $filaDatos = [date("d", strtotime($dat['fecini']))."/".date("m", strtotime($dat['fecini']))."/".date("Y", strtotime($dat['fecini'])), date("d", strtotime($dat['fecfin']))."/".date("m", strtotime($dat['fecfin']))."/".date("Y", strtotime($dat['fecfin'])), $dat['dper'], $dat['aper']." ".$dat['nper'], $dat['cper'], strtoupper($dat['dpt']), strtoupper($dat['tprm']), tot($dat['hdif'], $dat['ddif']), (($dta['estprm']==3) ? 'APROBADO' : 'RECHAZADO')];
            // Agregar la fila completa al array $datos
            $datos[] = $filaDatos;
        }
    }

    // Agregar datos dinámicos
    $fila = 3; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
    foreach ($datos as $dato) {
        $sheet->fromArray($dato, NULL, 'B' . $fila);
        $fila++;
    }

    // Definir estilo de borde
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
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


    // Aplicar estilo de borde y alineación a todo el rango de datos
    $range = 'B1:J' . ($fila - 1); // Rango que cubre todos los datos
    $sheet->getStyle($range)->applyFromArray($styleArray);
    $sheet->getStyle($range)->applyFromArray($alignmentStyleC);
    // $sheet->getStyle('M4:Z' . ($fila - 1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);

    // Ajustar la altura de las filas y el ancho de las columnas
    foreach (range('B', 'J') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);
    foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);

    // Agregar imagen
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../img/logoynombre.png'); // Ruta a tu imagen
    $drawing->setHeight(20); // Altura de la imagen
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

    function tot($time, $days) {
        $minxdia = 0;
        $totmindia = (8*60) + 30;
        list($h, $m, $s) = explode(':', $time);
        $totminreg = ($h * 60) + $m + ($s / 60);

        $minxdia = $days * $totmindia;
        $tot = ($totminreg + $minxdia)/60;

        return number_format($tot, 2, ",", "");
    }
?>