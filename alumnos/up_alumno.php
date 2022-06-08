<?php 
include '../conexion/conexion.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){/*Inicia 1 if*/
	$nombre = htmlentities($_POST['nombre']);
	$direccion = htmlentities($_POST['direccion']);
	$horario = htmlentities($_POST['horario']);
	$semestre = htmlentities($_POST['semestre']);
	$correo = htmlentities($_POST['correo']);
	$matricula = htmlentities($_POST['matricula']);
	$turno = htmlentities($_POST['turno']);
	$licenciatura = htmlentities($_POST['licenciatura']);
	$id = htmlentities($_POST['id']);
	
	$up = $con->prepare("UPDATE alumnos SET  nombre=?, direccion=?, horario=?, semestre=?, correo=?, matricula=?, turno=?, licenciatura=? WHERE id=? ");
	$up->bind_param('ssssssssi', $nombre, $direccion, $horario, $semestre, $correo, $matricula, $turno, $licenciatura, $id);
	
	if($up->execute()){/*Inicia 2 if*/
		header('location:../extend/alerta.php?msj=Cliente actualizado&c=alum&palum&t=success');
	}/*Fin 2 if*/
	else{/*Incia else*/
		header('location:../extend/alerta.php?msj=El cliente no pudo ser actualiado&c=alum&palum&t=error');
	}/*Fin else*/
	
	$up->close();
	$con->close();
}/*Fin 1 if*/
else{/*Inicia else*/
	header('location:../extend/alerta.php?msj=Utiliza el formulario&c=alum&palum&t=error');
}/*Fin else*/

?>