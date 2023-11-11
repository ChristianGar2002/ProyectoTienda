<?php
  require_once '../conexion.php';
  
?>

<div class="modal fade" id="ActualizarUsuarioModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<?php
    $id = $data['id'];

    $sql2= "SELECT * FROM usuarios WHERE id = {$id}";
    $result2= $conex->query($sql2);

    $data2= $result2->fetch_assoc();

?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-success" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Actualizar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="actualizar_usuario2.php" class="text-center" method="POST">    
            <div class="modal-body" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Nombre completo:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre Completo" name="name" value="<?php echo $data2['name']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Nombre del usuario:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre de usuario" name="username" value="<?php echo $data2['username']?>" required>
                       </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Contraseña:</b></label>
                            <input type="password" class="form-control text-center" placeholder="Contraseña" name="password" value="<?php echo $data2['password']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Correo:</b></label>
                            <input type="text" class="form-control  text-center" placeholder="Correo" name="correo" value="<?php echo $data2['correo']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Rol:</b></label>
                            <select name="rol" id="servicio" class="form-control text-center" class="form-control" placeholder="Rol">
                                <option value="<?php echo $data2['rol']?>">Rol: </option>
                                <option>Administrador</option>
                                <option>Cajero</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $data['id']?>"/>
                        </div>  
                </div>          
            </div>
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-success" name="act_user">Actualizar</button>
            </div>
        </form>
        </div>
    </div>
</div>  