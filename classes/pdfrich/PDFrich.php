<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

//header("Content-Type: text/html; charset=UTF-8");

class PDFrich extends FPDF 
{
	
    function Header(){
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
    function Footer(){
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

    function setPages($pages) {
		$this->pagesPass = $pages;
		//print_r($this->pages);
		//$this->AddPage();
		//$this->AddPage();
		$this->ChapterBody($this->pagesPass);
		//$this->SetFont('Times','',12);
		// Output text in a 6 cm width column
		//$this->MultiCell(120,5,$this->pagesPass);
		//$this->Write(5,$this->pagesPass);
		//$this->Cell(0,5,$this->pagesPass);
		//$this->Ln();
		// Mention
		//$this->SetFont('','I');
		//$this->Cell(0,5,'(end of excerpt)');
		// Go back to first column
		$this->SetCol(0);
	}	

    function ChapterTitle($num, $label){
        // Arial 12
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        $this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }


    function SetCol($col)    {
        // Set position at a given column
        $this->col = $col;
        $x = 10+$col*65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }
    function readFile($file){
        $txt = file_get_contents($file);
        $this->ChapterBody($txt);
    }

    function ChapterBody($txt)    {
        //$lines = file($file);
        $lines = explode("\n", $txt);
        $this->SetFont('Times','',12);

        $inTable = false;
        $tableData = [];

        foreach ($lines as $line) {
            $line = rtrim(utf8_decode($line));

            // LINHA VAZIA → ESPAÇO
            if ($line === '') {
                $this->Ln(5);
                continue;
            }

            // H1
            if (strpos($line, '# ') === 0) {
                $this->Ln(4);
                $this->SetFont('Arial','B',20);
                $this->Cell(130,8,substr($line,2),0,1,'C');
                $this->Ln(2);
                $this->SetFont('Times','',12);
            }

            // H2
            elseif (strpos($line, '## ') === 0) {
                $this->Ln(3);
                $this->SetFont('Arial','B',13);
                $this->Cell(130,7,substr($line,3),0,1);
                $this->Ln(1);
                $this->SetFont('Times','',12);
            }

            // Lista
            elseif (strpos($line, '- ') === 0) {
                $this->Cell(5,5,'•',0,0);
                $this->MultiCell(125,5,substr($line,2));
            }

            // Início tabela
            elseif ($line === '[TABLE]') {
                $inTable = true;
                $tableData = [];
            }

            // Fim tabela
            elseif ($line === '[/TABLE]') {
                $this->DrawTable($tableData);
                $inTable = false;
            }

            // Conteúdo tabela
            elseif ($inTable) {
                $tableData[] = explode('|', $line);
            }

            // Texto normal
            else {
                $this->Write(5,$line);
            }
        }
    }


    function PrintChapter($num, $title, $file)    {
        $this->AddPage();
        //$this->ChapterTitle($num,$title);
        $this->readFile($file);
    }

    function DrawTable($data){
        $this->Ln(3);
        $colWidth = 130 / count($data[0]);

        foreach ($data as $rowIndex => $row) {
            foreach ($row as $cell) {
                $this->SetFont('Arial', $rowIndex == 0 ? 'B' : '', 10);
                $this->Cell($colWidth,7,trim($cell),1,0);
            }
            $this->Ln();
        }

        $this->Ln(5);
    }

}

?>
