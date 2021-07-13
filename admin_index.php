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
                <a class="navbar-brand" href="admin_index.php"><span class="glyphicon glyphicon-education"></span>SCHOOLMAPS</a>
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
        <h1>¡ Bienvenido <?php echo $_SESSION['nombre'].' '.$_SESSION['apellidoPat'].' '.$_SESSION['apellidoMat']; ?>!</h1>
        <h2>CUENTA DEL ADMISTRADOR</h2>
        <blockquote>
            Esta página es para ayudarnos a tener un estacionamiento más seguro y eficaz
            Cualquier persona en la comunidad que conforma a la ESCOM puede ayudar
            Si observas alguna anomalía en el estacionamiento, puedes reportarla en ésta página
            Pero antes por favor inicia sesión o registrate para continuar
            Te pedimos que denuncies de manera honesta ya que se le hará seguimiento
            Ninguno de tus datos será revelado al público
        </blockquote>
    </div>


</div>
</body>
</html>