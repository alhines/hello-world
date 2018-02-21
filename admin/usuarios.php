<?php include ('includes/header.php'); ?>
<?php include ('includes/sidebar.php'); ?>         
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Lista de Usuarios</h1>   
  <?php 
  $conn = connection();

  if($conn){
    $sql = "Select * from usuarios";
    $result = consulta($conn,$sql);
  }
  ?>
  
  <div class="container">
        <div class="row">            
            <a href="#" class="btn btn-default" id="agregar-usuario">Agregar</a>
            <div class="tabla-usuarios">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td>Editar</td>
                            <td>Borrar</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        while($row = $result->fetch_assoc()) {
                            echo '<tr><td>' . $row['id'] . '</td><td>'. $row['nombre'] . '</td><td>'. $row['email']. '</td><td>'. $row['password'].'</td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default editar-usuario">Editar</a></td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default eliminar-usuario">Borrar</a></td></tr>';
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="form-agregar-usuario" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar Usuario</h4>
          </div>
          <div class="modal-body">
            <p>Llene los campos</p>

            <form>
                <div class="form-group has-error">
                    <label class="control-label" for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre-usuario" class="form-control" required>
                </div>
                <div class="form-group has-error">
                    <label class="control-label" for="email">Email</label>
                    <input type="text" name="email" id="email-usuario" class="form-control" required>
                </div>
                <div class="form-group has-error">
                    <label class="control-label" for="password">Password</label>
                    <input type="text" name="password" id="password-usuario" class="form-control" required>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="guardar-usuario">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="form-editar-usuario" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div class="modal-body">
            <p>Llene los campos</p>

            <form>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre-usuario" class="form-control" required="yes">
                </div>
                <div class="form-group">
                    <label for="telefono">Email</label>
                    <input type="text" name="email" id="email-usuario" class="form-control" required="yes">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password-usuario" class="form-control" required="yes">
                </div>
                <input type="hidden" name="codigo" id="codigo-usuario">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="editar-usuario">Editar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
          
</div> 
<?php close_db($conn); ?>       
<?php include ('includes/footer.php'); ?>