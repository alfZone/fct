<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        global $title;
        $this->SetFont('Arial','B',15);
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(220,50,50);
        $this->SetLineWidth(1);
        $this->Cell($w,9,$title,1,1,'C',true);
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(128);
        $this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
    }

    function ChapterTitle($num, $label)
    {
        $this->SetFont('Arial','',12);
        $this->SetFillColor(200,220,255);
        $this->Cell(0,6,"$label",0,1,'L',true);
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        $txt = file_get_contents($file);
        $this->SetFont('Times','',12);
        $this->MultiCell(0,5,$txt);
        $this->Ln();
        $this->SetFont('','I');
        $this->Cell(0,5,'(fim do documento)');
    }

    function PrintChapter($num, $title, $file)
    {
        $this->AddPage();
        $this->ChapterTitle($num,$title);
        $this->ChapterBody($file);
    }
}

$title = 'Caderneta FCT';
$pdf = new PDF();
$pdf->SetTitle($title);
$pdf->SetAuthor('Escola Profissional');

$pdf->PrintChapter(1, 'Caderneta FCT', _CAMINHO_CLASSES.'/fpdf/tutorial/caderneta_fct.txt');
$pdf->Output();
