<?php
require(_CAMINHO_CLASSES.'/fpdf/fpdf.php');

class PDF extends FPDF{
	protected $col = 0; // Current column
	protected $y0=20;      // Ordinate of column start
	protected $pagesPass;

	function setPages($pages) {
		$this->pagesPass = $pages;
		//print_r($this->pages);
		$this->AddPage();
		$this->AddPage();
		// Font
		$this->SetFont('Times','',12);
		// Output text in a 6 cm width column
		//$this->MultiCell(120,5,$this->pagesPass);
		$this->Write(5,$this->pagesPass);
		//$this->Cell(0,5,$this->pagesPass);
		//$this->Ln();
		// Mention
		//$this->SetFont('','I');
		//$this->Cell(0,5,'(end of excerpt)');
		// Go back to first column
		$this->SetCol(0);
	}	

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

	function SetCol($col){
		// Set position at a given column
		$this->col = $col;
		$x = 10+$col*150;
		$this->SetLeftMargin($x);
		$this->SetX($x);
	}

	function AcceptPageBreak(){
		// Method accepting or not automatic page break
		if($this->col<1)
		{
			// Go to next column
			$this->SetCol($this->col+1);
			// Set ordinate to top
			$this->SetY($this->y0);
			// Keep on page
			return false;
		}
		else
		{
			// Go back to first column
			$this->SetCol(0);
			// Page break
			return true;
		}
	}

	function ChapterTitle($num, $label)	{
		// Title
		$this->SetFont('Arial','',12);
		$this->SetFillColor(200,220,255);
		$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
		$this->Ln(4);
		// Save ordinate
		$this->y0 = $this->GetY();
	}

	function ChapterBody($file)	{
		// Read text file
		$txt = file_get_contents($file);
		$txt = utf8_decode($txt); 
		// Font
		$this->SetFont('Times','',12);
		// Output text in a 6 cm width column
		$this->MultiCell(120,5,$txt);
		$this->Ln();
		// Mention
		$this->SetFont('','I');
		$this->Cell(0,5,'(end of excerpt)');
		// Go back to first column
		$this->SetCol(0);
	}

	function PrintChapter($num, $title, $file)	{
		// Add chapter
		$this->AddPage();
		//$this->ChapterTitle($num,$title);
		$this->ChapterBody($file);
	}
}

class PDFWithTemplates extends PDF {
    private $variables = array();
    
    function SetVariables($vars) {
        $this->variables = $vars;
    }
    
    function PrintChapter($num, $title, $file) {
        if(!file_exists($file)) {
            $this->Error("Arquivo não encontrado: $file");
        }
        
        $content = file_get_contents($file);
        
        // Substituir variáveis
        foreach($this->variables as $key => $value) {
            $content = str_replace("{{$key}}", $value, $content);
            $content = str_replace("[[$key]]", $value, $content);
            $content = str_replace("##$key##", $value, $content);
        }
        
        // Processar formatação
        $this->ProcessAdvancedContent($content);
    }
    
    protected function ProcessAdvancedContent($content) {
        $lines = explode("\n", $content);
        
        foreach($lines as $line) {
            $line = trim($line);
            
            if(empty($line)) {
                $this->Ln(5);
                continue;
            }
            
            // Verificar tags de formatação
            if(preg_match('/^# (.+)/', $line, $matches)) {
                // Título nível 1
                $this->SetFont('Arial','B',16);
                $this->Cell(0,10,$matches[1],0,1,'C');
                $this->Ln(5);
                
            } elseif(preg_match('/^## (.+)/', $line, $matches)) {
                // Título nível 2
                $this->SetFont('Arial','B',14);
                $this->SetTextColor(0,0,128);
                $this->Cell(0,8,$matches[1],0,1);
                $this->Ln(3);
                
            } elseif(preg_match('/^### (.+)/', $line, $matches)) {
                // Título nível 3
                $this->SetFont('Arial','B',12);
                $this->SetTextColor(0,100,0);
                $this->Cell(0,6,$matches[1],0,1);
                $this->Ln(2);
                
            } elseif(preg_match('/^\*\*(.+)\*\*$/', $line, $matches)) {
                // Negrito
                $this->SetFont('Arial','B',12);
                $this->Cell(0,6,$matches[1],0,1);
                
            } elseif(preg_match('/^\*(.+)\*$/', $line, $matches)) {
                // Itálico
                $this->SetFont('Arial','I',12);
                $this->Cell(0,6,$matches[1],0,1);
                
            } elseif(preg_match('/^> (.+)/', $line, $matches)) {
                // Citação
                $this->SetFont('Arial','I',11);
                $this->SetTextColor(100,100,100);
                $this->MultiCell(0,6,$matches[1]);
                $this->SetTextColor(0,0,0);
                
            } elseif($line == '---') {
                // Linha divisória
                $this->Ln(5);
                $this->Line($this->GetX(), $this->GetY(), $this->GetX()+190, $this->GetY());
                $this->Ln(5);
                
            } elseif(preg_match('/^-\s(.+)/', $line, $matches)) {
                // Item de lista
                $this->SetFont('Arial','',12);
                $this->Cell(5,6,'',0,0);
                $this->Cell(5,6,chr(149),0,0);
                $this->MultiCell(0,6,' '.$matches[1]);
                
            } elseif(preg_match('/^\|(.+)\|$/', $line, $matches)) {
                // Linha de tabela
                $this->ProcessTableRow($matches[1]);
                
            } else {
                // Texto normal
                $this->SetFont('Arial','',12);
                $this->MultiCell(0,6,$line);
            }
        }
    }
    
    protected function ProcessTableRow($row) {
        $columns = explode('|', $row);
        $colCount = count($columns);
        
        if($colCount > 0) {
            $colWidth = 190 / $colCount;
            
            // Primeira linha como cabeçalho?
            static $isHeader = true;
            
            if($isHeader) {
                $this->SetFillColor(200, 220, 255);
                $this->SetFont('Arial','B',10);
                $fill = true;
                $isHeader = false;
            } else {
                static $rowCount = 0;
                $fill = ($rowCount % 2 == 0);
                $this->SetFont('Arial','',10);
                $rowCount++;
            }
            
            foreach($columns as $col) {
                $align = (is_numeric(trim($col)) && $col != '') ? 'R' : 'L';
                $this->Cell($colWidth, 7, trim($col), 1, 0, $align, $fill);
            }
            $this->Ln();
        }
    }
}

$pdf = new PDFWithTemplates('P','mm','A5'); // A4 deitada

$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->SetFont('Times','',12);
//$pdf->PrintChapter(1,'','../templates/pdf/caderneta_fct.txt');
$txt = file_get_contents('../templates/pdf/caderneta_fct.txt');
$txt = utf8_decode($txt); 
$pdf->setPages($txt);
//$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();

/*$pdf = new PDF();
$title = '20000 Leagues Under the Seas';
$pdf->SetTitle($title);
$pdf->SetAuthor('Jules Verne');
$pdf->PrintChapter(1,'A RUNAWAY REEF','../classes/fpdf/tutorial/20k_c1.txt');
$pdf->PrintChapter(2,'THE PROS AND CONS','../classes/fpdf/tutorial/20k_c2.txt');
$pdf->Output();*/
?>