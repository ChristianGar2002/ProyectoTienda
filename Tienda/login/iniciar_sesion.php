<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Icono de la pestaña -->
  <link rel="icon" href="../img/tienda.png">

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
		function ConfirmacionConexion(){
	        Swal.fire({
  					icon: 'success',
 						title: 'Conexión exitosa',
					}).then((result) => {
  					if (result.isConfirmed) {
    					window.location.href = "../dashboard/index.php";
  					}
				})

	    }

	  function RecuperacionFallida(){
          Swal.fire({
            icon: 'error',
            title: 'Esta clave no existe, intentelo nuevamente',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "../login/iniciar_sesion.php";
            }
        })

      }

		function ActualizacionContra(){
	        Swal.fire({
  					icon: 'success',
 						title: 'Actualizacion exitosa',
 						text: 'Se ha establecido una nueva contraseña',
					}).then((result) => {
  					if (result.isConfirmed) {
    					window.location.href = "../login/iniciar_sesion.php";
  					}
				})

	    }
	    	
</script>
</body>
</head>
</html>

<?php 
  session_start();
  if (isset($_SESSION['ID'])) {
    header("Location: ../dashboard/index.php");
    exit();
  }
  //Agregamos el archivo de conexion a la base de datos
  include_once('../conexion.php');

  if (isset($_POST['login_user'])) {
    $errorMsg="";
    $username = $conex->real_escape_string($_POST['username']);
    $password = $conex->real_escape_string(md5($_POST['password']));

    if (!empty($username) || !empty($password)) {
      $query="SELECT * FROM usuarios WHERE username = '$username' AND password='$password'";
      $result= $conex->query($query);
      if ($result->num_rows > 0) {
        $row=$result->fetch_assoc();
        $_SESSION['ID'] = $row['id'];
        $_SESSION['ROL'] = $row['rol'];
        $_SESSION['USERNAME'] = $row['username'];

        echo '<script language="javascript">ConfirmacionConexion();</script>';
 
        die();
      }else{
        $errorMsg = "El usuario o la contraseña son incorrectas";
      }
      
    } 
  } 
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Iniciar Sesión</title>

		<!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../dashboard/plugins/sweetalert2/sweetalert2.min.css">

		<!-- Estilos de bosstrap-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

		<!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Estilos css -->
	<link rel="stylesheet" href="../css/login.css">

	 <!-- Fondo UiGradients Personalizado -->
   <link rel="stylesheet" href="../css/bg-main.css">

</head>
<body>
	<div class="modal-dialog text-center">
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				<div class="col-12 user-img">
					<img src="../img/login.jpg" alt="Imagen de login">
				</div>
				<?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dissmissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
          <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
				<form method="POST" class="col-12">
					<div class="form-group" id="user-group">
						<input type="text" class="form-control" placeholder="Nombre de usuario" name="username" required autofocus>
					</div>
					<div class="form-group" id="contrasena-group">
						<input type="password" class="form-control" placeholder="Contraseña" name="password" required>
					</div>
					<button type="submit" class="btn btn-primary" name="login_user" style="width: 180px;"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
				</form>
				<!--<button type='button' class='btn' data-toggle="modal" data-target="#RecuperarModal" style="width: 250px; background-color: transparent;color: white; margin-bottom: 0px; margin-left: auto;margin-right: auto;"><b>Recordar contraseña</b></button>-->
			</div>
		</div>
	</div>
	<?php include('../dashboard/recuperacion.php')?>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  
</body>
</html>