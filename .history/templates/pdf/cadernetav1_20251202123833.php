<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
protected $col = 0; // Current column
protected $y0;      // Ordinate of column start

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
function Footer()
{
    // Rodapé ESQUERDA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',10,195,130);
	    // Linha inferior
		$this->Line(5, 190, 140, 190);

    // Rodapé DIREITA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png',158.5,195,130);
	$this->Line(155, 190, 290, 190);

    // Textos do footer esquerda
    $this->SetY(-25);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,15,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    $this->SetY(-25);
    $this->Cell(0,15,'FCT.Caderneta.016/05',0,0,'L');


}

function SetCol($col)
{
	// Set position at a given column
	$this->col = $col;
	$x = 10+$col*150;
	$this->SetLeftMargin($x);
	$this->SetX($x);
}

function AcceptPageBreak()
{
	// Method accepting or not automatic page break
	if($this->col<1)
	{
		// Go to next column
		$this->SetCol($this->col+1);
		// Set ordinate to top
		$this->SetY($this->y0);
		// Keep on page
		return false;
	}
	else
	{
		// Go back to first column
		$this->SetCol(0);
		// Page break
		return true;
	}
}

function ChapterTitle($num, $label)
{
	// Title
	$this->SetFont('Arial','',12);
	$this->SetFillColor(200,220,255);
	$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
	$this->Ln(4);
	// Save ordinate
	$this->y0 = $this->GetY();
}

function ChapterBody($file)
{
	// Read text file
	$txt = file_get_contents($file);
	$txt = utf8_decode($txt); 
	// Font
	$this->SetFont('Times','',12);
	// Output text in a 6 cm width column
	$this->MultiCell(120,5,$txt);
	$this->Ln();
	// Mention
	$this->SetFont('','I');
	$this->Cell(0,5,'(end of excerpt)');
	// Go back to first column
	$this->SetCol(0);
}

function PrintChapter($num, $title, $file)
{
	// Add chapter
	$this->AddPage();
	//$this->ChapterTitle($num,$title);
	$this->ChapterBody($file);
}
}

$pdf = new PDF('L','mm','A4'); // A4 deitada

$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->PrintChapter(1,'','../templates/pdf/caderneta_fct.txt');
//$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();

/*$pdf = new PDF();
$title = '20000 Leagues Under the Seas';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->PrintChapter(1,'A RUNAWAY REEF','../classes/fpdf/tutorial/20k_c1.txt');
$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();*/
?>