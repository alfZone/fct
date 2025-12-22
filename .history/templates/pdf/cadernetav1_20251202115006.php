<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
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
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Text color in gray
	$this->SetTextColor(128);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function ChapterTitle($num, $label)
{
	// Arial 12
	$this->SetFont('Arial','',12);
	// Background color
	$this->SetFillColor(200,220,255);
	// Title
	$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
	// Line break
	$this->Ln(4);
}

function ChapterBody($file)
{
	// Read text file
	$txt = file_get_contents($file);
	// Times 12
	$this->SetFont('Times','',12);
	// Output justified text
	$this->MultiCell(0,5,$txt);
	// Line break
	$this->Ln();
	// Mention in italics
	$this->SetFont('','I');
	$this->Cell(0,5,'(end of excerpt)');
}

function PrintChapter($num, $title, $file)
{
	$this->AddPage();
	$this->ChapterTitle($num,$title);
	$this->ChapterBody($file);
}
}

$pdf = new PDF();
$title = '20000 Leagues Under the Seas';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->PrintChapter(1,'A RUNAWAY REEF','../templates/pdf/caderneta_fct.txt');
$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();
?>
