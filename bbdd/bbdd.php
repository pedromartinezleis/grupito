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
			echo "Error al seleccionar el usuario:".$e->getMessage();
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
		
//funcion insertar pedido

function insertarPedido($idUsuario, $detallePedido, $total){
	$conexion = conectarbd();
	try{
		$conexion -> beginTransaction();
		$sql = 'INSERT INTO pedido(idUsuario, total) VALUES (:idUsuario,:total)';
		
		$sentencia = $conexion -> prepare($sql);
		$sentencia -> bindparam (":idUsuario", $idUsuario);
		
		$sentencia -> execute();
		
		$idPedido = $conexion -> lastInsertId();
		
		foreach($detallePedido as $idProducto => $cantidad){
			$sql2 = "INSERT INTO detallePedido";
			$producto = seleccionarProducto($idProducto);
			$precio = $producto['precioOferta'];
			$sql2 ="INSERT INTO detallePedido(idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
			$sentencia -> bindParam(":idPedido", $idPedido);
			$sentencia -> bindParam(":idProducto", $idProducto);
			$sentencia -> bindParam(":cantidad", $cantidad);
			$sentencia -> bindParam(":precio", $precio);
			$sentencia -> execute();
		}
		$conexion -> commit();
		
	}catch(PDOException $e ){
			$conexion -> rollback();
			echo "Error al hacer pedido:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
}
	return $rows;
}

	//Funcion actualizar usuario
	
	function actualizarUsuario($email, $nombre, $apellidos, $direccion, $telefono){
		$con = conectarbd();
		
		//$password = password_hash($npassword, PASSWORD_DEFAULT);
		
		try{
			$sql = "UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, direccion=:direccion, telefono=:telefono WHERE email=:email";
			$stmt=$con->prepare($sql);
			
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':nombre',$nombre);
			$stmt ->bindParam(':apellidos', $apellidos);
			$stmt ->bindParam(':direccion', $direccion);
			$stmt ->bindParam(':telefono', $telefono);
			
			$stmt -> execute();
			
		}catch(PDOException $e ){
			echo "Error al actualizar usuario:".$e->getMessage();
			file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e -> getMessage(), FILE_APPEND);
			exit;
		}
		return $stmt->rowCount();
	}
?>