<?php
session_start();
include "admin/includes/libreria.php";
$conn = connection();

if($conn){
   $sql = "Select * from productos";
   $result = consulta($conn,$sql);
}	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="admin/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
        
            <?php if( isset($_GET["retorno"]) && !empty($_GET["retorno"]) && $_GET["retorno"] == 1 ) { ?>
          <h3 style="color:#F00;">Error: Debe escoger al menos un producto.</h3>
            <?php } ?>
        
            <h1>Lista de Productos <a href="#" class="btn btn-default" id="mostrar-compra"><img src="images/cart.png" width="50" height="50"></a></h1>           
            <div class="tabla-contenido">
              <form name="productos" id="productos" method="post" action="actualizar-compra.php">  
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Producto</td>
                            <td>Precio Unitario</td>
                            <td>Cantidad</td>                            
                            <td>Seleccionar</td>                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					    $i=0;
						$cant = 0;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>                              
                              <td><?php echo $row['id']; ?></td>
                              <td><?php echo $row['nombre']; ?></td>
                              <td><?php echo "$".$row['precio']; ?></td>
                              <td>                              
                              <div class="form-group has-error">
                                
                                <input type="hidden" name="id<?php echo $i; ?>" value="<?php echo $i; ?>">
                                <input type="hidden" name="idproducto<?php echo $i; ?>" value="<?php echo $row['id'];?>">                            <input type="hidden" name="nombre<?php echo $i; ?>" value="<?php echo $row['nombre'];?>">                            <input type="hidden" name="precio<?php echo $i; ?>" value="<?php echo $row['precio'];?>">
                                                                                                    
                                <select name="cantidad<?php echo $i; ?>">
                                   <?php for($j=1;$j<=10;$j++){ ?>							   
                                       <option value="<?php echo $j; ?>" <?php if( isset($_SESSION["productos_seleccionados"][$i]["id"]) && !empty($_SESSION["productos_seleccionados"][$i]["id"]) && $_SESSION["productos_seleccionados"][$i]["id"] == $row['id'] && $_SESSION["productos_seleccionados"][$i]["cantidad"] == $j) { ?> selected <?php } ?>><?php echo $j; ?></option>                 
                                   <?php } ?>		    	
			                    </select>
                              </div>                             
                              </td>                              
                              <td>
                              <div class="form-group has-error">
                                <input name="producto<?php echo $i; ?>" type="checkbox" <?php if( isset($_SESSION["productos_seleccionados"][$i]["id"]) && !empty($_SESSION["productos_seleccionados"][$i]["id"]) && $_SESSION["productos_seleccionados"][$i]["id"] == $row['id']) { ?> checked <?php } ?>>														
                              </div>
                              </td>                              
                            </tr>                                
                    <?php $i++;$cant++; } ?>
                    </tbody>
                </table>
                <input type="hidden" name="cantidad_productos" value="<?php echo $cant; ?>">
                <button type="submit" class="btn btn-default">Actualizar</button>
                </form>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="form-comprar" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Productos Seleccionados</h4>
          </div>
          <div class="modal-body">
          
          <table class="table table-hover" border="1" cellpadding="0" cellspacing="0">
              <thead>
                 <tr>
                    <td nowrap><strong>ID Producto</strong></td>
                    <td nowrap><strong>Nombre</strong></td>
                    <td nowrap><strong>Precio</strong></td>
                    <td nowrap><strong>Cantidad</strong></td>
                    <td align="right" nowrap><strong>Monto Total</strong></td>                                                
                 </tr>
              </thead>
              <tbody>
              <?php
			  $gran_total = 0;
			  foreach ($_SESSION["productos_seleccionados"] as $producto) { 
			        $monto_total = 0;	
	                $monto_total = $producto["precio"] * $producto["cantidad"];
					$gran_total += $monto_total;
			  ?>
              <tr>                              
                    <td><?php echo $producto["id"]; ?></td>
                    <td><?php echo $producto["nombre"]; ?></td>
                    <td>$<?php echo $producto["precio"]; ?></td>
                    <td><?php echo $producto["cantidad"]; ?></td>
                    <td align="right">$<?php echo $monto_total; ?></td>
              </tr>
              <?php } ?>
              <tr>
                    <td><strong>Gran Total:</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right">$<?php echo $gran_total; ?></td>                                               
              </tr>
              </tbody> 
            </table>
            <br>          
            <p><strong>Incluya su informacion:</strong></p>
            <form>
                <div class="form-group has-error">
                    <label class="control-label" for="nombre"><strong>Nombre</strong></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group has-error">
                    <label class="control-label" for="email"><strong>Email</strong></label>
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="comprar">Realizar Compra</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>   
    
    <div class="modal fade" id="compra-realizada" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Compra Realizada</h4>
          </div>
          <div class="modal-body">
            <h4>Gracias. Su compra fue realizada en forma exitosa!!!</h4>           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>          
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>   
   
    </div><!-- /.modal -->
    <?php close_db($conn); ?>
    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

     <!-- Latest compiled and minified JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
     <script type="text/javascript" src="admin/js/script.js"></script>
   
</body>
</html>