
<?php
/*function multiexplode ($delimiters,$string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
// Los delimitadores pueden ser barra, punto o guión
$diagnostico = "IDX: BIOPSIA DE ANTRO Y CUERPO GASTRICO.\r\n- GASTRITIS CRONICA ANTRAL Y DE CUERPO EROSIVA, NO ACTIVIDAD CON ATROFIA E INFECCION POR HELICOBACTER PYLORI.\r\n- GASTRITIS QUIMICA POR REFLUJO BILIAR.\r\nCOMENTARIO:\r\n LA HIPERPLASIA PSEUDO POLIPOIDE DEL EPITELIO FOVEOLAR SE HALLA BIEN DOCUMENTADO COMO UN CAMBIO PRESENTE EN REFLUJO BILIAR ( ZONAS ELEVADAS )";
$diagnostico = multiexplode(array("\r\n"), $diagnostico);
$i=0;
$sizeDiagnostico = count($diagnostico);
while ($sizeDiagnostico>$i) {
    echo $diagnostico[$i]."<br><br>";
    $i++;
}*/

header('Content-type: text/html; charset=UTF-8');
$numero = $_POST['numero'];
$return_arr = array();
// Se especifica la ubicación de la base de datos Access (directorio actual)
$db = getcwd() . "\\" . 'REGISTRO 2014.mdb';

// Se define la cadena de conexión
$dsn = "DRIVER={Microsoft Access Driver (*.mdb)};DBQ=$db";
// Se realiza la conexón con los datos especificados anteriormente
$conn = odbc_connect($dsn, '', '' );
if (!$conn) { exit( "Error al conectar: " . $conn);
}//fecha recibido
$sql = "SELECT * FROM Biopsias where numero = ".$numero."or 'fecha recibido' ='02-abr.-14'";
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
       $medico=odbc_result($rs,"medico"); 
       $datos=odbc_result($rs,"datos clinicos"); 
       $descripcionMicro=odbc_result($rs,"descripcion microscopica"); 
       $descripcionMacro=odbc_result($rs,"descripcion macroscopica"); 
       $diagnostico=odbc_result($rs,"diagnostico"); 
       $ca=odbc_result($rs,"ca"); 
       $matriculaPatologo=odbc_result($rs,"matricula patologo"); 
       $tempArry = array_map('utf8_encode',
        array('estado'=>1,'numero' => $numero,'nombre'=>$nombre,'afiliacion'=> $afiliacion,'edad'=>$edad, 'telefono'=>$telefono, 
                'edad'=>$edad,'especimen'=>$especimen,'fechaR'=>$fechaR,'fechaC'=>$fechaC,'fechaE'=>$fechaE,'numeroMemo'=>$numeroMemo,
                'medico'=>$medico, 'datos'=>$datos,'descripcionMacro'=>$descripcionMacro,'descripcionMicro'=>$descripcionMicro,
                'diagnostico'=>$diagnostico,'ca'=>$ca,'matriculaPatologo'=>$matriculaPatologo));
        array_push($return_arr,$tempArry);
   }

    echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
  // Se cierra la conexión
  odbc_close( $conn );
?>