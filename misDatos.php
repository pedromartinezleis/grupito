<?php
	session_start();
	$pagina = "Mis datos";
	$titulo = "Tus datos";
	require_once("inc/encabezado.php");
	include ("inc/funciones.php");
	include ("bbdd/bbdd.php");
	$email=$_SESSION['email'];
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Mis Datos</h1>
      <p >Tu información: </p>
    </div>
	<div>
<?php 
function imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono){
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div class="form-group">
			<label for="email">Email</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="apellidos">Apellidos</label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" readonly="readonly" />
		</div>
		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" readonly="readonly" />
		</div>
		
		<a href="modificarDatos.php" class="btn btn-primary">Modificar Datos</a>
		<a href="modificarPassword.php" class="btn btn-success">Modificar Contraseña</a>
		<a href="index.php" class="btn btn-danger">Volver</a>
	</form>
	
<?php
} //fin imprimirFormulario
?>
 <?php
	if (isset($_SESSION['email'])){
		$email=$_SESSION['email'];
		$usuario=seleccionarUsuario($email);
		$nombre=$usuario['nombre'];
		$apellidos=$usuario['apellidos'];
		$direccion=$usuario['direccion'];
		$telefono=$usuario['telefono'];
		imprimirFormulario($email,$nombre,$apellidos,$direccion,$telefono);
	}
 ?>	
	</div>
  </div>
 </main>
