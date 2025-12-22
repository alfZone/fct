<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF
{
// ====================
//      HEADER
// ====================
function Header()
{
    // Cabeçalho ESQUERDA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg', 30, 5, 100);

    // Cabeçalho DIREITA
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_cima.jpg', 178.5, 5, 100);

    $this->Ln(20);

    // =============================
    //   LINHAS DUPLAS (TOPO) ESQ.
    // =============================
    $this->SetLineWidth(1.0);
    $this->Line(5, 17, 140, 17);

    $this->SetLineWidth(0.6);
    $this->Line(5, 18.5, 140, 18.5);

    // =============================
    //   LINHAS DUPLAS (TOPO) DIR.
    // =============================
    $this->SetLineWidth(1.0);
    $this->Line(153.5, 17, 288.5, 17);

    $this->SetLineWidth(0.6);
    $this->Line(153.5, 18.5, 288.5, 18.5);

    // Linha vertical que divide a folha em 2
    $this->SetLineWidth(0.6);
    $this->Line(148.5, 0, 148.5, 210);
}

// ====================
//      FOOTER
// ====================
function Footer()
{
    // --- COORDENADAS ---
    $yLinha = 185;       // altura da linha dupla inferior
    $yRodapeImg = 188;   // altura da imagem do rodapé
    $yTexto = -20;       // altura do texto do rodapé

    // =============================
    //       RODAPÉ IMAGENS
    // =============================
    // Esquerda
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png', 10, $yRodapeImg, 130);

    // Direita
    $this->Image(_CAMINHO_PDF.'/imagens/rodape_baixo.png', 158.5, $yRodapeImg, 130);

    // =============================
    //       LINHAS DUPLAS ESQ.
    // =============================
    $this->SetLineWidth(1.0);
    $this->Line(10, $yLinha, 140, $yLinha);

    $this->SetLineWidth(0.6);
    $this->Line(10, $yLinha + 1.7, 140, $yLinha + 1.7);

    // =============================
    //       LINHAS DUPLAS DIR.
    // =============================
    $this->SetLineWidth(1.0);
    $this->Line(158.5, $yLinha, 288.5, $yLinha);

    $this->SetLineWidth(0.6);
    $this->Line(158.5, $yLinha + 1.7, 288.5, $yLinha + 1.7);

    // =============================
    //          TEXTOS
    // =============================
    $this->SetY($yTexto);
    $this->SetFont('Arial','I',8);

    // Texto da folha ESQUERDA
    $this->Cell(140, 10, 'FCT.Caderneta.016/05', 0, 0, 'L');

    // Texto da folha DIREITA
    $this->SetX(158.5);
    $this->Cell(130, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'R');
}
}

// ==============================
//   INSTANCIAÇÃO DO PDF
// ==============================
$pdf = new PDF('L','mm','A4'); // A4 deitada
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Output();
?>
