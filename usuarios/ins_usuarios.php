<?php
include '../conexion/conexion.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){/*Inicia if*/
	$nombre = htmlentities($_POST['nombre']);
	$profesion = htmlentities($_POST['profesion']);
	$telefono = htmlentities($_POST['telefono']);
	$direccion = htmlentities($_POST['direccion']);
	$correo = htmlentities($_POST['correo']);
	$nivel = htmlentities($_POST['nivel']);
	$area = htmlentities($_POST['area']);
	$pass = '';
	$bloqueo = 1;
	$id = '';

if(empty($correo) || empty($profesion) || empty($area) || empty($telefono) || empty($direccion) || empty($correo) || empty($nivel)){/*Inicia if*/
	header('location:../extend/alerta.php?msj=Hay un campo vacio, revisa el formulario&c=us&p=in%t=error');
}/*Termina if*/

$caracteres = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
for($i=0;$i < strlen($nombre);$i++){/*Inicia for*/
	$buscar = substr($nombre,$i,1);
	if(strpos($caracteres,$buscar) === false){/*Inicia if*/
		header('location:../extend/alerta.php?msj=El nombre no contiene solo letras&c=us&p=in&t=error');
	}/*Termina if*/
}/*Termina for*/

if(!empty($correo)){/*Inicia primer if*/
	if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){/*Inicia segundo if*/
		header('location:../extend/alerta.php?msj=El correo no es valido&c=us&p=in&t=error');
	}/*Termina segundo if*/
}/*Termina primer if*/

/*Funcion para generar una contraseña aleatoria de 8 caracteres*/
$simbolos = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
for($j=0;$j<8;$j++){/*Inicia for*/
	$pass .= substr($simbolos, rand(0,53),1);
}/*Termina for*/

$foto = "foto_perfil/perfil.png";

$ins = $con->prepare(" INSERT INTO usuarios VALUES(?,?,?,?,?,?,?,?,?,?,?)");
	$ins->bind_param("isissssssis",$id,$nombre,$profesion,$telefono,$direccion,$correo,$nivel,$area,$foto,$bloqueo,$pass);

	
if($ins->execute()){/*Inicia if*/
	
	$asunto = "Sistema de Registro escolar UACM";
	$mensaje = "Bienvenido al Sistema de registro escolar UACM tus datos de inicio de sesion son los siguiente: \n Usuario: $correo \n Contraseña: $pass \n Te recomendamos cambiar tu contraseña una vez que entres al sistema";
	//Funcion para enviar correo
	$header = "MIME-vERSION 1.0 \r\n";
	$header .= "Content-Type: text/html; charset=iso-8859-1 \r\n";
	$header .= "From: Sistema Registro Escolar <administrador@sreuacm.com> \r\n";
	
	$mail = mail($correo, $asunto, $mensaje, $header);

	

	header('location:../extend/alerta.php?msj=El usuarios ha sido registrado&c=us&p=in&t=success');
	exit;
}/*Termina if*/else{/*Inicia else*/
	header('location:../extend/alerta.php?msj=El usuario no se ha podido registrar&c=us&p=in&t=error');
}/*Termina else*/
	
$con->close();
}/*Termina if*/else{
	header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
?>