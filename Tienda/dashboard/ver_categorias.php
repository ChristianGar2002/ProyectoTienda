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
    
    <title>Consultar Categorias</title>
  </head>
  <body>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">
        <h1 class="display text-center" style="margin-top: -20px;">Consultar categorias</h1>
        <br>

        <!-- Creacion de boton para exportaciones de la tabla -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
          <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
            Exportar BD
          </button>
          <div class="dropdown-menu" aria-labelledby="btn-GroupDrop1">
            <a class="dropdown-item" href="excel_categorias.php">Exportar a Excel</a>
            <a class="dropdown-item" href="PDF/crear_pdf_categorias.php">Exportar a PDF</a>
          </div>    
        </div>
      </div>
      
      <!-- Creacion de boton para acciones de la tabla -->
      <button style="float: right; margin-right: 50px;" type='button' class='btn btn-primary' data-toggle="modal" data-target="#CrearCategoriaModal"><span><i class="fa solid fa-plus"></i> Nuevo</span></button>

      <?php include('crear_categoria.php')?>
      <br>
      <br>
    <table class="table table-responsive text-center table-bordered table-hover" id="tabla2">
      <thead class="thead-dark text-center">
        <tr>
          <th>ID</th>
          <th>Categoría</th>
          <th>Fecha de registro</th>
          <th>Acciones</th>
        </tr>
      </thead>
     <?php
          $query=mysqli_query($conexion,"SELECT * FROM categorias");
          $result = mysqli_num_rows($query);

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td width="15%"><?php echo $data['id']; ?></td>
                  <td width="43%"><?php echo $data['nombre_categoria']; ?></td>
                  <td width="22%"><?php echo $data['fecha_registro']; ?></td>
                  <td class="text-center" style="width: 300px;">
                  <button type='button' class='btn btn-danger' onclick="eliminar_categoria('<?php echo $data['id'];?>')"><span><i class="fas fa-trash"></i></span></button>

                  <button type='button' class='btn btn-success' data-toggle="modal" data-target="#ActualizarCategoriaModal<?php echo $data['id']; ?>" ><span><i class="fas fa-pen"></i></span></button>
                  </td>
                </tr>
                <?php include('actualizar_categoria.php')?>

                <!-- Boton para eliminar -->
                <script type="text/javascript">
                  function eliminar_categoria(dato2){
                      Swal.fire({
                        title: '¿Estas seguro que quieres eliminar a la categoria?',
                        html:'<b style="font-size:30px;">'+dato2+'</b>',
                        icon: 'warning',
                        footer: '<b style="font-size:15px;"> Al eliminar la categoria también se eliminaran los productos que esten con vinculados</b>',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si, lo quiero eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "eliminar_categoria.php?id="+dato2;
                        }
                      })
                  }
                  </script>
                <!-- Fin -->

            <?php }
          } else{
            //Si la BD esta vacia o no tiene informacion de ex alumnos con codigo activo en 2 no mostrara datos y dira lo siguiente 
            echo "<tr> <td colspan='4'> <center>Datos no disponibles/ Base de datos vacia.</center></td></tr>";
          }
      ?>
      </table>
  
    </div>
  <!--Fin de la tabla de Boostrap-->
    
    
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function CategoriaRepetida(){
          Swal.fire({
            icon: 'error',
            title: 'Categoria Repetida...',
            text: 'Intente nuevamente, por favor!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_categorias.php";
            }
        })

      }

    function CategoriaCreada(){
          Swal.fire({
            icon: 'success',
            title: 'Categoria creada exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_categorias.php";
            }
        })

      }

      function CategoriaFallida(){
          Swal.fire({
            icon: 'error',
            title: 'Error al registrar categoria...',
            text: 'No se ha podido registrar la categoria!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_categorias.php";
            }
        })

      }

      function EliminacionCategoria(){
          Swal.fire({
            icon: 'success',
            title: 'Categoria eliminada exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_categorias.php";
            }
        })

      }

      function ActualizacionCategoria(){
          Swal.fire({
            icon: 'success',
            title: 'La categoria se ha actualizado exitosamente',
            confirmButtonColor:'#3085d6',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "ver_categorias.php";
            }
        })

      }
</script>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>