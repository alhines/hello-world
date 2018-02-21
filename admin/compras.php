<?php include ('includes/header.php'); ?>
<?php include ('includes/sidebar.php'); ?>         
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Lista de Compras</h1>   
  <?php 
  $conn = connection();

  if($conn){
    $sql = "Select * from compras";
    $result = consulta($conn,$sql);
  }
  ?>
  
  <div class="container">
        <div class="row">           
            <div class="tabla-compras">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre Producto</td>
                            <td>Precio Producto</td>
                            <td>Cantidad Producto</td>
                            <td>Fecha Compra</td>
                            <td>Monto Total</td>
                            <td>Nombre Cliente</td>
                            <td>Email Cliente</td>                                                       
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        while($row = $result->fetch_assoc()) {
							
							$sql = "Select * from productos where id = ".$row['id_producto'];
                            $result_producto = consulta($conn,$sql);
							$row_producto = $result_producto->fetch_assoc();							
							
                            echo '<tr><td>' . $row['id'] . '</td><td>'. $row_producto['nombre'] . '</td><td>'. $row_producto['precio']. '</td><td>'. $row['cantidad_producto']. '</td><td>'. $row['fecha_compra'].'</td><td>'. $row['monto_total'].'</td><td>'. $row['nombre_cliente'].'</td><td>'. $row['correo_cliente'].'</td></tr>';
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>   
    
              
</div> 
<?php close_db($conn); ?>       
<?php include ('includes/footer.php'); ?>