<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont principal-->
<div class="container">
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');
?> 
    
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Estilos de bosstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Los iconos tipo Solid de Fontawesome-->
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
   integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/iconos.css">

    <title>Consultar proveedores</title>
  </head>
  <body>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">
        <h1 class="display text-center" style="margin-top: -20px;">Consultar proveedores</h1>
        <br>
        
        <!-- Creacion de boton para exportaciones de la tabla -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Exportar BD
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="excel_proveedores.php">Exportar a Excel</a>
            <a class="dropdown-item" href="PDF/crear_pdf_proveedores.php">Exportar a PDF</a>
          </div>    
        </div>
      </div>
      
      <!-- Creacion de boton para acciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="float: right; margin-right: 30px;">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Acciones tabla
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <button class="dropdown-item" data-toggle="modal" data-target="#NuevoProveedorModal">Nuevo</button>
            <button class="dropdown-item" onclick="eliminar_todos_proveedores()">Eliminar Datos</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#EliminarDatosProveedoresPorModal">Eliminar Datos Por</button>
            <!-- <a class="dropdown-item" href="PDF/crear_pdf_usuario.php">Ver datos generales</a>-->
          </div>    
        </div>
      </div>

      <!-- Boton para eliminar -->
      <script type="text/javascript">
        function eliminar_todos_proveedores(){
          Swal.fire({
            title: '¿Estas seguro que quieres eliminar todos los datos de manera permanente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, los quiero eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "eliminar_todos_datos.php?tabla=proveedores";
            }
          })
        }
      </script>
      <!-- Fin -->

      <?php include('eliminar_proveedores_por.php')?>
      <?php include('registrar_proveedores.php')?>
      <br>
      <br>
    <table class="table table-responsive text-center table-bordered table-hover" id="tabla2">
      <thead class="thead-dark text-center">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Codigo postal</th>
          <th>Localidad</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Fecha registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
     <?php
          $query=mysqli_query($conexion,"SELECT * FROM proveedores");
          $result = mysqli_num_rows($query);

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['id']; ?></td>
                  <td><?php echo $data['nombre_proveedor']; ?></td>
                  <td><?php echo $data['direccion']; ?></td>
                  <td><?php echo $data['codigo_postal']; ?></td>
                  <td><?php echo $data['localidad']; ?></td>
                  <td><?php echo $data['telefono']; ?></td>
                  <td><?php echo $data['correo']; ?></td>
                  <td><?php echo $data['fecha_registro']; ?></td>
                  <td class="text-center" style="width: 100px;">
                  <button type='button' class='btn btn-danger' onclick="eliminar_proveedor('<?php echo $data['id'];?>')"><span><i class="fas fa-trash"></i></span></button>

                  <button type='button' class='btn btn-success' data-toggle="modal" data-target="#ActualizarProveedorModal<?php echo $data['id']; ?>"><span><i class="fas fa-pen"></i></span></button>
                  </td>
                </tr>
                <?php include('actualizar_proveedor.php')?>

                <!-- Boton para eliminar -->
                <script type="text/javascript">
                  function eliminar_proveedor(dato2){
                      Swal.fire({
                        title: '¿Estas seguro que quieres eliminar al proveedor?',
                        html:'<b style="font-size:30px;">'+dato2+'</b>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si, lo quiero eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "eliminar_proveedor.php?id="+dato2;
                        }
                      })
                  }
                  </script>
                <!-- Fin -->

            <?php }
          } else{
            //Si la BD esta vacia o no tiene informacion de ex alumnos con codigo activo en 2 no mostrara datos y dira lo siguiente 
            echo "<tr> <td colspan='9'> <center>Datos no disponibles/ Base de datos vacia.</center></td></tr>";
          }
      ?>
      </table>
  
    </div>
  <!--Fin de la tabla de Boostrap-->
    
    
</div>

<script type="text/javascript">

  function ProveedorCreado(){
          Swal.fire({
            icon: 'success',
            title: 'Proveedor registrado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

    function ProveedorRepetido2(){
          Swal.fire({
            icon: 'error',
            title: 'Proveedor Repetido...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

    function ProveedorRepetido(){
          Swal.fire({
            icon: 'error',
            title: 'ProveedorRepetido...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ProveedorFallido(){
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar el proveedor...',
            text: 'No se ha podido registrar el proveedor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ProveedoresFallidosDatos(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los proveedores...',
            text: 'No se ha podido eliminar los proveedores!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ProveedoresEliminadosVerificacion(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los proveedores...',
            text: 'No se ha podido eliminar los proveedores seleccionados, verifique sus datos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ProveedorEliminado(){
          Swal.fire({
            icon: 'success',
            title: 'Proveedor eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ProveedoresEliminadosPor(){
          Swal.fire({
            icon: 'success',
            title: 'Proveedores eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function TodosProveedoresEliminados(){
          Swal.fire({
            icon: 'success',
            title: 'Todos los proveedores se han eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }

      function ActualizacionProveedor(){
          Swal.fire({
            icon: 'success',
            title: 'El proveedor se ha actualizado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_proveedores.php";
            }
        })

      }
</script>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>