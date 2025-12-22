<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Cabeçalho ESQUERDA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg',30,5,100);

    // Cabeçalho DIREITA (duplicado)
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg',178.5,5,100);

    // Linhas no topo (esquerda)
    $this->SetFont('Arial','B',15);
    $this->Ln(20);

    $this->SetLineWidth(1.0);
    $this->Line(5, 17, 140, 17);

    $this->SetLineWidth(0.6);
    $this->Line(5, 18.5, 140, 18.5);

    // Linhas no topo (direita)
    $this->SetLineWidth(1.0);
    $this->Line(153.5, 17, 288.5, 17);

    $this->SetLineWidth(0.6);
    $this->Line(153.5, 18.5, 288.5, 18.5);

 

    // Linha vertical central (divide página em duas)
    $this->SetLineWidth(0.6);
    $this->Line(148.5, 0, 148.5, 210);
}

// Page footer
function Footer()
{
    // Rodapé ESQUERDA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',10,195,130);
	    // Linha inferior
		$this->Line(5, 190, 140, 190);

    // Rodapé DIREITA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',158.5,195,130);
	$this->Line(155, 190, 270, 190);

    // Textos do footer esquerda
    $this->SetY(-25);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,15,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    $this->SetY(-25);
    $this->Cell(0,15,'FCT.Caderneta.016/05',0,0,'L');


}
}

// Instanciation of inherited class
$pdf = new PDF('L','mm','A4'); // A4 deitada
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();
?>
