<?php include'../extend/header.php';
$id = htmlentities($_GET['id']);
$sel = $con->prepare("SELECT * FROM alumnos WHERE id = ? ");
$sel->bind_param('i',$id);
$sel->execute();
$res = $sel->get_result();

if($f = $res->fetch_assoc()){/*Inicia 1 if*/
	
}/*Fin 1 if*/
?>



<div class="row"><!--Inicia row-->
  <div class="col s12"><!--Inicia col-->
    <div class="card"><!--Inicia card-->
      <div class="card-content"><!--Inicia content-->
        <span class="card-title">Editar de alumnos</span>
        <form class="form" action="up_alumno.php" method="post" autocomplete=off ><!--Inicia form-->
         <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="nombre"  title="Solo letras" pattern="[A-Z/s ]+"  id="nombre" onblur="may(this.value, this.id)"  value="<?php echo $f['nombre'] ?>">
            <label for="nombre">Nombre</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="direccion"    id="direccion" onblur="may(this.value, this.id)"  value="<?php echo $f['direccion'] ?>">
            <label for="direccion">Dirección</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="horario"   id="horario"  value="<?php echo $f['horario'] ?>">
            <label for="horario">Horario</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia field-->
            <input type="text" name="semestre"   id="semestre" onblur="may(this.value, this.id)"  value="<?php echo $f['semestre'] ?>">
            <label for="semestre">Semestre</label>
          </div><!--Fin field-->
          <div class="input-field"><!--Inicia Field-->
            <input type="email" name="correo"   id="correo"   value="<?php echo $f['correo'] ?>">
            <label for="correo">Correo</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="matricula"  id="matricula"  value="<?php echo $f['matricula'] ?>">
            <label for="matricula">Matricula</label>
          </div><!--Fin field-->
		  <div class="input-field"><!--Inicia field-->
            <input type="text" name="licenciatura"  id="licenciatura" value="<?php echo $f['licenciatura'] ?>">
            <label for="licenciatura">Licenciatura</label>
          </div><!--Fin field-->
          <button type="submit" class="btn" >Guardar</button>
        </form><!--Fin form-->
      </div><!--Fin content-->
    </div><!--Fin card-->
  </div><!--Fin col-->
</div><!--Fin row-->

<?php 
$sel->close();
$con->close();
include'../extend/scripts.php'; ?>

</body>
</html>