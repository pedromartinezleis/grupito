<?php
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado2.php";
?>

<main role="main" class="container">
	
    <h1 class="mt-5">Borrar usuario</h1>
<?php
	$usuario = recoge("usuario");
	
	if($usuario==""){
			header("location:usuarios.php");
			exit();
	}
	$ok= borrarUsuario ($usuario);
	
	if($ok){
		echo "<div class='alert alert-success' role='alert'>
				Usuario $usuario borrado correctamente</div>";
	}else{
		echo "<div class='alert alert-danger' role='alert'> ERROR: Usuario NO borrado</div>";
		
			}
	echo "<p><a href='usuariossuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
?>
</main>
<?php
	require_once "inc/pie2.php";
?>