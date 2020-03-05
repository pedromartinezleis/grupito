<?php session_start();
	require_once("inc/encabezado.php");
	include("inc/funciones.php");
	include("bbdd/bbdd.php");
	function login($email,$password){
?>
<form method="post">
  <div class="form-group">
    <label for="email">Email: </label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="password">Contraseña: </label>
    <input type="password" class="form-control" name="password" id="password">
  </div>
  <button type="submit" class="btn btn-primary" name="login" >Logear</button>
</form>
<?php
	}
?>

<?php
	if(empty($_REQUEST)){
		$email="";
		$password="";
		login($email,$password);
	}else{
		$email=recoge("email");
		$password=recoge("password");
		
		if($email == "" OR $password == ""){
			echo "Rellena todo el formulario";
			login($email,$password);
		}else{
			$usuario=seleccionarUsuario($email,$password);
			
			if(!empty($usuario)){				
				$_SESSION["email"]=$email;				
				header("Location:productos.php");
			}else{
				echo "email o contraseña incorrectos";
				login($email,$password);
			}
		}

	}
?>
<?php
	require_once "inc/pie2.php";
?>