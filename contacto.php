<?php
	session_start();
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
		<div>
			<label for="mail">Correo: </label>
			<input type="text" id="mail" name="mail"/>
		</div>
		<div>
			<label for="asunto">Asunto: </label>
			<input type="text" id="asunto" name="asunto"/>
		</div>
		Escribe aqui tu consulta:
		<div>
			<textarea id="cuerpo" name="cuerpo" rows="4" cols="50">
				
			</textarea>
		</div>
		<div>
			<input type="submit" value="Enviar"/>
			<input type="reset" value="Vaciar"/>
		</div>
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
		 mostrarFormulario($mail, $asunto, $cuerpo);
	}else{
		$mail = recoge("mail");
		$asunto = recoge("asunto");
		$cuerpo = recoge("cuerpo");
		
		if($mail == "" or $asunto == "" or $cuerpo == ""){
			echo "Debes rellenar todos los campos";
			 mostrarFormulario($mail, $asunto, $cuerpo);
		}else{
			enviarMail($mail,$asunto,$cuerpo);
			if(enviarMail){
				echo "Gracias por ponerte en contacto con nosotros, en unas horas recibiras respuesta";
				 mostrarFormulario($mail, $asunto, $cuerpo);
			}
		}
	}
 ?>	
 <?php
	require_once("inc/pie.php");
?>