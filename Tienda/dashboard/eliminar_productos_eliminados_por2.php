<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion Eliminación</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Capturamos los valores del formulario
	if($_POST){
		$campo= trim($_POST['campo']);
		$valor= trim($_POST['valor']);


		$verificacion = mysqli_query($conex, "SELECT * FROM productos WHERE $campo='$valor' and ACTIVO='2'");

    		if (mysqli_num_rows($verificacion) > 0) {
      			//Realizamos la eliminación con la instrucción DELETE FROM
      			$sql = "DELETE FROM productos WHERE $campo = '$valor' and ACTIVO='2'";

				if(($conex -> query($sql) === TRUE)){
					include_once("ver_productos_eliminados.php");
      				echo '<script language="javascript">ProductosEliminadosPor();</script>';

      				exit();

				}else{

					require_once("ver_productos_eliminados.php");			
					echo '<script language="javascript">ProductosFallidosDatos();</script>';

      				exit();
				}

    	}else{

    		require_once("ver_productos_eliminados.php");			
			echo '<script language="javascript">ProductosEliminadosVerificacion();</script>';
			
      		exit(); 		
      	}

	$conex ->close();
	}


?>
