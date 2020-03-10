<?php
	session_start();
	$pagina = "confirmarPedido";
	$titulo = "Confirma tu pedido";
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");
	require_once "bbdd/bbdd.php";

?>
<?php
	if(!isset($_SESSION['carrito'])){
		echo "Tu carrito esta vacío.";
		echo "<a href=\"index.php\" class=\"btn btn-primary ml-3\">Volver.</a>";
	}else{				
		if(!isset($_SESSION['email'])){
					echo "Para procesar la compra, debe iniciar sesión.";
					echo "<a href=\"login.php\" class=\"btn btn-primary ml-3\">Iniciar sesión</a>";	
				}else{	
					$email=$_SESSION['email'];
					$detallePedido=$_SESSION['carrito'];
					$total=0;
					foreach($detallePedido as $id=>$cantidad){
						$producto = seleccionarProducto($id);
						$precio = $producto['precioOferta'];
						$subtotal = $precio * $cantidad;
						$total = $total + $subtotal;
					}
					$pedidoOK=insertarPedido($email, $detallePedido, $total);
					if($pedidoOK){
							echo "El pedido fue procesado con exito";
					}else{
							echo "Error al procesar el pedido";
					}
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