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

   <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-sm-4">
                <img src="img/ubicacion.png" class="img-responsive" width="460" height="345">
            </div>

            <div class="col-sm-8">   
                <h2>Mapa</h2>
                <blockquote>
                Con el mapa interactivo del estacionamiento podras ver que lugares estan disponibles, reservados u ocupados,
                Podras localizar tu carro más rapidamente y escoger el lugar que mas se acomode a ti
                y finalemte podras reportar faltas mas rapidamente, asegurando asi un mejor ervicio para todos
                </blockquote>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                <h2>Acerca de</h2>
                <blockquote>
                Este proyecto está hecho para ayudar en el funcionamiento correcto del estacionamiento perteneciente a la escuela
                Con una administración ordenada podremos hacer que el manejo de éste sea adecuado para una convivencia sana entre toda la comunidad
                Si todos ayudamos a seguir las reglas y a aprender de nuestros errores, el estacionamiento de ESCOM, podrá funcionar de manera óptima
                </blockquote>
            </div>
        </div>                
    </div>

</body>
</html>