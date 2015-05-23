  <?php
include('conexion.php');
header('Content-type: text/html; charset=UTF-8');
header('Content-type: application/json');
$matricula= $_POST['Matricula'];
$Tipo ='';
$conn->set_charset("utf8");
$sql = "SELECT * FROM userimss WHERE matricula =".$matricula;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $estado = 1;
       while($row = $result->fetch_assoc()){
             $Tipo = $row['Tipo'];
             $id = $row['id'];
         }
} 
else{
       $estado = 0;
}        
$arr = array('estado' => $estado,'Tipo'=>$Tipo,'id'=>$id);

$conn->close();
echo json_encode($arr);
?>
