<?php
	session_start();
?>

<?php
	if(isset($_SESSION["email"])){
				unset($_SESSION["email"]);
				header("location:login.php");
	}
?>