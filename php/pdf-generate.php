
<?php
include('conexion.php');
require('pdf/fpdf.php');
$numero=$_GET['numero'];
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
		$this->Image('../assets/img/IMSS.png',15,25,20);
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
    public function datosPaciente($nombre,$afiliacion,$especimen,$medicoUser,$datos,$edad,$numero,$fechaR)
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
        $this->Cell(0,0,strtoupper($nombre)); 
        $this -> SetXY(38, 64);
        $this->Cell(0,0,$afiliacion);
        $this -> SetXY(38, 71);
        $this->Cell(0,0,$especimen);
        $this -> SetXY(38, 78);
        $this->Cell(0,0,$medicoUser);
        $this -> SetXY(145, 57);
        $this->SetFont('Arial','',25);
        $this->Cell(0,0,'BX: '); 
        $this -> SetXY(163, 57);
        $this->SetFont('Arial','U',20);
        $this->Cell(0,0,$numero."/".$fechaR); 
        $this -> SetXY(130, 75);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'EDAD: '); 
        $this -> SetXY(150, 75);
        $this->SetFont('Arial','',16);
        $this->Cell(0,0,$edad); 

    }
    /**
	 * COLOCA EL CONTENIDO DEL PDF
	 * @return NONE
	 */
	public function cuerpoBiopsia($descripcionMicro,$descripcionMacro,$diagnostico)
	{	$this->SetTextColor(170, 44, 44);
        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 98);
        $this->Cell(0,0,'DESCRIPCIÓN MACROSCÓPICA: ');
        $this -> SetXY(10, 100);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0);	
		$this->MultiCell(0,5,$descripcionMacro);

        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 140);
        $this->Cell(0,0,'DESCRIPCIÓN MICROSCÓPICA: ');
        $this -> SetXY(10, 142);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0); 
        $this->MultiCell(0,5,$descripcionMicro);

        $this->SetFont('Arial','B',14);
        $this -> SetXY(4, 180);
        $this->Cell(0,0,'DIAGNÓSTICO: ');
        $this -> SetXY(10, 182);
        $this->SetFont('Arial','',9);
        $this->SetTextColor(0,0,0); 
        $this->MultiCell(0,5,$diagnostico);
    }
	/**
	 * FUNCIÓN PARA COLOCAR LAS FIRMAS AL FINAL
	 * @return NONE
	 */
	function firma($Medico,$Matricula)
	{	$this->SetTextColor(170, 44, 44);
        $this->SetDrawColor(0,0,0);
		//$this->Line(InicioX1, InicioY1, InicioX2, InicioY2); 	
		$this->Line(120, 260, 184, 260);
        $this -> SetXY(127, 265);
        $this->SetFont('Arial','B',10);
        $this->Cell(0,0,$Medico);  
        $this -> SetXY(136, 270);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,0,'MEDICO PATOLOGO'); 
        $this->SetFont('Arial','B',10);
        $this -> SetXY(140, 275);
        $this->Cell(0,0,'Mat. '.$Matricula);  

	}
	
	function Footer()
	{  $this->SetTextColor(0,0,0);
        date_default_timezone_set('America/Tijuana');
        setlocale(LC_TIME, 'spanish');
        $today= strftime("%A %d de %B del %Y");
	    $this -> SetXY(26, 265);
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

$return_arr = array();
// Se especifica la ubicación de la base de datos Access (directorio actual)
$db = getcwd() . "\\" . 'REGISTRO 2014.mdb';

// Se define la cadena de conexión
$dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=$db";
// Se realiza la conexón con los datos especificados anteriormente
$conn = odbc_connect($dsn, '', '' );
if (!$conn) { exit( "Error al conectar: " . $conn);
}//fecha recibido
$sql = "SELECT * FROM Biopsias where numero = ".$numero."";
$rs = odbc_exec( $conn, $sql );
if ( !$rs ) { exit( "Error en la consulta SQL" );
}
// Se muestran los resultados
while ( odbc_fetch_row($rs) ) { 
       $numero=odbc_result($rs,"numero"); 
       $nombre=odbc_result($rs,"nombre"); 
       $afiliacion=odbc_result($rs,"afiliacion"); 
       $edad=odbc_result($rs,"edad"); 
       $telefono=odbc_result($rs,"telefono"); 
       $especimen=odbc_result($rs,"especimen"); 
       $fechaR=odbc_result($rs,"fecha recibido"); 
       $fechaC=odbc_result($rs,"fecha de cita"); 
       $fechaE=odbc_result($rs,"fecha de entrega"); 
       $numeroMemo=odbc_result($rs,"numero de memo"); 
       $medicoUser=odbc_result($rs,"medico"); 
       $datos=odbc_result($rs,"datos clinicos"); 
       $descripcionMicro=odbc_result($rs,"descripcion microscopica"); 
       $descripcionMacro=odbc_result($rs,"descripcion macroscopica"); 
       $diagnostico=odbc_result($rs,"diagnostico"); 
       $ca=odbc_result($rs,"ca"); 
       $matriculaPatologo=odbc_result($rs,"matricula patologo"); 
   }
   $fechaR = split('[-]',$fechaR);
   $fechaR = $fechaR[0];
        $Medico=$_GET['Medico'];
        $Matricula=$_GET['Matricula'];
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
        $pdf->datosPaciente($nombre,$afiliacion,$especimen,$medicoUser,$datos,$edad,$fechaR,$numero);
        $pdf->cuerpoBiopsia($descripcionMicro,$descripcionMacro,$diagnostico);        
        $pdf->firma($Medico,$Matricula);
		$pdf->Output('IMSS-BIOPSIA.pdf','I');

?>
