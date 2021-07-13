<?php
    session_start();
    if(!isset($_SESSION['user']))
        header("Location: index.php", true, 301);
    else
        if($_SESSION['tipo'] != 'admin')
            header("Location: user_index.php", true, 301); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de usuarios</title>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--DEPENDENCIAS DEL BOOTSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--DEPENDENCIAS DEFINIDAS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="js/sorttable.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_index.php"><span class="glyphicon glyphicon-education"></span>SCHOOLMAPS</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="admin_index.php"> Inicio </a></li>
                <li><a href="admin_tablaMapas.php"> Mis mapas </a></li>
                <li><a href="admin_tablaUsuarios.php"> Tabla de usuarios </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user']?>  <img src="img/usuario.png" class="img-circle" alt="Cinque Terre" width="25" height="25"></a>
                <ul class="dropdown-menu">
                    <li><a href="admin_config.php">Configuración</a></li>
                    <li><a href="config/logout.php">Cerrar Sesión</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </nav>

        <div class="container-fluid">
        <h3>Tabla de usuarios</h3>
        <hr>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Telefono</th>
                    <th>Fecha de registro</th>
                    <th>Boleta</th>
                    <th>Asignado a</th>
                    <th>¿Está autorizado?</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("config/config.php");
                    $query = "SELECT * FROM `alumnos`";
                    $resultado = $conexion->query($query);
                    while ($ret = mysqli_fetch_array($resultado)){
                        echo "<tr><td>".$ret['NombreUsuario']."</td><td>".$ret['email']."</td> <td>".$ret['nombre']."</td><td>".$ret['apellidoPat']."</td><td>".$ret['apellidoMat']."</td><td>".$ret['telefono']."</td><td>".$ret['fechaRegistro']."</td><td>".$ret['noBoleta']."</td><td>".$ret['IDEdificio']."</td><td>". (($ret['autorizado'] == 0)?'No':'Si') ."</td><td><a class='btn btn-info' role='button' href='config/autorizar.php?NombreUsuario=".$ret['NombreUsuario']."&value=".$ret['autorizado']."'>" . (($ret['autorizado'] == 0)?'Permitir Acceso':'Negar Acesso') . "</a></td><td><a class='btn btn-primary' role='button' href='actualizarPersonal.php?NombreUsuario=".$ret['NombreUsuario']."&nombre=".$ret['nombre']."&apellidoPat=".$ret['apellidoPat']."&apellidoMat=".$ret['apellidoMat']."&telefono=".$ret['telefono']."&correo=".$ret['email']."&noBoleta=".$ret['noBoleta']."&IDEdificio=".$ret['IDEdificio']."'>Editar</a></td><td><a href='confirmDeleteUSR.php?NombreUsuario=".$ret['NombreUsuario']."' class='btn btn-danger' role='button'>Eliminar</a></td></tr>";
                    }
                 ?>
            </tbody>
        </table>
        <a href="registraPersonal.php" class="btn btn-success" role="button">Agregar usuario</a>
    </div>

</div>
</body>
</html>