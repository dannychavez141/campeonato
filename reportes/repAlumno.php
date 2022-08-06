<?php

include '../model/mConexion.php';
include '../model/mMetodos.php';
include '../model/mFunciones.php';
include './header.php';



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$modelo = new mFunciones();
$alumno = json_decode($modelo->uno($_GET['id']), true)[0];
//print_r($alumno);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetX(100);
$pdf->Cell(10, 5, 'FICHA DE ALUMNO REGISTRADO ', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->Cell(10, 5, 'DATOS DE ALUMNO ', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(30, 5, 'DNI ALUMNO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(1);
$pdf->SetX(40);
$pdf->Cell(100, 5, $alumno["dniAlu"], 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(30, 5, ' APELLIDOS Y NOMBRES :', 0, 1, 'C');
if ($alumno["foto"] == '0') {
    $pdf->Image('../img/logo.png', 140, 50, 45, 45);
} else {
    if (file_exists('../img/' . $alumno["dniAlu"] . '.' . $alumno['foto'])) {
        $pdf->Image('../img/' . $alumno["dniAlu"] . '.' . $alumno['foto'], 140, 50, 45, 45, $alumno['foto']);
    } else {
        $pdf->Image('../img/logo.png', 140, 50, 45, 45);
    }
}

$pdf->SetFont('Arial', '', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->MultiCell(80, 5, utf8_decode($alumno['nombAlu'] . " " . $alumno['apeAlu']), 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$dia = date("j");
$mes = date("n");
$ano = date("Y");

$nacimiento = explode("-", $alumno['fnacAlu']);
$dianac = $nacimiento[2];
$mesnac = $nacimiento[1];
$anonac = $nacimiento[0];
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual 
if (($mesnac == $mes) && ($dianac > $dia)) {
    $ano = ($ano - 1);
}
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual 
if ($mesnac > $mes) {
    $ano = ($ano - 1);
}
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
$edad = ($ano - $anonac);
$pdf->SetX(40);
$pdf->Cell(30, 5, 'FECHA DE NACIMIENTO / EDAD/ SEXO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(3);
$pdf->SetX(30);
if ($alumno['idSexo'] == "1") {
    $sex = "MASCULINO";
} else {
    $sex = "FEMENINO";
}
$pdf->Cell(100, 5, utf8_decode($alumno['fnacAlu'] . " / " . $edad . " AÑOS/ " . $sex), 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(45);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(10, 5, 'TALLA:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(25, 5, utf8_decode($alumno['tallaAlu']) . "M", 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(10, 5, 'PESO:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(25, 5, utf8_decode($alumno['pesoAlu']) . "KG", 0, 1, 'C');
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 5, 'COLEGIO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->SetX(40);
$pdf->Cell(40, 5, utf8_decode($alumno['descrEsc']), 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 5, 'CAMPEONATO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->SetX(40);
$pdf->Cell(40, 5, utf8_decode($alumno['descrCamp']) , 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(40);
$pdf->Cell(10, 5, 'DEPORTE:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->SetX(40);
$pdf->Cell(40, 5, utf8_decode($alumno['descrDep']) , 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'BU', 12);
$pdf->SetX(40);
$pdf->Cell(10, 5, 'DATOS DE APODERADO', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(30, 5, 'DNI APODERADO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(1);
$pdf->SetX(40);
$pdf->Cell(100, 5, utf8_decode($alumno['dniApo']), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(3);
$pdf->SetX(40);
$pdf->Cell(30, 5, 'DATOS DE APODERADO:', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(1);
$pdf->SetX(40);
$pdf->Cell(100, 5, utf8_decode($alumno['nombApo'] . " " . $alumno['apeApo']), 0, 1, 'C');

$modo = "I";
$nombre_archivo = "Ficha_alumno.pdf";
$pdf->Output($nombre_archivo, $modo);
