<?php
    session_start();
    include'config/config.php';
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
    <title>Inicio</title>
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

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h1 class="text-center">Listado de Administradores</h1></div>
                <div class="panel-body">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Nombre de usuario</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            </tr>
                        </thead>
                        <tbody id="myTableH1">
                            <?php
                                $sql = "SELECT *FROM Administradores";
                                $result=mysqli_query($conexion,$sql);
                                while ($mostrar = mysqli_fetch_array($result)) {
                            ?>  
                                <tr>
                                    <td><?php echo $mostrar['NombreUsuario']?></td>
                                    <td><?php echo $mostrar['email']?></td>
                                    <td><?php echo $mostrar['Password']?></td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-sm btn-info" data-toggle="modal" data-target="#editarModal"><span class="glyphicon glyphicon-pencil"></span> Editar </button>
                                        <button type="button" class="btn btn-default btn-sm btn-danger" data-toggle="modal" data-target="#eliminarModal"><span class="glyphicon glyphicon-remove"></span> Eliminar </button>
                                    </td>
                                </tr> 
                            <?php  
                                }
                            ?>     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="editarModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">EDITAR REGISTRO</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="eliminarModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ELIMINAR REGISTRO</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Está seguro que quiere eliminar el registro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
