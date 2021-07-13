<?php
	include("config.php");
	$query = "SELECT * FROM `tb_aula` WHERE `IDElementModel` = '".$_POST['IDElementModel']."'";
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0)
		{
			echo "SI";
			exit();
		}else{
			echo "NO";
			exit();
		}
	}
?>