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
        <h1>Bienvenido a SchoolMaps</h1>
           <blockquote> 
            SchoolMaps es una plataforma para poder modelar mapas interactivos de escuelas. Podras hacer un modelado de tu 
            escuela de una manera fácil, haciendo una representación fundamental con figuras básicas.
            <footer>Del administrador</footer>
            </blockquote>
            <hr>
            <center><img class="img-responsive" src="img/example.jpg" style="width: 100%; height: 600px;"></center>
            
            
    </div>

</body>
</html>