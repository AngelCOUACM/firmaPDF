<?php include '../conexion/conexion.php';?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Proyecto</title>
		<link rel="stylesheet" href="../css/icon.css">
		<link rel="stylesheet" href="../css/materialize.min.css">
		<link rel="stylesheet" href="../css/sweetalert2.min.css">
		<script src="../js/signature.js"></script>
		<script src="../js/jquery-3.2.1.min.js"></script>
		<script src="../js/sweetalert2.min.js"></script>
		<script src="../js/materialize.min.js"></script>
</head>

<body>
	<div class="row"><!--Inicia row-->
  <div class="col s12"><!--Inicia col-->
    <div class="card"><!--Inicia card-->
      <div class="card-content"><!--Inicia content-->
        <span class="card-title">Alta de alumnos</span>

	<!--Formulario para subir archivos pdf-->
	<form action="uploading.php" id="guardar" method="post" enctype="multipart/form-data">
		<input name="matricula" id="matricula" type="text" autofocus required>
		<label name="matricula" >Matricula:</label>
		
		<input name="nombre" id="nombre" type="text" required>
		<label name="nombre" id="nombre">Nombre:</label>
		
		<input name="responsable" id="responsable" type="text" required>
		<label name="responsable" id="responsable">Responsable:</label>
		
		<input type="text" name="area" id="area" required>
		<label name="area" id="area">Area:</label>
		
		
		
		<div id="canvas">
		<canvas class="roundCorners" id="newSignature" name="newSignature" style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
		</div>
		
		<script>signatureCapture();</script>
		
		<input type="hidden" name="imagen" id="imagen">
		
		<button type="button" onClick="MyReload()">Limpiar Firma</button>
		<br><br>
		<button type="submit" name="subir" id="subir" onClick="signatureSave()">Ingresar</button>
		
	</form>
	
	
		  </div><!--Fin content-->
    </div><!--Fin card-->
  </div><!--Fin col-->
</div><!--Fin row-->
		  
	<?php $sel = $con->query("SELECT * FROM archivos");
	$row = mysqli_num_rows($sel);
	?>
	<div class="row"><!--Inicia row-->
	<div class="col s12"><!--Inicia col-->
		<div class="card"><!--Inicia card-->
			<div class="card-content"><!--Inicia content-->

	
	<table>
		<thead>
			<th>Matricula</th>
		 	<th>Nombre</th>
			<th>responsable</th>
			<th>area</th>
			<th></th>
			<th>Pdf</th>
			<th>Vizualizar</th>
			<th>Firmar</th>
		</thead>
		<?php while($f = $sel->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $f['matricula'] ?></td>
			<td><?php echo $f['nombre'] ?></td>
			<td><?php echo $f['responsable'] ?></td>
			<td><?php echo $f['area'] ?></td>
			<td></td>
			<td><a href="crearPdf.php?id=<?php echo $f['id'] ?>">Crear</a></td>
			<td><a href="vizualizar.php?id=<?php echo $f['id'] ?>">Vizualizar</a></td>
			<td><a href="firmar.php?id=<?php echo $f['id'] ?>">Firmar</a></td>
		</tr>
		
		<?php } ?>
		
	</table>
		</div><!--Fin content-->
		</div><!--Fin card-->
	</div><!--Fin col-->
</div><!--Fin row-->

</body>
</html>