<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);

$del = $con->prepare("DELETE FROM alumnos WHERE id = ? ");
$del->bind_param('i', $id);

if($del->execute()){/*Inicia 1 if*/
	header('location:../extend/alerta.php?msj=Cliente eliminado&c=alum&palum&t=success');
}/*Fin 1 if*/
else{/*Inicia else*/
	header('location:../extend/alerta.php?msj=El cliente pudo ser eliminado&c=alum&palum&t=error');
}/*Fin else*/

$del->close();
$con->close();

?>