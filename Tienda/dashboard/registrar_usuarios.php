<!--Modal para CRUD-->
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');

?>
<div class="modal fade" id="NuevoUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Registrar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="accion_usuario.php" class="text-center" method="POST">    
            <div class="modal-body" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Nombre completo:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre Completo" name="name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Nombre del usuario:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre de usuario" name="username" required>
                       </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Contraseña:</b></label>
                            <input type="password" class="form-control text-center" placeholder="Contraseña" name="password" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Correo:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Correo" name="correo" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Rol:</b></label>
                            <select name="rol" id="servicio" class="form-control text-center" class="form-control" placeholder="Rol">
                                <option>Rol: </option>
                                <option>Administrador</option>
                                <option>Cajero</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="reg_user">Registrar</button>
            </div>
        </form>
        </div>
    </div>
</div>  