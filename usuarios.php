<?php session_start();
	require_once "bbdd/bbdd.php";
	require_once "inc/encabezado2.php";
?>

<?php
	include ("inc/funciones.php");
	
	
	if(!isset($_SESSION["email"])){
		header("Location:login.php");
	}
?>


	<main role="main" class="container">
	
    <h1 class="mt-5">Listado usuarios</h1>
	
	<p><a href="insertarUsuario.php" class="btn btn-success">Nuevo Usuario</a>
	<a href="menu.php" class="btn btn-primary">Volver al menu</a>
	<a href="cerrarSesion.php" class="btn btn-danger">Cerrar sesion</a></p>
	<?php
		$usuarios = seleccionarTodosUsuarios();
	?>
	
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">idUsuario</th>
      <th scope="col">password</th>
	  <th scope="col">email</th>
	  <th scope="col">nombre</th>
	  <th scope="col">apellidos</th>
	  <th scope="col">direccion</th>
	  <th scope="col">telefono</th>
    </tr>
  </thead>
  <tbody>
	<?php
	foreach($usuarios as $user){
		$usuario = $user['idUsuario'];
		$password = $user['password'];
		$email = $user['email'];
		$nombre = $user['nombre'];
		$apellidos= $user['apellidos'];
		$direccion = $user['direccion'];
		$telefono = $user['telefono'];
	?>
    <tr>
      <td><?php echo $usuario; ?></td>
      <td><?php echo $password; ?></td>
	  <td><?php echo $email; ?></td>
	  <td><?php echo $nombre; ?></td>
	  <td><?php echo $apellidos; ?></td>
	  <td><?php echo $direccion; ?></td>
	  <td><?php echo $telefono; ?></td>
	  <td>
		<a href='actualizarUsuario.php?email=<?php echo $email; ?>' class='btn btn-success' role='alert'>Editar</a>
		<a href='borrarUsuario.php?usuario=<?php echo $usuario; ?>' class='btn btn-danger' role='alert'>Borrar</a>
	  </td>
    </tr>
	<?php } //fin foreach?>
  </tbody>
</table>

</main>
<?php
	require_once "inc/pie2.php";
?>