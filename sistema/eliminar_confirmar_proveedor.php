
<?php

session_start();
if($_SESSION['rol'] != 1 AND $_SESSION['rol'] != 1)
{
  header("location: ../");
}

	
	include "../conexion.php";
	if(!empty($_POST))
	{
		if(empty($_POST['idproveedor'])){
            header("location: lista_proveedor.php");
            mysqli_close($conection);
        }
		$idproveedor = $_POST['idproveedor'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_proveedor.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) )
	{
		header("location: lista_proveedor.php");
		mysqli_close($conection);
	}else{

		$idproveedor = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE codproveedor = $idproveedor ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
                # code...
                $proveedor = $data['proveedor'];				
			}
		}else{
			header("location: lista_proveedor.php");
		}


	}




?>


<!doctype html>
<html lang="en">
<link rel="stylesheet" href="css/style1.css">
  <head>
    <?php include "includes/scripts.php" ?>
    <title>Eliminar proveedor</title>
  </head>
  <body>

  <?php include "includes/header.php" ?>
<div class="container">
<h1>Eliminar proveedor</h1>
<div class="data_delete">
    <h2>¿Esta seguro que desea eliminar el proveedor?</h2>
    <p>Nombre del proveedor: <span><?php echo $proveedor; ?></span> </p>
    
    

    <form method="post" action="">
        <div class="row">
            <div class="col">
            
           <!--<input type="submit" href="lista_usuarios.php" class="form-control btn_cancel" placeholder="First name" value="Cancelar">
            <a href="lista_usuarios.php" class="btn_cancel form-control">Cancelar</a>
            </div>
            <div class="col">
            <input type="submit" class="form-control btn_ok" placeholder="Last name" value="Aceptar" >-->
            <input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<a href="lista_proveedor.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
            
            </div>
        </div> 
   </form>
</div>
</div>

 
  <?php include "includes/footer.php" ?>
   </body>
</html>