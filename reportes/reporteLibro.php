<?php
require('../lib/fpdf/fpdf.php');
// Conexion a la base de datoa
require_once '../consultas.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php'); // Redirigir si no está logueado
    exit();
} 

// Reporte de libros
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(0,10,'LISTA DE AUTORES',0,1,'C');
$pdf->ln();
// Cabecera de datos de reporte
$pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Nombre',1,0,'C');
    $pdf->Cell(60,10,'Apellido Paterno',1,0,'C');
    $pdf->Cell(60,10,'Apellidos Materno',1,1,'C');

// Datos del reporte
$pdf->SetFont('Times','',14);
// var_dump(libro($con));die
foreach (autor($con) as $key =>$date) {
    $pdf->Cell(40,10,$date['nombre'],1,0,'C');
    $pdf->Cell(60,10,$date['apePaterno'],1,0,'C');
    $pdf->Cell(60,10,$date['apeMaterno'],1,1,'C');
}

$pdf->Output();
?>