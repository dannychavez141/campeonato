<?php

include '../model/mConexion.php';
include '../model/mMetodos.php';
include '../model/mFunciones.php';
include './header.php';

$modelo = new mFunciones();
$alumnos = json_decode($modelo->todosEval($_GET), true);
$pdf = new FPDF('L', 'mm', 'A4');
;
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln(5);
$pdf->SetX(85);
$pdf->SetFont('Arial', 'BU', 11);
$pdf->Cell(130, 5, utf8_decode('EVALUACION DE ALUMNOS REGISTRADOS'), 0, 1, 'C');
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(5);
$pdf->SetX(5);
$pdf->Cell(10, 6, utf8_decode('N°'), 1, 0, 'C', 1);
$pdf->Cell(55, 6, 'DATOS DEL ALUMNO', 1, 0, 'C', 1);
$pdf->Cell(55, 6, 'DATOS DE APODERADO', 1, 0, 'C', 1);
$pdf->Cell(55, 6, 'I.E', 1, 0, 'C', 1);
$pdf->Cell(55, 6, 'CAMPEONATO', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'DEPORTE', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'EVALUACION', 1, 1, 'C', 1);
$nlista = 1;
if (count($alumnos) != 0) {
    foreach ($alumnos as $alumno) {
         $pdf->SetFont('Arial', '', 8);
        $pdf->SetX(5);
        $pdf->Cell(10, 6, $nlista, 1, 0, 'C');
        $pdf->Cell(55, 6, $alumno['nombAlu'] . " " . $alumno['apeAlu'], 1, 0, 'C');
        $pdf->Cell(55, 6, $alumno['nombApo'] . " " . $alumno['apeApo'], 1, 0, 'C');
        $pdf->Cell(55, 6, $alumno['descrEsc'], 1, 0, 'C');
        $pdf->Cell(55, 6, $alumno['descrCamp'], 1, 0, 'C');
        $pdf->Cell(25, 6, $alumno['descrDep'], 1, 0, 'C');

        if ($alumno['eval'] > 10) {
            $pdf->SetFillColor(100, 255, 100);
        } else {
            $pdf->SetFillColor(255, 100, 100);
        }
        $pdf->SetFont('Arial', 'BU', 13);
        $pdf->Cell(25, 6, $alumno['eval'], 1, 1, 'C', 1);
        $pdf->SetFillColor(255, 255, 255);
        $nlista++;
    }
      $pdf->SetFont('Arial', '', 8);
} else {
    $pdf->SetX(25);
    $pdf->Cell(160, 6, utf8_decode('NO HAY REGISTROS DE ALUMNOS  '), 1, 1, 'C');
}


$pdf->Ln(20);
$pdf->Cell(200, 6, '                    	______________________', 0, 0, 'C', 0);
$pdf->Ln(6);
$pdf->Cell(198, 6, '                        Firma Director', 0, 0, 'C', 0);
$modo = "I";
$nombre_archivo = "registro.pdf";
$pdf->Output($nombre_archivo, $modo);
