<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion Eliminacion</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Capturamos los valores del formulario
	if($_POST){
		$campo= trim($_POST['campo']);
		$valor= trim($_POST['valor']);
		$fecha_eliminacion= date("d/m/y");

		$verificacion = mysqli_query($conex, "SELECT * FROM productos WHERE $campo='$valor' and ACTIVO='1'");

    		if (mysqli_num_rows($verificacion) > 0) {

    			//Realizamos una actualización con UPDATE SET
      			$sql = "UPDATE productos SET ACTIVO = 2, fecha_eliminacion='$fecha_eliminacion' WHERE $campo = '$valor'";

				if(($conex -> query($sql) === TRUE)){
					require_once("ver_productos.php");			
					echo '<script language="javascript">ProductosEliminadosPor();</script>';
      				exit();

				}else{

					require_once("ver_productos.php");			
					echo '<script language="javascript">ProductosFallidosDatos();</script>';

      				exit();
				}

    	}else{

    		require_once("ver_productos.php");			
					echo '<script language="javascript">ProductosEliminadosVerificacion();</script>';
      		exit(); 		
      	}

	$conex ->close();
	}


?>
