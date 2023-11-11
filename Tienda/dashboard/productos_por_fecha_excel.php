<!--Modal para CRUD-->
<div class="modal fade" id="ProductosFechaEXCELModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa las fechas para el reporte</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="productos_por_fecha_excel2.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <label style="font-size: 16px;"><b>Fecha inicial:</b></label>
                    <input type="date" class="form-control text-center" name="fecha_inicial" placeholder="Ingrese la primera fecha" required>
                </div>
                <div class="form-group text-center">
                    <label style="font-size: 16px;"><b>Fecha final:</b></label>
                    <input type="date" class="form-control text-center" name="fecha_final" placeholder="Ingrese las ultima fecha" required>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="fecha">Ingresar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  