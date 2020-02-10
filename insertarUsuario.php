<?php
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado2.php";
?>

<?php
	function imprimirFormulario($nombre, $contrasena, $email, $direccion, $telefono){
?>
		<form method="post">
		  <div class="form-group">
			<label for="nombre">Nombre:</label>
			<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>"/>
		  </div>
		  <div class="form-group">
			<label for="contrasena">Contrasena:</label>
			<input type="text" class="form-control" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>"/>
		  </div>
		  <div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
		  </div>
		  <div class="form-group">
			<label for="direccion">Direccion:</label>
			<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>"/>
		  </div>
		  <div class="form-group">
			<label for="telefono">Telefono:</label>
			<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>"/>
		  </div>
			<button type="submit" class="btn btn-primary" name="crear" value="crear" >Crear</button>
			<button type="reset" class="btn btn-primary" name="borrar" value="borrar" >Borrar</button>
		</form>

<?php
		}
?>

	<main role="main" class="container">
	
    <h1 class="mt-5">Añadir un nuevo usuario</h1>
	
<?php
	if(!isset($_REQUEST['crear'])){
		$nombre="";
		$contrasena="";
		$email="";
		$direccion="";
		$telefono="";
		
		imprimirFormulario($nombre, $contrasena, $email, $direccion, $telefono);
		
	}else{
		$nombre= recoge("nombre");
		$contrasena= recoge("contrasena");
		$email= recoge("email");
		$direccion= recoge("direccion");
		$telefono= recoge("telefono");
		
		$errores = "";
		
		if ($nombre == "" ){
			$errores = $errores . "<li>El campo nombre no puede estar vacio</li>";
		}
		if ($contrasena == "" ){
			$errores = $errores . "<li>El campo contrasena no puede estar vacio</li>";
		}
		if ($email == "" ){
			$errores = $errores . "<li>El campo email no puede estar vacio</li>";
		}
		if ($direccion == "" ){
			$errores = $errores . "<li>El campo direccion no puede estar vacio</li>";
		}
		if ($telefono == "" ){
			$errores = $errores . "<li>El campo telefono no puede estar vacio</li>";
		}
		if ($errores != ""){
			echo "<h2>Errores en el formulario</h2> <ul>$errores</ul>";
			imprimirFormulario($nombre, $contrasena, $email, $direccion, $telefono);
		}else{
			$nombre = insertarUsuario($nombre, $contrasena, $email, $direccion, $telefono);
			
			if($nombre != 0){
				echo "<div class='alert alert-success' role='alert'>
						nombre creado correctamente</div>";
				echo "<p><a href='listanombres.php' class='btn btn-primary'>Volver al listado</a></p>";
			}else{
				echo "<div class='alert alert-danger' role='alert'> ERROR: nombre NO creado</div>";
				imprimirFormulario($nombre, $contrasena, $email, $direccion, $telefono);
			}
		}
	}

?>
</main>




<?php
	require_once "inc/pie2.php";
?>