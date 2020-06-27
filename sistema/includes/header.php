
<?php 


if($_SESSION['rol'] != 1)
{
  header("location: ../");
}
?>



<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="img/256.png" class="img-fluid" alt="Responsive image" width="30px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
      </li>

      <?php   
      
      if($_SESSION['rol'] == 1){
 
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuario
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_usuario.php">Nuevo Usuario</a>
          <a class="dropdown-item" href="lista_usuarios.php">Lista de Usuarios</a>
          
        </div>
      </li>
    <?php } ?>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Clientes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_cliente.php">Nuevo Cliente</a>
          <a class="dropdown-item" href="lista_clientes.php">Lista de Clientes</a>
        </div>
    </li>
    <?php   
      
      if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
 
      ?>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Proveedores
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_proveedor.php">Nuevo Proveedor</a>
          <a class="dropdown-item" href="lista_proveedor.php">Lista Proveedor</a>
        </div>
    </li>
    <?php } ?>
    <?php   
      
      if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
 
      ?>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="registro_producto.php">Nuevo Producto</a>
          <a class="dropdown-item" href="lista_producto.php">Lista de Producto</a>
        </div>
    </li>
    <?php } ?>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Facturas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Nuevo Factura</a>
          <a class="dropdown-item" href="#">Facturas</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Sistema de Facturación </a>
      </li>
	</ul>
	   
        <a class="nav-link disabled" href="#">Mani Ortiz </a>
        
    
	<a href="salir.php" href=""><img class="close" src="img/1.svg" alt="Salir del sistema" title="Salir" width="30px" ></a>
  </div>
</nav>
<p class="nav-link disabled">México <?php echo fechaC() ?>  <span><?php echo $_SESSION['user'].' -'.$_SESSION['rol'].' -'.$_SESSION['email'] ;  ?> </span></p> 
</div>
