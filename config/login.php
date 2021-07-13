<?php
require_once'config.php';

session_start();

$nickname = $_POST['usuario'];
$password = $_POST['pwd'];

$query = "SELECT * FROM administradores WHERE NombreUsuario='".$nickname."' AND Password ='".$password."'";
$query2 = "SELECT * FROM alumnos WHERE NombreUsuario='".$nickname."' AND Password ='".$password."'";


if($resultado = $conexion->query($query)){
	if($resultado->num_rows>0)
	{
		$ret = mysqli_fetch_array($resultado); 
		$_SESSION["user"] = $nickname;
		$_SESSION["password"] = $password;
		$_SESSION["nombre"] = $ret['nombre'];
		$_SESSION["apellidoPat"] = $ret['apellidoPat'];
		$_SESSION["apellidoMat"] = $ret['apellidoMat'];
		$_SESSION["correo"] = $ret['correo'];
		$_SESSION["telefono"] = $ret['telefono'];
		$_SESSION["tipo"] = 'admin';
		header("Location: ../admin_index.php", true, 301);
	}else if($resultado2 = $conexion->query($query2)){
		if($resultado2->num_rows>0)
		{
			$ret2 = mysqli_fetch_array($resultado2);
			if($ret2['autorizado'] == '1'){
				$_SESSION["user"] = $nickname;
				$_SESSION["password"] = $password;
				$_SESSION["nombre"] = $ret2['nombre'];
				$_SESSION["apellidoPat"] = $ret2['apellidoPat'];
				$_SESSION["apellidoMat"] = $ret2['apellidoMat'];
				$_SESSION["correo"] = $ret2['correo'];
				$_SESSION["telefono"] = $ret2['telefono'];
				$_SESSION["noBoleta"] = $ret2['noBoleta'];
				$_SESSION['autorizado'] = $ret2['autorizado'];
				$_SESSION['IDEdificio'] = $ret2['IDEdificio'];
				$_SESSION["tipo"] = 'user';
				header("Location: ../user_index.php", true, 301);
			}
			else{
				header("Location: ../noAutorizado.php", true, 301);
			}
			
		}else{
			echo'<script>alert("Usuario no valido1");</script>';
			header("Location: ../iniciosesion.php", true, 301);
		}
	}else{
		echo'<script>alert("Usuario no valido2");</script>';
		header("Location: ../iniciosesion.php", true, 301);
	}
}
?>


