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
?>