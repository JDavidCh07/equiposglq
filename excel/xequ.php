<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mequ.php');

require ('../vendor/autoload.php');

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

$mequ = new Mequ();

$pgs = [52, 54];

foreach($pgs AS $index=>$pg){    
    ($pg==52) ? $datAll = $mequ->getAll(52) : $datAll = $mequ->getAll(54);
    // Crear o seleccionar la hoja
    if ($index == 0) {
        $sheet = $spreadsheet->getActiveSheet();
    } else {
        $spreadsheet->createSheet();
        $sheet = $spreadsheet->getSheet($index);
    }

    // Agregar titulo hoja
    $nm = ($pg==52) ? "EQUIPOS" : "CELULARES";
    $sheet->setTitle($nm);

    $collim = ($pg==52) ? 'L' : 'F';

    // Agregar titulo
    $sheet->setCellValue('A1', 'BASE DE DATOS');
    $sheet->mergeCells('A1:'.$collim.'1');
    $style = $sheet->getStyle('A1');
    $style->getFont()->setBold(true)->setSize(18);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('99A9D08E');

    // Agregar titulos

    $titulo = ['MARCA', 'MODELO', ($pg == 52) ? 'SERIAL' : 'IMEI',];
    if ($pg == 52) $titulo = array_merge($titulo, ['TIPO', 'PROCESADOR',]);
    $titulo = array_merge($titulo, ['RAM', 'ALMACENAMIENTO',]);
    if ($pg == 52) $titulo = array_merge($titulo, ['RED', 'OFFICE', 'WINDOWS',]);
    $titulo[] = 'ESTADO';
    if ($pg == 52) $titulo[] = 'ESTADO';

    $sheet->fromArray([$titulo], NULL, 'A2');
    $style = $sheet->getStyle('A2:'.$collim.'2');
    $style->getFont()->setBold(true);

    //información
    $datos = [];

    if ($datAll) {
        foreach ($datAll as $dat) {
            $filaDatos = [$dat['marca'], $dat['modelo'], $dat['serialeq'],];

            if ($pg == 52) $filaDatos = array_merge($filaDatos, [$dat['tpe'], $dat['procs'],]);

            if($dat["capgb"]>=1000){
                $frmt = $dat["capgb"]/1000;
                $capgb = number_format($frmt,1,".",",").' TB';
            } else $capgb = $dat["capgb"].' GB';
            $filaDatos = array_merge($filaDatos, [$dat['ram'].' GB', $capgb,]);
            if ($pg == 52) {
                $filaDatos[] = $dat['nomred'];
                // Obtener y agregar datos adicionales de $mequ
                $mequ->setIdequ($dat["idequ"]);
                $prgs = $mequ->getOnePxE();
                if ($prgs) {
                    foreach ($prgs as $pr) {
                        $filaDatos[] = $pr['nomval'].' '.$pr['verprg'];
                    }
                } else $filaDatos = array_merge($filaDatos, [ '', '',]);
            }
            if($dat["actequ"]==1) $actequ = 'Disponible';
            elseif($dat["actequ"]==2)  $actequ = 'Asignado';
            elseif($dat["actequ"]==3)  $actequ = 'Inactivo';
            $filaDatos[] = $actequ;
            if ($pg == 52) $filaDatos[] = $dat['tpc'];

            // Agregar la fila completa al array $datos
            $datos[] = $filaDatos;
        }
    }
    
    // Agregar datos dinámicos
    $fila = 3; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
    $ind = array_search("IMEI", $titulo);
    foreach ($datos as $dato) {
        $sheet->fromArray($dato, NULL, 'A' . $fila);
        if($index==1 && $dato[$ind]){
            $col = getColumnLetter($ind);
            $sheet->getStyle($col.$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
        }
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
    $alignmentStyle = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];


    // Aplicar estilo de borde y alineación a todo el rango de datos
    $range = 'A1:'.$collim.($fila - 1); // Rango que cubre todos los datos
    $sheet->getStyle($range)->applyFromArray($styleArray);
    $sheet->getStyle($range)->applyFromArray($alignmentStyle);

    // Ajustar la altura de las filas y el ancho de las columnas
    foreach (range('A', $collim) as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);

    foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
     
    
    // Agregar imagen
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../img/logoynombre.png'); // Ruta a tu imagen
    $drawing->setHeight(30); // Altura de la imagen
    $drawing->setCoordinates('B1'); // Celda donde se ubicará la imagen
    $drawing->setWorksheet($sheet);
}

$spreadsheet->setActiveSheetIndex(0);

$filename = "EQUIPOS Y CELULARES GALQUI ";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

function getColumnLetter($index) {
    $index++;
    $letter = '';
    while ($index > 0) {
        $mod = ($index - 1) % 26;
        $letter = chr(65 + $mod) . $letter;
        $index = intval(($index - $mod) / 26);
    }
    return $letter;
}
?>