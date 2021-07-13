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
        <label for="">Selecciona el número de piso que quieres editar: </label>
        <select id="noPiso">
            <?php
                include("config/config.php");
                $query = "SELECT `noPiso`FROM `tb_piso` WHERE `IDEdificio` = '".$_GET['IDEdificio']."'";
                $resultado = $conexion->query($query);
                while ($ret = mysqli_fetch_array($resultado)){
                    echo "<option value='".$ret['noPiso']."' >".$ret['noPiso']."</option>";
                }
            ?>
            
        </select> 
        <strong>Información:</strong> Para asignar un horario al salón, de doble clic sobre el mismo.
        <p class="bg-danger">
            <strong>¡Importante!</strong> Recuerda dar clic al botón guardar antes de recargar o cambiar de página, de
            lo contrario ningún cambio será guardado.
        </p>
    </div>  
    <div class="container-fluid">
        <div id="app" class="joint-app joint-theme-modern">
            <div class="app-header"></div>
            <div class="app-body">
                <div class="draw-area" id="stencil" style="background: #383b61;; height: 700px; width: 15%; position: relative;"></div>
                <div class="draw-area" id="paper" class="areaDibujo" style="background: #383b61;; height: 700px; width: 69%;  "></div>
                <div class="draw-area" style="background: #383b61; height: 700px; width: 15%; position:  absolute;">
                    <div id="inspector" style="height: 550px; width: 100%;"></div>
                    <div id="navigator" style="height: 150px; width: 100%;"></div>
                </div>
            </div>
        </div>
        <script src="js/mapaAdmin.js" type="text/javascript" charset="utf-8" async defer></script>
    </div>


    <!-- Modal mapa guardado correctamente -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="btnMapaCreado">
      Open modal
    </button>

    <!-- The Modal -->
    <div class="modal" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Guadar salón</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h3>Mapa guardado correctamente</h3>
            <textarea id="txtJSONModel" class="form-control" rows="5" ></textarea>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btnForm">
  Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Guadar salón</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="post" action="config/insertarAula.php">
          <div class="form-group">
            <label for="idModel">ID Model:</label>
            <input type="text" class="form-control" id="txtIDModel" name="IDElementModel" readonly="readonly">
            <label for="idModel">Selecciona un grupo:</label>
            <select id="IDGrupo" class="form-control" name="IDGrupo" required="">
            <?php
                include("config/config.php");
                $query = "SELECT `IDGrupo`FROM `tb_grupo` WHERE `IDAdmin` = '".$_SESSION['user']."' AND asignado != 1";
                $resultado = $conexion->query($query);
                while ($ret = mysqli_fetch_array($resultado)){
                    echo "<option value='".$ret['IDGrupo']."' >".$ret['IDGrupo']."</option>";
                }
            ?>
            </select>
            <label for="IDEdificio">ID del edificio:</label>
            <input type="text" class="form-control" id="IDEdificio" name="IDEdificio" readonly="readonly">
            <label for="noPisoTxt">Número de piso:</label>
            <input type="text" class="form-control" id="noPisoTxt" name="noPiso" readonly="readonly">
          </div>
          <button type="submit" class="btn btn-primary" hidden="hiden" id="btnForm">Asignar grupo</button>
        </form><br>
        <div class="alert alert-warning" id="atencion">
          <strong>¡Atención!</strong> Este salón ya ha sido asignado.
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
</body>
</body>
</html>