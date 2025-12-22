<?php
require_once __DIR__ . '/../fpdf/fpdf.php';

class PdfCreator extends FPDF
{
    private $title;

    public function __construct($title = "Documento PDF")
    {
        parent::__construct();
        $this->title = $title;
        $this->SetTitle($this->title);
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, utf8_decode($this->title), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    public function addText($text)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 8, utf8_decode($text));
    }

    public function outputPDF($filename = "documento.pdf")
    {
        $this->Output('I', $filename);
    }
}
