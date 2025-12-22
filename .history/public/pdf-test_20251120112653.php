<?php
require_once __DIR__ . '/../classes/PdfCreator.php';

$pdf = new PdfCreator("Teste de PDF - Exemplo");
$pdf->AddPage();
$pdf->addText("Olá! Este é um PDF gerado com sucesso usando FPDF.");
$pdf->outputPDF("teste.pdf");
