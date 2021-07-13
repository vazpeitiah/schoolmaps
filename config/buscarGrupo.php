<?php 
	include("config.php");
	$query1 = "SELECT `IDGrupo` FROM `tb_aula` WHERE `IDElementModel` = '".$_POST['IDElementModel']."'";
	
	if($resultado1 = $conexion->query($query1)){
		if($resultado1->num_rows>0){
			$ret1 = mysqli_fetch_array($resultado1);
			$query = "SELECT  `IDGrupo`, `Asignatura`, `Profesor`, `Lun`, `Mar`, `Mie`, `Jue`, `Vie`, `Turno`, `Nivel` FROM `horarios` WHERE `IDGrupo` = '".$ret1['IDGrupo']."'";
			echo '<h3>Horario del grupo '.$ret1['IDGrupo'].'</h3>
	        <hr>
	        <table class="table table-striped">
	            <thead>
	                <tr>
	                    <th>Grupo</th>
	                    <th>Asignatura</th>
	                    <th>Profesor</th>
	                    <th>Lunes</th>
	                    <th>Martes</th>
	                    <th>Miercoles</th>
	                    <th>Jueves</th>
	                    <th>Viernes</th>
	                    <th>Turno a</th>
	                    <th>Nivel</th>
	                </tr>
	            </thead>
	            <tbody>';
                $resultado = $conexion->query($query);
                while ($ret = mysqli_fetch_array($resultado)){
                    echo "<tr><td>".$ret['IDGrupo']."</td><td>".$ret['Asignatura']."</td> <td>".$ret['Profesor']."</td><td>".$ret['Lun']."</td><td>".$ret['Mar']."</td><td>".$ret['Mie']."</td><td>".$ret['Jue']."</td><td>".$ret['Vie']."</td><td>".$ret['Turno']."</td><td>".$ret['Nivel']."</td></tr>";
                }
             
	            echo '</tbody>
	        </table>';
		}else{
			echo "Nothing";
		}
	}
	
?>