<?php 
	include("config.php");
	session_start();

	$query = "UPDATE `tb_piso` SET `Json`= '".mysqli_real_escape_string($conexion,$_POST['JSONModel'])."' WHERE `IDEdificio` = '".$_POST["IDEdificio"]."' AND `noPiso` = ".$_POST["noPiso"]."";
	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	echo "Mapa actualizado correctamente";
    mysqli_close( $conexion );
?>