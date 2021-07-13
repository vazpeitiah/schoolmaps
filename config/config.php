<?php
	$servidor = "localhost";
	$nombreusuario = "root";
	$password = "Vl4d1m1R";
	$db = "schoolmaps";
	$conexion =  new mysqli($servidor,$nombreusuario, $password,$db);
	if($conexion -> connect_error){
		die("Conexion fallida: ".$conexion->connect_error);
	}
?>