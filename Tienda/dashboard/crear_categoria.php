<!--Modal para la creación de categorias-->
<div class="modal fade" id="CrearCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa el nombre de la nueva categoria</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="accion_categoria.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <label style="font-size: 16px;"><b>Nombre de la categoria:</b></label>
                    <input type="text" class="form-control text-center" name="nombre_categoria" placeholder="Ingrese el nombre de la categoria" required>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="agregar_categoria">Crear</button>
            </div>
        </form>    
        </div>
    </div>
</div>  