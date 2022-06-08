<?php
use setasign\Fpdi\Fpdi;
require_once'../fpdf/fpdf.php';
require_once'../fpdi/src/autoload.php';
include '../conexion/conexion.php';
$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT * FROM pdf WHERE id = ? ");
$sel->bind_param('i',$id);
$sel->execute();
$res = $sel->get_result();

if($f = $res->fetch_assoc()){
	
}
$sel_img = $con->prepare("SELECT * FROM archivos WHERE id = ? ");
$sel_img->bind_param('i',$id);
$sel_img->execute();
$res_img = $sel_img->get_result();

if($f_img = $res_img->fetch_assoc()){
	
}

$fecha = date("Y-m-d");
$firma = 'FIRMADO';
$x = 230;
$y = 500;
$width = 300;
$height = 150;
$nombre = $f['nombre'];
$nuevonombre = $f_img['matricula']."[".$fecha."]firmado.pdf";
$rutaguardado = '/archivos/';
$pdf = new Fpdi();
$pdf->AddPage();
$pdf->setSourceFile('/archivos/'.$nombre);
$template = $pdf->importPage(1);
$pdf->useTemplate($template);
$pdf->Image("firmas/".$f_img['firma'],$x, $y, $width, $height);
$output = $pdf->Output();
file_put_contents($rutaguardado.$nuevonombre, $output);


	$up = $con->prepare("UPDATE pdf SET  nombre=?,firma=? WHERE id=? ");
	$up->bind_param('ssi',$nuevonombre,$firma,$id);
	if($up->execute()){/*Inicia if*/
		header('location:../extend/alerta.php?msj=Pdf firmado&c=pdf&p=pdf&t=success');
	}/*Fin if*/
	else{/*Inicia else*/
		header('location:../extend/alerta.php?msj=pdf no firmado&c=pdf&p=pdf&t=error');
	}/*Fin else*/
	
	
	$up->close();
	$con->close();

?>