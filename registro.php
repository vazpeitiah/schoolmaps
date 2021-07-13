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
    <script type="text/javascript" src="js/registro.js"></script>
</head>
<body>

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

    
    <div class="container formm">
        <h1>Registro de Usuario</h1>
        <hr>
        <form class="form1" action="config/user_insertar.php" method="post" accept-charset="utf-8" class="form-horizontal">
            <label>Nickname (<span id="disponible" style="color:#45932CFF;">Disponible</span>)</label> 
            <input class="form-control" type="text" name="IDConductor" pattern="[A-Za-z0-9]+" required autofocus id="IDConductor" minlength="5" maxlength="20">
            <label>Nombre(s)</label>
            <input class="form-control" type="text" name="nombre" required pattern="[A-Za-z áéíóúÁÉÍÓÚ]+">

            <label>Apellido Paterno</label>

            <input class="form-control" type="text" name="appat" pattern="[A-Za-z áéíóúÁÉÍÓÚ]+" required>

            <label>Apellido Materno</label>
            <input class="form-control" type="text" name="apmat" pattern="[A-Za-z áéíóúÁÉÍÓÚ]+" required>

            <label>Teléfono</label>
            <input class="form-control" type="tel" name="tel" required pattern="(([0-9]{1,3}( )?)?([0-9]{0,4})[ -]?([0-9]{0,4})">

            <label id="tipoId" >Boleta</label>
            <input class="form-control" type="text" name="bole" required pattern="[0-9]{10}">

            <label>Correo</label>
            <input class="form-control" type="email" name="correo" placeholder="ejemplo@email.com" required>

            <label>Elige el mapa que quieres ver:</label>
            <select name="IDEdificio" class="form-control">  
                <?php
                include("config/config.php");
                    $query = "SELECT `IDEdificio` FROM `tb_edificio` WHERE `publico` = '1'";
                    $resultado = $conexion->query($query);
                    while ($ret = mysqli_fetch_array($resultado)){
                        echo "<option value='".$ret['IDEdificio']."' >".$ret['IDEdificio']."</option>";
                    }
                ?>
            </select>

            <label>Crear Contraseña</label>
            <input class="form-control" type="password" name="pass" required minlength="5" maxlength="40">

            <label>Verificar Contraseña</label>
            <input class="form-control" type="password" name="pass2" required minlength="5" maxlength="40"><br>       

            <input class="form-control btn btn-primary" type="submit" value="Enviar">
        </form>
    
    </div>

</body>
</html>