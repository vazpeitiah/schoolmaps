<?php 
	include('config.php');
	session_start();
    $consulta = "INSERT INTO `alumnos`(`NombreUsuario`, `Password`, `email`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `fechaRegistro`, `noBoleta`, `IDEdificio`, `autorizado`) VALUES ('".$_POST["IDConductor"]."', '".$_POST["pass"]."', '".$_POST["correo"]."','".$_POST["nombre"]."', '".$_POST["appat"]."', '".$_POST["apmat"]."', '".$_POST["tel"]."', '". date("Y/n/j") ."', '".$_POST["bole"]."', '".$_POST["IDEdificio"]."', 0);";
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	header("Location: ../registroExitoso.php", true, 301);
    mysqli_close( $conexion );
 ?>