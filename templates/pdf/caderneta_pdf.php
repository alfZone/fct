<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

// Caminho correto para vendor (subir 3 níveis até fct/)
require_once __DIR__ . '/../../../vendor/autoload.php';

// Caminho correto do DOCX
$docxFile = __DIR__ . '/FCT_Caderneta_FCT.Caderneta.016_05.docx';

// 1) Carregar DOCX
$phpWord = IOFactory::load($docxFile);

// 2) Converter DOCX -> HTML temporário
$tempHtml = tempnam(sys_get_temp_dir(), 'html');
$writer = IOFactory::createWriter($phpWord, 'HTML');
$writer->save($tempHtml);

// 3) Ler o HTML gerado
$html = file_get_contents($tempHtml);

// 4) Gerar PDF com Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 5) Mostrar no browser
$dompdf->stream("caderneta_fct.pdf", ["Attachment" => false]);
