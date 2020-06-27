<?php
session_start();
if($_SESSION['rol'] != 1)
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
    <title>Lista usuarios</title>
  </head>
  <body>
  <?php include "includes/header.php" ?>
  <?php 
  $busqueda =  strtolower($_REQUEST['busqueda']);
  if (empty($busqueda)){
      header("location: lista_usuario.php");
      mysqli_close($conection);
  }
  ?>
    <div class="container">
        <h1>Lista de usuarios </h1>
     <div class="container row">
     <form class="form-inline my-2 my-lg-0" action="buscar_usuario.php" method="get">
     <a href="registro_usuario.php" class="btn_new">Crea usuario</a>
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar usuario" aria-label="Search" name="busqueda" id="busqueda" value="<?php echo $busqueda;  ?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="buscar">Buscar</button>
      
    </form>
    </div>
    
<br>
<div class="table-responsive">
            <table class="table table-bordered  table-responsive-xl">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Rol</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <?php 
            
            //paginador
            $rol = '';
			if($busqueda == 'administrador')
			{
				$rol = " OR rol LIKE '%1%' ";

			}else if($busqueda == 'supervisor'){

				$rol = " OR rol LIKE '%2%' ";

			}else if($busqueda == 'vendedor'){

				$rol = " OR rol LIKE '%3%' ";
			}

            $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario 
                                                        WHERE ( idusuario LIKE '%$busqueda%' OR 
                                                                nombre LIKE '%$busqueda%' OR 
                                                                correo LIKE '%$busqueda%' OR 
                                                                usuario LIKE '%$busqueda%' 
                                                                $rol  ) 
                                                        AND estatus = 1  " );
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


            $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
            WHERE 
            ( u.idusuario LIKE '%$busqueda%' OR 
                u.nombre LIKE '%$busqueda%' OR 
                u.correo LIKE '%$busqueda%' OR 
                u.usuario LIKE '%$busqueda%' OR 
                r.rol    LIKE  '%$busqueda%' ) 
            AND
            estatus = 1 ORDER BY u.idusuario ASC LIMIT $desde,$por_pagina 
");
mysqli_close($conection);
            $result = mysqli_num_rows($query);
            if($result > 0 ){
                while ($data = mysqli_fetch_array($query)){
            ?>
            <tbody>
                <tr>
                <th scope="row"><?php echo $data['idusuario']; ?></th>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['correo']; ?></td>
                <td><?php echo $data['usuario']; ?></td>
                <td><?php echo $data['rol']; ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="link_edit">Editar </a>

                    <?php if($data['idusuario'] != 1){ ?>
                    |
                    <a href="eliminar_confirmar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="link_delete">Eliminar</a>
                <?php } ?>
                </td>
                </tr>  
            </tbody>
            <?php
        }
            }
            ?>
            </table>
            <?php    
            if($total_registro != 0){
            ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                <?php  
                
                if ($pagina != 1){                
               ?>
                    <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <?php
                    }
                    for($i=1; $i <= $total_paginas ; $i++){
                       
                        if($i == $pagina){
                            echo '<li class="page-item active"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pagina != $total_paginas){
                    ?>
                    <li class="page-item">
                    <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                <?php } ?>
                </ul>
            </nav>
         <?php } ?>

    </div>
    </div>
  <?php include "includes/footer.php" ?>
   </body>
</html>