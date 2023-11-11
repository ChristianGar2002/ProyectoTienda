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

    <title>Consultar productos vendidos</title>
  </head>
  <body>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">

        <h1 class="display text-center" style="margin-top: -20px;">Productos vendidos</h1>
        <br>
      <!-- Creacion de boton para exportaciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Exportar BD
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="excel_productos_vendidos.php">Exportar a Excel</a>
            <a class="dropdown-item" href="PDF/crear_pdf_productos_vendidos.php">Exportar a PDF</a>
            <button class="dropdown-item" data-toggle="modal" data-target="#ProductosVendidosFechaEXCELModal">Reporte por fecha Excel</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#ProductosVendidosFechaPDFModal">Reporte por fecha PDF</button>
          </div>    
        </div>
      </div>
      <?php include('productos_vendidos_por_fecha.php')?>
      <?php include('productos_vendidos_por_fecha_pdf.php')?>
      <!-- Creacion de boton para acciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="float: right; margin-right: 30px;">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Acciones tabla
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="ventas.php">Nuevo</a>
            <button class="dropdown-item" onclick="eliminar_todos_productos_vendidos()">Eliminar datos</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#EliminarDatosPorModal">Eliminar Datos Por</button>
          </div>    
        </div>
      </div>
      <?php include('eliminar_productos_vendidos_por.php')?>
      <!-- Boton para eliminar -->
      <script type="text/javascript">
        function eliminar_todos_productos_vendidos(){
          Swal.fire({
            title: '¿Estas seguro que quieres eliminar todos los productos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, los quiero eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "eliminar_todos_datos.php?tabla=productos_vendidos";
            }
          })
        }
      </script>
      <!-- Fin -->
      <br>
      <br>
   <table class="table table-responsive text-center table-bordered table-hover" id="tabla2">
      <thead class="thead-dark text-center">
        <tr>
          <th>Id de venta</th>
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Fecha de registro</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <?php 
      //Funcion para el formato de precios y totales

      function SetCurrency(float $valor, string $signo='$'):string
      {
        return $signo.number_format($valor,2, '.','');
      }

      ?>

     <?php
          $query=mysqli_query($conexion,"SELECT * FROM productos_vendidos");
          $result = mysqli_num_rows($query);

          $total=0;

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td width="5%"><?php echo $data['id_venta']; ?></td>
                  <td width="15%"><?php echo $data['codigo']; ?></td>
                  <td width="25%"><?php echo $data['descripcion']; ?></td>
                  <td width="10%"><?php echo $data['precio']; ?></td>
                  <td width="10%"><?php echo $data['cantidad']; ?></td>
                  <?php 
                    $total=$data['precio']*$data['cantidad'];
                  ?>
                  <td width="5%"><?php echo SetCurrency($total); ?></td>
                  <td width="12%"><?php echo $data['fecha_registro']; ?></td>
                  <td class="text-center" width="13%">
                  <button type='button' class='btn btn-danger' onclick="eliminar_usuario('<?php echo $data['id_venta'];?>','<?php echo $data['codigo'];?>')"><span><i class="fas fa-trash"></i></span></button>
                  <!--<button type='button' class='btn btn-success' data-toggle="modal" data-target="#ActualizarUsuarioModal<?php// echo $data['id_venta']; ?>"><span><i class="fas fa-pen"></i></span></button>-->
                  </td>
                </tr>

                <!-- Boton para eliminar -->
                <script type="text/javascript">
                  function eliminar_usuario(dato2, dato3){
                      Swal.fire({
                        title: '¿Estas seguro que quieres eliminar al producto?',
                        html:'<b style="font-size:30px;">'+dato3+'</b>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si, lo quiero eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "eliminar_producto_vendido.php?id_venta="+dato2+"&codigo="+dato3;
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

  function ProductosVendidosEliminadosPor(){
          Swal.fire({
            icon: 'success',
            title: 'Productos eliminados exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "productos_vendidos.php";
            }
        })

      }

  function UsuarioRepetido(){
          Swal.fire({
            icon: 'error',
            title: 'Usuario Repetido...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_usuarios.php";
            }
        })

      }

  function UsuarioFallido(){
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar al usuario...',
            text: 'No se ha podido registrar el usuario!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_usuarios.php";
            }
        })

      }

  function ProductosVendidosFallidosDatos(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los productos...',
            text: 'No se ha podido eliminar los productos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "productos_vendidos.php";
            }
        })

      }

  function ProductoVendidoEliminado(){
          Swal.fire({
            icon: 'success',
            title: 'Producto eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "productos_vendidos.php";
            }
        })

      }

  function TodosProductosVendidos(){
          Swal.fire({
            icon: 'success',
            title: 'Todos los productos se han eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "productos_vendidos.php";
            }
        })

      }

  function UsuariosEliminadosExistencia(){
          Swal.fire({
            icon: 'error',
            title: 'Ya no existen usuarios cajeros',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_usuarios.php";
            }
        })

      }

  function ProductosVendidosEliminadosVerificacion(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los productos...',
            text: 'No se ha podido eliminar los productos seleccionados, verifique sus datos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "productos_vendidos.php";
            }
        })

      }
</script>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>