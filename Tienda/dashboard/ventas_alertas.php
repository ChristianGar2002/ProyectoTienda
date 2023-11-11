<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Ventas Alertas</title>

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
		<?php 
		//Funcion para el formato de precios y totales
      	function SetCurrency2(float $valor, string $signo='$'):string
      	{
       		return $signo.number_format($valor,2, '.','');
      	}

		?>
		function ProductoNoExistente(){
	        Swal.fire({
  					icon: 'error',
  					text: 'El producto ingresado no existe!',
					}).then((result) => {
  					if (result.isConfirmed) {
    					window.location.href = "ventas.php";
  					}
				})

	    }
	    
	     function VentaRealizada(){
          Swal.fire({
            icon: 'success',
            title: 'Venta realizada exitosamente',
            html:'<h4><b>Cambio: </b><?php echo SetCurrency2($cambio); ?></h4>',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas.php";
            }
        })

      }

      function VentaEliminada(){
          Swal.fire({
            icon: 'success',
            title: 'Venta eliminada exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }

      function SinVenta(){
	        Swal.fire({
  				icon: 'error',
  				text: 'No se ha realizado ninguna venta!',
				}).then((result) => {
  				if (result.isConfirmed) {
    				window.location.href = "ventas.php";
  				}
			})
	 }

</script>
</head>
</body>
</html>