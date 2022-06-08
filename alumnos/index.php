<?php include '../extend/header.php'; ?>

<div class="row"><!--Inicia row-->
  <div class="col s12"><!--Inicia col-->
    <div class="card"><!--Inicia card-->
      <div class="card-content"><!--Inicia content-->
        <span class="card-title">Alta de alumnos</span>
        <form class="form" action="ins_alumnos.php" method="post" autocomplete=off ><!--Inicia form-->
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="nombre"  title="Solo letras" pattern="[A-Z/s ]+"  id="nombre" onblur="may(this.value, this.id)"  >
            <label for="nombre">Nombre</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="direccion"    id="direccion" onblur="may(this.value, this.id)"  >
            <label for="direccion">Dirección</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="horario"   id="horario"  >
            <label for="horario">Horario</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="semestre"   id="semestre"  >
            <label for="semestre">Semestre</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia field-->
            <input type="email" name="correo"   id="correo"  >
            <label for="correo">Correo</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia Field-->
            <input type="text" name="correo"   id="correo"   >
            <label for="correo">Correo</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="matricula"   id="matricula"  >
            <label for="matricula">Matricula</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="turno"   id="turno"  >
            <label for="turno">Turno</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="licenciatura"   id="licenciatura"  >
            <label for="licenciatura">Licenciatura</label>
          </div><!--Fin field-->
          <button type="submit" class="btn" >Guardar</button>
        </form><!--Fin form-->
      </div><!--Fin content-->
    </div><!--Fin card-->
  </div><!--Fin col-->
</div><!--Fin row-->

<div class="row"><!--Inicia row-->
  <div class="col s12"><!--Inicia col-->
    <nav class="brown lighten-3" ><!--Inicia nav-->
      <div class="nav-wrapper"><!--Inicia wrapper-->
        <div class="input-field"><!--Inicia field-->
          <input type="search"   id="buscar" autocomplete="off"  >
          <label for="buscar"><i class="material-icons" >search</i></label>
          <i class="material-icons" >close</i>
        </div><!--Fin field-->
      </div><!--Fin wrapper-->
    </nav><!--Fin nav-->
  </div><!--Fin col-->
</div><!--Fin row-->


<?php
if($_SESSION['nivel'] == 'ADMINISTRADOR'){/*Inicia 1 if*/
	$sel = $con->prepare("SELECT * FROM alumnos");
}/*Fin 1 if*/
$sel->execute();
$res = $sel->get_result();
$row = mysqli_num_rows($res);
?>

<div class="row"><!--Inicia row-->
	<div class="col s12"><!--Inicia col-->
		<div class="card"><!--Inicia card-->
			<div class="card-content"><!--Inicia content-->
				<span class="card-title">Alumnos (<?php echo $row ?>)</span>
				
				<table class="responsive-table"><!--Inicia table-->
				<thead><!--Incia thead-->
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Horario</th>
					<th>Semestre</th>
					<th>Correo</th>
					<th>Matricula</th>
					<th>Turno</th>
					<th>Licenciatura</th>
					<th>PDf</th>
					<th>Actualizar</th>
					<th>Eliminar</th>
				</thead><!--Fin thead-->
				<?php while($f = $res->fetch_assoc()){ ?>
					<tr>
						<td><?php echo $f['nombre'] ?></td>
						<td><?php echo $f['direccion'] ?></td>
						<td><?php echo $f['horario'] ?></td>
						<td><?php echo $f['semestre'] ?></td>
						<td><?php echo $f['correo'] ?></td>
						<th><?php echo $f['matricula'] ?></th>
						<th><?php echo $f['turno'] ?></th>
						<th><?php echo $f['licenciatura'] ?></th>
						<td><a href="../pdfs/crear_Pdf.php?id=<?php echo $f['id'] ?>" class="btn-floating green"><i class="material-icons">add</i></a></td>
						<td><a href="editar_alumno.php?id=<?php echo $f['id'] ?>" class="btn-floating blue"><i class="material-icons">loop</i></a></td>
						<td><a href="#" class="btn-floating red" onClick="swal({ title: 'Esta seguro que desea eliminar el cliente?', text: 'Al eliminarlo no podra recuperarlo!', type: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, eliminarlo', }).then(function(){ location.href='eliminar_alumno.php?id=<?php echo $f['id'] ?>'; })"><i class="material-icons">clear</i></a></td>
					</tr>
					<?php
						}
					$sel->close();
					$con->close();
					?>
				</table><!--Fin table-->
				
			</div><!--Fin content-->
		</div><!--Fin card-->
	</div><!--Fin col-->
</div><!--Fin row-->

<?php include '../extend/scripts.php'; ?>

</body>
</html>