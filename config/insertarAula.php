<?php 
	include('config.php');
	session_start();
    $consulta = "INSERT INTO `tb_aula`(`IDElementModel`, `noPiso`, `IDGrupo`) VALUES ('".$_POST['IDElementModel']."','".$_POST['noPiso']."','".$_POST['IDGrupo']."')";
    $consulta2 = "UPDATE `tb_grupo` SET `asignado`= 1 WHERE `IDGrupo` = '".$_POST['IDGrupo']."'";
    
    mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    mysqli_query( $conexion, $consulta2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	header("Location: ../admin_editarMapa.php?IDEdificio=".$_POST['IDEdificio']."", true, 301);
    mysqli_close( $conexion );
 ?>