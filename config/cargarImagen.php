<?php
	include("config.php"); 
	session_start();
	$query = "SELECT `img` FROM `tb_edificio` WHERE `IDEdificio` = '".$_POST["IDEdificio"]."'";
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0)
		{
			$ret = mysqli_fetch_array($resultado);
			$imagenURL = $ret['img'];
			echo base64_encode($imagenURL); 
		}else{
			echo "";
		}
	}
 ?>