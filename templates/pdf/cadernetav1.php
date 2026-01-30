<?php
require(_CAMINHO_CLASSES.'/pdfrich/PDFrich.php');

//header("Content-Type: text/html; charset=UTF-8");

function htmlToPlainText($html)
{
    // Normaliza <br> e <p> para quebras de linha
    $html = preg_replace('/<\s*br\s*\/?>/i', "\n", $html);
    $html = preg_replace('/<\s*\/p\s*>/i', "\n\n", $html);
    $html = preg_replace('/<\s*p[^>]*>/i', '', $html);

    // Remove o resto do HTML
    $text = strip_tags($html);

    // Decodifica entidades HTML
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Normaliza quebras de linha
    $text = preg_replace("/\r\n|\r/", "\n", $text);

    return $text;
}

$txt=$_REQUEST['txt'];
$txt=htmlToPlainText($txt);
//$txt=strip_tags($_REQUEST['txt']);
//$txt=str_replace("&nbsp;",'\n',$txt);
//$txt=limparParaFPDF($txt);

$pdf = new PDFrich('P','mm','A5'); // A4 deitada

$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->AddPage();
//$pdf->PrintChapter(1,'','../templates/pdf/caderneta_fct.txt');
//$txt = file_get_contents('../templates/pdf/caderneta_fct.txt');

$pdf->addPage();
$pdf->setPages($txt);
//$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();
?>
