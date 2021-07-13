<?php
	include("config.php"); 
	$query = "SELECT `JSONModel` FROM `tb_mapa` WHERE `IDAdmin` = 'admin'";
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0)
		{
			$ret = mysqli_fetch_array($resultado);
			$JSONString = $ret['JSONModel'];
			echo $JSONString; 
		}else{
			echo '';
		}
	}
 ?>