<?php
	include_once('../conexion.php');

  //Se reciben los datos mandados por la ventana modal
  if (isset($_POST['reg_user'])) {
  	$name = $conex->real_escape_string($_POST['name']);
    $username = $conex->real_escape_string($_POST['username']);
    $password = $conex->real_escape_string(md5($_POST['password']));
    $correo = $conex->real_escape_string($_POST['correo']);
    $rol = $conex->real_escape_string($_POST['rol']);
    $fecha_registro= date("d/m/y");

    $verificacion = mysqli_query($conex, "SELECT * FROM usuarios WHERE username='$username'");

    if (mysqli_num_rows($verificacion) > 0) {
      require_once("ver_usuarios.php");			
			echo '<script language="javascript">UsuarioRepetido();</script>';
      exit();
    }

    $query = "INSERT INTO usuarios(name, username, password, correo, rol, fecha_registro) VALUES ('$name','$username', '$password', '$correo', '$rol', '$fecha_registro')";
    $result = $conex->query($query);

    if ($result == true) {      
      require_once("ver_usuarios.php");			
			echo '<script language="javascript">UsuarioCreado();</script>';
    }else{
      require_once("ver_usuarios.php");			
			echo '<script language="javascript">UsuarioFallido();</script>';
    }
  }
?>