<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php'); // Redirigir si no está logueado
    exit();
} 
require('../lib/fpdf/fpdf.php');
require_once '../consultas.php';

class PDF extends FPDF
{
// Page header
function Header()
{
	$this->SetDrawColor(0,100,100);
	// Logo
	$this->Image('../img/eispdm.jpg',10,6,30);
	
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// 
	$this->Cell(70);
	// Titulo
	$this->Cell(50,10,'Lista de autores',1,0,'C');

	$this->Image('../img/eispdm.jpg',170,6,30);
	// Salto de linea
	$this->Ln(30);

	
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Lista de libros

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

// Cabecera de datos de reporte
$pdf->SetFont('Arial','B',10);
    $pdf->Cell(60,10,'Titulo',1,0,'C');
    $pdf->Cell(20,10,'ISBM',1,0,'C');
    $pdf->Cell(30,10,'Autor',1,0,'C');
    $pdf->Cell(30,10,'Editorial',1,0,'C');
    $pdf->Cell(25,10,'Paginas',1,0,'C');
	$pdf->Cell(25,10,'Portada',1,1,'C');

// Datos del reporte
$pdf->SetFont('Times','',12);
// var_dump(libro($con));die
$fill = false;
foreach (libro($con) as $key =>$date) {
    $pdf->Cell(60,20,$date['titulo'],1,0,'C');
    $pdf->Cell(20,20,$date['isbn'],1,0,'C');
	$pdf->Cell(30,20,$date['nombre'],1,0,'C');
    $pdf->Cell(30,20,$date['editorial'],1,0,'C');
    $pdf->Cell(25,20,$date['paginas'],1,0,'C');

    // Obtener la ruta de la portada
    $portada = $date['fotos'];

    // Comprobar si la ruta no está vacía y si el archivo existe
    if (!empty($portada) && file_exists($portada)) {
        // Guardamos la posición actual
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        // Insertamos la imagen
        $pdf->Image($portada, $x + 5, $y + 2, 12); // +2 para centrar verticalmente
        // Aumentamos la altura de la celda para que el contenido se ajuste
        $pdf->Cell(25, 20, '', 1, 1, 'C'); // Espacio para la celda de imagen
    } else {
        $pdf->Cell(25, 20, 'No Image', 1, 1, 'C'); // O puedes mostrar una imagen predeterminada
    }
	$fill = !$fill;
}
$pdf->Output();
?>
