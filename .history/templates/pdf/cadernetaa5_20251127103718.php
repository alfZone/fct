<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg',30,5,100);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
//	$this->Cell(30,10,'Title',1,0,'C');
	// Line break
	$this->Ln(20);
	$this->SetLineWidth(1.0); // 0.8 mm de espessura
	$this->Line(5, 17, 120, 17);

	$this->SetLineWidth(0.6); // 0.8 mm de espessura
	$this->Line(5, 18.5, 120, 18.5);
	


}

// Page footer
function Footer()
{
	$this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',10,195,130);
	// Position at 1.5 cm from bottom
	$this->SetY(-25);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,15,'Page '.$this->PageNo().'/{nb}',0,0,'R');
	$this->SetY(-25);
	$this->Cell(0,15,'FCT.Caderneta.016/05',0,0,'L');
	$this->Line(0, 190, 200, 190);

}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage("P","A5");
$pdf->SetFont('Times','',12);
//for($i=1;$i<=200;$i++)
//	$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
