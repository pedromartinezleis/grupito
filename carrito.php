<?php
	session_start();
	$pagina = "carrito";
	$titulo = "Tu compra";
	require_once("inc/encabezado.php");
	require_once("inc/funciones.php");
	require_once "bbdd/bbdd.php";

?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carro</h1>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando</a></p>
    </div>
  </div>
  <?php
	if(empty($_SESSION['carrito'])){
		$mensaje = 'carrito vacio';
		mostrarMensaje($mensaje);
	}else{
  ?>
<div class="container">
<div class="row px-5">
<table class="table"><!-- tabla-->
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$total=0;
		foreach($_SESSION['carrito'] as $idProducto => $cantidad){
			$producto = seleccionarProducto($idProducto);
			
			$nombre = $producto['nombre'];
			$precio = $producto['precioOferta'];
			$subtotal = $precio * $cantidad;
			$total = $total + $subtotal;
	?>
    <tr>
      <td><a class="btn btn-primary btn-lg" href="producto.php?idProducto=<?php echo $producto['idProducto']?>"><?php echo $nombre;?></a></td>
      <td><?php echo $precio;?></td>
	  <td><a href="procesarCarrito.php?idProducto=<?php echo $idProducto;?>&op=remove"><i class="fas fa-minus"></i></a>  <?php echo $cantidad;?><a href="procesarCarrito.php?idProducto=<?php echo $idProducto;?>&op=add"><i class="fas fa-cart-plus"></i></a></td>
      <td><?php echo $subtotal;?>€</td>
    </tr>
	<?php
		}//fin tabla
	?>
  </tbody>

  <tfoot>
	<tr>
		<th scope="row" colspan="3" class="test-right">Total</th>
		<td><?php echo $total;?>€</td>
	</tr>
  </tfoot>
</table>

<a href="procesarCarrito.php?id=<?php echo $idProducto?>&op=empty" class="btn btn-danger">Vaciar carrito</a><br />
<a href="confirmarPedido.php" class="btn btn-success">Confirmar pedido</a>
</div><!--fin div de la tabla-->
</div><!-- fin div class container-->
<?php
	$_SESSION['total']=$total;
	}//fin del if de empty $carrito
?>
</main>
<?php
	require_once("inc/pie.php");
?>