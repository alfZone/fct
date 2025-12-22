<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header, Footer, ChapterTitle, ChapterBody (deixas igual)
}

$pdf = new PDF();
$title = 'Caderneta FCT';
$pdf->SetTitle($title);
$pdf->SetAuthor('Escola Profissional');

$pdf->PrintChapter(1, 'Caderneta FCT', '../classes/fpdf/tutorial/caderneta_fct.txt');
$pdf->Output();
