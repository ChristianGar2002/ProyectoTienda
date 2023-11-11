<div class="modal fade" id="RecuperarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Ingresa la clave de recuperación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="../dashboard/recuperacion2.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <input type="text" class="form-control text-center" style="padding-left: 0px;" name="clave_recuperacion" placeholder="Ingrese la clave recuperación" required>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="recuperar_contra">Ingresar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  