<?php
	session_start();
	require_once "bbdd/bbdd.php";
	require_once "inc/funciones.php";
?>

<?php
	$idProducto = recoge("idProducto");
	$op = recoge("op");
	
	if($idProducto == "" or $op == ""){
		header("location: index.php");
	}
	
	$producto = seleccionarProducto($idProducto);
	
	if(empty($producto)){
		header("location: index.php");
	}
	
	switch($op){
		case "add":
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]++;
			}else{
				$_SESSION['carrito'][$idProducto]=1;
			}
		break;
		
		case "remove":
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]--;
				if($_SESSION['carrito'][$idProducto]<=0){
					unset($_SESSION['carrito'][$idProducto]);
				}
			}
		break;
		
		case "empty":
			unset($_SESSION['carrito']);
		break;
		
		default:
			header("location: index.php");
	}//fin nintendo switch
	
	header("location: carrito.php");
?>