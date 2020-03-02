<?php
	$pagina = "Contacto";
	$titulo = "Contacta con nosotros";
	require_once("inc/encabezado.php");
	include ("inc/funciones.php");
?>
<?php
	function enviarMail($mail,$asunto,$cuerpo){
		
	}
?>
<?php function mostrarFormulario($mail, $asunto, $cuerpo){
	?>
<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
      <p >Formulario de contacto</p>
    </div>
	<div>
	 <form action="" method="post">
		<p>
			<label for="mail">Correo: </label>
			<input type="text" id="mail" name="mail"/>
		</p>
		<p>
			<label for="asunto">Asunto: </label>
			<input type="text" id="asunto" name="asunto"/>
		</p>
		Escribe aqui tu consulta:
		<p>
			<textarea id="cuerpo" name="cuerpo" rows="4" cols="50">
				
			</textarea>
		</p>
		<p>
			<input type="submit" value="Enviar"/>
			<input type="reset" value="Vaciar"/>
		</p>
	  </form>
	</div>
  </div>
 </main>
 
 <?php
	}
	if (empty($_REQUEST)){
		$mail = "";
		$asunto = "";
		$cuerpo = "";
	}else{
		$mail = recoge("mail");
		$asunto = recoge("asunto");
		$cuerpo = recoge("cuerpo");
		
		if($mail == "" or $asunto == "" or $cuerpo == ""){
			echo "Debes rellenar todos los campos";
		}else{
			enviarMail($mail,$asunto,$cuerpo);
		}
	}
 ?>	
 <?php
	require_once("inc/pie.php");
?>