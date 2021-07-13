<?php 
	include('config.php');

	$query = "SELECT `NombreUsuario` FROM `Alumnos` WHERE `NombreUsuario` = '".$_POST["nickname"]."'";
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0)
		{
			echo "No disponible";
			exit();
		}else{
			echo "Disponible";
			exit();
		}
	}
?>