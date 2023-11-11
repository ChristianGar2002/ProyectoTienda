<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion Eliminacion</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Recibimos el valor enviaddo
	if($_POST){
		$valor= trim($_POST['valor']);

		//Realizamos una verificación
		$verificacion = mysqli_query($conex, "SELECT * FROM ventas WHERE fecha_registro='$valor'");

    		if (mysqli_num_rows($verificacion) > 0) {
      			
      			//Se realiza una consulta con la instrucción DELETE FROM para la eliminacion			
      			$sql = "DELETE FROM ventas WHERE fecha_registro='$valor' and ACTIVO=2";
				
				if(($conex -> query($sql) === TRUE)){
					include_once("ventas_administracion.php");
      				echo '<script language="javascript">VentasEliminadasPor();</script>';

      				exit();

				}else{

					require_once("ventas_administracion.php");
					echo '<script language="javascript">ProveedoresFallidosDatos();</script>';

      				exit();
				}

    	}else{

    		require_once("ventas_administracion.php");			
			echo '<script language="javascript">VentasEliminadosVerificacion();</script>';
			
      		exit(); 		
      	}

	$conex ->close();
	}


?>
