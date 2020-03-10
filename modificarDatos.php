<?php
	session_start();
	$pagina = "Mis datos";
	$titulo = "Tus datos";
	require_once("inc/encabezado.php");
	include ("inc/funciones.php");
	include ("bbdd/bbdd.php");
	$email=$_SESSION['email'];
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
		<div class="form-group"
			<label for="email">Correo: </label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>" readonly="readonly"/>
		</div>
		<div>
			<label for="nombre">Nombre: </label>
			<input type="text" id="nombre" name="nombre"  value="<?php echo $nombre;?>"/>
		</div>
		<div>
			<label for="apellidos">Apellidos: </label>
			<input type="text" id="apellidos" name="apellidos"  value="<?php echo $apellidos;?>"/>
		</div>
		<div>
			<label for="direccion">Direccion: </label>
			<input type="text" id="direccion" name="direccion"  value="<?php echo $direccion;?>"/>
		</div>

		<div>
			<label for="telefono">Telefono: </label>
			<input type="text" id="telefono" name="telefono"  value="<?php echo $telefono;?>"/>
		</div>
			<input type="submit" name="modificar" id="modificar" value="Modificar"/>
			<input type="reset" value="Vaciar"/>
		</div>
	  </form>
	</div>
  </div>
 </main>
 <?php
}
	if (empty($_REQUEST['modificar'])){
		$email=$_SESSION['email'];
		$usuario=seleccionarUsuario($email);
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
