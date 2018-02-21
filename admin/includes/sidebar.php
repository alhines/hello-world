<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li <?php if(contains(curPageURL(),"dashboard.php")){ ?> class="active" <?php } ?>><a href="dashboard.php">Home</a></li>
    <li <?php if(contains(curPageURL(),"productos.php")){ ?> class="active" <?php } ?>><a href="productos.php">Productos</a></li>
    <li <?php if(contains(curPageURL(),"usuarios.php")){ ?> class="active" <?php } ?>><a href="usuarios.php">Usuarios</a></li>
    <li <?php if(contains(curPageURL(),"compras.php")){ ?> class="active" <?php } ?>><a href="compras.php">Compras</a></li>
  </ul>
</div>
