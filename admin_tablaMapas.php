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
    <title>Mapas</title>
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
        <h3>Tabla de mapas</h3>
        <hr>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>ID del edificio</th>
                    <th>Imagen</th>
                    <th>Número de pisos</th>
                    <th>¿Es público?</th>
                    <th>Nickname del Administrador</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("config/config.php");
                    $query = "SELECT * FROM `tb_edificio` WHERE `NombreAdministrador` = '".$_SESSION['user']."'";
                    $resultado = $conexion->query($query);
                    $i = 1;
                    while ($ret = mysqli_fetch_array($resultado)){
                        echo "<tr><td>".$ret['IDEdificio']."</td><td><img style='width: 50px; height: 50px;'' src='data:image/jpeg;base64," . base64_encode($ret['img']) . "'/></td> <td>".$ret['noPisos']."</td><td>". (($ret['publico'] == 0)?'No':'Si') ."</td><td>".$ret['NombreAdministrador']."</td><td><a class='btn btn-info' role='button' href='config/autorizar.php?IDEdificio=".$ret['IDEdificio']."&value=".$ret['publico']."'>" . (($ret['publico'] == 0)?'Publicar':'Ocultar') . "</a></td><td><a class='btn btn-primary' role='button' href='admin_editarMapa.php?IDEdificio=".$ret['IDEdificio']."'>Editar</a></td><td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal".$i."' id='btnMapaCreado'> Eliminar</button></td></tr>

                             <div class='modal' id='myModal".$i."' style='margin-top:150px;'>
                              <div class='modal-dialog'>
                                <div class='modal-content'>
    
                                  <!-- Modal Header -->
                                  <div class='modal-header'>
                                    <h3 class='modal-title'>Eliminar automóvil</h3>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                  </div>
    
                                  <!-- Modal body -->
                                  <div class='modal-body'>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                        ";
                        $i++;
                    }
                 ?>
            </tbody>
        </table>
        <a href="admin_agregarMapa.php" class="btn btn-success" role="button">Agregar mapa</a>
    </div>

</div>
</body>
</html>