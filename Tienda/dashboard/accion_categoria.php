<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Iniciar Sesión</title>

		<!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Alerta personalizada de javascript -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

   <!-- Estilos de bosstrap-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>
	<script type="text/javascript">
		function mostrar2(){
	        Swal.fire({
  					icon: 'error',
 					title: 'Oops...',
  					text: 'No se ha podido registrar la categoria!',
					}).then((result) => {
  					if (result.isConfirmed) {
    					window.location.href = "ver_categorias.php";
  					}
				})

	    	}

</script>
</body>
</head>
</html>

<?php

	include("../conexion.php");
	include('ver_categorias.php');
	if (isset($_POST['agregar_categoria'])) {
			$nombre_categoria= trim($_POST['nombre_categoria']);
			$fecha_registro= date("d/m/y");

			//Verificacion del nombre de la categoria
			$verificacion = mysqli_query($conex, "SELECT * FROM categorias WHERE nombre_categoria='$nombre_categoria'");

    			if (mysqli_num_rows($verificacion) > 0) {
      				
      				echo '<script language="javascript">CategoriaRepetida();</script>';
      				exit();
    			}else{
    				//Inserción de datos a la tabla categoria
					$consulta= "INSERT INTO categorias(nombre_categoria, fecha_registro) VALUES('$nombre_categoria', '$fecha_registro')";
					$resultado=mysqli_query($conex, $consulta);

			}

		if ($resultado == true) {			
      		echo '<script language="javascript">CategoriaCreada();</script>';
		}else{
      		echo '<script language="javascript">CategoriaFallida();</script>';
		}		
	}
?>