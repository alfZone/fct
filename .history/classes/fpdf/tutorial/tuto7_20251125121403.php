<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddFont('../classes/fpdf/tutorial/CevicheOne','','../classes/fpdf/tutorial/CevicheOne-Regular.php','.');
$pdf->AddPage();
$pdf->SetFont('CevicheOne','',45);
$pdf->Write(10,'Enjoy new fonts with FPDF!');
$pdf->Output();
?>
