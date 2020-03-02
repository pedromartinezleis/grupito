<?php
	session_start();
	$pagina = "confirmarPedido";
	$titulo = "Confirma tu pedido";
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");
	require_once "bbdd/bbdd.php";

?>
<?php
	if(empty($_SESSION['carrito'])){
		$mensaje = 'carrito vacio';
		mostrarMensaje($mensaje);
		header('Location:index.php');
	}elseif{
		$mensaje = 'Necesitas estar logeado para realizar esta accion';
		mostrarMensaje($mensaje);
		header('Location:login.php');
	}else{
		foreach($_SESSION['carrito'] as $idProducto => $cantidad){
			
		}
	}
	
?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
 <main role="main">
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Confirmar</h1>
    </div>
  </div>
  
  <div class="container">
	
  </div>
 </main>
<?php
	require_once("inc/pie.php");
?>