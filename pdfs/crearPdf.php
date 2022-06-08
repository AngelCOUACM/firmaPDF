<?php
include '../conexion/conexion.php';
$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT * FROM archivos WHERE id = ? ");
$sel->bind_param('i',$id);
$sel->execute();
$res = $sel->get_result();

if($f = $res->fetch_assoc()){
	
}
date("d-m-Y");
ob_start();
?>

<html>
	<body>
		<p align="right">México, C.D.M.X, a <?php echo $f['fecha'] ?><br>
			Constancias de Incripción Semestral <?php echo  $f['semestre'] ?>
		</p>
		
		<p>A quien corresponda:</p>
		
		<p>De acuerdo al Sistema de Informacion Academica sobre la Universidad, SIASU, el que suscribe,Dr. Juan Antonio Lopez Solis, Coordinador de Plantel </p>
	</body>
</html>

<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$status = 'NO FIRMADO';
$rutaGuardado = "archivos/";
$nombreArchivo = $f['matricula']."[".$f['fecha']."].pdf";
$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('letter','portrait');
$dompdf->render();
$output = $dompdf->output();
$firma = '';
file_put_contents($rutaGuardado.$nombreArchivo, $output);
		
$ins = $con->prepare(" INSERT INTO pdf VALUES(?,?,?,?)");
	$ins->bind_param("isss",$id,$nombreArchivo,$status,$firma);
	
	if($ins->execute()){//Inicia if
		header('location:../extend/alerta.php?msj=Documento guardado&c=alum&p=alum&t=success');

	}/*Termina if*/else{//Inicia else
		header('location:../extend/alerta.php?msj=El Documento no pudo ser guardado&c=alum&p=alum&t=error');
	}//Termina else
	
	$ins->close();
	
	$con->close();
?>
