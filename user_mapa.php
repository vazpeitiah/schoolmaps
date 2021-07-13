<?php
    session_start();
    if(!isset($_SESSION['user']))
        header("Location: index.php", true, 301);
    else
        if($_SESSION['tipo'] == 'admin')
            header("Location: admin_index.php", true, 301); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa</title>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--DEPENDENCIAS DEL BOOTSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <!--Dependencias JOINTJS-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jointjs/2.1.0/joint.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jointjs/2.1.0/joint.js"></script>
    <link rel="stylesheet" type="text/css" href="js/rappid/build/rappid.min.css">
    <script src="js/rappid/build/rappid.min.js"></script>
    <!--DEPENDENCIAS DEFINIDAS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_index.php"><span class="glyphicon glyphicon-education"></span>SCHOOLMAPS</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="user_index.php"> Inicio </a></li>
                <li><a href="user_mapa.php"><span id="IDEdificio"><?php echo $_SESSION['IDEdificio']?></span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user']?>  <img src="img/usuario.png" class="img-circle" alt="Cinque Terre" width="25" height="25"></a>
                <ul class="dropdown-menu">
                    <li><a href="config/logout.php">Cerrar Sesión</a></li>
                </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <label for="">Selecciona el número de piso que quieres ver: </label>
        <select id="noPiso">
            <?php
                include("config/config.php");
                $query = "SELECT `noPiso`FROM `tb_piso` WHERE `IDEdificio` = '".$_SESSION['IDEdificio']."'";
                $resultado = $conexion->query($query);
                while ($ret = mysqli_fetch_array($resultado)){
                    echo "<option value='".$ret['noPiso']."' >".$ret['noPiso']."</option>";
                }
            ?>
            
        </select> 
        <div class="alert alert-info">
            <strong>Información: </strong> Para visualizar el horario del salón tienes que dar doble clic sobre él.
        </div> 
    </div>  

     <div class="container-fluid">
        <div id="app" class="joint-app joint-theme-modern">
            <div class="app-header"></div>
            <div class="app-body">
                <div class="draw-area" id="paper" class="areaDibujo" style="background: #383b61;; height: 650px; width: 99%;  "></div>
            </div>
        </div>
        <script src="js/mapaUser.js" type="text/javascript" charset="utf-8" async defer></script>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnForm">
  Open modal
</button>
        <!-- The Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Guadar salón</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body" id="myDiv">
             
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
</body>
</html>