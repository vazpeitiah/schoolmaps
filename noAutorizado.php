<?php
    session_start();
    include 'config/config.php';
    if(isset($_SESSION['user'])){
        if($_SESSION['tipo']== 'admin')
            header("Location: admin_index.php", true, 301);
        else
            header("Location: user_index.php", true, 301);
    }
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
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-education"></span>SchoolMaps</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php" class="active">Inicio</a></li>
                <li><a href="acercade.php">Acerca de</a></li>
                <li><a href="mapaEjemplo.php">Mapa interactivo</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="registro.php"><span class="glyphicon glyphicon-check"></span> Registrarse </a></li>
                <li><a href="iniciosesion.php"><span class="glyphicon glyphicon-user"></span> Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Tu usuario no ha sido autorizado</h1>
           <blockquote> 
            Necesitas esperar a que el administrador valide tu cuenta; o en caso de que lleve mucho tiempo sin ser validada
            presentarte a gestión escolar y entregar tus papeles correspondientes
            <footer>Del administrador</footer>
            </blockquote> 
    </div>

</body>
</html>