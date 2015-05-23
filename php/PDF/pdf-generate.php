
<?php
require('pdf/fpdf.php');
class PDF extends FPDF
{	
	/**
	 * COLOCA EL ENCABEZADO Y LOGO DEL PDF
	 */
	function Header()
	{	$this->SetTextColor(170, 44, 44);
        $this -> SetXY(12, 18);
        $this->SetFont('Arial','B',30);
        $this->Cell(0,0,'IMSS');  
		$this->Image('img/IMSS.png',15,25,20);
        $this -> SetXY(10, 10);
		$this->SetFont('Arial','B',19);
		$this->Cell(30);
        $this->Cell(0,10,'INSTITUTO MEXICANO DEL SEGURO SOCIAL',0,0,'C');
        $this -> SetXY(30, 18);
        $this->Cell(0,10,'H.G.Z. IV #8 ENSENADA B.C.',0,0,'C');
        $this -> SetXY(30, 25);
        $this->Cell(0,10,'A N A T O M I A  P A T O L O G I C A.',0,0,'C');
	}
	/**
     * COLOCA EL CONTENIDO DEL PDF
     * @return NONE
     */
    public function datosPaciente()
    {   $this->SetTextColor(153, 153, 153);
        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 57);
        $this->Cell(0,0,'NOMBRE DEL PACIENTE: '); 
        $this -> SetXY(4, 64);
        $this->Cell(0,0,'AFILIACIÓN: ');  
        $this -> SetXY(4, 71);
        $this->Cell(0,0,'ESPECIMEN: ');  
        $this -> SetXY(4, 78);
        $this->Cell(0,0,'MÉDICO: ');  
        $this -> SetXY(4, 90);
        $this->Cell(0,0,'DATOS CLINICOS: ');
        $this->SetTextColor(2, 2, 2); 
        $this->SetFont('Arial','U',10);
        $this -> SetXY(68, 57);
        $this->Cell(0,0,'NOMBRE COMPLETO DEL PACIENTE'); 
        $this -> SetXY(38, 64);
        $this->Cell(0,0,'21-59-24-1363 ');
        $this -> SetXY(38, 71);
        $this->Cell(0,0,'BX-GASTRICAL');
        $this -> SetXY(38, 78);
        $this->Cell(0,0,'DR SANTOS');
        $this -> SetXY(145, 57);
        $this->SetFont('Arial','',25);
        $this->Cell(0,0,'BX: '); 
        $this -> SetXY(163, 57);
        $this->SetFont('Arial','U',20);
        $this->Cell(0,0,'211/2014'); 
        $this -> SetXY(130, 75);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'EDAD: '); 
        $this -> SetXY(150, 75);
        $this->SetFont('Arial','',16);
        $this->Cell(0,0,'84'); 

    }
    /**
	 * COLOCA EL CONTENIDO DEL PDF
	 * @return NONE
	 */
	public function cuerpoBiopsia()
	{	$this->SetTextColor(170, 44, 44);
        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 98);
        $this->Cell(0,0,'DESCRIPCIÓN MACROSCÓPICA: ');
        $this -> SetXY(10, 100);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0);	
        $s='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolores adipisci est quod iure quasi accusantium maxime quidem amet labore omnis, facilis, culpa pariatur sit aliquam cupiditate laudantium enim itaque!';
		$this->MultiCell(0,5,$s);

        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 140);
        $this->Cell(0,0,'DESCRIPCIÓN MICROSCÓPICA: ');
        $this -> SetXY(10, 142);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0); 
        $s='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolores adipisci est quod iure quasi accusantium maxime quidem amet labore omnis, facilis, culpa pariatur sit aliquam cupiditate laudantium enim itaque!';
        $this->MultiCell(0,5,$s);

        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 180);
        $this->Cell(0,0,'DIAGNÓSTICO: ');
        $this -> SetXY(10, 182);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0); 
        $s='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam dolores adipisci est quod iure quasi accusantium maxime quidem amet labore omnis, facilis, culpa pariatur sit aliquam cupiditate laudantium enim itaque!';
        $this->MultiCell(0,5,$s);
    }
	/**
	 * FUNCIÓN PARA COLOCAR LAS FIRMAS AL FINAL
	 * @return NONE
	 */
	function firma()
	{	$this->SetTextColor(170, 44, 44);
        $this->SetDrawColor(0,0,0);
		//$this->Line(InicioX1, InicioY1, InicioX2, InicioY2); 	
		$this->Line(120, 260, 184, 260);
        $this -> SetXY(127, 265);
        $this->SetFont('Arial','B',10);
        $this->Cell(0,0,'Dra. Iracema de Ávila Olvera');  
        $this -> SetXY(136, 270);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,0,'MEDICO PATOLOGO'); 
        $this->SetFont('Arial','B',10);
        $this -> SetXY(140, 275);
        $this->Cell(0,0,'Mat. 5570730');  

	}
	
	function Footer()
	{  $this->SetTextColor(0,0,0);
        date_default_timezone_set('America/Tijuana');
        setlocale(LC_TIME, 'spanish');
        $today= strftime("%A %d de %B del %Y");
	    $this -> SetXY(27, 265);
        $this->SetFont('Arial','U',9);
        $this->Cell(0,0,'FECHA DE ENTREA');  
        $this -> SetXY(20, 270);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,0,$today); 
        $this->SetFont('Arial','',10);
        $this -> SetXY(34, 275);
        $this->Cell(0,0,'Memo:');  
        $this->SetFont('Arial','U',10);
        $this -> SetXY(46, 275);
        $this->Cell(0,0,'0');  
	}
}

		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
        $pdf->datosPaciente();
        $pdf->cuerpoBiopsia();
		$pdf->firma();
		$pdf->Output('IMSS-BIOPSIA','I');

?>
