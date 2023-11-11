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
    <br>
    <title>Consultar productos</title>
  </head>
  <body>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">
        <h1 class="display text-center" style="margin-top: -40px;">Consultar productos</h1>
        <br>
        
        <!-- Creacion de boton para exportaciones de la tabla -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Exportar BD
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="excel_productos.php">Exportar a Excel</a>
            <a class="dropdown-item" href="PDF/crear_pdf_productos.php">Exportar a PDF</a>
            <button class="dropdown-item" data-toggle="modal" data-target="#ProductosFechaEXCELModal">Reporte por fecha EXCEL</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#ProductosFechaPDFModal">Reporte por fecha PDF</button>
          </div>    
        </div>
      </div>
      <?php include('productos_por_fecha_excel.php')?>
      <?php include('productos_por_fecha_pdf.php')?>

      <!-- Creacion de boton para acciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="float: right; margin-right: 30px;">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Acciones tabla
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <button class="dropdown-item" data-toggle="modal" data-target="#NuevoProductoModal">Nuevo</button>
            <button class="dropdown-item" onclick="eliminar_todos_productos()">Eliminar Datos</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#EliminarDatosPorModal">Eliminar Datos Por</button>
          </div>    
        </div>
      </div>
      
      <!-- Boton para eliminar -->
      <script type="text/javascript">
        function eliminar_todos_productos(){
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
              window.location.href = "eliminar_todos_datos.php?tabla=productos";
            }
          })
        }
      </script>
      <!-- Fin -->

      <?php include('eliminar_productos_por.php')?>
      <?php include('registrar_productos.php')?>
      <br>
      <br>
    <table class="table table-responsive text-center table-bordered table-hover" id="tabla2">
      <thead class="thead-dark text-center">
        <tr>
          <th>Codigo</th>
          <th>Descripción</th>
          <th>Precio compra</th>
          <th>Precio venta</th>
          <th>Cantidad</th>
          <th>Proveedor</th>
          <th>Categoria</th>
          <th>Fecha de registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
     <?php
          $query=mysqli_query($conexion,"SELECT * FROM productos WHERE ACTIVO = 1");
          $result = mysqli_num_rows($query);

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>

            <tr>
                  <td><?php echo $data['codigo_producto']; ?></td>
                  <td><?php echo $data['descripcion_producto']; ?></td>
                  <td><?php echo $data['precio_compra']; ?></td>
                  <td><?php echo $data['precio_venta']; ?></td>
                  <td><?php echo $data['cantidad']; ?></td>
                  <td><?php echo $data['proveedor']; ?></td>

            <?php $data2=$data['categoria_id']; ?>

            <?php 
              $query2=mysqli_query($conexion,"SELECT * FROM categorias WHERE id = '$data2'");
            $result2 = mysqli_num_rows($query2);

            if($result2 > 0){ 
           while ($data3 = mysqli_fetch_assoc($query2)) { ?>

                
                  <td><?php echo $data3['nombre_categoria']; ?></td>
                <?php }
              }?>
                  <td><?php echo $data['fecha_registro']; ?></td>
                  <td class="text-center" style="width: 100px;">
                  <button type='button' class='btn btn-danger' onclick="eliminar_producto('<?php echo $data['codigo_producto'];?>')"><span><i class="fas fa-trash"></i></span></button>
                  <button type='button' class='btn btn-success' data-toggle="modal" data-target="#ActualizarProductoModal<?php echo $data['codigo_producto']; ?>"><span><i class="fas fa-pen"></i></span></button>
                  <?php require('actualizar_producto.php')?>
                  </td>
                </tr>

                <!-- Boton para eliminar -->
                <script type="text/javascript">
                  function eliminar_producto(dato2){
                      Swal.fire({
                        title: '¿Estas seguro que quieres eliminar este producto?',
                        html:'<b style="font-size:30px;">'+dato2+'</b>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si, lo quiero eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "eliminar_productos.php?codigo_producto="+dato2;
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
<?php 
//Datos generales
$sql2="SELECT * FROM productos WHERE ACTIVO='1'";
if ($result2=mysqli_query($conexion,$sql2)) {
    $rowcount=mysqli_num_rows($result2); 
}
?>
<script type="text/javascript">
function DatosGenerales(){
          Swal.fire({
            icon: 'success',
            title:'Datos Generales',
            html:'<b>Cantidad de registros:</b> <?php echo $rowcount; ?>',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

  function ProductoCreado(){
          Swal.fire({
            icon: 'success',
            title: 'Producto creado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

    function ProductoRepetido2(){
          Swal.fire({
            icon: 'error',
            title: 'Producto Repetido...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

    function ProductoRepetido(){
          Swal.fire({
            icon: 'error',
            title: 'Producto Repetido...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ProductoFallido(){
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar el producto...',
            text: 'No se ha podido registrar el producto!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ProductosFallidosDatos(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los productos...',
            text: 'No se ha podido eliminar los producto!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ProductosEliminadosVerificacion(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar los productos...',
            text: 'No se ha podido eliminar los producto seleccionados, verifique sus datos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ProductoEliminado(algo){
          Swal.fire({
            icon: 'success',
            title: 'Producto eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ProductosEliminadosPor(){
          Swal.fire({
            icon: 'success',
            title: 'Productos eliminados exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function TodosProductosEliminados(){
          Swal.fire({
            icon: 'success',
            title: 'Todos los productos se han eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }

      function ActualizacionProducto(){
          Swal.fire({
            icon: 'success',
            title: 'El producto se ha actualizado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_productos.php";
            }
        })

      }
</script>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>