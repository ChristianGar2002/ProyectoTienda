<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion actualización</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	include('ver_categorias.php');

	if($_POST){
		$nombre_categoria= trim($_POST['nombre_categoria']);

		$id = $_POST['id'];

		//Creamos la consulta de actualización en SQL con los datos recabados del POST a traves del ID del campo id que esta "oculto".

		$verificacion = mysqli_query($conex, "SELECT * FROM categorias WHERE nombre_categoria='$nombre_categoria'");

		if (mysqli_num_rows($verificacion) > 0) {

      			echo '<script language="javascript">CategoriaRepetida();</script>';

      		exit();
			
		}else{

			$sql = "UPDATE categorias SET nombre_categoria = '$nombre_categoria' WHERE id = {$id}";

			if($conex -> query($sql) === TRUE) {

      			echo '<script language="javascript">ActualizacionCategoria();</script>';
      			
      			exit();
			}else{
				echo "Error al actualizar el registro: " . $conex->error;
			}
		}
	$conex ->close();
	}
?>
