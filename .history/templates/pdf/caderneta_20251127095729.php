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

function Footer()
{
    // Imagem do rodapé
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',35,280,150);

    // Texto à direita (FCT.Caderneta.016/05)
    $this->SetY(-20); // posição vertical (ajusta se necessário)
    $this->SetFont('Arial','I',9);
    $this->SetTextColor(70,70,70); // cinzento suave
    $this->Cell(0,5,'FCT.Caderneta.016/05',0,1,'R'); // ALINHADO À DIREITA

    // Número da página
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetTextColor(0,0,0);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
