<?php 
include '../conexion/conexion.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){//Incia if
	//variables enviadas por el formulario
	$matricula = htmlentities($_POST['matricula']);
	$area = htmlentities($_POST['area']);
	$responsable = htmlentities($_POST['responsable']);
	$nombre = htmlentities($_POST['nombre']);
	$img = htmlentities($_POST['imagen']);
	
	
	//variables ocupadas por el sistema
	$fecha = date("Y-m-d");
	$id = '';
	
	//imagen mano alzada
		$name = 'mi_imagen_'.$fecha.'.png';
		$datosBase64 = base64_decode(preg_replace('#^data:image\/w+;base64,#i','',$img));
		$path = 'firmas/'.$name;
		file_put_contents($path,$datosBase64);
		
	
	
	
	
	//proceso para la firma digital
	
	$ins = $con->prepare(" INSERT INTO archivos VALUES(?,?,?,?,?,?,?)");
	$ins->bind_param("issssss",$id,$matricula,$nombre,$area,$responsable,$fecha,$path);
	
	if($ins->execute()){//Inicia if
		header('location:../extend/alerta.php?msj=Documento guardado&c=pdf&p=pdf&t=success');

	}/*Termina if*/else{//Inicia else
		header('location:../extend/alerta.php?msj=El Documento no pudo ser guardado&c=pdf&p=pdf&t=error');
	}//Termina else
	
	$ins->close();
	
	$con->close();
	
}/*Termina if*/else{//Inicia else
	header('location:../extend/alerta.php?msj=Utilia el formulario&c=li&p=li&t=error');
}//Termina else
?>