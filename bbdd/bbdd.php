<?php
	include "configuracion.php";
?>

<?php
	//funcion para conectarnos base de datos
	
	function conectarbd(){
		try{		
			$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USER, PASS);
		
			$con -> setAttribute (PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
		}catch(PDOException $e ){
			echo "Error al conectar la base de datos:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
		}
		return $con;
	}
//seleccionar un producto

function seleccionarUnProducto($idProducto){
	$con = conectarbd();
	try{
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con -> prepare($sql);
		
		$stmt -> bindParam(':idProductos',$idProductos);
		
		$stmt -> execute();
		$row =  $stmt -> fetch(PDO::FETCH_ASSOC);//uso el fetch cuando sé que me va a devolver una fila
		
		
	}catch(PDOException $e ){
			echo "Error al seleccionar el producto:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;	
	}
	return $row;
}

//seleccionar un usuario
function seleccionarUsuario($email){
	$con = conectarbd();
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con -> prepare($sql);
		
		$stmt -> bindParam(':email',$email);
		
		$stmt -> execute();
		$row =  $stmt -> fetch(PDO::FETCH_ASSOC);
		
		
	}catch(PDOException $e ){
			echo "Error al seleccionar el usuairo:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;	
	}
	return $row;
}

//seleccionar todos los usuarios
function seleccionarTodosUsuarios(){
	$con = conectarbd();
	try{
		$sql = "SELECT * FROM Usuarios";
		
		$stmt = $con -> query($sql);
		
		$rows =  $stmt -> fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e ){
			echo "Error al seleccionar todos los usuarios:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;	
	}
	return $rows;
}

//funcion que selecciona una oferta

		function seleccionarOfertasPortada($numOfertas){
			
			
			$con = conectarbd();
			
			try{
				$sql = "SELECT * FROM productos LIMIT :numOfertas";
				$stmt = $con->prepare($sql);
				
				$stmt -> bindparam('numOfertas', $numOfertas, PDO::PARAM_INT);
				
				$stmt -> execute();
				$rows =  $stmt -> fetchAll(PDO::FETCH_ASSOC);
				
			}catch(PDOException $e ){
			echo "Error al seelccionar ofertas:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
			}
			return $rows;
		}

//funcion que selecciona todas las ofertas

		function seleccionarTodasOfertas(){
			
			
			$con = conectarbd();
			
			try{
				$sql = "SELECT * FROM productos";
				
				$stmt = $con->prepare($sql);
				
				
				$stmt -> execute();
				
				$rows =  $stmt -> fetchAll(PDO::FETCH_ASSOC);
				
			}catch(PDOException $e ){
			echo "Error al seelccionar ofertas:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
			}
			return $rows;
		}
		
//funcion que selecciona una oferta

		function seleccionarProducto($idProducto){
			
			
			$con = conectarbd();
			
			try{
				$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
				$stmt = $con->prepare($sql);
				
				$stmt -> bindparam('idProducto', $idProducto, PDO::PARAM_INT);
				
				$stmt -> execute();
				$row =  $stmt -> fetch(PDO::FETCH_ASSOC);
				
			}catch(PDOException $e ){
			echo "Error al seleccionar una oferta:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
				
			}
			return $row;
		}
?>