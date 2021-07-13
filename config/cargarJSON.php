<?php
	include("config.php"); 
	session_start();
	$query = "SELECT `JSON` FROM `tb_piso` WHERE `IDEdificio` = '".$_POST["IDEdificio"]."' AND noPiso = ".$_POST['noPiso']."";
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0)
		{
			$ret = mysqli_fetch_array($resultado);
			$JSONString = $ret['JSON'];
			echo $JSONString; 
		}else{
			echo '';
		}
	}
 ?>