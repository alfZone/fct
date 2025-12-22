<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg',55,5,100);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
//	$this->Cell(30,10,'Title',1,0,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	$this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',55,300,100);
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//for($i=1;$i<=200;$i++)
//	$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
