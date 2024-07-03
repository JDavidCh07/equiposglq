<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/masg.php');
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

$masg = new Masg();
$mequ = new Mequ();

$asgs = ["equ", "cel"];

foreach($asgs AS $index=>$asg){
    if($asg=="equ"){
        $datAllA = $masg->getAllAsig(52);
        $datAcc = $masg->getAllAcc(3);
    }elseif($asg=="cel"){
        $datAllA = $masg->getAllAsig(54);
        $datAcc = $masg->getAllAcc(5);
    }
    
    // Crear o seleccionar la hoja
    if ($index == 0) {
        $sheet = $spreadsheet->getActiveSheet();
    } else {
        $spreadsheet->createSheet();
        $sheet = $spreadsheet->getSheet($index);
    }

    // Agregar titulo hoja
    $nm = ($asg=="equ") ? "EQUIPOS" : "CELULARES";
    $sheet->setTitle($nm);

    // Agregar titulo
    $sheet->setCellValue('A1', 'BASE DE DATOS');
    $sheet->mergeCells('A1:AB1');
    $style = $sheet->getStyle('A1');
    $style->getFont()->setBold(true)->setSize(30);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('99A9D08E');

    // Agregar encabezados
    $sheet->setCellValue('A2', 'DATOS DE TRABAJADOR');
    $sheet->mergeCells('A2:D2');
    $sheet->setCellValue('E2', 'DATOS DEL EQUIPO');
    $merge = ($asg=="equ") ? 'E2:K2':'E2:I2';
    $sheet->mergeCells($merge);
    $sheet->setCellValue('L2', 'ACCESORIOS');
    $merge = ($asg=="equ") ? 'L2:P2':'J2:P2';
    $sheet->mergeCells($merge);
    $sheet->setCellValue('Q2', 'DEVOLUCION');
    $sheet->mergeCells('Q2:V2');
    $sheet->setCellValue('W2', 'ENTREGA');
    $sheet->mergeCells('W2:AB2');
    $style = $sheet->getStyle('A2:AB2');
    $style->getFont()->setBold(true)->setSize(18);
    $style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('99A9D08E');

    // Agregar titulos

    $titulo = ['CEDULA', 'NOMBRE', 'CARGO', 'CORREO',];
    if ($asg == "equ") $titulo[] = 'TIPO';
    $titulo = array_merge($titulo, ['MARCA', 'MODELO', ($asg == "equ") ? 'SERIAL' : 'IMEI',]);
    if ($asg == "equ") $titulo = array_merge($titulo, ['RED', 'OFFICE', 'WINDOWS',]);
    if ($asg == "cel") $titulo = array_merge($titulo, ['NUMERO','OPERADOR',]);
    if($datAcc){ foreach($datAcc AS $dtac) $titulo[] = strtoupper($dtac["nomval"]);}
    $titulo = array_merge($titulo, ['FECHA ENTREGA', 'NOMBRE ENTREGA', 'CARGO', 'NOMBRE RECIBE', 'CARGO', 'OBSERVACIONES', 'FECHA DEVOLUCION', 'NOMBRE ENTREGA', 'CARGO', 'NOMBRE RECIBE', 'CARGO', 'OBSERVACIONES',
    ]);

    $sheet->fromArray([$titulo], NULL, 'A3');
    $style = $sheet->getStyle('A3:AB3');
    $style->getFont()->setBold(true);

    //información
    $datos = [];

    if ($datAllA) {
        foreach ($datAllA as $dat) {
            $filaDatos = [$dat['dprec'], $dat['prec'], $dat['cprec'], $dat['eprec'],];

            if ($asg == "equ") $filaDatos[] = $dat['tpe'];

            $filaDatos = array_merge($filaDatos, [ $dat['marca'], $dat['modelo'], $dat['serialeq'],]);

            if ($asg == "equ") {
                $filaDatos[] = $dat['nomred'];
                // Obtener y agregar datos adicionales de $mequ
                $mequ->setIdequ($dat["idequ"]);
                $prgs = $mequ->getOnePxE();
                if ($prgs) {
                    foreach ($prgs as $pr) {
                        $filaDatos[] = $pr['nomval'].' '.$pr['verprg'];
                    }
                } else $filaDatos = array_merge($filaDatos, [ '', '',]);
            } elseif ($asg == "cel") {
                $filaDatos = array_merge($filaDatos, [ $dat['numcel'], $dat['operador'],]);
            }

            // Agregar marcadores 'X' según la condición
            $datAxE = $masg->getAllAxE($dat["ideqxpr"]);
            if ($datAcc && $datAxE) {
                foreach ($datAcc as $dac) {
                    $marcadorEncontrado = false;
                    foreach ($datAxE as $dae) {
                        if ($dac['idval'] == $dae['idvacc']) {
                            $filaDatos[] = 'X';
                            $marcadorEncontrado = true;
                            break; // Terminar el bucle interno si se encuentra el marcador
                        }
                    }
                    if (!$marcadorEncontrado) {
                        $filaDatos[] = ''; // Opcional: dejar en blanco si no hay coincidencia
                    }
                }
            }

            // Agregar datos finales
            $filaDatos = array_merge($filaDatos, [ $dat['fecent'], $dat['pent'], $dat['cpent'], $dat['prec'], $dat['cprec'], $dat['observ'], $dat['fecdev'], $dat['pentd'], $dat['cpentd'], $dat['precd'], $dat['cprecd'], $dat['observd'],
            ]);

            // Agregar la fila completa al array $datos
            $datos[] = $filaDatos;
        }
    }

    // Agregar datos dinámicos
    $fila = 4; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
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
    $range = 'A1:AB' . ($fila - 1); // Rango que cubre todos los datos
    $sheet->getStyle($range)->applyFromArray($styleArray);
    $sheet->getStyle($range)->applyFromArray($alignmentStyle);

    // Ajustar la altura de las filas y el ancho de las columnas
    foreach (range('A', 'Z') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);
    $sheet->getColumnDimension('AA')->setAutoSize(true);
    $sheet->getColumnDimension('AB')->setAutoSize(true);

    foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
     
    
    // Agregar imagen
    $drawing = new Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('../img/logoynombre.png'); // Ruta a tu imagen
    $drawing->setHeight(50); // Altura de la imagen
    $drawing->setCoordinates('B1'); // Celda donde se ubicará la imagen
    $drawing->setWorksheet($sheet);
}

$spreadsheet->setActiveSheetIndex(0);

$filename = "ASIGNACION EQUIPOS GALQUI ";

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