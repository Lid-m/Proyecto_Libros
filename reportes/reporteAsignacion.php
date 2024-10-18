<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php'); // Redirigir si no está logueado
    exit();
} 
require('../lib/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../img/eispdm.jpg', 10, 10, 30);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Boleta de Asignación de Materia', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    function TablaDatosPersonales($ci, $nombre, $apellido)
    {
        $this->SetFillColor(200, 220, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Datos Personales', 0, 1, 'L', true);
        
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'CI:', 0);
        $this->Cell(0, 10, $ci, 0, 1);
        $this->Cell(40, 10, 'Nombre:', 0);
        $this->Cell(0, 10, $nombre, 0, 1);
        $this->Cell(40, 10, 'Apellido:', 0);
        $this->Cell(0, 10, $apellido, 0, 1);
    }

    function TablaDatosCarrera($paralelo, $turno, $fechaInicio)
    {
        $this->SetFillColor(255, 200, 200);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Datos de Carrera', 0, 1, 'L', true);
        
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Paralelo:', 0);
        $this->Cell(0, 10, $paralelo, 0, 1);
        $this->Cell(40, 10, 'Turno:', 0);
        $this->Cell(0, 10, $turno, 0, 1);
        $this->Cell(40, 10, 'Fecha de Inicio:', 0);
        $this->Cell(0, 10, $fechaInicio, 0, 1);
    }

    function TablasLadoALado($ci, $nombre, $apellido, $paralelo, $turno, $fechaInicio)
    {
        // Posición inicial
        $this->SetXY(10, $this->GetY());
        
        // Primera tabla (Datos Personales)
        $this->SetFillColor(200, 220, 255);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(95, 10, 'Datos Personales', 1, 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'CI:', 1);
        $this->Cell(55, 10, $ci, 1);
        $this->Ln();
        $this->Cell(40, 10, 'Nombre:', 1);
        $this->Cell(55, 10, $nombre, 1);
        $this->Ln();
        $this->Cell(40, 10, 'Apellido:', 1);
        $this->Cell(55, 10, $apellido, 1);
        
        // Mover la posición Y para la segunda tabla
        $this->SetXY(110, $this->GetY() - 20); // Ajusta el valor -20 según sea necesario

        // Segunda tabla (Datos de Carrera)
        $this->SetFillColor(255, 200, 200);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(95, 10, 'Datos de Carrera', 1, 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Paralelo:', 1);
        $this->Cell(55, 10, $paralelo, 1);
        $this->Ln();
        $this->Cell(40, 10, 'Turno:', 1);
        $this->Cell(55, 10, $turno, 1);
        $this->Ln();
        $this->Cell(40, 10, 'Fecha de Inicio:', 1);
        $this->Cell(55, 10, $fechaInicio, 1);
        $this->Ln(10);
    }

    function TablaDetallesMaterias($materias)
    {
        $this->SetFillColor(200, 255, 200);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Detalles de Materias', 0, 1, 'L', true);
        $this->SetFont('Arial', 'B', 12);
        
        $this->Cell(40, 10, 'Nro.', 1, 0, 'C', true);
        $this->Cell(70, 10, 'Código', 1, 0, 'C', true);
        $this->Cell(70, 10, 'Asignatura', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Horas', 1, 1, 'C', true);
        
        $this->SetFont('Arial', '', 12);
        foreach ($materias as $index => $materia) {
            $this->Cell(40, 10, $index + 1, 1);
            $this->Cell(70, 10, $materia['codigo'], 1);
            $this->Cell(70, 10, $materia['asignatura'], 1);
            $this->Cell(30, 10, $materia['horas'], 1);
            $this->Ln();
        }
    }
}

// Datos de ejemplo
$ci = '12345678';
$nombre = 'Juan';
$apellido = 'Pérez';
$paralelo = 'A';
$turno = 'Mañana';
$fechaInicio = '01/01/2024';
$materias = [
    ['codigo' => 'MAT101', 'asignatura' => 'Matemáticas', 'horas' => 5],
    ['codigo' => 'FIS101', 'asignatura' => 'Física', 'horas' => 4],
    ['codigo' => 'QUI101', 'asignatura' => 'Química', 'horas' => 3],
];

// Creación del documento
$pdf = new PDF();
$pdf->AddPage();
$pdf->TablasLadoALado($ci, $nombre, $apellido, $paralelo, $turno, $fechaInicio);
$pdf->TablaDetallesMaterias($materias);
$pdf->Output();
?>
