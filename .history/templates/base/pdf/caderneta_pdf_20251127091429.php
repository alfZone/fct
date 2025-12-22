<?php

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

// Caminho correto para vendor
require_once __DIR__ . '/../../../vendor/autoload.php';

// Caminho para o DOCX (o ficheiro está na mesma pasta!)
$docxFile = __DIR__ . '/FCT_Caderneta_FCT.Caderneta.016_e5.docx';


// 1) Carregar DOCX
$phpWord = IOFactory::load($docxFile);

// 2) Converter para HTML temporário
$tempHtml = tempnam(sys_get_temp_dir(), 'html');
$writer = IOFactory::createWriter($phpWord, 'HTML');
$writer->save($tempHtml);

// 3) Ler o HTML gerado
$html = file_get_contents($tempHtml);

// 4) Criar PDF com DOMPDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 5) Mostrar PDF no browser
$dompdf->stream("caderneta_fct.pdf", ["Attachment" => false]);
