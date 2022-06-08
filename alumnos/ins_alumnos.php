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
	$id = '';
	
	$ins = $con->prepare(" INSERT INTO clientes VALUES(?,?,?,?,?,?,?,?,?) ");
	$ins->bind_param("issssssss", $id, $nombre, $direccion, $horario, $semestre, $correo, $matricula, $turno, $licenciatura);
	
	if($ins->execute()){/*Inicia 2 if*/
		header('location:../extend/alerta.php?msj=Cliente registrado&c=alum&p=alum&t=success');
	}/*Fin 2 if*/
	else{/*Inicia else*/
		header('location:../extend/alerta.php?msj=El cliente no puede ser registrado&c=alum&p=alum&t=error');
	}/*Fin else*/
	
	$ins->close();
	
	$con->close();
}/*Fin 1 if*/
else{/*Inicia else*/
	header('location:../extend/alerta.php?msj=Utiliza el formulario&c=alum&p=alum&t=error');
}/*Fin else*/

?>