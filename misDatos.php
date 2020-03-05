<?php
	session_start();
	$pagina = "Mis datos";
	$titulo = "Tus datos";
	require_once("inc/encabezado.php");
	include ("inc/funciones.php");
	include ("bbdd/bbdd.php");
?>
<?php function mostrarFormulario($email, $nombre, $apellidos, $direccion, $telefono){
	?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Modificar tu información</h1>
      <p >Tu información: </p>
    </div>
	<div>
	 <form action="" method="post">
		<div>
			<label for="email">Correo: </label>
			<input type="text" id="email" name="email" <?php echo $email;?> readonly="readonly"/>
		</div>
		<div>
			<label for="nombre">Nombre: </label>
			<input type="text" id="nombre" name="nombre" <?php echo $nombre;?>/>
		</div>
		<div>
			<label for="apellidos">Apellidos: </label>
			<input type="text" id="apellidos" name="apellidos" <?php echo $apellidos;?>/>
		</div>
		<div>
			<label for="direccion">Direccion: </label>
			<input type="text" id="direccion" name="direccion" <?php echo $direccion;?>/>
		</div>

		<div>
			<label for="telefono">Telefono: </label>
			<input type="text" id="telefono" name="telefono" <?php echo $telefono;?>/>
		</div>
			<input type="submit" value="Modificar"/>
			<input type="reset" value="Vaciar"/>
		<p>
			¿Quieres modificar tu contraseña? Hazlo <a href="modificarPassword.php" >Aquí</a>
		</p>
		</div>
	  </form>
	</div>
  </div>
 </main>
 <?php
}
	if (empty($_REQUEST)){
		$usuario=seleccionarUsuario($email, $nombre, $apellidos, $direccion, $telefono);
		$email=$usuario['email'];
		$nombre=$usuario['nombre'];
		$apellidos=$usuario['apellidos'];
		$direccion=$usuario['direccion'];
		$telefono=$usuario['telefono'];
		mostrarFormulario($email, $nombre, $apellidos, $direccion, $telefono);
	}else{
		$email = recoge("email");
		$nombre=recoge("nombre");
		$apellidos=recoge("apellidos");
		$direccion=recoge("direccion");
		$telefono=recoge("telefono");
		
		$actualizarOK=actualizarUsuario($email, $nombre, $apellidos, $direccion, $telefono);
		if($actualizarOK){
			echo "Tus datos se han modificado corectamente";
			mostrarFormulario($email, $nombre, $apellidos, $direccion, $telefono);
		}else{
			echo "Ha habido un problema al actualizar tus datos";
			mostrarFormulario($email, $nombre, $apellidos, $direccion, $telefono);
		}
	}
 ?>	
