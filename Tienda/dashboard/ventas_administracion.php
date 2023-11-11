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

    <title>Ver ventas</title>
  </head>
  <body>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">

        <h1 class="display text-center" style="margin-top: -20px;">Ventas realizadas</h1>
        <br>
        
      <!-- Creacion de boton para exportaciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Exportar BD
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="excel_ventas.php">Exportar a Excel</a>
            <a class="dropdown-item" href="PDF/crear_pdf_ventasT.php">Exportar a PDF</a>
            <button class="dropdown-item" data-toggle="modal" data-target="#VentasFechaEXCELModal">Ventas por fecha Excel</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#VentasFechaPDFModal">Ventas por fecha PDF</button>
          </div>    
        </div>
      </div>
      <?php include('ventas_por_fecha_pdf.php')?>
      <?php include('ventas_por_fecha_excel.php')?>
      
      <!-- Creacion de boton para acciones de la tabla -->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="float: right; margin-right: 30px;">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Acciones tabla
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="ventas.php">Nuevo</a>
            <button class="dropdown-item" onclick="eliminar_todas_ventas()">Eliminar datos</button>
            <button class="dropdown-item" data-toggle="modal" data-target="#EliminarPorVentaModal">Eliminar por fecha</button>
          </div>    
        </div>
      </div>

      <!-- Boton para eliminar -->
      <script type="text/javascript">
        function eliminar_todas_ventas(){
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
              window.location.href = "eliminar_todos_datos.php?tabla=ventas";
            }
          })
        }
      </script>
      <!-- Fin -->

      <?php include('eliminar_venta_por.php')?>
      <br>
      <br>
   <table class="table table-responsive text-center table-bordered table-hover" id="tabla2">
      <thead class="thead-dark text-center">
        <tr>
          <th width="80%">Venta</th>
          <th width="100%">Fecha de registro</th>
          <th width="100%">Acciones</th>
        </tr>
      </thead>
     <?php
          $query=mysqli_query($conexion,"SELECT DISTINCT id_venta, fecha_registro FROM ventas WHERE ACTIVO=2");
          $result = mysqli_num_rows($query);

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td>Venta-<?php echo $data['id_venta']; ?></td>
                  <td><?php echo $data['fecha_registro']; ?></td>
                  <td class="text-center" style="width: 100px;">
                  <button type='button' class='btn btn-danger' onclick="eliminar_venta('<?php echo $data['id_venta'];?>')"><span><i class="fas fa-trash"></i></span></button>
                  <a href="PDF/venta_individual.php?id_venta=<?php echo $data['id_venta']; ?>"class="btn btn-warning"><span><i class="fas solid fa-file"></i></span></a>
                  </td>
                </tr>
                
                <!-- Boton para eliminar -->
                <script type="text/javascript">
                  function eliminar_venta(dato2){
                      Swal.fire({
                        title: '¿Estas seguro que quieres eliminar la venta?',
                        html:'<b style="font-size:30px;">'+dato2,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si, lo quiero eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {

                          window.location.href = "eliminar_venta.php?id_venta="+dato2;
                        }
                      })
                  }
                  </script>
                <!-- Fin -->

            <?php }
          } else{
            //Si la BD esta vacia o no tiene informacion de ex alumnos con codigo activo en 2 no mostrara datos y dira lo siguiente 
            echo "<tr> <td colspan='3'> <center>Datos no disponibles/ Base de datos vacia.</center></td></tr>";
          }
      ?>
      </table>
  
    </div>
  <!--Fin de la tabla de Boostrap-->
    
    
</div>

<script type="text/javascript">

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

  function VentasEliminadasPor(){
          Swal.fire({
            icon: 'success',
            title: 'Ventas eliminada exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }

    function VentasFallidosDatos(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar las ventas...',
            text: 'No se ha podido eliminar las ventas!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }

    function VentasEliminadosVerificacion(){
          Swal.fire({
            icon: 'error',
            title: 'Error al eliminar las ventas..',
            text: 'No se ha podido eliminar las ventas seleccionadas, verifique sus datos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }

    function TodasVentasEliminadas(){
          Swal.fire({
            icon: 'success',
            title: 'Todos las ventas se han eliminado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ventas_administracion.php";
            }
        })

      }
</script>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>