<!--Modal para CRUD-->
<div class="modal fade" id="EliminarPorVentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Introduce la fecha, para eliminar las ventas</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="eliminar_venta_por2.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <label style="font-size: 16px;"><b>Fecha de registro:</b></label>
                    <input type="text" class="form-control text-center" name="valor" placeholder="Ingresa la fecha correspondiente" required>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-danger">Eliminar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  