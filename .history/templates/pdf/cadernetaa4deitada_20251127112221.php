<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg',30,5,100);
    $this->SetFont('Arial','B',15);
    $this->Cell(80);
    $this->Ln(20);

    $this->SetLineWidth(1.0);
    $this->Line(5, 17, 140, 17);

    $this->SetLineWidth(0.6);
    $this->Line(5, 18.5, 140, 18.5);

    // Linha no meio (A4 Landscape)
    $this->SetLineWidth(0.5);
    $this->Line(5, 105, 292, 105);
}

// Page footer
function Footer()
{
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',10,195,130);
    $this->SetY(-25);
    $this->SetFont('Arial','I',8);

    $this->Cell(0,15,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    $this->SetY(-25);
    $this->Cell(0,15,'FCT.Caderneta.016/05',0,0,'L');

    $this->Line(0, 190, 297, 190);
}
}

// Instanciation of inherited class
$pdf = new PDF('L','mm','A4'); // A4 deitada
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();
?>
