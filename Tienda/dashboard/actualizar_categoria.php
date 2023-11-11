<?php require_once "vistas/parte_superior.php"?>
<?php
  require_once '../conexion.php';

?>
<div class="container">
	
<!--Modal para CRUD-->
<div class="modal fade" id="ActualizarCategoriaModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<?php

    $id = $data['id'];

    $sql= "SELECT * FROM categorias WHERE id = {$id}";
    $result= $conex->query($sql);

    $data= $result->fetch_assoc();


	?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-success">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa el nuevo nombre de la categoria</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="actualizar_categoria2.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <label style="font-size: 16px;"><b>Nombre de la categoria:</b></label>
                    <input type="text" class="form-control text-center" name="nombre_categoria" placeholder="Ingrese el nombre de la categoria" value="<?php echo $data['nombre_categoria']?>" required>
                </div>          
            </div>
            <div class="col-lg-12">
            	<div class="form-group">
              		<input type="hidden" name="id" value="<?php echo $data['id']?>"/>
            	</div>
          	</div>
            <div class="modal-footer" style="margin-top: -15px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-success" name="agregar_categoria">Actualizar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

</div>