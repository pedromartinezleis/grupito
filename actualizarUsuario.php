<?php
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado2.php";
?>

<?php
	function imprimirFormulario($email, $contrasena){
?>
		<form method="post">
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly="readonly"/>
		  </div>
		  <div class="form-group">
			<label for="contrasena">contrasena:</label>
			<input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>"/>
		  </div>
		  <div class="form-group">
			<label for="ncontrasena">nueva contrasena:</label>
			<input type="password" class="form-control" id="ncontrasena" name="ncontrasena"/>
		  </div>
		  <div>
			<label for="ncontrasena1">confirmar nueva contrasena:</label>
			<input type="password" class="form-control" id="ncontrasena1" name="ncontrasena1"/>
		  </div>
		  <br />
			<button type="submit" class="btn btn-primary" name="guardar" value="guardar" >Guardar</button>
			<a href="usuarios.php" class="btn btn-danger">Cancelar</a></p>
		</form>
		
<?php
		}
?>

<main role="main" class="container">
	
    <h1 class="mt-5">Actualizar Usuario</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		
		$email = recoge("email");
		$contrasena = recoge("contrasena");
		$ncontrasena = recoge("ncontrasena");
		$ncontrasena1 = recoge("ncontrasena1");
		if($email == ""){
			header("location:usuarios.php");
			exit();
		}else{
			$user = seleccionarUsuario($email);
			
			if(empty($email)){
				header("location:usuarios.php");
				exit();				
			}
			
			$contrasena = $user['contrasena'];

			
			imprimirFormulario($email, $contrasena);
		}
	}else{
		$email= recoge("email");
		$contrasena= recoge("contrasena");
		$ncontrasena = recoge("ncontrasena");
		$ncontrasena1 = recoge("ncontrasena1");
		
		$errores = "";
		if ($ncontrasena != $ncontrasena1){
			echo "<li>La confirmacion de contrasena no coincide</li>";
		}
		if ($contrasena == "" ){
			$errores = $errores . "<li>El campo contrasena no puede estar vacio</li>";
		}
		if ($errores != ""){
			echo "<h2>Errores en el formulario</h2> <ul>$errores</ul>";
			imprimirFormulario($email, $contrasena);
		}else{
			
			$ok = actualizarUsuario($email, $contrasena);
			
			if($ok){
				echo "<div class='alert alert-success' role='alert'>
						email $email actualizado correctamente</div>";
				echo "<p><a href='usuarios.php' class='btn btn-primary'>Volver al listado</a></p>";
			}else{
				echo "<div class='alert alert-danger' role='alert'> ERROR: usuario NO actualizado</div>";
				imprimirFormulario($email, $contrasena);
			}
		}
	}
?>
</main>
<?php
	require_once "inc/pie2.php";
?>