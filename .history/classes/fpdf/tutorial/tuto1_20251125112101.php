<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Cell(80,10,'olá');
$pdf->Output();
?>
