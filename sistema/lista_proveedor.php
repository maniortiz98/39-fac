<?php
session_start();


if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 )
{
  header("location: ../");
}
include "../conexion.php"
?>
<!doctype html>
<html lang="en">
<link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Lista Proveedor</title>
  </head>
  <body>
  <?php include "includes/header.php" ?>
    <div class="container">
        <h1>Lista Proveedores </h1>
     <div class="container row">
     <form class="form-inline my-2 my-lg-0" action="buscar_proveedor.php" method="get">
     <a href="registro_proveedor.php" class="btn_new">Crea Proveedor</a>
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar proveedor" aria-label="Search" name="busqueda" id="busqueda">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="buscar">Buscar</button>
      
    </form>
    </div>
    
<br>
<div class="table-responsive">
            <table class="table table-bordered  table-responsive-xl">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Proveedor</th>
                <th scope="col">contacto</th>
                <th scope="col">telefono</th>
                <th scope="col">Direccion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <?php 
            
            //paginador
            $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estatus = 1 " );
            $result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 3;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);


            $query = mysqli_query($conection, "SELECT * FROM proveedor
                                                    WHERE estatus = 1 ORDER BY codproveedor ASC LIMIT $desde,$por_pagina " );
            mysqli_close($conection);
            $result = mysqli_num_rows($query);
            if($result > 0 ){
                while ($data = mysqli_fetch_array($query)){

                    $formato = 'Y-m-d H:i:s';
                    $fecha = DateTime::createFromFormat($formato, $data['date_add']);

            ?>
            <tbody>
                <tr>
                <th scope="row"><?php echo $data['codproveedor']; ?></th>
                <td><?php echo $data['proveedor']; ?></td>
                <td><?php echo $data['contacto']; ?></td>
                <td><?php echo $data['telefono']; ?></td>
                <td><?php echo $data['direccion']; ?></td>
                <td><?php echo $fecha->format('d-m-Y'); ?></td>
                
                <td>
                    <a href="editar_proveedor.php?id=<?php echo $data['codproveedor']; ?>" class="link_edit">Editar </a>
                   
|
                    
                    <a href="eliminar_confirmar_proveedor.php?id=<?php echo $data['codproveedor']; ?>" class="link_delete">Eliminar</a>
          
                </td>
                </tr>  
            </tbody>
            <?php
        }
            }
            ?>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">

                <?php  
                
                if ($pagina != 1){                
               ?>
                    <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>

                    <?php
                    }
                    for($i=1; $i <= $total_paginas ; $i++){
                       
                        if($i == $pagina){
                            echo '<li class="page-item active"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pagina != $total_paginas){
                    ?>
                    <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                <?php } ?>
                </ul>
            </nav>
    </div>
    </div>
  <?php include "includes/footer.php" ?>
   </body>
</html>