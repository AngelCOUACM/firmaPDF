<?php
include '../conexion/conexion.php';
$id = $con->real_escape_string(htmlentities($_GET['id']));
//asociar numero idusuario con idpdf
$sel = $con->prepare("SELECT * FROM pdf WHERE id = ? ");
$sel->bind_param('s', $id);
$sel->execute();
$res = $sel->get_result();
if ($f =$res->fetch_assoc()) {
	
}
	
header('content-type: application/pdf');
readfile('archivos/'.$f['nombre']);
	
$sel->close();
$con->close();
	
?>
